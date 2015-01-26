<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <script src="jquery-2.1.3.min.js"></script>
    <style>
        body {
            background-color: #333;
        }
        div.depart {
            border: 2px solid white;
        }
        .depart {
            background-color: #ffa700;
            height: 30px;
            width: 120px;
            text-align: center;
            margin: 2px;
            font-size: 15px;
            padding-top: 10px;
            cursor: pointer;
        }
        .th {
            background-color: #0e58ff;
            border: 2px solid #83a9ff;
            height: 30px;
            width: 120px;
            text-align: center;
            margin: 2px;
            margin-left: 10px;
            font-size: 15px;
            padding-top: 10px;
            cursor: pointer;
        }
        .classes{
/*            border: 2px solid #ff3a3a;*/
            background-color: #00fa9a;
/*            height: 120px;*/
            width: 950px;
            text-align: left ;
            margin-left: 250px;
            font-size: 15px;
            padding-top: 10px;
        }
        #closeAll {
            background-color: #ff3030;
/*            height: 30px;*/
            width: 50px;
            font-size: 20px;
            margin: 2px;
            text-align: center;
            cursor: pointer;
        }
        #name {
            color: #19dcff;
        }
    </style>

    <script>
        
        //點 th (老師)
        $('body,html').on('click','div.th',function(){
//             alert("點到老師");
             var classview=$(this);
             $.ajax({
                type: "get", //型態有get post none
                url: "0122_teacherClasses_json.php", //抓的檔案
                data: {
                    id: $(classview).attr("id")   //屬性"did"進去url抓資料
                },
                success: function (date) {
                   
                   var testId=$(classview).attr("id");
                   var info = JSON.parse(date);
//                     alert("ajax 成功");
                     var classShow='<div id="testt" class="classes">開課資訊@no <p> 日期與時間：@date　&nbsp時間：@time <br/>教室：@classroom &nbsp性質：                                                                             @sign &nbsp教科書：@book </div>';
                     for(var k=0; k < info.length; k++){
//                         老師
                         var classtmp=classShow.replace('@no',k+1)
                                               .replace('@date',info[k]["Weekday"])
                                               .replace('@time',info[k]["Period"])
                                               .replace('@classroom',info[k]["Room"])
                                               .replace('@sign',info[k]["Outline"])
                                               .replace('@book',info[k]["Textbook"]); 
                         $(classview).append(classtmp);
                    }
                    alert(info.length);
//                    slide("#testt");
                //slideToggle自動判定收還合
//                $("#testt").slideDown(1000);
                    
// 2                   $(document).ready(function () {
//            //div 點擊後，先執行id=one ，執行完後再執行id=two
//            $("div").click(function () {
//                $("#two").slideUp(500, function () {
//                    $("#one").slideUp(500);
//                });
//            });
//        });

                    
                }                                                                   
            });
            
//  1         function slide(selector){
//            $(selector).slideUp(function(){
//             $(this).slideDown(function(){
//                slide(this);
//             });
//            })
//           };
        });
    </script>
    <script>          
        //等檔案準備好，去找叫.dessert的東西，幫她準備click事件
        $(document).ready(function () {
            //先把.dessertWrapper，關起來
            $(".departWrapper").slideUp(0);
            //點 .depart 系所
            $(".depart").click(function () {
            var view = $(this);
                //=== 完全相等
                if($(this).next().text() === "") {
                    $.ajax({ 
                        type: "get", //有三種狀況 get ,post ,none
                        url: "scriptLink_DB_json_encode.php",
                        //data: {},是 jQuery寫Ajax規定的, 傳送過去的資料
                        data: {
                            id: $(view).attr("id")
                        },
                        //success:  function (data)
                        //是當Ajax 觸發success事件的時候  會觸發這個function()
                        //並傳傳入一個值  值傳進來的東西 取名為data
                        success: function (data) {
                            //data 丟到info ,info是二維陣列  
                            //因為剛剛取名叫做
                            //data所以現在要呼叫的時候就是用data
                            var info = JSON.parse(data); 
                            var thShow='<div id="@ddid" class="th">@teacher</div>';
                            for(var i=0; i<info.length;i++){
                                //老師
                                //alert(info[0]["Name"]); //顯示陣列，第0列，Name資料 
                                //js的replace，和 html的不一樣
                                var tmp=thShow.replace('@teacher',info[i]["Name"]).replace('@ddid',info[i]["EID"]); 
                                $(view).next().append(tmp);
                            }                                                    
                        }
                        
                    });
                    
                } 
                //slideToggle自動判定收還合
                $(this).next().slideToggle(500);
            });
            //全部關閉
            $("#closeAll").click(function () {
                $(".departWrapper").slideUp(500);
            });
            //javascript的變數用var宣告
        });
    </script>
</head>

<body>
    <div id="closeAll">close ALL</div>
    
    <?php
       $link=require("0122_connectDB.php");
       //系所   1 2 11 12 13
       $departData = '<div id="@classID" class="depart">@classNAME</div>
                      <div class="departWrapper"></div>';
       $class = "SELECT * FROM departments";	
       $result = mysqli_query($link,$class);
       while($meta=mysqli_fetch_assoc($result)){
             $tmp=$departData;
             $tmp=str_replace('@classID',$meta["NO"],$tmp);
             $tmp=str_replace('@classNAME',$meta["Name"],$tmp);
             echo $tmp;
       };

       $classShow = '<div id="testt" class="classes"></div>
                     <div class="classWrapper"></div>';
    ?>
</body>

</html>