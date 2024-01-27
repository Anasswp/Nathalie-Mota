document.addEventListener("DOMContentLoaded", function () {
    const boutonContact = document.getElementById("contact-button");
    const boutonContactPost = document.getElementById("contact-post");
    const modale = document.querySelector(".modale");
    const overlay = document.querySelector(".overlay");
    const referenceCopy = document.getElementById("single-reference");
    const modalReference = document.querySelector("#modal-reference input");

    // Fonction pour afficher ou masquer la modale et l'overlay
    function toggleModale() {
        if (modale.style.display === "flex") {
            modale.style.display = "none";
            overlay.style.display = "none";
        } else {
            modale.style.display = "flex";
            overlay.style.display = "block";
            // Copier la référence dans le champ de la modale
            modalReference.value = referenceCopy.textContent;
        }
    }

    // Gestionnaire d'événements pour le bouton "contact-button"
    boutonContact.addEventListener("click", function (event) {
        event.stopPropagation();
        toggleModale();
    });

    // Gestionnaire d'événements pour le bouton "contact-post"
    boutonContactPost.addEventListener("click", function (event) {
        event.stopPropagation();
        toggleModale();
    });

    // Gestionnaire d'événements sur la fenêtre (lorsqu'on clique n'importe où sur la page)
    document.addEventListener('click', (event) => {
        if (!modale.contains(event.target) && event.target !== boutonContact && event.target !== boutonContactPost) {
            // Cacher la modale uniquement si elle est affichée
            if (modale.style.display === "flex") {
                toggleModale();
            }
        }
    });

    const nav = document.querySelector("nav");
    const contactBouton = document.getElementById("contact-post");

    contactBouton.addEventListener("click", function (event) {
        event.stopPropagation();
        nav.classList.add("active");
    });
});
