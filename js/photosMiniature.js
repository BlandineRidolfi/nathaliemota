// Ce message s'affichera dans la console lorsque le script JS sera chargé
console.log("Affichage Miniature : le js de la miniature est chargé");

$(document).ready(function() {
    // Gestion de l'événement 'mouseenter' sur les flèches gauche et droite
    $('.arrow__left, .arrow__right').mouseenter(function() {
        // Récupération de l'élément suivant (la miniature) et modification de son style
        $(this).next().css({
            visibility: 'visible',
            opacity: 1
        }).html(`<a href="${$(this).data('target-url')}">
                        <img src="${$(this).data('thumbnail-url')}" alt="${$(this).hasClass('arrow__left') ? 'Photo précédente' : 'Photo suivante'}">
                    </a>`);
    });

    // Gestion de l'événement 'mouseleave' sur le conteneur des flèches
    $('.arrowContainer').mouseleave(function() {
        // Recherche de l'élément '.minaturePhoto' à l'intérieur et modification de son style
        $(this).find('.minaturePhoto').css({
            visibility: 'hidden',
            opacity: 0
        });
    });

    // Gestion de l'événement 'click' sur les flèches gauche et droite
    $('.arrow__left, .arrow__right').click(function() {
        // Redirection vers l'URL cible
        window.location.href = $(this).data('target-url');
    });
});
