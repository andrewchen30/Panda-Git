<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>css selector</title>
    
    <script src="../jquery-2.1.3.min.js"></script>
    
</head>
<body>
    <div id="closeAll">-</div>
    
    <?php

        $departStr = '<div id="@departID" class="depart myclass">@departName</div><div class="departWrapper"></div>';
        
        //這兩行加起來代表一個系所
        //<div class="depart">資訊管理管系</div>
        //<div class="departWrapper"></div>

        //這代表一個老師
        //<div class="th">陳東柏</div>

        $link = require("unites/sql_conn.php");
        $result = mysqli_query($link, "select * from departments");

        while($rows = mysqli_fetch_assoc($result)){
            $tmp = $departStr;
            
            $tmp = str_replace('@departID', $rows["NO"], $tmp);
            $tmp = str_replace('@departName', $rows["Name"], $tmp);
            
            echo $tmp;
        }
    ?>
</body>
</html>