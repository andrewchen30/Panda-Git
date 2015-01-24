<?php 

    $id = $_GET["id"];
    $comm = 'SELECT * 
                FROM `employee` 
                WHERE `DID` = @DID';

    $comm = str_replace('@DID', $id, $comm);


    $link = require("sql_conn.php");
    $result = mysqli_query($link, $comm);

    $info = array();
    while($rows = mysqli_fetch_assoc($result)){
        $info[] = $rows;
    }
//    echo $info[0]["Name"];
    $jsonStr = json_encode($info);
    echo $jsonStr;

      
?>