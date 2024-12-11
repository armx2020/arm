$(document).ready(function ($) {
	$.mask.definitions['h'] = "[0|1|3|4|5|6|7|9]"
	$(".mask-phone").mask("+7 (h99) 999-99-99");
});