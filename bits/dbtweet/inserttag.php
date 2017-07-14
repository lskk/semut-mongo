<?php
	session_start();
	mysql_connect('localhost','root','Vicky12345') or die('koneksi gagal');
	mysql_select_db('smarttransportasi') or die('database tidak ada');
		
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];

	$query = mysql_query("INSERT INTO user_tags(id_user,latitude,longitude,type) VALUES ('$_SESSION[userid]','$lat','$lon',0)");

	echo "dian manis";
?>