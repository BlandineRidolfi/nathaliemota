
(function($){

	/* Gestion de la modale  */

	$(".modale-contact").on("click", (event) => {
		event.preventDefault();
		//console.log("Clic détecté sur .modale-contact");
		$(".popup__overlay").css("display", "flex");
    });

	$(".popup__overlay").on("click", function(event){
		if (event.target !== this) return;
		//console.log("Clic détecté sur .popup__overlay"); 
		$(".popup__overlay").css("display", "none");
	}); 

	/* Je récupère la référence de la photo depuis le bouton contact vers la modale */
    const modaleOverlay = $(".popup__overlay");
    // Ajoute un gestionnaire d'événement au clic sur la fenêtre
    $(window).on("click", function (event) {
        // Vérifie si l'élément cliqué est l'overlay de la modale
        if ($(event.target).is(modaleOverlay)) {
        closeModal();
        }
    });
    // Fonction pour ouvrir la modale
    function openModal() {
        modaleOverlay.css("display", "flex");
    }
    // Fonction pour fermer la modale
    function closeModal() {
        modaleOverlay.css("display", "none");
    }
    $(".modale-contact").on("click", function (event){
        event.preventDefault();
        $("#referencePhoto").val($('#single-reference').html());
        openModal();
    })
})(jQuery);