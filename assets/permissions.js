const permInputs = $('.permissions').children('input')

//On génère un fichier JSON contenant les permissions
function generatePermissionObject () {
    let permissionsTable = {}
    permInputs.each(function () {
        permissionsTable[this.id] = this.checked ? 1 : 0
    })
    return permissionsTable
}

permInputs.on('change', function(){
    if (confirm('Êtes-vous sûr de changer cette permission ?')) {
        $.ajax({
                url: window.location.href + '/permissions',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(generatePermissionObject()),
                success: (data) => alert(data)
            }
        )
    } else {
        const keepCheckStatus = !$(this).prop('checked')
        $(this).prop('checked', keepCheckStatus)
        return false
    }
} )