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
    <link rel="canonical" href="https://ypria.votreartisanpro.fr/" />
    <title>Ypria : prothésiste ongulaire et maquilleuse</title>
    <link rel="stylesheet" href="/pages_artisans/css/reset.css" class="css">
    <link rel="stylesheet" href="/pages_artisans/css/style.css" class="css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
</head>
<body id="body" class="june">
    <div class="container">
        <nav class="navbar navbar-top">      
            <ul class="nav-links">
                <li><a href="#accueil">Accueil</a></li>
                <li><a href="#nails">Ongles</a></li>
                <li><a href="#make-up">Maquillage</a></li>
                <li><a href="#payment">Paiement</a></li>
                <li><a href="#whoami">Qui suis-je</a></li>
            </ul>
        </nav>      
        <header>
                    <!--     Header Hero and logo  -->

            <div id="accueil" class="en-tete">
                <div class="en-tete__hero">
                    <img class="en-tete__hero_hero-img" src="/pages_artisans/ypria/images/hero/h1.jpeg" alt="" >
                </div>
                <div class="en-tete__logo">
                    <img class="en-tete__logo_logo-img" src="/pages_artisans/ypria/images/logo/logo.jpeg"  alt="">
                </div>
            </div>

                    <!--     Header  Title, Commercial Name, City  -->

            <div class="en-tete__title limelight-regular">
                <h1 class="en-tete__title_metier ">
                    PROTHÉSISTE ONGULAIRE ET MAQUILLEUSE
                </h1>
                <h2 class="en-tete__title_enseigne">
                    YPRIA_BEAUTY
                </h2>   
                <h2 class="en-tete__title_commune">
                    Les Sables d'Olonne
                </h2>
            </div>                
        </header>
        <main>

            <!--     Header contact Tel and Mail witha button -->

            <div class="en-tete__contact">
                <div class="button" >
                    <img class="en-tete__contact_icone" src="/pages_artisans/icones/telephone.svg" alt=""> 
                    <a class="en-tete__contact-text" href="tel:+33745063458">             
                        07 45 06 34 58 
                    </a>
                </div>
            </div>
            
                                <!--      SERVICES SECTION     -->

            <section id="nails" class="services">
                <h2 class="services__title limelight-regular">Mes services</h2>

                                <!--      Nails Services     -->

                <div  class="services__lambda">
                    <h2  class="services__lambda_title">Ongles</h2>
                    <p class="services__lambda_text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet consequatur, natus, asperiores vitae ipsam provident quo ab minus officia, ipsum quia sequi repellat adipisci modi ipsa eius ducimus? Cumque et ipsa unde, doloremque hic voluptates nesciunt aliquam fugit impedit nemo minus possimus assumenda praesentium earum autem, architecto similique 
                    </p>

                                <!--     Nails Pictures     -->

                    <p class="services__lambda_photos">
                        <img class="photo photo1" src="/pages_artisans/ypria/images/photos1/m1.jpeg" width="100" alt="">
                        <img class="photo photo2" src="/pages_artisans/ypria/images/photos1/m2.jpeg"  width="100" alt="">
                    </p>
                    <p class="services__lambda_photos">
                        <img class="photo photo3" src="/pages_artisans/ypria/images/photos1/m3.jpeg"  width="100" alt="">
                        <img class="photo photo4" src="/pages_artisans/ypria/images/photos1/m4.jpeg" width="100" alt="">
                    </p>
                    <p class="services__lambda_photos">
                        <img class="photo photo5" src="/pages_artisans/ypria/images/photos1/m5.jpeg" width="100" alt="">
                        <img class="photo photo6" src="/pages_artisans/ypria/images/photos1/m6.jpeg" width="100" alt="">
                    </p>
                    <p class="services__lambda_photos">
                        <img class="photo photo7" src="/pages_artisans/ypria/images/photos1/m7.jpeg"  width="100" alt="">
                        <img class="photo photo8" src="/pages_artisans/ypria/images/photos1/m8.jpeg"  width="100" alt="">
                    </p>
                    <p class="services__lambda_photos">
                        <img class="photo photo9" src="/pages_artisans/ypria/images/photos1/m9.jpeg"  width="100" alt="">
                        <img class="photo photo10" src="/pages_artisans/ypria/images/photos1/m10.jpeg" width="100" alt="">
                    </p>
                </div>
                <div class="en-tete__contact">
                    <div id="make-up" class="button" >
                        <img class="en-tete__contact_icone" src="/pages_artisans/icones/telephone.svg" alt=""> 
                        <a class="en-tete__contact-text" href="tel:+33745063458">             
                            07 45 06 34 58 
                        </a>
                    </div>
                </div>

                                <!--     Make-up Service     -->

                <div class="services__lambda">
                    <h2  class="services__lambda_title">Maquillage</h2>
                    
                        <p class="services__lambda_text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam expedita nam obcaecati repudiandae. Facere temporibus maxime rem, nulla blanditiis ipsa eius? Expedita pariatur, nulla repellendus numquam voluptates tenetur harum, sit vero recusandae voluptatum possimus, quis quisquam maxime inventore incidunt excepturi cumque. Tempora odit ut vero cupiditate architecto! Eaque iste earum 
                        </p>
                                <!--     Make-up Pictures    -->

                        <p class="services__lambda_photos">
                            <img class="photo photo11" src="/pages_artisans/ypria/images/photos2/mq1.jpeg" width="100" alt="">
                            <img class="photo photo12" src="/pages_artisans/ypria/images/photos2/mq2.jpeg"  width="100" alt="">
                        </p>
                        <p class="services__lambda_photos">
                            <img class="photo photo13" src="/pages_artisans/ypria/images/photos2/mq3.jpeg"  width="100" alt="">
                            <img class="photo photo14" src="/pages_artisans/ypria/images/photos2/mq4.jpeg" width="100" alt="">
                        </p>
                        <p class="services__lambda_photos">
                            <img class="photo photo15" src="/pages_artisans/ypria/images/photos2/mq5.jpeg" width="100" alt="">
                            <img class="photo photo16" src="/pages_artisans/ypria/images/photos2/mq6.jpeg" width="100" alt="">
                        </p>
                        <p class="services__lambda_photos">
                            <img class="photo photo17" src="/pages_artisans/ypria/images/photos2/mq7.jpeg"  width="100" alt="">
                            <img class="photo photo18" src="/pages_artisans/ypria/images/photos2/mq8.jpeg"  width="100" alt="">
                        </p>
                        <p class="services__lambda_photos">
                            <img class="photo photo19" src="/pages_artisans/ypria/images/photos2/mq9.jpeg"  width="100" alt="">
                            <img class="photo photo20" src="/pages_artisans/ypria/images/photos2/mq10.jpeg" width="100" alt="">
                        </p>                  
                </div>       
            </section>   
                <div class="en-tete__contact">
                    <div class="button" >
                        <img class="en-tete__contact_icone" src="/pages_artisans/icones/telephone.svg" alt=""> 
                        <a class="en-tete__contact-text" href="tel:+33745063458">             
                            07 45 06 34 58 
                        </a>
                    </div>
                </div>

                                    <!-- PRICE SECTION    -->

            <section id="payment" class="services">
                <h2 class="services__title limelight-regular">Paiement</h2>            
                <div class="services__lambda">
                    <h2 class="services__lambda_title">Tarif</h2>
                    <p class="services__lambda_text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet consequatur, natus, asperiores vitae ipsam provident quo ab minus officia, ipsum quia sequi repellat adipisci modi ipsa eius ducimus? Cumque et ipsa unde, doloremque hic voluptates nesciunt aliquam fugit impedit nemo minus possimus assumenda praesentium earum autem, architecto similique 
                    </p>  
                </div>
            </section>                       

                                <!--     WHO AM I SECTION     -->

            <section id="whoami" class="services">
                <h2 class="services__title limelight-regular">Qui suis-je</h2>            
                <div class="services__lambda">
                    <h2 class="services__lambda_title">Junia</h2>
                    <p class="services__lambda_text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet consequatur, natus, asperiores vitae ipsam provident quo ab minus officia, ipsum quia sequi repellat adipisci modi ipsa eius ducimus? Cumque et ipsa unde, doloremque hic voluptates nesciunt aliquam fugit impedit nemo minus possimus assumenda praesentium earum autem, architecto similique 
                    </p>  
                </div>
            </section>
            <div class="en-tete__contact">
                <div class="button" >
                    <img class="en-tete__contact_icone" src="/pages_artisans/icones/telephone.svg" alt=""> 
                    <a class="en-tete__contact-text" href="tel:+33745063458">             
                        07 45 06 34 58 
                    </a>
                </div>
            </div>
                                <!--    ******FORMULAIRE DE CONTACT *******-->


            <form id="contact" class="form-container">
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
                    <a class="socialmedia-link insta"  href="https://www.instagram.com/ypria_beauty?igsh=MWw1ZDdpdHQ1NjJnOQ==">             
                        <img class="socialmedia-img" src="/pages_artisans/icones/icons8-instagram-48.svg"  alt=""> 
                    </a>
                    <a class="socialmedia-link tictac"  href="https://www.tiktok.com/@ypria_?_r=1&_t=ZN-93t81PboCjD">             
                        <img class="socialmedia-img" src="/pages_artisans/icones/icons8-tic-tac-50.svg" alt=""> 
                    </a>
                    <a class="socialmedia-link fbook"  href="https://www.facebook.com/share/14VhSsPpgAV/?mibextid=wwXIfr">             
                        <img class="socialmedia-img" src="/pages_artisans/icones/icons8-facebook-48.svg"  alt=""> 
                    </a>
                </div>
            </div> 

                    <!-- Navbar bottom screen for mobile -->

            <nav class="navbar navbar-bottom">
                <ul class="nav-links">
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#nails">Ongles</a></li>
                    <li><a href="#make-up">Maquillage</a></li>
                    <li><a href="#payment">Paiement</a></li>
                    <li><a href="#whoami">Qui suis-je</a></li>
                </ul>
            </nav>
        </main>
        <footer class="footer-nav">
            <a class="mentions-link" href="/pages_artisans/ypria/mentions_legales.php">Mentions légales</a>
        </footer>
    </div>
    <script src="/assets/vap/form.js"></script>
</body>
</html>
