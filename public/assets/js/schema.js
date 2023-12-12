// Validation - start

$('#schema_btn').on('click', function (event) {
    if (confirm("Modifying the schema will erase the page content") == true) {
        let page_schema = $('input[name=schema]');
        let number = $('input[name=number]');
        let name = $('input[name=name]');
    
        page_schema.val(glean_json('json_editor'));
        if (!number.val()) {
            number.parent().next().text('Page no. is required').show();
        }
        if (isNaN(number.val())) {
            number.parent().next().text('Page no. is not a number').show();
        }
        if (!name.val()) {
            name.parent().next().text('Page name is required').show();
        }
        if (number.val() && name.val() && page_schema.val()) {
            $('#page_form').submit();
        }
    }
});

$('input[name=number]').on('input', function (event) {
    let number_value = $(this).val();
    $(this).val(number_value.replace(/[^0-9]/g, ''));
    $(this).parent().next().text('').hide();
});

$('input[name=name]').on('input', function (event) {
    $(this).parent().next().text('').hide();
});

// Validation - end