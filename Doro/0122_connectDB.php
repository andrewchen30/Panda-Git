<?php
        $link=@mysqli_connect( "localhost", "root", "root", "oit_v3") or die( "無法開啟資料庫連接"); 
//        mysqli_select_db($link,"oit_v2");
        mysqli_query($link,'SET NAMES utf8');

        return $link;
?>