$(document).ready(function () {

	var hi = [0, 0, 0, 0]; //col height
	
	var shi = window.screen.availHeight;
	var flag = 0;
	var adding = true;
	var speed = 300;

	//model
	var table = '<div class="table"><img src="@pic" alt="" class="inside"><div class="info inside">@info</div></div>';

	var piclist = $("ul#info>img");
	var infolist = $("ul#info>li.info");
	
	$("div#waterfall").height(shi + 400);


	//add new pic to waterfall div
	function addTable(index) {
		//build
		var tmp = table;
		tmp = tmp.replace('@pic', $(piclist[index]).attr("src"));
		tmp = tmp.replace('@info', $(infolist[index]).html());

		//append 
		var minIndex = getMin();
		var view = $("div#col" + minIndex.toString());
		var nowhi = $(view).append(tmp).height();
		hi[minIndex] = nowhi;

		//animate and callback
		$(view).children("div.table:last-child").fadeOut(0).fadeIn(speed, function () {
			if (checkNeedMore()) {
				(index < piclist.length - 1) ? addTable(++index) : addTable(0);
			} else {
				(index < piclist.length - 1) ? flag = index + 1 : flag = 0;
				adding = false;
			}
		});
	}

	//get min col index 
	function getMin() {
		var minIndex = 0;
		for (var i = 0; i < 4; i++) {
			if (hi[minIndex] > hi[i]) {
				minIndex = i;
			}
		}
		return minIndex;
	}

	//check needed
	function checkNeedMore() {
		shi = window.screen.availHeight + document.body.scrollTop;
		
		if ((hi[getMin()] + 400) <= shi) {
			return true;
		}else{
			$("div#waterfall").height(shi + 400);
		}
	}

	addTable(0);

	$(document).scroll(function () {
		if (checkNeedMore() && (adding == false)) {
			adding = true;
			addTable(flag);
		}
	});

});