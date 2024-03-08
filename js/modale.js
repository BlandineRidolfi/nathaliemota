                                  // JS DE LA PARTIE MODALE
                                  
console.log("Le JS de la modale s'est correctement chargé");

(function ($) {

  // Fonction pour ouvrir la modale
  function openModal() {
    $(".popup__overlay").css("display", "flex");
  }

  // Fonction pour fermer la modale
  function closeModal() {
    $(".popup__overlay").css("display", "none");
  }

  // Gestion du clic sur le bouton de contact
  $(".modale-contact").on("click", function (event) {
    event.preventDefault();
    $("#referencePhoto").val($('#single-reference').html());
    openModal();
  });

  // Gestion du clic en dehors de la modale pour la fermer
  $(".popup__overlay").on("click", function (event) {
    if (event.target === this) {
      closeModal();
    }
  });

  // Ajoute un gestionnaire d'événement au clic sur la fenêtre
  $(window).on("click", function (event) {
    // Vérifie si l'élément cliqué est l'overlay de la modale
    if ($(event.target).is(".popup__overlay")) {
      closeModal();
    }
  });

})(jQuery);
