
//On récupère les éléments du DOM//
document.addEventListener("DOMContentLoaded", function () {
    const boutonContact = document.getElementById("contact-button");
    let modale = document.querySelector(".modale");
    const conteneurModale = document.querySelector(".modale-contact");

    //Vérifie si la propriété display de la modale est actuellement "flex"
    boutonContact.addEventListener("click", function () {
        // elle est affichée (display est réglé sur "flex")
        if (modale.style.display === "flex") {
            modale.style.display = "none";
        } else {
            modale.style.display = "flex";
        }
    });

    //Ajout d'un gestionnaire d'événements sur la fenêtre (lorsqu'on clique n'importe où sur la page)
    document.addEventListener('click', (event) => {
        if (!conteneurModale.contains(event.target) && event.target !== boutonContact) {
            modale.style.display = "none";
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