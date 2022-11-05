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
                "permissions" : jsonPermissions,
                "partenaireId": $('#inputPartenaireId').val()
            },
            "email": $('#clientEmail').text()

        }
        console.log(jsonData)
        $.ajax({
                url: '/validation_structure',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(jsonData),
                success: (data) => {
                    //Ouvre un nouvel onglet. Nécessite d'ajouter une exception pour le domaine dans les paramètre du navigateur
                    //car ils bloquent généralement les pop-ups
                    const newTab = window.open('about:blank', '_blank')
                    newTab.document.open()
                    newTab.document.write(data)
                    newTab.document.close()

                    //Charge l'html renvoyé par le serveur sur la même page
                    //$('html').html(data)
                }
            }
        )
    }
})