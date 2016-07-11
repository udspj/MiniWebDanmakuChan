<?php

require_once "utils/DBConnect.php";

session_start(); 

$code = trim($_POST['vercode']); 
$content = trim($_POST['content']); 

$code = md5($code);

function insertSQLData($danmuStr)
{
	$con = DBConnect::connectDB();

	mysql_select_db("danmakuBaseTable",$con);

	$danmuid = uniqid();
	$sql = "INSERT INTO Danmakus(danmustr,danmuid,showflag) VALUES('$danmuStr','$danmuid','999')";
	if(!mysql_query($sql,$con))
	{
		die('insert error '.mysql_error());
	}
}

if($code==$_SESSION["verification"]){ 
    insertSQLData($content);
    echo '1'; 
} else {
	echo "0";
}

?>