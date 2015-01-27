<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>css selector</title>
    
    <script src="jquery-2.1.3.min.js"></script>
    
    <style>
        body{
            background-color: #333;
        }
        div.depart, div.th{
            border: 2px solid white;
        }
        .depart{
            background-color: #2a7e11;
            height: 30px;
            width: 120px;
            text-align: center;
            margin: 2px;
            padding-top: 10px;
            cursor: pointer;
        }
        
        /*找class*/
        .th{
            background-color: #3f85c1;
            height: 26px;
            width: 120px;
            text-align: center;
            margin: 2px;
            padding-top: 10px;
            margin-left: 20px;
            cursor: pointer;
        }
        
        /*找id*/
        #closeAll{
            background-color: #b6c732;
            height: 20px;
            width: 20px;
            text-align: center;
            cursor: pointer;
        }
    </style>
    
    <script>
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
    </script>
    
    
</head>
<body>
    <div id="closeAll">-</div>
    
<!--
    <div class="depart">資訊管理管系</div>
    <div class="departWrapper">
        <div class="th">陳東柏</div>
        <div class="th">陳鵬文</div>
        <div class="th">劉一凡</div>
        <div class="th">葉乙璇</div>
    </div>
-->    
    
    <?php

        $departStr = '<div id="@departID" class="depart myclass">@departName</div><div class="departWrapper"></div>';
        
        //這兩行加起來代表一個系所
        //<div class="depart">資訊管理管系</div>
        //<div class="departWrapper"></div>

        //這代表一個老師
        //<div class="th">陳東柏</div>

        $link = require("sql_conn.php");
        $result = mysqli_query($link, "select * from departments");

        while($rows = mysqli_fetch_assoc($result)){
            $tmp = $departStr;
            
            $tmp = str_replace('@departID', $rows["NO"], $tmp);
            $tmp = str_replace('@departName', $rows["Name"], $tmp);
            
            echo $tmp;
        }
    ?>
</body>
</html>