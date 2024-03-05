// Ce message s'affichera dans la console lorsque le script JS sera chargé
console.log("Le JS du bouton charger plus s'est correctement chargé");
// Fonction pour attacher des événements aux images chargées
function attachEventsToImages() {
    // Votre logique d'attache d'événements ici
    console.log('Les photos se chargent');
}

// Fonction pour gérer le chargement du contenu additionnel
function loadMoreContent() {
    const offset = $("#viewMore").data("offset");
    const ajaxurl = ajax_params.ajax_url;

    $.ajax({
        url: ajaxurl,
        type: "post",
        data: {
            offset: offset,
            action: "load_more_photos",
        },
        success: function (response) {
            if (response == 'Aucune photo trouvée.') {
                $("#viewMore").hide();
                console.log('Aucune photo n\'est disponible.');
            } else {
                $("#photo__container").append(response);
                attachEventsToImages();
                $("#viewMore").data("offset", offset + 8);
            }
        },
    });
}

// Utiliser la délégation d'événement sur un parent stable
$(document).on("click", "#moreImage #viewMore", function () {
    loadMoreContent();
});