$(document).ready(function () {

	$(".list").slideUp(0);

	$("div.btn").hover(function () {
		$(this).children(".list").slideDown('fast');
	}, function () {
		$(this).children(".list").slideUp('fast');
	});

	$(".list>div").hover(function () {
		$(this).children(".list").slideDown('fast');
	}, function () {
		$(this).children(".list").slideUp('fast');
	});
});