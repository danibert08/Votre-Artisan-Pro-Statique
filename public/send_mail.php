<?php 
    
// header('Content-Type: application/json');

// // Sécurité : méthode POST uniquement
// if ($_SERVER["REQUEST_METHOD"] !== "POST") {
//     echo json_encode(["status" => "error", "message" => "Méthode non autorisée"]);
//     exit;
// }

// // Honeypot anti-spam
// if (!empty($_POST["website"])) {
//     echo json_encode(["status" => "error", "message" => "Spam détecté"]);
//     exit;
// }

// // Nettoyage
// $nom = trim($_POST["nom"] ?? '');
// $email = trim($_POST["email"] ?? '');
// $sujet = trim($_POST["subject"] ?? '');
// $message = trim($_POST["message"] ?? '');

// // Validation
// if (empty($nom) || empty($email) || empty($sujet) || empty($message)) {
//     echo json_encode(["status" => "error", "message" => "Tous les champs sont obligatoires"]);
//     exit;
// }

// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     echo json_encode(["status" => "error", "message" => "Email invalide"]);
//     exit;
// }

// // Sécurisation supplémentaire
// $nom = htmlspecialchars($nom);
// $sujet = htmlspecialchars($sujet);
// $message = htmlspecialchars($message);

// // Configuration mail
// $to = "apr.a3p@gmail.com";
// $subject = "[NOUVEAU MESSAGE] de $nom";

// $headers = "From: noreply@tonsite.com\r\n";
// $headers .= "Reply-To: $email\r\n";
// $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// $body = "Nom : $nom\n";
// $body .= "Email : $email\n";
// $body .= "Sujet : $sujet\n";
// $body .= "Message :\n$message\n";

// // Envoi
// if (mail($to, $subject, $body, $headers)) {
//     echo json_encode(["status" => "success", "message" => "Message envoyé avec succès ✅"]);
// } else {
//     echo json_encode(["status" => "error", "message" => "Erreur lors de l'envoi"]);
// }

// V2

// if (isset($_SERVER['HTTP_ORIGIN'])) {
//     $origin = $_SERVER['HTTP_ORIGIN'];

//     // Autorise uniquement les sous-domaines de votreartisanpro.fr
//     if (preg_match('#^https://([a-z0-9-]+\.)?votreartisanpro\.fr$#', $origin)) {
//         header("Access-Control-Allow-Origin: $origin");
//     }
// }

// header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type, Authorization");
// header("Vary: Origin");

// // Gestion du preflight
// if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
//     http_response_code(204);
//     exit();
// }


// header('Content-Type: application/json');

// if ($_SERVER["REQUEST_METHOD"] !== "POST") {
//   echo json_encode(["status" => "error", "message" => "Méthode non autorisée"]);
//   exit;
// }
// if (!empty($_POST["website"])) {
//   echo json_encode(["status" => "error", "message" => "Spam détecté"]);
//   exit;
// }

// $nom     = trim($_POST["nom"] ?? '');
// $email   = trim($_POST["email"] ?? '');
// $sujet   = trim($_POST["subject"] ?? '');
// $message = trim($_POST["message"] ?? '');

// if (empty($nom) || empty($email) || empty($sujet) || empty($message)) {
//   echo json_encode(["status" => "error", "message" => "Tous les champs sont obligatoires"]);
//   exit;
// }
// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//   echo json_encode(["status" => "error", "message" => "Email invalide"]);
//   exit;
// }

// $nom     = htmlspecialchars($nom, ENT_QUOTES, 'UTF-8');
// $sujet   = htmlspecialchars($sujet, ENT_QUOTES, 'UTF-8');
// $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

// function getSubdomainLabel(string $host): string {
//   $host = strtolower(trim($host));
//   $host = preg_replace('/:\d+$/', '', $host);   // strip port
//   if (str_starts_with($host, 'www.')) $host = substr($host, 4);

//   $root = 'votreartisanpro.fr';
//   if ($host === $root) return '';               // pas de sous-domaine
//   if (!str_ends_with($host, '.' . $root)) return '';

//   return substr($host, 0, -1 - strlen($root));  // ex: "ypria"
// }

// $host = $_SERVER['HTTP_HOST'] ?? '';
// $sd  = getSubdomainLabel($host);

// if ($sd === '') {
//   echo json_encode(["status" => "error", "message" => "Sous-domaine artisan introuvable"]);
//   exit;
// }

// /**
//  * Mapping manuel sous-domaine -> email artisan
//  * (ajoute tes artisans ici)
//  */
// $artisanMap = [
//   'ypria' => 'apr.a3p@gmail.com',
//   'la-belle-peinture'=> 'apr.a3p@gmail.com',
//   'preprod' => 'informacc85@gmail.com',
//   'maquette' => 'berthida34@gmail.com',
// ];

// $artisanEmail = $artisanMap[$sd] ?? null;
// if (!$artisanEmail) {
//   echo json_encode(["status" => "error", "message" => "Aucun email configuré pour cet artisan"]);
//   exit;
// }

// require __DIR__ . '/vendor/autoload.php';
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// $mail = new PHPMailer(true);

