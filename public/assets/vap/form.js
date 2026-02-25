
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
document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("contact");
    const responseBox = document.getElementById("form-response");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        const API_URL = "https://votreartisanpro.fr/send_mail.php";

        fetch(API_URL, {
            method: "POST",
            body: formData
            
            .then(res => res.json())
            .then(data => {

            responseBox.textContent = data.message;
            responseBox.className = data.status;

            if (data.status === "success") {
                form.reset();
            }
        })
        .catch(() => {
            responseBox.textContent = "Erreur serveur.";
            responseBox.className = "error";
        });
    });

});