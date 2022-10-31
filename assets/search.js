

$('#structureSearchBar').on('input', function() {
    if($(this).val()) {
        $('#structuresDisplayBlock').children().hide()
        $('#' + $(this).val()).show()
    }
} )