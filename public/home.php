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
    <link rel="stylesheet" href="assets/vap/style.css">
</head>
<body>

    <header>
        <div class="logo">
            <img src="assets/vap/logoAP.png" alt="Logo votre artisan pro, bleu et orange" >
        </div>
    </header>
    <main>

        <div>
            <h1>Votre site professionnel clé en main pour votre activité artisanale</h1><br><br>
            <h2>Nous vous simplifions la tâche :</h2><br><br>
            <br><p>Un site pour votre activité, adapté à tous les écrans, simple, efficace, prêt à l’emploi,
            et optimisé pour le référencement google</p><br><br>
            <p>**************</p><br>
            <p><u>Tarif unique sans coûts cachés :</u></p><br><br>
            <p>Une seule fois 69€ pour la réalisation</p><br>
            <p>12,99€/mois pour l'hébergement, la maintenance, les petites modifications, les mises a jour</p><br>
            <p>**************</p>
        </div>



        <!--<button>Je crée mon site maintenant</button>-->
        <!--    ******FORMULAIRE DE CONTACT *******-->


        <form id="contact" class="form-container" novalidate>
            <h2>Contactez-moi</h2>
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="subject">Sujet</label>
                <input type="text" id="subject" name="subject" required>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" required></textarea>
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
