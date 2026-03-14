<?php


    session_start();

    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    } 
    $json_path = __DIR__ . '/datas.json';
        $data = [];

    if (file_exists($json_path)) {
        $json_content = file_get_contents($json_path);
        $data = json_decode($json_content, true);
    }else {
    // Petit message de debug pour la prod
    die("Erreur : Le fichier est introuvable à l'adresse : " . $json_path);
    }
        $host = $_SERVER['HTTP_HOST'];
    
    // 1. URL Canonique (racine du domaine en HTTPS)
    $canonical_url = "https://" . $host . "/";

    // 2. On récupère le chemin vers le dossier actuel (ex: /pages_artisans/ypria/)
    $currentPath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';

    // 3. On récupère le chemin mais on retire "public" s'il est présent dans l'URL
    $baseUrl = str_replace('/public/', '/', dirname($_SERVER['SCRIPT_NAME']));
    $baseUrl = rtrim($baseUrl, '/') . '/'; 
?>

