
<?php 
//拿前面的拿前面的id=11
    $Id=$_GET["id"];

    $link=require("0122_connectDB.php");

    $info=array();
    $class="SELECT * FROM employee WHERE`DID`=@departDID";	

    $class=str_replace('@departDID',$Id,$class);

    if($result=mysqli_query($link,$class)){
         while($meta=mysqli_fetch_assoc($result)){	
//              echo $meta["NO"].$meta["Name"].$meta["Credits"].
//                   $meta["DID"].$meta["Grade"].$meta["Semester"].
//                   $meta["Builtyear"].$meta["Status"]."  <br/>";
            $info[]=$meta;
         }
    }

    //json_encode 把它轉換成 code

    $data=json_encode($info);
    echo $data;
?>
