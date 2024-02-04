document.addEventListener("DOMContentLoaded", function () {
    const boutonContact = document.getElementById("contact-button");
    const boutonContactPost = document.getElementById("contact-post");
    const modale = document.querySelector(".modale");
    const overlay = document.querySelector(".overlay");
    const referenceCopy = document.getElementById("single-reference");
    const modalReference = document.querySelector("#modal-reference input");

    let copyReference = false; // Variable pour vérifier si la référence doit être copiée

    // Fonction pour afficher ou masquer la modale et l'overlay
    function toggleModale() {
        if (modale.style.display === "flex") {
            modale.style.display = "none";
            overlay.style.display = "none";
            // Efface la référence dans le champ de la modale
            modalReference.value = "";
            copyReference = false; // Réinitialiser la variable
        } else {
            modale.style.display = "flex";
            overlay.style.display = "block";
            // Copie la référence dans le champ de la modale seulement si copyReference est vrai
            if (copyReference) {
                modalReference.value = referenceCopy.textContent;
                copyReference = false; // Réinitialise la variable après avoir copié la référence
            }
        }
    }

    // Gestionnaire d'événements pour le bouton "contact-button"
    boutonContact.addEventListener("click", function (event) {
        event.stopPropagation();
        toggleModale();
    });

    // Gestionnaire d'événements pour le bouton "contact-post"
    let urlActuelle = window.location.href;
    if (urlActuelle.match(/photographies/)) {
        boutonContactPost.addEventListener("click", function (event) {
            event.stopPropagation();
            // Défini copyReference à vrai avant d'ouvrir la modale
            copyReference = true;
            toggleModale();
        });
    }

    // Gestionnaire d'événements sur la fenêtre (lorsqu'on clique n'importe où sur la page)
    document.addEventListener('click', (event) => {
        if (!modale.contains(event.target) && event.target !== boutonContact && event.target !== boutonContactPost) {
            // Cache la modale uniquement si elle est affichée
            if (modale.style.display === "flex") {
                toggleModale();
            }
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    // Fonction pour rediriger vers la page du post lorsqu'on clique sur une image
    function redirectToPost(url) {
        window.location.href = url;
    }

    // Gestionnaire d'événements pour chaque élément avec la classe "photo-block"
    const photoBlocks = document.querySelectorAll('.photo-block');

    photoBlocks.forEach(photoBlock => {
        photoBlock.addEventListener('click', function (event) {
            // Assurez-vous que le clic provient de l'image et non des enfants (icônes, etc.)
            if (event.target.tagName.toLowerCase() !== 'i') {
                const postLink = this.querySelector('a').getAttribute('href');
                redirectToPost(postLink);
            }
        });
    });
});



  /////////////////////////////////////////////////////////////////////////


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
    
    /////////////////////////////////////////////////////////////////////////
    
    // Overlay des photos de photo_block.php
    
    function overlay() {
        // Apparition de l'overlay au survol
        const autresPhotos = document.querySelectorAll('.photo-block');
    
        autresPhotos.forEach(element => {
            const overlay = element.querySelector('.icons-container');
            const lightbox = document.querySelector('.lightbox');
            const oeil = element.querySelector('.oeil');
            const divLienPhoto = element.querySelector('.photo-details');
            const lienPhoto = divLienPhoto.textContent.trim();  // Utilisez textContent pour récupérer le texte
    
            // Début du survol
            element.addEventListener('mouseenter', function() {
                overlay.style.display = 'block';
                //lightbox.style.display = 'block';
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



    /////////////////////////////////////////////////////////////////////////
    
    document.addEventListener('DOMContentLoaded', function () {
        // Get the burger icon and menu
        const burgerIcon = document.getElementById('burger-icon');
        const navMenu = document.querySelector('nav');
    
        // Add click event listener to the burger icon
        burgerIcon.addEventListener('click', function () {
            // Toggle the 'active' class on both the burger icon and the menu
            burgerIcon.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
    });
    
    