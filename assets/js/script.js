
//On récupère les éléments du DOM//
document.addEventListener("DOMContentLoaded", function () {
    const boutonContact = document.getElementById("contact-button");
    const modale = document.querySelector(".modale");
    const conteneurModale = document.querySelector(".modale-contact");
    const overlay = document.querySelector(".overlay");

    //Vérifie si la propriété display de la modale est actuellement "flex"
    boutonContact.addEventListener("click", function () {
        if (modale.style.display === "flex") {
            modale.style.display = "none";
            overlay.style.display = "none"; // Masquer l'overlay également
        } else {
            modale.style.display = "flex";
            overlay.style.display = "block"; // Afficher l'overlay
        }
    });

    //Ajout d'un gestionnaire d'événements sur la fenêtre (lorsqu'on clique n'importe où sur la page)
    document.addEventListener('click', (event) => {
        if (!conteneurModale.contains(event.target) && event.target !== boutonContact) {
            modale.style.display = "none";
            overlay.style.display = "none"; // Masquer l'overlay également
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