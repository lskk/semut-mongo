<?php
	include "dbtweet/koneksi.php";
	$query = mysql_query("DELETE FROM stop_word WHERE id_stopword= '".$_GET["kata"]."'");
	//oci_execute($query);
	if ($query){ 	
		header("location:insertstopword.php");
	}else {
		echo "tidak bisa menyimpan data";
	}
?>