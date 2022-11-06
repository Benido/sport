//Gère les évènements onClick des cartes partenaires et structure

$('.structureCard').not('label').on('click', function (e) {
    if(!$(e.target).is('label, input')) {
        window.location = '/structure/' + $(this).attr('id')
        return false;
    }
})

$('.partenaireCard').not('label').on('click', function (e) {
    if(!$(e.target).is('label, input')) {
        window.location = '/partenaire/' + $(this).attr('id')
        return false;

    }
})