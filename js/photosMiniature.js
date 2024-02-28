console.log("Affichage Miniature : le js de la miniature est chargé");

$(document).ready(function() {
    $('.arrow__left, .arrow__right').mouseenter(function() {
        $(this).next().css({
            visibility: 'visible',
            opacity: 1
        }).html(`<a href="${$(this).data('target-url')}">
                        <img src="${$(this).data('thumbnail-url')}" alt="${$(this).hasClass('arrow__left') ? 'Photo précédente' : 'Photo suivante'}">
                    </a>`);
    });

    $('.arrowContainer').mouseleave(function() {
        $(this).find('.minaturePhoto').css({
            visibility: 'hidden',
            opacity: 0
        });
    });

    $('.arrow__left, .arrow__right').click(function() {
        window.location.href = $(this).data('target-url');
    });
});
