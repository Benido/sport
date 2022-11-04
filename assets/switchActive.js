//Gère la modification du statut actif des partenaires / structure

$('#partenaireSetActiveButton').on('change', function () {
    let isChecked = $(this).is(':checked')
    //On demande confirmation
    if (confirm('Êtes-vous sûr de changer le statut de ce partenaire ?')) {
        $.post({
            url: window.location.href + '/isactive',
            data: {isActive: isChecked ? '1' : '0'},
            success: () => {
                    //we reload the page since most of its content is dependant of the active status
                    location.reload()
            },
            error: () => {$(this).prop('checked', !isChecked)}
        })
    }
})