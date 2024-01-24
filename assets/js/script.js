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


// Flèches de navigation sur single-photo.php
document.addEventListener("DOMContentLoaded", function () {

// Si on se trouve sur la page single-photo.php seulement
    let urlActuelle = window.location.href;
    if (urlActuelle.match(/photographies/)) {
    const flechePrecedente = document.querySelector('.fleche-gauche');
    const flecheSuivante = document.querySelector('.fleche-droite');
    const zoneVignetteGauche = document.querySelector('.conteneur-vignette-precedent');
    const zoneVignetteDroite = document.querySelector('.conteneur-vignette-suivant');

    flechePrecedente.addEventListener('mouseenter', function() {
        zoneVignetteGauche.style.display = "flex";
    });

    flechePrecedente.addEventListener('mouseleave', function() {
        zoneVignetteGauche.style.display = "none";
    });

    flecheSuivante.addEventListener('mouseenter', function() {
        zoneVignetteDroite.style.display = "flex";
    });

    flecheSuivante.addEventListener('mouseleave', function() {
        zoneVignetteDroite.style.display = "none";
    });
}

overlay();
});


document.addEventListener("DOMContentLoaded", function () {
    // Gestionnaire d'événements pour l'image précédente
    const previousPostImage = document.querySelector('.previous-post-image');
    if (previousPostImage) {
        previousPostImage.addEventListener('click', function () {
            // Récupérer l'URL du post précédent
            const previousPostLink = document.querySelector('.previous-post a');
            if (previousPostLink) {
                const previousPostURL = previousPostLink.getAttribute('href');
                // Rediriger vers l'URL du post précédent
                if (previousPostURL) {
                    window.location.href = previousPostURL;
                }
            }
        });
    }

    // Gestionnaire d'événements pour l'image suivante
    const nextPostImage = document.querySelector('.next-post-image');
    if (nextPostImage) {
        nextPostImage.addEventListener('click', function () {
            // Récupérer l'URL du post suivant
            const nextPostLink = document.querySelector('.next-post a');
            if (nextPostLink) {
                const nextPostURL = nextPostLink.getAttribute('href');
                // Rediriger vers l'URL du post suivant
                if (nextPostURL) {
                    window.location.href = nextPostURL;
                }
            }
        });
    }
});




/////////////////////////////////////////////////////////////////////////

// Overlay des photos de photo-bloc.php

function overlay() {
    // Apparition de l'overlay au survol
    const autresPhotos = document.querySelectorAll('.autres-photos');

    autresPhotos.forEach(element => {
        const overlay = element.querySelector('.survol-photo');
        const oeil = element.querySelector('.oeil');
        const divLienPhoto = element.querySelector('.lien-photo');
        const lienPhoto = divLienPhoto.innerHTML;


        // Début du survol
        element.addEventListener('mouseenter', function() {
            overlay.style.display = 'block';
        });
        // Fin du survol
        element.addEventListener('mouseleave', function() {
            overlay.style.display = 'none';
        });

        //////////////////////////

        // Clic sur l'oeil pour redirection de page
        oeil.addEventListener('click', function() {
            // Redirection vers la page de la photo
            window.location.href = lienPhoto;
        });
    });

    lightbox();
}

