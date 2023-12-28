document.addEventListener("DOMContentLoaded", function () {
    const boutonContact = document.getElementById("contact-button");
    const modale = document.querySelector(".modale");
    const conteneurModale = document.querySelector(".modale-contact");

    boutonContact.addEventListener("click", function () {
        if (modale.style.display === "block") {
            modale.style.display = "none";
        } else {
            modale.style.display = "block";
        }
    });

    // Fermeture de la modale lorsqu'on clique hors de la modale
    window.addEventListener('click', (event) => {
        if (event.target === conteneurModale) {
            modale.style.display = "none";
        }
    });
});

