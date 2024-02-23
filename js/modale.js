
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
})(jQuery);