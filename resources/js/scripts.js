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