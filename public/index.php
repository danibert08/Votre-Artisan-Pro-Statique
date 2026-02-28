<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Configuration
|--------------------------------------------------------------------------
*/

$rootDomain = 'votreartisanpro.fr';
$baseDir    = __DIR__ . '/pages_artisans';

/*
|--------------------------------------------------------------------------
| Détection du sous-domaine
|--------------------------------------------------------------------------
*/

$host = strtolower($_SERVER['HTTP_HOST'] ?? '');
$host = explode(':', $host)[0]; // Suppression du port

// 1. Liste des domaines qui pointent vers la Homepage
$homeDomains = [
    $rootDomain,
    "www.$rootDomain",
    "preprod.$rootDomain",
    "test.$rootDomain"
];

if (in_array($host, $homeDomains)) {
    require __DIR__ . '/home.php';
    exit;
}

// 2. Extraction du sous-domaine
if ($host === 'localhost' || $host === '127.0.0.1') {
    $subdomainRaw = $_GET['subdomain'] ?? '';
} else {
    if (!str_ends_with($host, '.' . $rootDomain)) {
        http_response_code(400);
        exit('Domaine invalide.');
    }
    // On enlève le suffixe ".votreartisanpro.fr"
    $subdomainRaw = substr($host, 0, -strlen('.' . $rootDomain));
}

// 3. logique multi-niveau (ex: ypria.preprod -> ypria)
$parts = explode('.', $subdomainRaw);
// On définit les mots-clés techniques à ignorer pour trouver le dossier dossier
$technicalKeywords = ['preprod', 'test', 'www'];

$subdomain = $parts[0]; // Par défaut le premier
foreach ($parts as $p) {
    if (!in_array($p, $technicalKeywords)) {
        $subdomain = $p;
        break; // On a trouvé le nom de l'artisan (ex: ypria)
    }
}

/*
|--------------------------------------------------------------------------
| Validation sécurité
|--------------------------------------------------------------------------
*/

// Uniquement lettres, chiffres, tirets
if (!$subdomain || !preg_match('/^[a-z0-9-]{2,50}$/', $subdomain)) {
    http_response_code(404);
    exit('Artisan invalide : ' . htmlspecialchars($subdomain));
}

/*
|--------------------------------------------------------------------------
| Construction du chemin sécurisé
|--------------------------------------------------------------------------
*/

$artisanDir = realpath($baseDir . '/' . $subdomain);
// verifie que le dossier existe
if ($artisanDir === false || !str_starts_with($artisanDir, realpath($baseDir))) {
    http_response_code(404);
    exit('Artisan introuvable.');
}
// fichier index propriétairre
$indexFile = $artisanDir . '/index.php';

if (!is_file($indexFile)) {
    http_response_code(404);
    exit('Page artisan inexistante.');
}

/*
|--------------------------------------------------------------------------
| Sécurité HTTP headers
|--------------------------------------------------------------------------
*/

header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');

/*
|--------------------------------------------------------------------------
| Inclusion de la page
|--------------------------------------------------------------------------
*/

include $indexFile;
exit;

?>