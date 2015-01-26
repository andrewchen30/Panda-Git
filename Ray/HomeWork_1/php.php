 <?php
        $id=$_GET["id"];
        $comm = 'SELECT * FROM `employee` WHERE `DID`=@idd';
        $comm = str_replace("@idd",$id,$comm);       
        $link=require("sql_conn.php");
        $result=mysqli_query($link,$comm);
        $info = array();
        while($row = mysqli_fetch_assoc($result))
        {        
            $info[] = $row;
        }
        $jsonStr=json_encode($info);
        echo $jsonStr;
?>