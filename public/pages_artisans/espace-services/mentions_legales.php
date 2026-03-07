<?php
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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <base href="<?php echo $baseUrl; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/common_assets/css/reset.css" class="css">
    <link rel="stylesheet" href="/assets/assets_artisans/css/style.css" class="css">
    
    <title><?= $data['nom_commercial'] . ' - Mentions Légales'; ?></title>
</head>
<body id="body" class="<?= $data['theme_couleur'] ?>">  
    <main class="mentions">
        <h1>Mentions légales</h1><br>
        <div>
            <h2>Éditeur du site :</h2><br>    
            <p>Le présent site est édité par :</p><br>
            <p>Nom / Raison sociale : <?= $data['nom_commercial'] ?><p>
            <p>Forme juridique : <?= $data['forme_juridique'] ?></p>
            <p>SIRET : <?= $data['siren'] ?></p>
            
            <p>Numéro TVA intracommunautaire : non concerné</p><br>
            <p>Adresse du siège social : </p><br>
            <address>
                <?= $data['rue'] ?><br>
                <?= $data['ville'] ?><br><br>
                Téléphone : <?= $data['telephone'] ?> <br><br>
                Email : <?= $data['mail'] ?> 
            </address><br>
            <p>La directrice de la publication est : <?= $data['prenom'] . ' '  . $data['nom'] .'.' ?></p><br>
        </div>
        <div>
            <h2>Hébergement :</h2><br>
            <p>Le site est hébergé par :</p><br>
            <address> 
                votreartisanpro.fr (InformAcc)<br>
                6 Rue du Val d'Olonne<br>
                85180 Les Sables d'Olonne
            </address><br>
            <p>Email : informacc85@gmail.com</p><br>
            <p>Infrastructure d’hébergement :</p><br>
            <address> 
                Hostinger International Ltd<br>
                61 Lordou Vironos Street<br>
                6023 Larnaca<br>
                Chypre
            </address><br>
            <p>Site : https://www.votreartisanpro.fr <br>
                (https://www.hostinger.fr)</p><br>
            <h2>Activité :</h2><br>
            <p>Le présent site a pour objet de présenter les services de : <?=  $data['nom_commercial'] ?></p>
            <p>Description de l’activité : <?= $data['activite'] ?></p><br>
            <h2>Propriété intellectuelle :</h2><br>
            <p>L’ensemble des éléments présents sur ce site (textes, images, logos, structure, design) sont protégés par le Code de la propriété intellectuelle.
            Toute reproduction, représentation, modification ou adaptation, totale ou partielle, sans autorisation préalable écrite est interdite.</p><br>
            <h2>Responsabilité :</h2><br>
            <p>L’éditeur s’efforce de fournir des informations exactes et à jour.
            Toutefois, il ne saurait être tenu responsable des omissions, inexactitudes ou défauts de mise à jour.</p><br>
            <h2>Données personnelles :</h2><br>
            <p>Les informations collectées via les formulaires sont destinées uniquement à <?= $data['nom_commercial'] ?> afin de répondre aux demandes des utilisateurs. <br>
            Conformément au Règlement Général sur la Protection des Données (RGPD), vous pouvez exercer vos droits d’accès, de rectification ou de suppression en contactant :
            Email : <?= $data['mail'] ?></p><br>
            <h2>Droit applicable :</h2><br>
            <p>Le présent site est soumis au droit français. Tout litige relève de la compétence des tribunaux français.</p> 
        </div>
    </main>
    <div class="en-tete__contact">
        <div class="button" >
            <img class="en-tete__contact_icone" src="/assets/common_assets/icones/telephone.svg" alt=""> 
            <a class="en-tete__contact-text" href="/pages_artisans/<?= $data['dossier'] ?>/index.php">             
                Retour
            </a>
        </div>
    </div>
</body>
</html>