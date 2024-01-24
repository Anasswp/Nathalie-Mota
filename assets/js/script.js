document.addEventListener("DOMContentLoaded", function () {
    let urlActuelle = window.location.href;
    const boutonContact = document.getElementById("contact-button");
    const modale = document.querySelector(".modale");
    const overlay = document.querySelector(".overlay");
    const nav = document.querySelector("nav");
    let contactBouton;  // Déclarer contactBouton ici
    let referenceCopy;
    let modalReference;
    if (urlActuelle.match(/photographies/)) {
        console.log('Page single détectée');
         referenceCopy = document.getElementById("single-reference");
         modalReference = document.querySelector("#modal-reference input");
        contactBouton = document.getElementById("contact-post");  // Initialiser contactBouton ici
    }

    console.log('Chargement de la modale');

    // Fonction pour afficher ou masquer la modale et l'overlay
    function toggleModale() {
        console.log('Toggle Modale');
        if (modale.style.display === "block") {
            console.log('Disparition');
            modale.style.display = "none";
            overlay.style.display = "none"; // Masquer l'overlay
            nav.classList.remove("active");
        } else {
            console.log('Apparition');
            modale.style.display = "block";
            overlay.style.display = "block"; // Afficher l'overlay
            nav.classList.add("active");
            if (urlActuelle.match(/photographies/)) {
                modalReference.value = referenceCopy.textContent;
            }
            console.log('Toggle Modale ' + modale.style.display);
        }
    }

    // Gestionnaire d'événements pour le bouton "contact-button"
    boutonContact.addEventListener("click", function (event) {
        // Empêcher la propagation de l'événement
        console.log('Clique sur bouton contact');
        toggleModale();
        console.log('Après clic ' + modale.style.display);
    });

    // Gestionnaire d'événements pour le bouton "contact-post"
    if (contactBouton) {
        contactBouton.addEventListener("click", function (event) {
            console.log('Déclenchement de l\'événement');
            toggleModale();
        });
    }
});
