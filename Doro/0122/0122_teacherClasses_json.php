<?php 
    $Id=$_GET["id"];

    $link=require("0122_connectDB.php");

    $info=array();
    $class="SELECT *
            FROM `employee`,`classes`
            WHERE 
             `classes`.EID='@departDID' and `employee`.EID ='@departDID' " ;

    $class=str_replace('@departDID',$Id,$class);

    if($result=mysqli_query($link,$class)){
         while($meta=mysqli_fetch_assoc($result)){	
            $info[]=$meta;
         }
    }

    $dataclasses=json_encode($info);
    echo $dataclasses;
?>