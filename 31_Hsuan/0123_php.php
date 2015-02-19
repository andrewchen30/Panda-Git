<?php
    $EID=$_GET["id"];
     $link=require("connect.php");

     $info=array();

     $comm='SELECT *,`employee`.Name as tName,`courses`.Name as couName,`courses`.NO as couNO,`semesters`.Semester as sSemester FROM `semesters`,`classes`,`employee`,`courses` WHERE `classes`.EID= "@eid" and  `classes`.EID = `employee`.EID and `semesters`.NO=`classes`.SNO and `classes`.CNO=`courses`.NO';
     $comm=str_replace('@eid',$EID,$comm);

     
     $result=mysqli_query($link,$comm);
     //$t=mysqli_num_rows($result);
     
     
     while($row=mysqli_fetch_assoc($result)){
         $info[]=$row;
         //echo $row['Name']."</br>";
     }
     $jStr=json_encode($info);
     echo $jStr;
?>