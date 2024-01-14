
document.addEventListener("DOMContentLoaded", function () {
    const boutonContact = document.getElementById("contact-button");
    const boutonContactPost = document.getElementById("contact-post");
    const modale = document.querySelector(".modale");
    const conteneurModale = document.querySelector(".modale-contact");
    const overlay = document.querySelector(".overlay");

    // Fonction pour afficher ou masquer la modale et l'overlay
    function toggleModale() {
        if (modale.style.display === "flex") {
            modale.style.display = "none";
            overlay.style.display = "none"; // Masquer l'overlay également
        } else {
            modale.style.display = "flex";
            overlay.style.display = "block"; // Afficher l'overlay
        }
    }

    // Gestionnaire d'événements pour le bouton "contact-button"
    boutonContact.addEventListener("click", function () {
        toggleModale();
    });

    // Gestionnaire d'événements pour le bouton "contact-post"
    boutonContactPost.addEventListener("click", function () {
        toggleModale();
    });

    // Gestionnaire d'événements sur la fenêtre (lorsqu'on clique n'importe où sur la page)
    document.addEventListener('click', (event) => {
        if (!conteneurModale.contains(event.target) && event.target !== boutonContact && event.target !== boutonContactPost) {
            toggleModale();
        }
    });
});



document.addEventListener("DOMContentLoaded", function (){
    const nav = document.querySelector("nav");
    const contactBouton = document.getElementById("contact-post");
    let modale = document.querySelector(".modale");
    const referenceCopy = document.getElementById("single-reference");
    const modalReference = document.getElementById("modal-reference");


    contactBouton.addEventListener("click", function (){
        nav.classList.add("active");
        modale.style.display = "flex";
        modalReference.value = referenceCopy.textContent;
    });
});