/*global cofirm */
$(function () {

	'use strict';

	// $(function(){
	//   $('#nav li').click(function(){
	//     $('li').removeClass("active");
	//     $(this).addClass("active");
	// });
	// });  

	// Toggle between li in navbar 
	$('#nav a').click(function(){
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
	});

// .addClass('active')

	// Toggle between login & signup
	$('.login-page h1 span').click(function(){
		$(this).addClass('activeform').siblings().removeClass('activeform');
		$('.login-page form').hide();
		$('.' + $(this).data('class')).fadeIn(100);
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