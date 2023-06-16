$(document).ready(function() {
    // Initialize select2
    if ($("#dd_city").length > 0) {
        $("#dd_city").select2({
            ajax: {
                url: " {{ route('cities') }}",
                type: "post",
                delay: 250,
                dataType: 'json',
                data: function(params) {
                    return {
                        query: params.term, // search term
                        "_token": "{{ csrf_token() }}",
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    }

});

$(document).ready(function() {
    $("#locationButton1").click(function() {
        $("#selectCity").toggle();
    });
})

$(document).ready(function() {
    $("#locationButton2").click(function() {
        $("#selectCity").toggle();
    });
})

$(document).ready(function() {
    $("#openMenu").click(function() {
        $("#menu").toggle();
        document.body.style.position = 'fixed';
    });
})
$(document).ready(function() {
    $("#closeMenu").click(function() {
        $("#menu").toggle();
        document.body.style.position = '';
    });
})