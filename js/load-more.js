// Fonction pour attacher des événements aux images chargées
function attachEventsToImages() {
    // Votre logique d'attache d'événements ici
    console.log('Les photos se chargent');
}

// Fonction pour gérer le chargement du contenu additionnel
function loadMoreContent() {
    const offset = $("#viewMore").data("offset");
    const ajaxurl = ajax_params.ajax_url;

    // Utilisation d'AJAX pour charger plus de contenu
    $.ajax({
        url: ajaxurl,
        type: "post",
        data: {
            offset: offset,
            action: "load_more_photos",
        },
        success: function (response) {
            handleLoadResponse(response, offset);
        },
    });
}

// Fonction pour traiter la réponse du chargement AJAX
function handleLoadResponse(response, offset) {
    if (response == 'Aucune photo trouvée.') {
        handleNoPhotos();
    } else {
        appendPhotos(response);
        updateOffset(offset);
    }
}

// Fonction pour masquer le bouton "viewMore" en cas de l'absence de photos
function handleNoPhotos() {
    $("#viewMore").hide();
    console.log('Aucune photo n\'est disponible.');
}

// Fonction pour ajouter la réponse à la fin du conteneur des photos
function appendPhotos(response) {
    $("#photo__container").append(response);
    attachEventsToImages();
}

// Fonction pour mettre à jour l'offset pour la prochaine requête
function updateOffset(offset) {
    $("#viewMore").data("offset", offset + 8);
}

// Utiliser la délégation d'événement sur un parent stable
$(document).on("click", "#moreImage #viewMore", function () {
    loadMoreContent();
});

// Ce message s'affichera dans la console lorsque le script JS sera chargé
console.log("Le JS du bouton charger plus s'est correctement chargé");