// try {
//   $mail->isSMTP();
//   $mail->Host       = getenv('SMTP_HOST');
//   $mail->SMTPAuth   = true;
//   $mail->Username   = getenv('SMTP_USER');
//   $mail->Password   = getenv('SMTP_PASS');
//   $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
//   $mail->Port       = (int)(getenv('SMTP_PORT') ?: 465);

//   // From = ton domaine (celui du SMTP), Reply-To = client
//   $fromEmail = getenv('SMTP_FROM') ?: getenv('SMTP_USER');
//   $fromName  = getenv('SMTP_FROM_NAME') ?: 'VotreArtisanPro';
//   $mail->setFrom($fromEmail, $fromName);
//   $mail->addReplyTo($email, $nom);

//   $mail->addAddress($artisanEmail);

//   $mail->Subject = "Demande via {$sd}.votreartisanpro.fr : {$sujet}";
//   $mail->Body =
//     "Nouvelle demande via formulaire\n\n" .
//     "Artisan (sous-domaine): {$sd}\n" .
//     "Nom: {$nom}\n" .
//     "Email client: {$email}\n" .
//     "Sujet: {$sujet}\n\n" .
//     "Message:\n{$message}\n";

//   $mail->send();
//   echo json_encode(["status" => "success", "message" => "Message envoyé"]);
// } catch (Exception $e) {
//     http_response_code(500);
//     echo json_encode(["status" => "error", "message" => "Erreur d'envoi"]);
// }

// V3


/* =========================
   CORS sécurisé multi-sous-domaines
========================= */

$allowedRoot = 'votreartisanpro.fr';
$originHost = '';

if (isset($_SERVER['HTTP_ORIGIN'])) {
    $origin = $_SERVER['HTTP_ORIGIN'];
    $originHost = parse_url($origin, PHP_URL_HOST);

    // Autorise uniquement les sous-domaines de votreartisanpro.fr
    if (preg_match('#^([a-z0-9-]+)\.' . preg_quote($allowedRoot, '#') . '$#', $originHost)) {
        header("Access-Control-Allow-Origin: $origin");
        header("Vary: Origin");
    } else {
        http_response_code(403);
        echo json_encode(["status" => "error", "message" => "Origine non autorisée"]);
        exit;
    }
}

header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

// Gestion du preflight
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
    $host = preg_replace('/:\d+$/', '', $host);

    if (!str_ends_with($host, '.' . $root)) return '';

    return substr($host, 0, -1 - strlen($root));
}

$sd = getSubdomainLabel($originHost, $allowedRoot);

if ($sd === '') {
    echo json_encode(["status" => "error", "message" => "Sous-domaine artisan introuvable"]);
    exit;
}

/* =========================
   Mapping artisan -> email
========================= */

$artisanMap = [
    'ypria' => 'apr.a3p@gmail.com',
    'la-belle-peinture'=> 'apr.a3p@gmail.com',
    'preprod' => 'informacc85@gmail.com',
    'maquette' => 'daniel@votreartisanpro.fr',
];

$artisanEmail = $artisanMap[$sd] ?? null;

if (!$artisanEmail) {
    echo json_encode(["status" => "error", "message" => "Aucun email configuré pour cet artisan"]);
    exit;
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

require __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
  // $mail->isSMTP();
  // $mail->Host       = getenv('SMTP_HOST');
  // $mail->SMTPAuth   = true;
  // $mail->Username   = getenv('SMTP_USER');
  // $mail->Password   = getenv('SMTP_PASS');
  // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  // $mail->Port       = (int)(getenv('SMTP_PORT') ?: 587);

  // // From = ton domaine (celui du SMTP), Reply-To = client
  // $fromEmail = getenv('SMTP_FROM') ?: getenv('SMTP_USER');
  // $fromName  = getenv('SMTP_FROM_NAME') ?: 'VotreArtisanPro';
  // $mail->setFrom($fromEmail, $fromName);
  // $mail->addReplyTo($email, $nom);

  // $mail->addAddress($artisanEmail);

$mail->isSMTP();
$mail->Host       = getenv('SMTP_HOST');
$mail->Username   = getenv('SMTP_USER');
$mail->Password   = getenv('SMTP_PASS');
$mail->Port       = (int)getenv('SMTP_PORT');
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

var_dump(getenv('SMTP_USER'));
exit;

$mail->setFrom('daniel@votreartisanpro.fr', 'VotreArtisanPro');
$mail->addReplyTo($email, $nom);  // email du client
$mail->addAddress($artisanEmail);


  $mail->Subject = "Nouvelle demande via le formulaire de votre site : {$sd}.votreartisanpro.fr ";
  $mail->Body =
    
    "Artisan : {$sd}\n" .
    "Nom: {$nom}\n" .
    "Email client: {$email}\n" .
    "Sujet: {$sujet}\n\n" .
    "Message:\n{$message}\n";

  $mail->send();
  echo json_encode(["status" => "success", "message" => "Message envoyé"]);
// } catch (Exception $e) {
//     http_response_code(500);
//     echo json_encode(["status" => "error", "message" => "Erreur d'envoi"]);
// }

}catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Erreur SMTP",
        "debug" => $mail->ErrorInfo
    ]);
}

?> 