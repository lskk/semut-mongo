<?php
	include "dbtweet/koneksi.php";
	$query = mysql_query("DELETE FROM kata_tempat WHERE idtempat= '".$_GET["id"]."'");
	//oci_execute($query);
	if ($query){ 	
		header("location:insertkatatempat.php");
	}else {
		echo "tidak bisa menyimpan data";
	}
?>