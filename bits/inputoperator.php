<?php
	include "dbtweet/koneksi.php";
	$query = mysql_query("INSERT INTO operatorinput(lokasi,poin,kondisi) VALUES ('".$_POST["lok"]."','".$_POST["poin"]."','".$_POST["kondisi"]."')");

	if ($query)
	{ 	
		header("location:index.php");
	}
	else 
	{
		echo "tidak bisa menyimpan data";
	}
?>