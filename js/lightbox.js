// Ce message s'affichera dans la console lorsque le script JS sera chargé
console.log("Le JS de la lightbox s'est correctement chargé");
// Fonction principale exécutée lorsque le DOM est prêt
$(function () {
    // Sélection des éléments du DOM nécessaires
    const $lightbox = $("#lightbox");
    const $lightboxImage = $(".lightboxImage");
    const $lightboxCategory = $(".lightboxCategorie");
    const $lightboxReference = $(".lightboxReference");
    let currentIndex = 0; // Indice de l'image actuellement affichée dans la lightbox
  
    // Fonction pour mettre à jour le contenu de la lightbox en fonction de l'index de l'image
    function updateLightbox(index) {
      const $images = $(".icon-fullscreen");
      const $image = $images.eq(index);
  
      // Récupération des données associées à l'image
      const categoryText = $image.data("category").toUpperCase();
      const referenceText = $image.data("reference").toUpperCase();
  
      // Mise à jour des éléments de la lightbox avec les nouvelles données
      $lightboxImage.attr("src", $image.data("full"));
      $lightboxCategory.text(categoryText);
      $lightboxReference.text(referenceText);
      currentIndex = index;
    }
  
    // Fonction pour ouvrir la lightbox avec une image spécifique (index)
    function openLightbox(index) {
      updateLightbox(index);
      $lightbox.show();
    }
  
    // Fonction pour fermer la lightbox
    function closeLightbox() {
      $lightbox.hide();
    }
  
    // Fonction pour attacher les événements aux images
    function attachEventsToImages() {
      const $images = $(".icon-fullscreen");
      $images.off("click", imageClickHandler);
      $images.on("click", imageClickHandler);
    }
  
    // Gestionnaire d'événement pour le clic sur une image
    function imageClickHandler() {
      const $images = $(".icon-fullscreen");
      const index = $images.index($(this).closest(".icon-fullscreen"));
      openLightbox(index);
    }
  
    // Attachement des événements aux images lors du chargement initial
    attachEventsToImages();
  
    // Gestionnaire d'événement pour le clic sur le bouton de fermeture
    $(".lightboxClose").on("click", closeLightbox);
  
    // Gestionnaire d'événement pour le clic sur le bouton précédent
    $(".lightboxPrevious").on("click", function () {
      const $images = $(".icon-fullscreen");
      currentIndex = currentIndex > 0 ? currentIndex - 1 : $images.length - 1;
      updateLightbox(currentIndex);
    });
  
    // Gestionnaire d'événement pour le clic sur le bouton suivant
    $(".lightboxNext").on("click", function () {
      const $images = $(".icon-fullscreen");
      currentIndex = currentIndex < $images.length - 1 ? currentIndex + 1 : 0;
      updateLightbox(currentIndex);
    });
  
    // Réattachez les gestionnaires d'événements après le chargement dynamique du contenu
    $(document).ajaxComplete(function () {
      attachEventsToImages();
    });
  });