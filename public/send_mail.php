<?php 
require('/../vendor/autoload.php');
/* =========================
   Environnement et erreurs // on ffiche les erreurs en local, et on les log en prod
========================= */

$appEnv = getenv('APP_ENV') ?: 'prod';

if ($appEnv === 'local') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
}

/* =========================
   Session + CSRF
========================= */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* =========================
   Charger .env local si existe
========================= */

if (file_exists(__DIR__ . '/.env.local')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

/* =========================
   Anti-spam / rate limit
========================= */

if (!isset($_SESSION['last_submit'])) {
    $_SESSION['last_submit'] = time();
} elseif (time() - $_SESSION['last_submit'] < 10) {
    exit(json_encode(["status"=>"error","message"=>"Trop rapide"]));
}
$_SESSION['last_submit'] = time();

/* =========================
   CORS sécurisé multi-sous-domaines
========================= */

$allowedRoot = 'votreartisanpro.fr';
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$originHost = parse_url($origin, PHP_URL_HOST) ?: '';

// On vérifie si l'origine finit par notre domaine (ex: ypria.votreartisanpro.fr)
if ($originHost === $allowedRoot || str_ends_with($originHost, '.' . $allowedRoot)) {
    // CRUCIAL : On renvoie l'origine exacte qui a fait la requête
    header("Access-Control-Allow-Origin: $origin");
    header("Access-Control-Allow-Credentials: true");
    header("Vary: Origin");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, X-CSRF-Token, X-Requested-With");
} else {
    // Si on est ici, le navigateur bloquera la requête
    header("Content-Type: application/json");
    echo json_encode(["status" => "error", "message" => "Origine non autorisée : $originHost"]);
    exit;
}

// Toujours répondre 204 aux requêtes OPTIONS (Preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

/* =========================
   Méthode POST uniquement
========================= */

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Méthode non autorisée"]);
    exit;
}

/* =========================
   Honeypot anti-spam
========================= */

if (!empty($_POST["website"])) {
    echo json_encode(["status" => "error", "message" => "Spam détecté"]);
    exit;
}

/* =========================
   Extraire sous-domaine
========================= */

function getSubdomainLabel(string $host, string $root): string {
    $host = strtolower(trim($host));
    $host = preg_replace('/:\d+$/', '', $host); 

    if ($host === $root) return 'root';
    if (!str_ends_with($host, '.' . $root)) return 'null';

    // 1. On récupère tout ce qui est avant "votreartisanpro.fr"
    // Ex: "ypria.preprod" ou "proprios" ou "ypria"
    $subPart = substr($host, 0, -1 - strlen($root));
    $labels = explode('.', $subPart);

    // 2. On définit les mots-clés techniques à ignorer pour trouver l'artisan
    $technicalKeywords = ['preprod', 'test', 'www'];

    // 3. On cherche le premier label qui n'est PAS technique
    foreach ($labels as $label) {
        if (!in_array($label, $technicalKeywords)) {
            return $label; // Retourne "ypria" même s'il y a ".preprod" après
        }
    }

    // 4. Si on n'a que des mots techniques (ex: preprod.votreartisanpro.fr)
    // On retourne le premier label trouvé pour le mapping email
    return $labels[0]; 
}

$sd = getSubdomainLabel($originHost, $allowedRoot);

if ($sd === 'null') {
    http_response_code(403);
    exit(json_encode(["status"=>"error","message"=>"Sous-domaine artisan introuvable"]));
}

/* =========================
   Mapping artisan -> email
========================= */

$artisanMap = [
    'ypria' => 'apr.a3p@gmail.com',
    'la-belle-peinture'=> 'apr.a3p@gmail.com',
    'preprod' => 'informacc85@gmail.com',
    'maquette' => 'daniel@votreartisanpro.fr',
    'root' => 'daniel@votreartisanpro.fr',
];

$artisanEmail = $artisanMap[$sd] ?? null;

if (!$artisanEmail) {
    http_response_code(500);
    exit(json_encode(["status"=>"error","message"=>"Aucun email configuré pour cet artisan"]));
}

/* =========================
   Validation formulaire
========================= */

$nom     = htmlspecialchars(trim($_POST["nom"] ?? ''), ENT_QUOTES, 'UTF-8');
$email   = htmlspecialchars(trim($_POST["email"] ?? ''), ENT_QUOTES, 'UTF-8');
$sujet   = htmlspecialchars(trim($_POST["subject"] ?? ''), ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars(trim($_POST["message"] ?? ''), ENT_QUOTES, 'UTF-8');

if (!$nom || !$email || !$sujet || !$message || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status"=>"error","message"=>"Tous les champs sont obligatoires ou email invalide"]);
    exit;
}

/* =========================
   Envoi via Brevo
========================= */

$apiKey = getenv('BREVO_API_KEY');
if (!$apiKey) {
    http_response_code(500);
    exit(json_encode(["status"=>"error","message"=>"Config serveur invalide"]));
}

$data = [
    "sender" => ["name" => "VotreArtisanPro", "email" => "daniel@votreartisanpro.fr"],
    "to" => [["email" => $artisanEmail]],
    "replyTo" => ["email" => $email, "name" => $nom],
    "subject" => "Nouveau contact pour {$sd}",
    "textContent" => "Demande envoyée depuis le formulaire de {$sd}.votreartisanpro.fr\n\n".
                     "Objet: {$sujet}\nNom: {$nom}\nEmail: {$email}\n\nMessage:\n{$message}"
];

$ch = curl_init("https://api.brevo.com/v3/smtp/email");
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ["accept: application/json","api-key: $apiKey","content-type: application/json"],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => json_encode($data)
]);

/* =========================
   Envoi via Brevo et Réponse
========================= */
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

// --- SÉCURITÉ SORTIE ---
// On mémorise si c'est un succès avant de nettoyer
$isSuccess = ($response !== false && $httpCode === 201);

// On vide les buffers parasites (espaces, warnings)
while (ob_get_level() > 0) {
    ob_end_clean();
}

// On force les headers
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: " . ($_SERVER['HTTP_ORIGIN'] ?? '*'));
header("Access-Control-Allow-Credentials: true");

if ($isSuccess) {
    echo json_encode(["status" => "success"]);
} else {
    // Si ça échoue, on renvoie quand même un JSON pour que le JS affiche l'erreur
    http_response_code(500);
    echo json_encode([
        "status" => "error", 
        "message" => "Erreur d'envoi (Code: $httpCode)",
        "debug" => $curlError ?: "Réponse Brevo incorrecte"
    ]);
}
exit;
?>

 