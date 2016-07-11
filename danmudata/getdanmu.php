<?php

require_once "utils/DBConnect.php";

$paramstr = $_SERVER['QUERY_STRING'];
$args = explode('&', $paramstr);
$paramcount = count($args);

$con = DBConnect::connectDB();

if(mysql_select_db("danmakuBaseTable",$con))
{
	$whereTemp = "";
	$i = 0;
	foreach($_GET as $key => $val) 
	{
		if($val != "")
		{
        	$whereTemp = $whereTemp.$args[$i]." AND ";
		}
		$i++;
	}
	$whereTemp = substr($whereTemp,0,strlen($whereTemp)-5); 
		
	mysql_select_db("danmakuBaseTable",$con);
	$sqlstr = "SELECT * FROM Danmakus"; // WHERE showflag = '1' AND deleteflag != '1'
	if($whereTemp != "")
	{
		$sqlstr = $sqlstr . " WHERE $whereTemp";
	}
	$reslut = mysql_query($sqlstr);
	$apires = array();
	while($row = mysql_fetch_array($reslut))
	{
		$apires[] = $row;
	}

	echo json_encode($apires);
}

?>