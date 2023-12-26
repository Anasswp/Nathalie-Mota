// Gestion de la modale de contact
document.addEventListener("DOMContentLoaded", function () {
    const boutonContact = document.querySelector("...");
    const modale = document.querySelector("...");
    const boutonFermeture = document.querySelector("...");
    const conteneurModale = document.getElementById("....");
    boutonContact.addEventListener("click", function() {
    // Gestion de la fermeture de la modale - En cliquant à
    if (modale.style.display === "block") {
    modale.style.display = "none";
    }
    else {
    modale.style.display = "block";
}
    });
// Fermeture de la modale lorsqu'on clic sur la croix
boutonFermeture.addEventListener("click", function() {
modale.style.display = "none";
});
// Fermeture de la modale lorsqu'on clic hors de la modale
window.addEventListener('click', (event) => {
if (event.target === conteneurModale) {
modale.style.display = "none";
}
});
});