//Gère la recherche dynamique parmi les structures chargées sur la page
let searchSelection = $('.structureCard')


function checkIfActive(selection) {
    if($('#structureActiveButton').is(':checked')) {
        //On cache les cartes contenant un bouton inactif
        selection.find(".btn-warning").parent('.structureCard').hide()
    } else {
        selection.find(".btn-warning").parent('.structureCard').show()
    }
}

function checkIfInactive(selection) {
    if($('#structureInactiveButton').is(':checked')) {
        //On cache les cartes contenant un bouton inactif
        selection.find(".btn-success").parent('.structureCard').hide()
    } else {
        selection.find(".btn-success").parent('.structureCard').show()
    }
}

$('#structureSearchBar').on('input', function() {
    if($(this).val()) {
        $('#structuresDisplayBlock').children().hide()
        searchSelection = $(`[id^="${$(this).val()}"]`)
        searchSelection.show()
        checkIfActive(searchSelection)
        checkIfInactive(searchSelection)
    } else {
        //On s'assure que la liste réapparaisse quand l'utilisateur efface son entrée
        searchSelection = $('.structureCard')
        searchSelection.show()
        checkIfActive(searchSelection)
        checkIfInactive(searchSelection)
    }
} )

$('#structureActiveButton').on('change', function() {
    //On active ou non le bouton en fonction de son statut checked
    $(this).is(':checked') ? $(this).parent().addClass('active') : $(this).parent().removeClass('active')

    //On filtre les structures ayant le statut actif
    checkIfActive(searchSelection)
})

$('#structureInactiveButton').on('change', function() {
    //On active ou non le bouton en fonction de son statut checked
    $(this).is(':checked') ? $(this).parent().addClass('active') : $(this).parent().removeClass('active')

    //On filtre les structure ayant le statut inactif
    checkIfInactive(searchSelection)
})

$('#showAllStructures').on('click', function() {
    //On remet à zéro tous les filtres de recherche
    searchSelection = $('.structureCard')
    $('.structureCard').show()
    $('#structureActiveButton, #structureInactiveButton')
        .prop('checked', false)
        .parent()
        .removeClass('active')
    $('#structureSearchBar').val('')
})