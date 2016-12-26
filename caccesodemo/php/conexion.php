<?php
	function conectarse(){
		$con = mysql_connect("localhost","chilecop","cHilecop2016");
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }
		 
		mysql_select_db("chilecop_cademo", $con);
		return $con;
	}
?>