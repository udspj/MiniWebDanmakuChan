<?php

class DBConnect {

	public static function connectDB(){
	    $con = mysql_connect("localhost","root","123456");
		if(!$con) {
			die('could not connect:'. mysql_error());
		}

	    if(!mysql_select_db("danmakuBaseTable", $con)) {
	          $con = null;
	    }
		return $con;
	}

}

?>