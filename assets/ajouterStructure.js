//Gère le formulaire d'ajout de structure

const address = $('#address')
const postalCode = $('#postalCode')
const city = $('#city')
const addressError = $('#addressError')
const postalCodeError = $('#postalCodeError')
const cityError = $('#cityError')


//Crée l'objet permission associé à la nouvelle structure
function generatePermissionObject() {
    let permissionsTable = {}
    $('.permissions').children('input').each(function () {
        permissionsTable[this.id] = this.checked ? 1 : 0
    })
    return permissionsTable
}


function checkAddress () {
    let addressValue = address.val()
    if(addressValue.length > 255) {
        addressError.text('L\'adresse ne doit pas dépasser 255 caractères')
    } else {
        addressError.text('')
    }
}

function checkPostalCode() {
    const postalCodeRegex = new RegExp(/^(\d{5})$/, 'g')
    if(!postalCodeRegex.test(postalCode.val())) {
        postalCodeError.text('Le code postal doit comporter 5 chiffres')
    } else {
        postalCodeError.text('')
    }
}

function checkCity() {
    let cityValue = city.val()
    if(cityValue.length > 255) {
    cityError.text('Le nom de ville ne doit pas dépasser 255 caractères')
    } else {
        cityError.text('')
    }
}

// On vérifie que les entrées sont correctement formatées
address.on('keyup', checkAddress)
postalCode.on('keyup', checkPostalCode)
city.on('keyup', checkCity)



$('#ajouterStructureForm').on('submit', function(e) {
    e.preventDefault()

    checkAddress()
    checkPostalCode()
    checkCity()

    if($('#addressError').text() !== '' || $('#postalCodeError').text() !== '' || $('#cityError').text() !== '' ) {
        $('#submitError').text('Vérifiez vos entrées')
    }else {
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
                }
            }
        )
    }
})