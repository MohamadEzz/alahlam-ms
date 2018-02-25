/*global cofirm */
$(function () {

	'use strict';

	//Dashboard toggel info iconbotton
	$('.toggel-info').click(function () {

		$(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);
		if ($(this).hasClass('selected')){
			$(this).html('<i class="fa fa-plus fa-lg"></i>');
		}else{
			$(this).html('<i class="fa fa-minus fa-lg"></i>');
		}

	});

	//Hide Placeholder when Focus
	$('[placeholder]').focus(function () {
		$(this).attr('data-text', $(this).attr('placeholder'));
		$(this).attr('placeholder', '');
	}).blur(function () {
		$(this).attr('placeholder', $(this).attr('data-text'));
	});

	//Add Asterisk on requird Fields
	$('input').each(function () {
		if ($(this).attr('required') === 'required') {
			$(this).after('<span class="asterisk">*</span>');
		}
	});

	//Convert Password to text on Hover
	var passField = $('.password');
	$('.show-pass').hover(function () {
		passField.attr('type', 'text');
	}, function () {
		passField.attr('type', 'password');
	});

	//Cnfirmation Message on Button Click
	$('.confirm').click(function () {
		return confirm('Are You Sure?');
	});

});