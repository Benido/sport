//Gère la recherche dynamique parmi les partenaires chargées sur la page

//On stocke dans des variables les objets jQuery fréquemment utilisés
const searchActivePartenaireBtn = $('#searchActivePartenaireButton')
const searchInactivePartenaireBtn = $('#searchInactivePartenaireButton')
const partenaireCard = $('.partenaireCard')

//On crée un state dans lequel on stocke la sélection sortie par la barre de recherche
//Au chargement de la page, montre tous les partenaires
let searchSelection = partenaireCard

function checkIfActive (selection) {
    if(searchActivePartenaireBtn.is(':checked')) {
        //On cache les cartes contenant un bouton inactif
        selection.find(".btn-warning").parent('.partenaireCard').hide()
    } else {
        selection.find(".btn-warning").parent('.partenaireCard').show()
    }
}

function checkIfInactive (selection) {
    if(searchInactivePartenaireBtn.is(':checked')) {
        //On cache les cartes contenant un bouton inactif
        selection.find(".btn-success").parent('.partenaireCard').hide()
    } else {
        selection.find(".btn-success").parent('.partenaireCard').show()
    }
}

function switchBtnState (thisButton, otherButton ) {
    if($(thisButton).is(':checked')) {
        $(thisButton).parent().addClass('active')
        if (otherButton.is(':checked')) {
            otherButton.prop('checked', false)
            otherButton.parent().removeClass('active')
        }
    } else {
        $(thisButton).parent().removeClass('active')
    }
}

$('#partenaireSearchBar').on('input', function() {
    if($(this).val()) {
        $('#partenairesDisplayBlock').children().hide()
        searchSelection = $(`[id^="${$(this).val()}"]`)
        searchSelection.show()
        checkIfActive(searchActivePartenaireBtn, searchSelection)
        checkIfInactive(searchInactivePartenaireBtn, searchSelection)
    } else {
        //On s'assure que la liste réapparaisse quand l'utilisateur efface son entrée
        searchSelection = $('.partenaireCard')
        searchSelection.show()
        checkIfActive(searchActivePartenaireBtn, searchSelection)
        checkIfInactive(searchInactivePartenaireBtn, searchSelection)
    }
} )

searchActivePartenaireBtn.on('change', function () {
    searchSelection.show()
    switchBtnState(this, searchInactivePartenaireBtn)
    checkIfActive(searchSelection)
})

searchInactivePartenaireBtn.on('change', function () {
    searchSelection.show()
    switchBtnState(this, searchActivePartenaireBtn)
    checkIfInactive(searchSelection)
})

$('#showAllPartenaires').on('click', function() {
    //On remet à zéro tous les filtres de recherche
    searchSelection = partenaireCard
    partenaireCard.show()
    $('#partenaireActiveButton, #partenaireInactiveButton')
        .prop('checked', false)
        .parent()
        .removeClass('active')
    $('#partenaireSearchBar').val('')
})