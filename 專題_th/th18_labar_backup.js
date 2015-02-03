$(document).ready(function () {

	var ctrl = true;
	var box = $('.cal');

	var index = 1;
	var img = '<img id="in" src="../Doro/SlotMachine/rila_@num.png" alt="">';



	setInterval(function () {

		if ((Math.floor((Math.random() * 10) + 1) < 9) && ctrl == true) {
			$(box).append(img.replace('@num', index++)); //insert a pic
			if (index == 6) {
				index = 1;
			}
			show($('img:last-child'));
		} else {
			ctrl = false;
		}
	}, 300);

	function show(obj) {
		$(obj).animate({
			top: "+=200px",
			opacity: 1
		}, 300, function () {

			if (!ctrl) {
				return;
			}

			//這裡要寫if去判定是否出場
			$(obj).animate({
				top: "+=200px",
				opacity: 0
			}, 300);
		});
	}
});