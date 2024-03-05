// Ce message s'affichera dans la console lorsque le script JS sera chargé
console.log("Le JS du menu burger s'est correctement chargé");
$(document).ready(function () {
    const menuBurger = $('.burgerMenu');
    const nav = $('.siteNavigation__menu');

    menuBurger.on('click', function () {
        const isOpen = nav.hasClass('open');

        if (isOpen) {
            // Si le menu est ouvert, ajoute la classe 'close' pour déclencher l'animation de fermeture
            nav.addClass('close');
            menuBurger.removeClass('open'); // Retirez la classe 'open' pour afficher les barres
            setTimeout(() => {
                // Après un délai, retire la classe 'open' et 'close' pour réinitialiser l'animation
                nav.removeClass('open close');
            }, 1000); // Assurez-vous que le délai correspond à la durée de l'animation de fermeture
        } else {
            // Si le menu est fermé, ajoute la classe 'open' pour déclencher l'animation d'ouverture
            nav.addClass('open');
            menuBurger.addClass('open'); // Ajoutez la classe 'open' pour afficher la croix
        }
    });
});
