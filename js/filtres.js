
/* les Filtres */
console.log("les Filtres : son js est chargé");

(function($){

    function fetchFilteredPhotos(){
        var filter = {
            'categorie': $('#categorie').val(),
            'format': $('#format').val(),
            'annee': $('#annee').val(),
        };

        $.ajax({
            url: ajax_params.ajax_url,
            data: {
                'action': 'filter_photos',
                'filter': filter
            },
            type: 'POST',
            beforeSend: function(){
                $('#photo__container').html('<div class="loading">Chargement en cours..</div>');
            },
            success: function(data) {
                $('#photo__container').html(data);
                attachEventsToImages();
                setTimeout(function() {
                document.getElementById('photo__container').scrollIntoView();
            }, 0);
        }})
    }

    $('#filtrePhoto select').on('change', function(event){
        event.preventDefault();
        fetchFilteredPhotos();
    });
})(jQuery);
