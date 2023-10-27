$(document).ready(function () {
    $("#locationButton1").click(function () {
        $("#selectCity").toggle();
    });
    $("#locationButton2").click(function () {
        $("#selectCity").toggle();
    });
    $("#openMenu").click(function () {
        $("#menu").toggle();
        document.body.style.position = 'fixed';
    });
    $("#closeMenu").click(function () {
        $("#menu").toggle();
        document.body.style.position = '';
    });
    $("#CategoryButton").click(function () {
        $("#selectCategory").toggle();
    });
    $("#button-profile-menu").click(function () {
        $("#select-profile-menu").toggle();
        $("#button-profile-menu").css({ 'background-color': 'rgb(226 232 240)' })

        if ($('#p-profile-menu').text() == 'меню') {
            $("#p-profile-menu").text('закрыть')
        } else {
            $("#p-profile-menu").text('меню')
        }
    });
    $("#dropdown_button").click(function() {
        $("#dropdown_ul").toggle();
        document.body.style.position = '';
    });
    $("#warning_button_cookie").click(function() {
        $("#warning_cookie").remove();
        document.cookie = "cooking=true; max-age=2592000; path=/";
    });
    if (document.cookie.indexOf("cooking") != 0) {
		$("#warning_cookie").css({ 'display': 'block' });
	}
})
