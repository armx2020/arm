$(document).ready(function ($) {

	// Маска "телефона".
	$.mask.definitions['h'] = "[0|1|3|4|5|6|7|9]"
	$(".mask-phone").mask("+7 (h99) 999-99-99");

	// Клик по ссылке "Закрыть".
	$('#backStep').click(function () {
		$(this).parents('.popup-fade').fadeOut();
		$('.popup-fade').hide();
		return false;
	});

	// Закрытие по клавише Esc.
	$(document).keydown(function (e) {
		if (e.keyCode === 27) {
			e.stopPropagation();
			$('.popup-fade').fadeOut();
			$('.popup-fade').hide();
		}
	});

	// Клик по фону, но не по окну.
	$('.popup-fade').click(function (e) {
		if ($(e.target).closest('.popup').length == 0) {
			$(this).fadeOut();
			$('.popup-fade').hide();
		}
	});
});