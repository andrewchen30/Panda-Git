<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>tree view</title>
    
    <link rel="stylesheet" href="css/hw1_treeview.css">
    
    <script src="../jquery-2.1.3.min.js"></script>
    <script src="js/hw1_treeview.js"></script>
    
</head>
<body>
   	<div id="treeview">
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
    </div>
    <div id="show"></div>
</body>
</html>