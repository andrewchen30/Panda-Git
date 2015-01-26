 <?php
     $EID=$_GET["id"];
     $link=require("sql_conn.php");
     $info=array();
     $comm='SELECT *,`employee`.Name as empName,`courses`.Name as couName,`courses`.NO as couNO,`semesters`.Semester as sSemester FROM `semesters`,`classes`,`employee`,`courses` WHERE `classes`.EID= "@eid" and  `classes`.EID = `employee`.EID and `semesters`.NO=`classes`.SNO and `classes`.CNO=`courses`.NO';
     $comm=str_replace('@eid',$EID,$comm);
     $result=mysqli_query($link,$comm);
     while($row=mysqli_fetch_assoc($result))
     {
         $info[]=$row;
     }
     $jsonStr=json_encode($info);
     echo $jsonStr;
?>