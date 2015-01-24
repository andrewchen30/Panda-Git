$(document).ready(function () {

	//root variable
	var linkbarInfo = $('#linkbarInfo>li');

	var rootTable = '<div class="root">@text</div>';
	var childTable = '<div class="child">@text</div>';
	var rootWrapper = '<div class="rootWrapper"></div>';

	//add root text
	for (var i = 0; i < linkbarInfo.length; i++) {
		$('div#linkbar').append(rootTable.replace('@text', $(linkbarInfo[i]).children("p").text()));

		if ($(linkbarInfo[i]).children("ul").length != 0) {

			var childInfo = $(linkbarInfo[i]).find("ul>li>p");
			for (var j = 0; j < childInfo.length; j++) {
				$('div#linkbar>div.root:last-child').append(childTable.replace('@text', $(childInfo[j]).text()));
			}
		}
	}
	
	$('.child').slideUp(0);
});

$('html, body').on('mouseover', '.root', function () {
	$(this).children('.child').slideDown('fast');
});

$('html, body').on('mouseleave', '.root', function () {
	$(this).children('.child').slideUp('fast');
});