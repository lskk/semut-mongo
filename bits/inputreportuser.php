<?php
	include "dbtweet/koneksi.php";
	$query = mysql_query("INSERT INTO user_tags(id_user,type,latitude,longitude) VALUES ('".$_POST["namauser"]."','".$_POST["tipe"]."','".$_POST["lat"]."','".$_POST["lon"]."')");

	if ($query)
	{ 	
		header("location:index.php");
	}
	else 
	{
		echo "tidak bisa menyimpan data";
	}
?>