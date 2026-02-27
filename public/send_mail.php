<?php 
    

/*===================================
En local on affiche les erreurs, en prod on les logs
=====================================*/ 

if ($appEnv === 'local') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
}

$appEnv = getenv('APP_ENV') ?: 'prod';

/*====================================
    Demarrage d'une session
=====================================*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/*=========================
CORS sécurisé multi-sous-domaines
========================= */

if (file_exists(__DIR__ . '/.env.local')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

if (!isset($_SESSION['last_submit'])) {
    $_SESSION['last_submit'] = time();
} else {
    if (time() - $_SESSION['last_submit'] < 10) {
        exit(json_encode(["status"=>"error","message"=>"Trop rapide"]));
    }
    $_SESSION['last_submit'] = time();
}

$allowedRoot = 'votreartisanpro.fr';

if (empty($_SERVER['HTTP_ORIGIN'])) {
    http_response_code(403);
    exit(json_encode([
        "status"=>"error",
        "message"=>"Origine manquante"
    ]));
}

$origin = $_SERVER['HTTP_ORIGIN'];
$originHost = parse_url($origin, PHP_URL_HOST);

// Autorise domaine racine et tous les sous-domaines
if ($originHost === $allowedRoot || str_ends_with($originHost, '.' . $allowedRoot)) {
    header("Access-Control-Allow-Origin: $origin");
    header("Access-Control-Allow-Credentials: true");
    header("Vary: Origin");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, X-CSRF-Token");
    header('Content-Type: application/json');
} else {
    http_response_code(403);
    exit(json_encode([
        "status"=>"error",
        "message"=>"Origine non autorisée"
    ]));
}

// Gestion du preflight OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

/* =========================
   Sécurité méthode
========================= */

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Méthode non autorisée"]);
    exit;
}

/* =========================
   Anti-spam honeypot
========================= */

if (!empty($_POST["website"])) {
    echo json_encode(["status" => "error", "message" => "Spam détecté"]);
    exit;
}

/* =========================
   Extraction artisan via Origin UNIQUEMENT
========================= */

function getSubdomainLabel(string $host, string $root): string {
    $host = strtolower(trim($host));
    $host = preg_replace('/:\d+$/', '', $host); // enlève le port

    if ($host === $root) {
        return 'root'; // Domaine racine
    }

    if (!str_ends_with($host, '.' . $root)) {
        return 'null'; // Origine invalide / hors domaine autorisé
    }

    return substr($host, 0, -1 - strlen($root));
}

$allowedRoot = 'votreartisanpro.fr';

if (empty($_SERVER['HTTP_ORIGIN'])) {
    http_response_code(403);
    exit(json_encode([
        "status"=>"error",
        "message"=>"Origine manquante"
    ]));
}

$origin = $_SERVER['HTTP_ORIGIN'];
$originHost = parse_url($origin, PHP_URL_HOST);

$sd = getSubdomainLabel($originHost, $allowedRoot);

if ($sd === 'null') {
    http_response_code(403);
    exit(json_encode([
        "status"=>"error",
        "message"=>"Sous-domaine artisan introuvable"
    ]));
}

/* =========================
//    Mapping artisan -> email
// ========================= */

$artisanMap = [
    'ypria' => 'apr.a3p@gmail.com',
    'la-belle-peinture'=> 'apr.a3p@gmail.com',
    'preprod' => 'informacc85@gmail.com',
    'maquette' => 'daniel@votreartisanpro.fr',
    'root' => 'daniel@votreartisanpro.fr', // domaine racine
];

$artisanEmail = $artisanMap[$sd] ?? null;

if (!$artisanEmail) {
    http_response_code(500);
    exit(json_encode([
        "status"=>"error",
        "message"=>"Aucun email configuré pour cet artisan"
    ]));
}

/* =========================
   Validation formulaire
========================= */

$nom     = trim($_POST["nom"] ?? '');
$email   = trim($_POST["email"] ?? '');
$sujet   = trim($_POST["subject"] ?? '');
$message = trim($_POST["message"] ?? '');

if (empty($nom) || empty($email) || empty($sujet) || empty($message)) {
    echo json_encode(["status" => "error", "message" => "Tous les champs sont obligatoires"]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Email invalide"]);
    exit;
}

$nom     = htmlspecialchars($nom, ENT_QUOTES, 'UTF-8');
$sujet   = htmlspecialchars($sujet, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

/* =========================
   Envoi mail
========================= */

$apiKey = getenv('BREVO_API_KEY');

if (!$apiKey) {
    http_response_code(500);
    exit(json_encode(["status"=>"error","message"=>"Config serveur invalide"]));
}
$data = [
    "sender" => [
        "name" => "VotreArtisanPro",
        "email" => "daniel@votreartisanpro.fr"
    ],
    "to" => [
        [
            "email" => $artisanEmail
        ]
    ],
    "replyTo" => [
        "email" => $email,
        "name"  => $nom
    ],
    "subject" => "Nouveau contact pour {$sd}",
    "textContent" =>
        "Demande envoyée depuis le formulaire de {$sd}.votreartisanpro.fr\n\n" .
        "Objet : {$sujet}\n" .
        "Nom: {$nom}\n" .
        "Email: {$email}\n\n" .
        "Message:\n{$message}"
];

$ch = curl_init("https://api.brevo.com/v3/smtp/email");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "accept: application/json",
    "api-key: $apiKey",
    "content-type: application/json"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
if ($response === false) {
    error_log(curl_error($ch));
    echo json_encode(["status"=>"error","message"=>"Erreur technique"]);
    exit;
}
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


if ($httpCode === 201) {
    echo json_encode(["status" => "success"]);
} else {
  error_log("Brevo error HTTP $httpCode: $response");
  echo json_encode(["status"=>"error","message"=>"Erreur d'envoi"]);
}
?> 