
/* Affichage Miniature */
console.log("Affichage Miniature : son js est chargé");

$(document).ready(function() {
    const miniaturePhoto = $('#miniaturePhoto');

    $('.arrow__left, .arrow__right').hover(
        function() {
            miniaturePhoto.css({
                visibility: 'visible',
                opacity: 1
            }).html(`<a href="${$(this).data('target-url')}">
                        <img src="${$(this).data('thumbnail-url')}" alt="${$(this).hasClass('arrow__left') ? 'Photo précédente' : 'Photo suivante'}">
                    </a>`);
        },
        function() {
            miniaturePhoto.css({
                visibility: 'hidden',
                opacity: 0
            });
        }
    );

    $('.arrow__left, .arrow__right').click(function() {
        window.location.href = $(this).data('target-url');
    });
});