<?php 
    @$link = mysqli_connect('localhost', 'root', 'root', 'oit_v3')
               or die('connect fail'); //false
    mysqli_query($link, 'SET names utf8'); //set utf8

    return $link;
?>