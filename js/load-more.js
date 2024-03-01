// Script permettant de charger + d'images avec AJAX ce qui permet de ne pas recharger la page lors de la requète
console.log("Chargement de plus d'images avec Ajax : son js est chargé");

(function($) {
    $('#viewMore').click(function() {
        var button = $(this),
            data = {
                'action': 'load_more',
                'query': ajaxloadmore ? ajaxloadmore.query_vars : null, // Ajout de la vérification
                'page': button.data('page')
            };

        $.ajax({
            url: ajaxloadmore.ajaxurl, // Utilisation de ajaxloadmore.ajaxurl
            data: data,
            type: 'POST',
            beforeSend: function(xhr) {
                button.text('Chargement...');
            },
            success: function(data) {
                console.log('Réponse AJAX reçue :', data);
            
                if (data === 'no_posts') {
                    button.remove();
                } else if(data) {
                    try {
                        // Essayer de créer un objet jQuery à partir de la réponse
                        var $data = $(data);
                        button.data('page', button.data('page') + 1);
                        $('#moreImage').before($data);
                        button.text('Charger plus');
                        // Commentez la ligne suivante si vous ne l'utilisez pas réellement
                        // attachEventsToImages(); 
                    } catch (error) {
                        console.error('Erreur lors de la création de l\'objet jQuery :', error);
                    }
                } else {
                    button.text('Plus de photos à charger');
                }
            }
        });
    });
})(jQuery);
