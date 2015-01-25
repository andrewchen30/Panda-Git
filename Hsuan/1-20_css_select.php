<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    
    <script src="jquery-2.1.3.min.js"></script>
    
<!--文字閃爍效果-->
    <script type="text/javascript" >
    function blink(selector){
        $(selector).fadeOut('slow', function(){
            $(this).fadeIn('slow', function(){
                blink(this);
            });
        });
    }
     
    $(document).ready(function(){
        blink('.blink');    
    }); 
</script>
<!------------------------------------------------------------------------------------>
    <style>
        body{
            background-color: #333;
        }
        .body2{
            background-color: #f8f7f7;
        }
        
        div.depart{
            border: 3px solid white;
            
        }
        
        div#closeAll{
            border: 3px solid #f76dd2;
        }
        .depart {
            
            background-color: #a32a9a;
            height: 30px;
            width: 120px;
            text-align: center;
            margin: 2px;
            padding-top: 10px;
            cursor: pointer;
        }
        .fruit {
            background-color: #eb3373;
            height: 30px;
            width: 120px;
            text-align: center;
            margin: 2px;
            padding-top: 10px;
            margin-left: 20px;
            cursor: pointer;
            
        }
        
        #closeAll{
            background-color: #86abe5;
            height: 30px;
            width: 50px;
            text-align: center;
            cursor: pointer;
        }
         
       
        
       
    </style>

    <script>
        //點選老師  
        $('body,html').on('click','div.fruit',function(){
            //alert($(this).attr("id"));
            var view2=$(this);
            $.ajax({
                type: "get", //型態可以用get post none
                url: "0123_php.php", //抓取的檔案
                data: {
                    id: $(view2).attr("id")   //屬性"id"進去url裡抓取資料
                },
                success: function (date) {

                    //#test是抓取下面的div
                    $("#test").html(""); //html代表是抓html的資料
                     var info = JSON.parse(date);
                    
                     var txt="";
                     for(var i=0; i<info.length;i++)
                        {
//                            $('#test').append(info[i]["ClassID"]+" "+info[i]["couNO"]+" "+info[i]["EID"]+" "+info[i]["tName"]+" "+info[i]["couName"]+" "+info[i]["Year"]+" "+info[i]["Semester"]+" "+info[i]["Limitnum"]+" "+info[i]["Choosenum"]+" "+info[i]["Period"]+" "+info[i]["Weekday"]+" "+info[i]["Room"]+" "+info[i]["Outline"]+" "+info[i]["Textbook"]+"<br />");
                            txt += info[i]["ClassID"]+" "+info[i]["couNO"]+" "+info[i]["EID"]+" "+info[i]["tName"]+" "+info[i]["couName"]+" "+info[i]["Year"]+" "+info[i]["Semester"]+" "+info[i]["Limitnum"]+" "+info[i]["Choosenum"]+" "+info[i]["Period"]+" "+info[i]["Weekday"]+" "+info[i]["Room"]+" "+info[i]["Outline"]+" "+info[i]["Textbook"]+"<br />";
                        }
                    $("#test").html(txt);

                }
            });
        });
        </script><script>
        //跑完所有程式才跑
        $(document).ready(function () {
            //收起下拉方塊
            $(".departWrapper").slideUp(0);
            
            //點擊
            $(".depart").click(function () {
                
                var view =$(this);  //將這個傳給物件view
                
                if($(this).next().text()==="")
                {
                    $.ajax({
                        type: "get", //型態可以用get post none
                        url: "1_21_php.php", //抓取的檔案
                        data: {
                            id: $(view).attr("id")  //注意不用分號，id是view的屬性值"id"
                        },
                        success: function (date) {
                            //$("body").append(date);

                            var info = JSON.parse(date);//data 丟到info ,info是2維陣列
                            var thfurit= '<div id="@ddd" class="fruit">@Name</div>'; //給id可以抓老師的代號 
                            for(var i=0; i<info.length;i++)
                            {
                                var temp=thfurit.replace("@ddd",info[i]["EID"]).replace("@Name",info[i]["Name"]);//取代把info的Name給@Name
                                $(view).next().append(temp);  //顯示view的下一個

                            }
                            
                        }
                    });
                }
                
                //點擊抓取該鍵文字
                //alert($(this).text());
                
                //attr屬性
                //alert($(this).attr("id"));

                //顯示下拉方塊
                //$(this).next().slideToggle(500);
                
                //在收起和顯示中做選擇
                $(this).next().slideToggle(100);

            });
            
            
            $("#closeAll").click(function(){
                $(".departWrapper").slideUp(1000);
            });
        });
    </script>

</head>

<body>
    <div id="closeAll">-</div>
    
<!--
    <div class="depart">水果</div>
    <div class="departWrapper1">
        <div class="fruit">蘋果</div>
    </div>
    <div class="departWrapper2">
        <div class="fruit">蘋果</div>
    </div>
    <div class="fruit">水蜜桃</div>
    <div class="fruit">草莓</div>
-->


   <?php

        $departStr = '<div id="@departID" class="depart">@departName</div><div class="departWrapper"></div>';

        //這兩行加起來代表一個系所
        //<div class="depart">資訊管理管系</div>
        //<div class="departWrapper"></div>

        //這代表一個老師
        //<div class="th">陳東柏</div>
echo "<table><tr><td width=200px>";
        $link = require("connect.php");
         
         $sql="SELECT * FROM `departments`";
         $result = mysqli_query($link, $sql);
    
        
            while($rows= mysqli_fetch_assoc($result))
            {
                
                    $temp = $departStr;
                    $temp = str_replace('@departID', $rows["NO"], $temp);
                    $temp= str_replace('@departName', $rows["Name"], $temp);
                    echo $temp;
               
            }
//表格
echo '</td><td valign="Top">';
//設一個div是放課程清單資料的
$temp = '<div id="test" class="blink" style=" background-color: #f8f7f7"></div>';
echo $temp;
echo "</td></tr></table>";
        
  
    ?>
    
    
    
       

</body>

</html>