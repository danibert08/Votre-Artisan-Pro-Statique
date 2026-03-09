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

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <base href="<?php echo $baseUrl; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex"><!-- A retirer pour chaque artisan -->
    
    <link rel="canonical" href="<?= $canonical_url; ?>" />
    <title><?= $data['tag_title']; ?></title>
    <link rel="stylesheet" href="../../assets/common_assets/css/reset.css" class="css">
    <link rel="stylesheet" href="../../assets/assets_artisans/css/style.css" class="css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
</head>
<body id="body" class="<?= $data['theme_couleur'] ?>";>
    <div class="container">
        <nav class="navbar navbar-top">      
            <ul class="nav-links">
                <li><a href="#accueil" onclick="document.getElementById('accueil').scrollIntoView({behavior: 'smooth'}); return false;">Accueil</a></li> 
                <?php   foreach ($data['sections'] as $section): ?>
                            <li>
                                <a href="#services<?= $section['id'] ?>" 
                                onclick="document.getElementById('services<?= $section['id'] ?>').scrollIntoView({behavior: 'smooth'}); return false;">
                                <?= $section['activite'] ?>
                                </a>
                            </li>
                       <?php endforeach;  
                        if (count($data['sections']) <= 2)                      
                            {   ?>                        
                                <li><a href="#whoami" onclick="document.getElementById('whoami').scrollIntoView({behavior: 'smooth'}); return false;">Qui suis-je</a></li>
                        <?php 
                            }        
                        ?>                                
                <li><a href="#contact" onclick="document.getElementById('contact').scrollIntoView({behavior: 'smooth'}); return false;">Contact</a></li>
            </ul>
        </nav>     
        <header>
                  
                    <!--     Header Hero and logo  -->

            <div id="accueil" class="en-tete">
                <div class="en-tete__hero">
                    <img class="en-tete__hero_hero-img" src="/pages_artisans/<?= $data['dossier'] ?>/<?= $data['image_hero'];?>"  alt="" >
                </div>
                <?php  if(!empty($data['image_logo'])) 
         echo  '<div class="en-tete__logo">
                    <img class="en-tete__logo_logo-img" src="/pages_artisans/'. $data['dossier'] . '/' . $data['image_logo'] . '"  alt="">
                </div>' ?>
            </div>

                    <!--     Header  Title, Commercial Name, City  -->

            <div class="en-tete__title limelight-regular">
                <h1 class="en-tete__title_metier ">
                    <?= $data['metier']; ?>
                </h1>
                <h2 class="en-tete__title_enseigne">
                    <?=  $data['nom_commercial'] ?>
                </h2>
                 
                <h2 class="en-tete__title_commune">
                    <?=  $data['commune']; ?>
                </h2>
            </div>                   
        </header>
        <main>

            <!--     Header contact Tel and Mail witha button -->

            <div class="en-tete__contact">
                <div class="button" >
                    <img class="en-tete__contact_icone" src="/assets/common_assets/icones/telephone.svg" alt=""> 
                    <a class="en-tete__contact-text" href="tel: +33 <?= substr($data['telephone'],1) ?>">             
                         <?=  implode(' ', str_split($data['telephone'], 2)); ?>
                    </a>
                </div>
            </div> 

                                <!--      SERVICES SECTION     -->
            <section  class="services">
                <h2 class="services__title limelight-regular"><?= $data['services'] ?></h2>

            <?php foreach ($data['sections'] as $section) : ?>
                                <!--       Services  N°1   -->

                <div  id="services<?= $section['id']; ?>" class="services__lambda">
                    <h2  class="services__lambda_title"><?= $section['activite']; ?></h2>
                    <p class="services__lambda_text"> <?= $section['text'] ?></p>

                                <!--     Main1 Pictures     -->

                    <p class="services__lambda_photos">
                        <img class="photo photo1" src="/pages_artisans/<?=  $data['dossier'] ?>/images/<?= $section['dossier_photos'] ?>/m1.jpeg" width="100" alt="">                    
                        <img class="photo photo2" src="/pages_artisans/<?=  $data['dossier'] ?>/images/<?= $section['dossier_photos'] ?>/m2.jpeg"  width="100" alt="">
                    </p>
                    <p class="services__lambda_photos">
                        <img class="photo photo4" src="/pages_artisans/<?=  $data['dossier'] ?>/images/<?= $section['dossier_photos'] ?>/m4.jpeg" width="100" alt="">
                        <img class="photo photo3" src="/pages_artisans/<?=  $data['dossier'] ?>/images/<?= $section['dossier_photos'] ?>/m3.jpeg"  width="100" alt="">                  
                    </p>
                    <p class="services__lambda_photos">
                        <img class="photo photo5" src="/pages_artisans/<?=  $data['dossier'] ?>/images/<?= $section['dossier_photos'] ?>/m5.jpeg" width="100" alt="">                    
                        <img class="photo photo6" src="/pages_artisans/<?=  $data['dossier'] ?>/images/<?= $section['dossier_photos'] ?>/m6.jpeg" width="100" alt="">
                    </p>
                    <p class="services__lambda_photos">
                        <img class="photo photo7" src="/pages_artisans/<?=  $data['dossier'] ?>/images/<?= $section['dossier_photos'] ?>/m7.jpeg"  width="100" alt="">                  
                        <img class="photo photo8" src="/pages_artisans/<?=  $data['dossier'] ?>/images/<?= $section['dossier_photos'] ?>/m8.jpeg"  width="100" alt="">
                    </p>
                    <p class="services__lambda_photos">
                        <img class="photo photo9" src="/pages_artisans/<?=  $data['dossier'] ?>/images/<?= $section['dossier_photos'] ?>/m9.jpeg"  width="100" alt="">                   
                        <img class="photo photo10" src="/pages_artisans/<?=  $data['dossier'] ?>/images/<?= $section['dossier_photos'] ?>/m10.jpeg" width="100" alt="">
                    </p>
                </div>
                <div class="en-tete__contact">
                    <div class="button" >
                        <img class="en-tete__contact_icone" src="/assets/common_assets/icones/telephone.svg" alt=""> 
                        <a class="en-tete__contact-text" href="tel: +33 <?= substr($data['telephone'],1) ?>">             
                            <?= implode(' ', str_split($data['telephone'], 2)); ?>
                        </a>
                    </div>
                </div>   
                <?php endforeach; ?>          
            </section>   
            
                         <!--   Google map. -->
          
            <div class="map">
                <iframe class="frame-map" src="<?=$data['google_map']?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

                                    <!-- PRICE SECTION    -->

            <section id="payment" class="services">
                <h2 class="services__title limelight-regular"><?= $data['price']['price_first_title'] ?></h2>            
                <div class="services__lambda">
                    <h2 class="services__lambda_title"><?= $data['price']['price_second_title'] ?></h2>
                    <p class="services__lambda_text">
                        <?= $data['price']['price_text'] ?>
                    </p>  
                </div>
            </section>                       

                                <!--     WHO AM I SECTION     -->

            <section id="whoami" class="services">
                <h2 class="services__title limelight-regular"><?= $data['whoami']['whoami_first_title'] ?></h2>            
                <div class="services__lambda">
                    <h2 class="services__lambda_title"><?= $data['prenom'] ?></h2>
                    <p class="services__lambda_text">
                        <?= $data['whoami']['whoami_text'] ?>
                    </p>  
                </div>
            </section>
            <div class="en-tete__contact">
                <div class="button">
                    <img class="en-tete__contact_icone" src="/assets/common_assets/icones/telephone.svg" alt=""> 
                    <a class="en-tete__contact-text" href="tel: +33 <?= substr($data['telephone'],1) ?>">             
                        <?=  implode(' ', str_split($data['telephone'], 2)); ?>
                    </a>
                </div>
            </div> 

                                <!--    ******FORMULAIRE DE CONTACT *******-->


            <form id="contact" class="form-container">
                <h2>Contactez-nous</h2>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" id="name" name="nom" placeholder="Votre nom" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Votre email" required>
                </div>
                <div class="form-group">
                    <label for="subject">Sujet</label>
                    <input type="text" id="subject" name="subject" placeholder="Sujet">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Votre message" required></textarea>
                </div>
                <!-- Honeypot anti-spam -->
                <input type="text" name="website" id="website" style="display:none">

                <button class="button" type="submit">Envoyer</button>

                <div id="form-response"></div>
            </form>

                                <!--   SOCIAL MEDIA ICONS SECTION -->
                  
         <?php  if(!empty($data['tiktok']) || !empty($data['instagram']) || !empty($data['facebook'])): 
            echo'<div class="socialmedia">
                    <p class="socialmedia-title">Pour me suivre :</p>
                    <div class="socialmedia-icons">';
                        if(!empty($data['instagram'])):?>
                        <a class="socialmedia-link insta"  href="<?= $data['instagram'] ?>">            
                            <img class="socialmedia-img" src="/assets/common_assets/icones/icons8-instagram-48.svg"  alt=""> 
                        </a>
                        <?php endif; 
                        if(!empty($data['tiktok'])):?>
                        <a class="socialmedia-link tictac"  href="<?=  $data['tiktok'] ?>">             
                            <img class="socialmedia-img" src="/assets/common_assets/icones/icons8-tic-tac-50.svg" alt=""> 
                        </a>
                        <?php endif;
                        if(!empty($data['facebook'])): ?>
                        <a class="socialmedia-link fbook"  href=" <?= $data['facebook'] ?>">             
                            <img class="socialmedia-img" src="/assets/common_assets/icones/icons8-facebook-48.svg"  alt=""> 
                        </a>
                        <?php endif;?>
                    </div>
                </div>
            <?php endif ?>
            <nav class="navbar navbar-bottom">
                <ul class="nav-links">
                    <li><a href="#accueil" onclick="document.getElementById('accueil').scrollIntoView({behavior: 'smooth'}); return false;">Accueil</a></li> 
                    <?php   foreach ($data['sections'] as $section): ?>
                                <li>
                                    <a href="#services<?= $section['id'] ?>" 
                                    onclick="document.getElementById('services<?= $section['id'] ?>').scrollIntoView({behavior: 'smooth'}); return false;">
                                    <?= $section['activite'] ?>
                                    </a>
                                </li>
                        <?php endforeach;  
                            if (count($data['sections']) <= 2)                      
                            {   ?>                        
                                <li><a href="#whoami" onclick="document.getElementById('whoami').scrollIntoView({behavior: 'smooth'}); return false;">Qui suis-je</a></li>
                        <?php 
                            }                                 
                        ?>                                  
                <li><a href="#contact" onclick="document.getElementById('contact').scrollIntoView({behavior: 'smooth'}); return false;">Contact</a></li>
            </ul>
            </nav>
        </main>
        <footer class="footer-nav">
            <a class="mentions-link" href="/pages_artisans/<?= $data['dossier'] ?>/mentions_legales.php">Mentions légales</a>
        </footer>
    </div>
    <script src="/assets/vap/form.js"></script>
</body>
</html>

