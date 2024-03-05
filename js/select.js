
//* Déclarer la bibliothèque select2 pour custom les selects du formulaire de ti

$(document).ready(function() {
    $('.taxonomy-select').select2({
        dropdownPosition: 'below',
        
    });
});

$(document).ready(function(){
   
    $(".bouton").hover(
        function(){
            // Fonction exécutée lorsque le survol commence
            $(this).find("a").css("color", "#fff"); // Changer la couleur de fond à rouge (#ff0000)
        },
        function(){
            // Fonction exécutée lorsque le survol se termine
            $(this).find("a").css("color", "#000"); // Rétablir la couleur de fond par défaut
        }
    );
});
