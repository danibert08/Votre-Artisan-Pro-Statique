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


<div class="logo">
    <img src="assets/vap/logoAP.png" alt="Logo votre artisan pro, bleu et orange" >
</div>
<h1>Votre site professionnel clé en main pour votre activité artisanale</h1>
<h2>En ligne en 24h – Simple, fiable, sans compétence technique</h2>
<br><p>Tarif abordable et pas de coûts cachés</p><br><br>
<h2>En preprod</h2>
<!--<button>Je crée mon site maintenant</button>-->
<!--    ******FORMULAIRE DE CONTACT *******-->


            <form id="contact" class="form-container" novalidate>
    <h2>Contactez-moi</h2>

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

<script src="assets/vap/form.js"></script>
            
</body>
</html>
