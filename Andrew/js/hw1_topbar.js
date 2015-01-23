$(document).ready(function () {
	$(document).scroll(function () {
		if (document.body.scrollTop > 400) {
			alert('ok');
			$("div#topbar").height(40);
		} else {}
	}):
});