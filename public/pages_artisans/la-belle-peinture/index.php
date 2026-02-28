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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Belle Peinture</title>
    <link rel="stylesheet" href="/pages_artisans/css/reset.css" class="css">
    <link rel="stylesheet" href="/pages_artisans/css/style.css" class="css">
</head>
<body id="body" class="purple">
    <div class="container"> 
        <nav class="navbar navbar-top">      
            <ul class="nav-links">
                <li><a href="#accueil">Accueil</a></li>
                <li><a href="#services1">Mon travail</a></li>
                <li><a href="#whoami">Qui suis-je</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>       
        <header>
                    <!--     Header Hero and logo  -->

            <div id="accueil" class="en-tete">
                <div class="en-tete__hero">
                    <img class="en-tete__hero_hero-img" src="/pages_artisans/la-belle-peinture/images/hero/h1.jpg" alt="" >
                </div>
                <!--<div class="en-tete__logo">
                    <img class="en-tete__logo_logo-img" src="assets/photos/logo/logo.jpeg"  alt="">
                </div>-->
            </div>

                    <!--     Header  Title, Commercial Name, City  -->

            <div class="en-tete__title limelight-regular">
                <h1 class="en-tete__title_metier ">
                    PEINTRE D'INTÉRIEUR
                </h1>
                <h2 class="en-tete__title_enseigne">
                    LA BELLE PEINTURE
                </h2>                 
                <h2 class="en-tete__title_commune">
                    Le Bernard (85560)
                </h2>
            </div>         
        </header>
        <main>

                     <!--     Header contact Tel and Mail witha button -->

            <div id="services1" class="en-tete__contact">
                <div class="button" >
                    <img class="en-tete__contact_icone" src="/pages_artisans/icones/telephone.svg" alt=""> 
                    <a class="en-tete__contact-text" href="tel:+33601753824">             
                        06 01 75 38 24 
                    </a>
                </div>
            </div>

                                <!--      SERVICES SECTION     -->

            <section class="services">
                <h2 class="services__title limelight-regular">Mes services</h2>

                                <!--       Services N°1    -->

                <div  class="services__lambda">
                    <h2  class="services__lambda_title">Mon travail</h2>
                    <p class="services__lambda_text">
                        De la préparation des supports à l’application des peintures et revêtements muraux, je travaille avec rigueur et propreté afin de garantir un résultat durable et esthétique.<br><br> À l’écoute de vos envies, je vous conseille dans le choix des couleurs et des matières pour créer une ambiance qui vous ressemble. <br><br>
                        Professionnalisme, propreté et respect des délais sont au cœur de mon engagement pour vous garantir un résultat impeccable.    
                    </p>

                                <!--     Main1 Pictures     -->

                    <p class="services__lambda_photos">
                        <img class="photo photo1" src="/pages_artisans/la-belle-peinture/images/photos1/m2.jpeg" width="100" alt="">                  
                        <img class="photo photo2" src="/pages_artisans/la-belle-peinture/images/photos1/m1.jpeg"  width="100" alt="">
                    </p>
                    <p class="services__lambda_photos">
                        <img class="photo photo3" src="/pages_artisans/la-belle-peinture/images/photos1/m3.jpeg"  width="100" alt="">               
                        <img class="photo photo4" src="/pages_artisans/la-belle-peinture/images/photos1/m4.jpeg" width="100" alt="">
                    </p>
                    <p class="services__lambda_photos">
                        <img class="photo photo5" src="/pages_artisans/la-belle-peinture/images/photos1/m5.avif" width="100" alt="">               
                        <img class="photo photo6" src="/pages_artisans/la-belle-peinture/images/photos1/m7.avif" width="100" alt="">
                    </p>
                    <p class="services__lambda_photos">
                        <img class="photo photo7" src="/pages_artisans/la-belle-peinture/images/photos1/m8.avif"  width="100" alt="">              
                        <img class="photo photo8" src="/pages_artisans/la-belle-peinture/images/photos1/m9.avif"  width="100" alt="">
                    </p>
                    <p class="services__lambda_photos">
                        <img class="photo photo9" src="/pages_artisans/la-belle-peinture/images/photos1/m1.jpeg"  width="100" alt="">               
                        <img class="photo photo10" src="/pages_artisans/la-belle-peinture/images/photos1/m10.avif" width="100" alt="">
                    </p>
                </div>            
            </section>   
            <div class="en-tete__contact">
                <div class="button" >
                    <img class="en-tete__contact_icone" src="/pages_artisans/icones/telephone.svg" alt=""> 
                    <a class="en-tete__contact-text" href="tel:+33601753824">             
                        06 01 75 38 24 
                    </a>
                </div>
            </div>

                                    <!--   Google map. -->

            <div class="map">
                <iframe class="frame-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d84059.89019205117!2d-1.670334660144053!3d46.46985652812022!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48041107f92e88a5%3A0xfa24988e41912e38!2sLa%20Belle%20Peinture!5e0!3m2!1sfr!2sfr!4v1771495647046!5m2!1sfr!2sfr"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

                                    <!-- PRICE SECTION    -->

            <section class="services">
                <h2 class="services__title limelight-regular">Devis</h2>            
                <div class="services__lambda">
                    <h2 class="services__lambda_title">Tarif</h2>
                    <p id="whoami" class="services__lambda_text">
                        Afin de vous proposer un **devis précis et au prix juste**, je me déplace directement sur place pour évaluer votre projet. Cette visite me permet d’analyser les surfaces, l’état des supports et les éventuelles contraintes techniques, afin d’établir une estimation détaillée et sans surprise.<br><br>
                        Chaque chantier étant unique, ce rendez-vous est essentiel pour vous garantir un tarif maîtrisé, adapté à vos besoins et à votre budget. Mon engagement : transparence, conseils personnalisés et respect du prix annoncé.
                    </p>  
                </div>
            </section>                       

                                <!--     WHO AM I SECTION     -->

            <section  class="services">
                <h2 class="services__title limelight-regular">Qui suis-je</h2>            
                <div class="services__lambda">
                    <h2 class="services__lambda_title">Laurent</h2>
                    <p class="services__lambda_text">
                        Peintre d’intérieur passionné, je mets mon savoir-faire, depuis 2016,  au
                        service de vos espaces pour leur donner une nouvelle vie. 
                        J’interviens aussi bien en rénovation qu’en neuf, avec un souci 
                        constant du détail et des finitions soignées.<br><br>
                        Mon objectif : transformer vos intérieurs en espaces harmonieux, chaleureux et à votre image.
                    </p>  
                </div>
            </section>
            <div class="en-tete__contact">
                <div class="button" >
                    <img class="en-tete__contact_icone" src="/pages_artisans/icones/telephone.svg" alt=""> 
                    <a class="en-tete__contact-text" href="tel:+33601753824">             
                        06 01 75 38 24 
                    </a>
                </div>
            </div>

                                <!--    ******FORMULAIRE DE CONTACT *******  -->

            <form  id="contact" class="form-container">
                <h2>Contactez-moi</h2>
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
                     
            <div class="socialmedia">
                <p class="socialmedia-title">Pour me suivre :</p>
                <div class="socialmedia-icons">
                    <a class="socialmedia-link insta"  href="#">             
                        <img class="socialmedia-img" src="/pages_artisans/icones/icons8-instagram-48.svg"  alt=""> 
                    </a>
                    <a class="socialmedia-link tictac"  href="#">             
                        <img class="socialmedia-img" src="/pages_artisans/icones/icons8-tic-tac-50.svg" alt=""> 
                    </a>
                    <a class="socialmedia-link fbook"  href="#">             
                        <img class="socialmedia-img" src="/pages_artisans/icones/icons8-facebook-48.svg"  alt=""> 
                    </a>
                </div>
            </div> 

                    <!-- Navbar bottom screen for mobile -->
          
            <nav class="navbar navbar-bottom">
                <ul class="nav-links">
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#services1">Mon travail</a></li>
                    <li><a href="#whoami">Qui suis-je</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </main>
        <footer class="footer-nav">
            <a class="mentions-link" href="/pages_artisans/la-belle-peinture/mentions_legales.php">Mentions légales</a>
        </footer>
    </div>
    <script src="/assets/vap/form.js"></script>
</body>
</html>
