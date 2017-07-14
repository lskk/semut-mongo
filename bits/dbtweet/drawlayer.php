<?php
	mysql_connect('localhost', 'root', 'Vicky12345');
	mysql_select_db('smarttransportasi');
	
	$query = mysql_query("select * from kata_tempat_detail") or die(mysql_error());
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