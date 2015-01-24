$(document).ready(function(){
            
            //把所有的老師先隱藏起來
            $(".departWrapper").slideUp(0);
            
            //全部關閉的按鈕
            $("#closeAll").click(function(){
                $(".departWrapper").slideUp(500);
            });
            
            //掛事件給.depart
            $(".depart").click(function(){                
				
				if($(this).next().text() !== ""){
					$(this).next().slideToggle(200);
					return;
				}
				
				var view = $(this);

                $.ajax({ //get,post,none
                    type: "get",
                    url: "json_names.php",
                    data: {
                        id: $(view).attr("id")
                    },
                    success: function (data) {
                        //$("body").append(data);

                        var info = JSON.parse(data);
                        var thInfo = '<div class="th">@thName</div>';
                        //alert(info[0]["Name"]);

                        for (var i = 0; i < info.length; i++) {			
                            var tmp = thInfo.replace('@thName', info[i]["Name"]);
                            $(view).next().append(tmp);
                        }
                    }
                });
                
                //顯示那些老師
                $(this).next().slideToggle(200);
                
            });
        });