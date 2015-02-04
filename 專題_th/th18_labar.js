$(document).ready(function () {

	
	
	startAt(1);
	
	setTimeout(startAt(2), 2000);
	setTimeout(startAt(3), 4000);

	function startAt(num) {  
		var ctrl = true;
		var box = $('#cal' + num.toString());

		var index = 1;
		var img = '<img src="../Doro/0122/ImageCarousel/rila_@num.jpg" alt="">';

		var count = 0;
		var limit = Math.floor((Math.random() * 10) + 10);

		setInterval(function () {
			if (count++ <= limit && ctrl == true) {
				$(box).append(img.replace('@num', index++)); //insert a pic
				if (index == 4) {
					index = 1;
				}
				show($('#cal' + num.toString() + '>img:last-child'));
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
				}, 300, function(){
					$(this).remove();
				});
			});
		}
	}
});