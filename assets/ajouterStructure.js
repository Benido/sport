//Gère le formulaire d'ajout de structure

function generatePermissionObject () {
    let permissionsTable = {}
    $('.permissions').children('input').each(function () {
        permissionsTable[this.id] = this.checked ? 1 : 0
    })
    return permissionsTable
}

$('#ajouterStructureForm').on('submit', function (e) {
    e.preventDefault()
    if ($('#addressError').text() !== '' || $('#postalCodeError').text() !== '' || $('#cityError').text() !== '' ) {
        $('#submitError').text('Vérifiez vos entrées')
    } else {
        //On réutilise la fonction de 'permissions.js' qui génère un tableau de permissions
        const jsonPermissions = generatePermissionObject()

        //On construit l'objet JSON qui sera transmis au contrôleur
        const jsonData = {
            "structure":  {
                "address" : $('#address').val(),
                "postalCode" : $('#postalCode').val(),
                "city" : $('#city').val(),
                "permissions" : jsonPermissions
            },
            "email": $('#clientEmail').text()
        }
        console.log(jsonData)
        $.ajax({
                url: '/validation_structure',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(jsonData),
       //         success: () => {
        //            $('html').append("<a href='/email_prev' target='_blank' class='d-none'>!</a>").click()
                  success: (data) =>  {
                    $('html').html(data)
                }
            }
        )
    }
})