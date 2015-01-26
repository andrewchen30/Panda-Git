<?php
     $id=$_GET["id"];
     $link=require("connect.php");

     $info=array();

     $comm='SELECT * FROM employee WHERE `DID`=@DID';
     $comm=str_replace('@DID',$id,$comm);

     
     $result=mysqli_query($link,$comm);
     //$t=mysqli_num_rows($result);
     
     
     while($row=mysqli_fetch_assoc($result)){
         $info[]=$row;
         //echo $row['Name']."</br>";
     }
     $jStr=json_encode($info);
     echo $jStr;
?>