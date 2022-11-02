//Gère les évènements onClick des cartes partenaires et structure

$('.structureCard').on('click', function () {
    window.location = '/structure/' + $(this).attr('id')
    return false;
})


