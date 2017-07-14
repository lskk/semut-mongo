<?php
	session_start();
	include "dbtweet/koneksi.php";
	$query = mysql_query("INSERT INTO kata_tempat(kata_tempat) VALUES ('".$_POST["kt"]."')");

	if ($query)
	{ 	
		header("location:insertkatatempat.php");
	}
	else 
	{
		echo "tidak bisa menyimpan data";
	}
?>