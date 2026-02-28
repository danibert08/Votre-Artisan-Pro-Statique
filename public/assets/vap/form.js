
document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("contact");
    const responseBox = document.getElementById("form-response");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        // Utiliser un chemin relatif pour rester sur le même domaine
        const API_URL = "/send_mail.php";

        fetch(API_URL, {
            method: "POST",
            body: formData,
            credentials: "include" // nécessaire pour session/csrf
        })
        .then(res => res.json())
        .then(data => {

            responseBox.textContent = data.message ?? (data.status === "success" ? "Message envoyé !" : "Erreur d'envoi");
            responseBox.className = data.status ?? "error";

            if (data.status === "success") {
                form.reset();
            }
        })
        .catch((err) => {
            console.error("Fetch error:", err);
            responseBox.textContent = "Erreur serveur.";
            responseBox.className = "error";
        });
    });

});