<?php

require_once "utils/DBConnect.php";

session_start(); 

$code = trim($_POST['reqSent']); 

$json = html_entity_decode($code);
$json = stripslashes($json);
 
$arrayobj = json_decode($json, 1);

$con = DBConnect::connectDB();

mysql_select_db("danmakuBaseTable",$con);

$ctrltype = $arrayobj['ctrltype'];
$count_json = count($arrayobj["idlist"]);
for ($i = 0; $i < $count_json; $i++)
{
	$idstr = $arrayobj['idlist'][$i];
	if($ctrltype == 1)
	{
		$sql = "UPDATE Danmakus SET showflag = '1' WHERE danmuid = '$idstr'";
	}
	else if($ctrltype == 0)
	{
		$sql = "DELETE FROM Danmakus WHERE danmuid = '$idstr'";
		//$sql = "UPDATE Danmakus SET deleteflag = '1' WHERE danmuid = '$idstr'";
		//$sql = "UPDATE Danmakus SET deleteflag = '1',showflag = '1' WHERE danmuid = '$idstr'";
	}

	if(!mysql_query($sql,$con))
	{
		die('insert error '.mysql_error());
	}
}

echo "1"; 

?>