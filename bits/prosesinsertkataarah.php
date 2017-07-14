<?php
	session_start();
	include "dbtweet/koneksi.php";
	$query = mysql_query("INSERT INTO kata_arah(kata) VALUES ('".$_POST["ka"]."')");

	if ($query)
	{ 	
		header("location:insertkataarah.php");
	}
	else 
	{
		echo "tidak bisa menyimpan data";
	}
?>