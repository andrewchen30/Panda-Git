 <?php
        $link = mysqli_connect("localhost","root","root","oit_v3")or die("無法連接");
        mysqli_query($link,'set names utf8');
        return $link;
?>