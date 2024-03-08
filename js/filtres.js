                                                   // JS DES FILTRES

console.log("Le JS des filtres s'est correctement chargé");

jQuery(document).ready(function ($) {
  $("#categorie, #format, #annees").on("change", function () {
    // Je récupère les valeurs des filtres
    const category = $("#categorie").val();
    const format = $("#format").val();
    const years = $("#annees").val();
    console.log(category);
    // Je vérifie si les valeurs sont les valeurs par défaut
    const isDefaultValues = category === "" && format === "" && years === "";

    // J'effectue une requête AJAX pour filtrer les photos
    $.ajax({
      url: ajax_params.ajax_url,
      type: "post",
      data: {
        action: "filter_photos",
        filter: {
          category: category,
          format: format,
          years: years,
        },
      },
      success: function (response) {
        // Je met à jour la section des photos avec les résultats filtrés
        $("#photo__container").html("");
        $("#photo__container").append(response);
        attachEventsToImages();

        // Je masque le bouton "Voir plus" si des filtres sont appliqués
        if (category.length || format.length || years.length) {
          $("#viewMore").hide();
        } else {
          $("#viewMore").show();
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
        console.log(ajaxOptions);
        console.log(xhr.responseText);
      },
      complete: function () {
        // Si les valeurs sont les valeurs par défaut, je relance le conteneur photo
        if (isDefaultValues) {
          // Je met à jour la section des photos avec le contenu par défaut
          $("#photo__container").load(window.location.href + " #photo__container");
        }
      },
    });
  });
});
