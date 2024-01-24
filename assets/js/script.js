document.addEventListener("DOMContentLoaded", function () {
    let urlActuelle = window.location.href;
    const boutonContact = document.getElementById("contact-button");
    const modale = document.querySelector(".modale");
    const overlay = document.querySelector(".overlay");
    const nav = document.querySelector("nav");
    let contactBouton;

    if (urlActuelle.match(/photographies/)) {
        console.log('Page single détectée');
        const referenceCopy = document.getElementById("single-reference");
        const modalReference = document.querySelector("#modal-reference input");
        contactBouton = document.getElementById("contact-post");
    }

    console.log('Chargement de la modale');

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

    boutonContact.addEventListener("click", function (event) {
        event.stopPropagation(); // Empêcher la propagation de l'événement
        console.log('Clique sur bouton contact');
        toggleModale();
        console.log('Après clic ' + modale.style.display);
    });

    if (contactBouton) {
        contactBouton.addEventListener("click", function (event) {
            event.stopPropagation(); // Empêcher la propagation de l'événement
            console.log('Déclenchement de l\'événement');
            toggleModale();
        });
    }

    // Gestionnaire d'événements pour la fenêtre entière
    window.addEventListener('click', function (event) {
        if (!modale.contains(event.target) && event.target !== boutonContact && event.target !== contactBouton) {
            // Clique en dehors de la modale, fermer la modale
            modale.style.display = "none";
            overlay.style.display = "none";
            nav.classList.remove("active");
        }
    });
});
