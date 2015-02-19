$(document).ready(function () {

	//把所有的老師先隱藏起來
	$(".departWrapper").slideUp(0);

	//全部關閉的按鈕
	$("#closeAll").click(function () {
		$(".departWrapper").slideUp(500);
	});

	//掛事件給.depart
	$(".depart").click(function () {

		if ($(this).next().text() !== "") {
			$(this).next().slideToggle(200);
			return;
		}

		var view = $(this);

		$.ajax({ //get,post,none
			type: "get",
			url: "json/json_name.php",
			data: {
				id: $(view).attr("id")
			},
			success: function (data) {
				//$("body").append(data);
				var info = JSON.parse(data);
				var thInfo = '<div id="@id" class="th">@thName</div>';
				//				alert(info[0]["Name"]);

				for (var i = 0; i < info.length; i++) {
					var tmp = thInfo.replace('@thName', info[i]["Name"]);
					tmp = tmp.replace('@id', info[i]["EID"]);
					$(view).next().append(tmp);
				}
			}
		});

		//顯示那些老師
		$(this).next().slideToggle(200);

	});
});

$('body, html').on('click', 'div.th', function () {
	var view = $(this);
	$.ajax({ //get,post,none
		type: "get",
		url: "json/json_thInfo.php",
		data: {
			id: $(view).attr("id")
		},
		success: function (data) {
			var info = JSON.parse(data);
			var thInfo = '<div class="thc"><h3>[@name]</h3><p>@weekday@time&nbsp;&nbsp;@grade學分</p></div>';
			//alert(info[0]["Name"]);

			$("#show").html(""); //clear
			
			var limit = info.length; //資料的筆數

			var show = function (i) {
				//make table
				var tmp = thInfo.replace('@name', info[i]["Name"]);
				tmp = tmp.replace('@weekday', info[i]["Weekday"]);
				tmp = tmp.replace('@time', info[i]["Period"]);
				tmp = tmp.replace('@grade', info[i]["Grade"]);
				
				//show it 
				$("#show").append(tmp);
				$("div.thc:last-child").animate({
					opacity: 1,
					marginLeft: '-=200px'
				}, 150, function () {
					if (++i < info.length) { //recursive
						show(i);
					}
				});
			};
			show(0);//start
		}
	});
});