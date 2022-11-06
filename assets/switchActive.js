//Gère la modification du statut actif des partenaires / structure

$('.partenaireSetActiveButton').on('change', function () {
    let isChecked = $(this).is(':checked')
    //On demande confirmation
    if (confirm('Êtes-vous sûr de changer ce statut ?')) {
        $.post({
            url: window.location.href + '/isactive',
            data: {isActive: isChecked ? '1' : '0'},
            success: () => {
                    //we reload the page since most of its content is dependant of the active status
                    location.reload()
            },
            error: () => {$(this).prop('checked', !isChecked)}
        })
    } else {
        const keepCheckStatus = !$(this).prop('checked')
        $(this).prop('checked', keepCheckStatus)
        return false
    }
})

$('.structureSetActiveButton').on('change', function () {
    //Si l'objet n'a pas d'id (sur la page partenaire), on va chercher celui du parent .structureCard
    const id =  $(this).attr('id') ?? $(this).closest('.structureCard').attr('id')
    let isChecked = $(this).is(':checked')
    //On demande confirmation
    if (confirm('Êtes-vous sûr de changer ce statut ?')) {
        $.post({
            url: '/structure/'+ id + '/isactive',
            data: {isActive: isChecked ? '1' : '0'},
            success: () => {
                //On recharge la page
                location.reload()
            },
            error: () => {$(this).prop('checked', !isChecked)}
        })
    } else {
        const keepCheckStatus = !$(this).prop('checked')
        $(this).prop('checked', keepCheckStatus)
        return false
    }
})