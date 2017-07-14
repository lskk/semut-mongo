<?php
	include 'koneksi.php';
	$kode = $_GET["jalur"];
	$query = mysql_query("SELECT * from tbl_angkot where kode = '$kode'") or die(mysql_error());
	//$query = mysql_query("select * from allringkasan") or die(mysql_error());

	$sound = array();
	for($i = 0; $fields = mysql_fetch_assoc($query); $i++) {
		$inner_sound = array();
		foreach($fields as $column => $row) {
			$inner_sound[$column] = trim($row);
		}
		array_push($sound, $inner_sound);
	}

	echo json_encode($sound);

?>