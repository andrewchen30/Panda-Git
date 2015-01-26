<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="jquery-2.1.3.min.js"></script>
<style>
    div.depart,
    div.an {
        border: 2px solid yellow;
    }
    
    .depart {
        background-color: #b7f708;
        height: 30px;
        width: 120px;
        text-align: center;
        margin: 1px;
        padding-top: 10px;
        cursor: pointer;
    }
    
    .an {
        background-color: #4176d9;
        height: 30px;
        width: 120px;
        text-align: center;
        margin: 1px;
        padding-top: 10px;
        margin-left: 10px;
        cursor: pointer;
    }
    
    #closeall {
        background-color: #ce9ded;
        height: 30px;
        width: 10px;
        text-align: center;
        margin: 1px;
        padding-top: 10px;
        margin-left: 10px;
        cursor: pointer;
    }
    
    .classes {
        background-color: #13e2da;
        height: 30px;
        width: 10px;
        text-align: center;
        margin: 1px;
        padding-top: 10px;
        margin-left: 10px;
        cursor: pointer;
    }
    
    .body2 {
        background-color: #cae213;
        width: calc (100% - 135px);
    }
    
    .left{
        background-color: #ed18dd;
        width: 135px;
        float:left;
        Clear:left;
    }
</style>
    

<script>
    $('body,html').on('click', 'div.an', function () {
        var view2 = $(this);
        $.ajax({
            type: "get",
            url: "classes.php",
            data: {
                id: $(view2).attr("id")
            },
            success: function (date) {
                var info = JSON.parse(date);
                $("#con").html("");
                $("#con").fadeOut(1000);
                $("#con").fadeIn(1000);
                for (var i = 0; i < info.length; i++) {
                    $("#con").append(info[i]["empName"] + "," + info[i]["couName"] + "," + info[i]["Limitnum"] +"," + info[i]["Choosenum"] +"," + info[i]["Period"] +"," + info[i]["Weekday"] +"," + info[i]["Room"] +"," + info[i]["Outline"] +"," + info[i]["Textbook"] +"</br>");
                }
            }
        });
    });
</script>
   
<script>
    $(document).ready(function () {
        $(".water").slideUp(0);
        $(".depart").click(function () {
            var view = $(this);
            $(this).next().slideToggle(500);
            if ($(this).next().text() === "") {
                $.ajax({
                    type: "get",
                    url: "php.php",
                    data: {
                        id: $(view).attr("id")
                    },
                    success: function (data) {
                        var info = JSON.parse(data);
                        var thshow = '<div id="@EID" class="an">@Name</div>';
                        for (var i = 0; i < info.length; i++) {
                            var temp = thshow.replace('@EID', info[i]["EID"]).replace('@Name', info[i]["Name"]);
                            $(view).next().append(temp);
                        }
                    }
                });
            }

        });

        $("#closeall").click(function () {
            $(".water").slideUp(500);
        });
    });
</script>
</head>

<body>
   <div class="left">
    <div id="closeall">-</div>
    <?php $departStr='<div id="@departID" class="depart">@departName</div><div class="water"></div>';
        $link=require( "sql_conn.php");
        $sql="SELECT * FROM `departments`";
        $result=mysqli_query($link,$sql);  
        while($row=mysqli_fetch_assoc($result))
        { 
            $temp=$departStr;
            $temp=str_replace( "@departID",$row[ "NO"],$temp);
            $temp=str_replace( "@departName",$row[ "Name"],$temp); 
            print $temp; 
        }
    ?>
    </div>
    <div id="con" class="body2"></div>
</body>

</html>