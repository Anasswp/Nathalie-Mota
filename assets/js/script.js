document.addEventListener("DOMContentLoaded", function () {
    const boutonContact = document.getElementById("contact-button");
    const boutonContactPost = document.getElementById("contact-post");
    const modale = document.querySelector(".modale");
    const conteneurModale = document.querySelector(".modale-contact");
    const overlay = document.querySelector(".overlay");
    const nav = document.querySelector("nav");
    const contactBouton = document.getElementById("contact-post");
    const referenceCopy = document.getElementById("single-reference");
    const modalReference = document.querySelector("#modal-reference input");

    // Fonction pour afficher ou masquer la modale et l'overlay
    function toggleModale() {
        if (modale.style.display === "flex") {
            modale.style.display = "none";
            overlay.style.display = "none"; // Masquer l'overlay
            nav.classList.remove("active");
        } else {
            modale.style.display = "flex";
            overlay.style.display = "block"; // Afficher l'overlay
            nav.classList.add("active");
            modalReference.value = referenceCopy.textContent;
        }
    }

    // Gestionnaire d'événements pour le bouton "contact-button"
    boutonContact.addEventListener("click", function (event) {
        event.stopPropagation(); // Empêcher la propagation de l'événement
        toggleModale();
    });

    // Gestionnaire d'événements pour le bouton "contact-post"
    boutonContactPost.addEventListener("click", function (event) {
        event.stopPropagation(); // Empêcher la propagation de l'événement
        toggleModale();
    });

    // Gestionnaire d'événements sur la fenêtre (lorsqu'on clique n'importe où sur la page)
    document.addEventListener('click', (event) => {
        if (!conteneurModale.contains(event.target) && event.target !== boutonContact && event.target !== boutonContactPost) {
            modale.style.display = "none";
            overlay.style.display = "none"; // Masquer la modale et l'overlay
            nav.classList.remove("active");
        }
    });
});
