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

// Suppression du port éventuel (localhost:8000)
$host = explode(':', $host)[0];

if ($host === $rootDomain || $host === "www.$rootDomain") {
    http_response_code(404);
    exit('Page non disponible.');
}

// Mode local (facultatif)
if ($host === 'localhost' || $host === '127.0.0.1') {
    $subdomain = $_GET['subdomain'] ?? null;
} else {
    if (!str_ends_with($host, '.' . $rootDomain)) {
        http_response_code(400);
        exit('Domaine invalide.');
    }

    $subdomain = substr($host, 0, -strlen('.' . $rootDomain));
}

/*
|--------------------------------------------------------------------------
| Validation sécurité
|--------------------------------------------------------------------------
*/

// Uniquement lettres, chiffres, tirets
if (!$subdomain || !preg_match('/^[a-z0-9-]{2,50}$/', $subdomain)) {
    http_response_code(404);
    exit('Artisan invalide.');
}

/*
|--------------------------------------------------------------------------
| Construction du chemin sécurisé
|--------------------------------------------------------------------------
*/

$artisanDir = realpath($baseDir . '/' . $subdomain);

// Vérifie que le dossier existe
if ($artisanDir === false || !str_starts_with($artisanDir, realpath($baseDir))) {
    http_response_code(404);
    exit('Artisan introuvable.');
}

// Fichier index prioritaire
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

readfile($indexFile);
exit;

