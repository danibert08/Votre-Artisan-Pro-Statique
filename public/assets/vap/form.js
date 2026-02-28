
// document.addEventListener("DOMContentLoaded", function(){
//     document.querySelector(".button").addEventListener("click", function(e){
//         e.preventDefault();

//         const formData = new FormData();
//         formData.append("nom", document.querySelector("#name").value.trim());
//         formData.append("email", document.querySelector("#email").value.trim());
//         formData.append("subject", document.querySelector("#subject").value.trim());
//         formData.append("message", document.querySelector("#message").value.trim());
      

//         fetch("http://localhost:8002/send_mail.php", {
//             method: "POST",
//             body: formData
//         })
//         .then(response => response.json())
//         .then(data => {
//             alert(data.message);
//         })
//         .catch(error => console.error(error));
//     });

// });



// document.addEventListener("DOMContentLoaded", function () {

//     const form = document.getElementById("contact");
//     const responseBox = document.getElementById("form-response");

//     form.addEventListener("submit", function (e) {
//         e.preventDefault();

//         const formData = new FormData(form);

//         const API_URL = "https://votreartisanpro.fr/send_mail.php";

//         fetch(API_URL, {
//             method: "POST",
//             body: formData,
//             credentials: "include"
//         })
//         .then(res => res.json())
//         .then(data => {

//             responseBox.textContent = data.message;
//             responseBox.className = data.status;

//             if (data.status === "success") {
//                 form.reset();
//             }
//         })
//         .catch(() => {
//             responseBox.textContent = "Erreur serveur.";
//             responseBox.className = "error";
//         });
//     });

// });


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