<?php 

    $id = $_GET["id"];
    $comm = 'SELECT * 
				FROM `classes`,`courses`
				WHERE `EID` = "@EID"
					and `CNO` = `NO`';

    $comm = str_replace('@EID', $id, $comm);

    $link = require("../unites/sql_conn.php");
    $result = mysqli_query($link, $comm);

    $info = array();
    while($rows = mysqli_fetch_assoc($result)){
        $info[] = $rows;
    }
//    echo $info[0]["Name"];
    $jsonStr = json_encode($info); //pirnt json出來
    echo $jsonStr;

      
?>