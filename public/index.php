<?php

// declare(strict_types=1);

// /*
// |--------------------------------------------------------------------------
// | Configuration
// |--------------------------------------------------------------------------
// */

// $rootDomain = 'votreartisanpro.fr';
// $baseDir    = __DIR__ . '/pages_artisans';

// /*
// |--------------------------------------------------------------------------
// | Détection du sous-domaine
// |--------------------------------------------------------------------------
// */

// $host = strtolower($_SERVER['HTTP_HOST'] ?? '');
// $host = explode(':', $host)[0]; // Enlève le port (ex: 8000)
// // On récupère le chemin tapé (ex: /ypria)
// $uri = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');

// // 1. Définition des accès directs à la Homepage
// $homeDomains = [
//     $rootDomain,
//     "www.$rootDomain",
//     "preprod.$rootDomain",
//     "proprios.$rootDomain",
//     'localhost',    // <-- Ajouté pour le local
//     '127.0.0.1'     // <-- Ajouté pour le local
// ];

// // Si on est sur un domaine "Home" et qu'aucun artisan n'est forcé en URL
// if (in_array($host, $homeDomains) && !isset($_GET['subdomain'])) {
//     require __DIR__ . '/home.php';
//     exit;
// }

// // 2. Extraction de l'artisan (Subdomain)
// $subdomain = '';

// if ($host === 'localhost' || $host === '127.0.0.1') {
//     // En local, on accède aux artisans via : localhost/?subdomain=ypria
//     $subdomain = $_GET['subdomain'] ?? '';
// } else {
//     // En Prod / Preprod
//     if (!str_ends_with($host, '.' . $rootDomain)) {
//         http_response_code(400);
//         exit('Domaine invalide.');
//     }

//     $subdomainRaw = substr($host, 0, -strlen('.' . $rootDomain));
//     $parts = explode('.', $subdomainRaw);
//     $technicalKeywords = ['preprod', 'proprios', 'maquette', 'www', 'artisans'];

//     // On cherche le premier label qui n'est pas un mot technique
//     foreach ($parts as $p) {
//         if (!in_array($p, $technicalKeywords)) {
//             $subdomain = $p;
//             break;
//         }
//     }
// }

// /*
// |--------------------------------------------------------------------------
// | Validation sécurité
// |--------------------------------------------------------------------------
// */

// // Uniquement lettres, chiffres, tirets
// if (!$subdomain || !preg_match('/^[a-z0-9-]{2,50}$/', $subdomain)) {
//     http_response_code(404);
//     exit('Artisan invalide : ' . htmlspecialchars($subdomain));
// }

// /*
// |--------------------------------------------------------------------------
// | Construction du chemin sécurisé
// |--------------------------------------------------------------------------
// */

// $artisanDir = realpath($baseDir . '/' . $subdomain);
// // verifie que le dossier existe
// if ($artisanDir === false || !str_starts_with($artisanDir, realpath($baseDir))) {
//     http_response_code(404);
//     exit('Artisan introuvable.');
// }
// // fichier index propriétairre
// $indexFile = $artisanDir . '/index.php';

// if (!is_file($indexFile)) {
//     http_response_code(404);
//     exit('Page artisan inexistante.');
// }

// /*
// |--------------------------------------------------------------------------
// | Sécurité HTTP headers
// |--------------------------------------------------------------------------
// */

// header('X-Frame-Options: SAMEORIGIN');
// header('X-Content-Type-Options: nosniff');
// header('Referrer-Policy: strict-origin-when-cross-origin');

// /*
// |--------------------------------------------------------------------------
// | Inclusion de la page
// |--------------------------------------------------------------------------
// */

// include $indexFile;
// exit;


declare(strict_types=1);

$rootDomain = 'votreartisanpro.fr';
$baseDir    = __DIR__ . '/pages_artisans'; 

/* ============================================================
   1. DÉTECTION DU HOST ET DE L'URI
   ============================================================ */
$host = strtolower($_SERVER['HTTP_HOST'] ?? '');
$host = explode(':', $host)[0]; // Nettoyage du port (:8000)
$uri  = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');

/* ============================================================
   2. LOGIQUE DE ROUTAGE (LOCAL VS PROD)
   ============================================================ */
$subdomain = '';

// CAS A : LOCAL (php -S)
if ($host === 'localhost' || $host === '127.0.0.1') {
    if (empty($uri)) {
        require __DIR__ . '/home.php';
        exit;
    }
    
    // Si c'est un fichier réel (CSS, JS, images), on laisse PHP -S le servir
    if (file_exists(__DIR__ . '/' . $uri) && is_file(__DIR__ . '/' . $uri)) {
        return false; 
    }

    $subdomain = $uri; // localhost:8000/ypria -> $subdomain = 'ypria'
} 
// CAS B : PRODUCTION / PREPROD
else {
    $homeDomains = [$rootDomain, "www.$rootDomain", "preprod.$rootDomain", "proprios.$rootDomain"];
    
    if (in_array($host, $homeDomains)) {
        require __DIR__ . '/home.php';
        exit;
    }

    // Extraction du sous-domaine (ex: ypria.votreartisanpro.fr)
    if (str_ends_with($host, '.' . $rootDomain)) {
        $subdomainRaw = substr($host, 0, -strlen('.' . $rootDomain));
        $parts = explode('.', $subdomainRaw);
        $technicalKeywords = ['preprod', 'proprios', 'www'];

        foreach ($parts as $partsLabel) {
            if (!in_array($partsLabel, $technicalKeywords)) {
                $subdomain = $partsLabel;
                break;
            }
        }
    }
}

/* ============================================================
   3. HEADERS CORS (Indispensable pour tes formulaires)
   ============================================================ */
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

// Autorisation si ça vient de localhost ou de ton domaine
if (($host === 'localhost' || $host === '127.0.0.1') || 
    (!empty($origin) && str_contains($origin, $rootDomain))) {
    
    header("Access-Control-Allow-Origin: $origin");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, X-CSRF-Token, X-Requested-With");
}

// Réponse immédiate aux requêtes de vérification du navigateur
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

/* ============================================================
   4. CHARGEMENT DE LA PAGE ARTISAN
   ============================================================ */
if (!$subdomain || !preg_match('/^[a-z0-9-]{2,50}$/', $subdomain)) {
    http_response_code(404);
    exit('Artisan non reconnu ou page introuvable.');
}

$artisanDir = realpath($baseDir . '/' . $subdomain);
if ($artisanDir === false || !str_starts_with($artisanDir, realpath($baseDir))) {
    http_response_code(404);
    exit('Dossier artisan introuvable.');
}

$indexFile = $artisanDir . '/index.php';
if (!is_file($indexFile)) {
    http_response_code(404);
    exit('Page artisan inexistante.');
}

include $indexFile;
exit;

?>