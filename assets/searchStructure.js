//Gère la recherche dynamique parmi les structures chargées sur la page

//On stocke dans des variables les objets jQuery fréquemment utilisés
const searchActiveStructureBtn = $('#searchActiveStructureButton')
const searchInactiveStructureBtn = $('#searchInactiveStructureButton')
const structureCard = $('.structureCard')

////On crée un state dans lequel on stocke la sélection sortie par la barre de recherche
// //Montre toutes les structures par défaut
let searchSelection = structureCard

function checkIfActive(selection) {
    if(searchActiveStructureBtn.is(':checked')) {
        //On cache les cartes contenant un bouton inactif
        selection.find(".btn-warning").parent('.structureCard').hide()
    } else {
        selection.find(".btn-warning").parent('.structureCard').show()
    }
}

function checkIfInactive(selection) {
    if(searchInactiveStructureBtn.is(':checked')) {
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
        searchSelection = structureCard
        searchSelection.show()
        checkIfActive(searchSelection)
        checkIfInactive(searchSelection)
    }
} )

searchActiveStructureBtn.on('change', function() {
    //On active ou non le bouton en fonction de son statut checked
    searchSelection.show()

    if($(this).is(':checked')) {
        $(this).parent().addClass('active')
        if (searchInactiveStructureBtn.is(':checked')) {
            searchInactiveStructureBtn.prop('checked', false)
            searchInactiveStructureBtn.parent().removeClass('active')
        }
    } else {
        $(this).parent().removeClass('active')
    }

    //On filtre les structures ayant le statut actif
    checkIfActive(searchSelection)
})

searchInactiveStructureBtn.on('change', function() {
    //On active ou non le bouton en fonction de son statut checked
    searchSelection.show()

    if($(this).is(':checked')) {
        $(this).parent().addClass('active')
        if (searchActiveStructureBtn.is(':checked')) {
            searchActiveStructureBtn.prop('checked', false)
            searchActiveStructureBtn.parent().removeClass('active')
        }
    } else {
        $(this).parent().removeClass('active')
    }

    //On filtre les structure ayant le statut inactif
    checkIfInactive(searchSelection)
})

$('#showAllStructures').on('click', function() {
    //On remet à zéro tous les filtres de recherche
    searchSelection = structureCard
    structureCard.show()
    $('#searchActiveStructureButton, #searchInactiveStructureButton')
        .prop('checked', false)
        .parent()
        .removeClass('active')
    $('#structureSearchBar').val('')
})