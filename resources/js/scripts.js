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
    $(document).ready(function () {
        $("#button-profile-menu").click(function () {
            $("#select-profile-menu").toggle();
            $("#button-profile-menu").css({ 'background-color': 'rgb(226 232 240)' })

            if ($('#p-profile-menu').text() == 'меню') {
                $("#p-profile-menu").text('закрыть')
            } else {
                $("#p-profile-menu").text('меню')
            }
        });
    })
})
