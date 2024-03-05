//* Déclaration de la bibliothèque select2 pour custom les selects du formulaire de tri
console.log("Le JS des select s'est correctement chargé");

$(document).ready(function () {
    $('.taxonomy-select').select2({
        dropdownPosition: 'below',
        // dropdownParent: $(document.body)
    });
});