 <?php
        $link = mysqli_connect("localhost","root","","oit_v2")or die("無法連接");
        mysqli_query($link,'set names utf8');
        return $link;
?>