<?php 
    
header('Content-Type: application/json');

// Sécurité : méthode POST uniquement
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Méthode non autorisée"]);
    exit;
}

// Honeypot anti-spam
if (!empty($_POST["website"])) {
    echo json_encode(["status" => "error", "message" => "Spam détecté"]);
    exit;
}

// Nettoyage
$nom = trim($_POST["nom"] ?? '');
$email = trim($_POST["email"] ?? '');
$sujet = trim($_POST["subject"] ?? '');
$message = trim($_POST["message"] ?? '');

// Validation
if (empty($nom) || empty($email) || empty($sujet) || empty($message)) {
    echo json_encode(["status" => "error", "message" => "Tous les champs sont obligatoires"]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Email invalide"]);
    exit;
}

// Sécurisation supplémentaire
$nom = htmlspecialchars($nom);
$sujet = htmlspecialchars($sujet);
$message = htmlspecialchars($message);

// Configuration mail
$to = "apr.a3p@gmail.com";
$subject = "[NOUVEAU MESSAGE] de $nom";

$headers = "From: noreply@tonsite.com\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$body = "Nom : $nom\n";
$body .= "Email : $email\n";
$body .= "Sujet : $sujet\n";
$body .= "Message :\n$message\n";

// Envoi
if (mail($to, $subject, $body, $headers)) {
    echo json_encode(["status" => "success", "message" => "Message envoyé avec succès ✅"]);
} else {
    echo json_encode(["status" => "error", "message" => "Erreur lors de l'envoi"]);
}
?> 