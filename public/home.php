<?php
    session_start();

    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    } 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Simple</title>
    <link rel="stylesheet" href="assets/reset.css">
    <link rel="stylesheet" href="assets/assets_artisans/style.css">
    <link rel="stylesheet" href="assets/vap/style.css">
</head>
<body>

    <header>
        <div class="logo">
            <img src="assets/vap/logo.jpeg" width="500" alt="Logo votre artisan pro, bleu et orange" >
        </div>
    </header>
    <main>

        <div>
            <h1>Obtenez votre site professionnel clé en main pour votre activité artisanale</h1><br>
            <h2>Nous vous simplifions la tâche :</h2><br>
            <p>Vous communiquez les informations et les photos, et nous nous occupons du reste.</p>
            <p>Vous n'avez rien d'autre à faire, et votre site sera en ligne dans les 24h (souvent moins)</p>
            <p>Un site pour votre activité, adapté à tous les écrans, simple, efficace, prêt à l’emploi,
            et optimisé pour le référencement google.</p>
            <p>Le site comprend un menu, une en-tête avec image et logo, de une à trois sections avec pour chacune 10 photos, la localisation google map, une section tarif, une section qui suis-je, un formulaire de contact et les liens vers vos réseaux sociaux si vous en disposez.</p>
                <p>Vous trouverez par ailleurs un grand choix de thème couleur.</p>
                <p>Cliquez sur l'image pour en voir plus !</p><br><br>
            <div class="choix_theme">
                <div   class="services__lambda">
                    

                                <!--     Main1 Pictures     -->
                    
                    <p class="services__lambda_photos">
                        <a class="theme_link" href="/pages_artisans/espaces-verts">Feuillage<br><img class="photo photo1" src="/images_vap/photos1/m1.jpeg"  alt=""></a>
                        <a class="theme_link" href="pages_artisans/ma-salle-de-bain">Lilas<br><img class="photo photo2" src="/images_vap/photos1/m2.jpeg"  alt=""></a> 
                    </p>
                    
                    <p class="services__lambda_photos">
                        <a class="theme_link" href="<?= $baseDir ?>/martine-beauty/index.php">Flamant<br><img class="photo photo3" src="/images_vap/photos1/m3.jpeg"  alt=""></a>                    
                        <a class="theme_link" href="<?= $baseDir ?>/mon-cordonnier">Cuir<br><img class="photo photo4" src="/images_vap/photos1/m4.jpeg" alt=""></a>
                    </p>
                    <p class="services__lambda_photos">
                        <a class="theme_link" href="<?= $baseDir ?>/mon-electricien">Ciel<br><img class="photo photo5" src="/images_vap/photos1/m5.jpeg" alt=""></a>                    
                        <a class="theme_link" href="<?= $baseDir ?>/mon-menuisier">Terre<br><img class="photo photo6" src="/images_vap/photos1/m6.jpeg" alt=""></a>
                    </p>
                  
                    <p class="services__lambda_photos">
                        <a class="theme_link" href="<?= $baseDir ?>/mon-parpaing">Soleil<br><img class="photo photo7" src="/images_vap/photos1/m7.jpeg" alt=""></a>                  
                        <a class="theme_link" href="<?= $baseDir ?>/mon-peintre">Aubergine<br><img class="photo photo8" src="/images_vap/photos1/m8.jpeg" alt=""></a>
                    </p>
                   
                    <p class="services__lambda_photos">
                        <a class="theme_link" href="<?= $baseDir ?>/mon-platrier">Lagon<br><img class="photo photo9" src="/images_vap/photos1/m9.jpeg" alt=""></a>                   
                        <a class="theme_link" href="<?= $baseDir ?>/mon-serrurier">Océan<br><img class="photo photo10" src="/images_vap/photos1/m10.jpeg" alt=""></a>
                    </p>
                    <p class="services__lambda_photos">
                        <a class="theme_link" href="<?= $baseDir ?>/mon-ferronnier">Souris<br><img class="photo photo11" src="/images_vap/photos1/m11.jpeg" alt=""></a>                                        
                        <a class="theme_link" href="<?= $baseDir ?>/mon-verrier">Tomate<br><img class="photo photo12" src="/images_vap/photos1/m12.jpeg" alt=""></a>                                        
                    </p>
                    <p class="services__lambda_photos">
                                                              
                    </p>
                </div>
            </div>
            <p>**************</p><br>
            <p><u>Tarif unique sans coûts cachés :</u></p><br><br>
            <p>Une seule fois 49€ pour la réalisation.</p><br>
            <p>Puis seulement 12,99€/mois pour l'hébergement, la maintenance,les mises a jour et les petites modifications.</p><br>
            <p>**************</p><br>
            <p>Vous êtes convaincus ? </p><br>
            <p>Alors remplissez dès à présent le formulaire ci-dessous.</p>
            <p>Dans la partie message, renseignez votre Siren, et en option vos textes par section, je peux m'en charger si vous préférez.</p>
            <p>Puis adressez-moi 11 photos en format paysage par whatsApp au 07.45.06.34.58, ainsi que votre logo si vous en avez un.</p>
            <p>**************</p>
            <p>Votre site internet sera en ligne dans les 24 heurs</p>
            <p>Vous recevrez ensuite un lien de paiement pour effectuer votre règlement</p>
            <p>**************</p>
        </div>



        <!--<button>Je crée mon site maintenant</button>-->
        <!--    ******FORMULAIRE DE CONTACT *******-->


        <form id="contact" class="form-container" novalidate>
            <h2>Demande d'informations</h2>
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Votre nom" required>
            </div>
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="prenom" placeholder="Votre prénom" required>
            </div>
            <div class="form-group">
                    <label for="tel">Téléphone</label>
                    <input type="text" id="tel" name="tel" placeholder="0612345678" minlength="10" maxlength="10" required>
                </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Votre email" required>
            </div>

            <div class="form-group">
                <label for="subject">Sujet</label>
                <input type="text" id="subject" name="subject" placeholder="Sujet" required>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" placeholder="Votre message" required></textarea>
            </div>

            <!-- Honeypot anti-spam -->
            <input type="text" name="website" id="website" style="display:none">

            <button type="submit">Envoyer</button>

            <div id="form-response"></div>
        </form>
    </main>
<script src="/assets/vap/form.js"></script>
            
</body>
</html>
