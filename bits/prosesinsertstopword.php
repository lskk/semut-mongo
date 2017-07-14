<?php
	session_start();
	include "dbtweet/koneksi.php";
	$query = mysql_query("INSERT INTO stop_word(stopword) VALUES ('".$_POST["sw"]."')");

	if ($query)
	{ 	
		header("location:insertstopword.php");
	}
	else 
	{
		echo "tidak bisa menyimpan data";
	}
?>