<?php
	include 'koneksi.php';

	$query = mysql_query("SELECT t1. * FROM user_tags t1 JOIN (SELECT id_user, MAX(timestamp) timestamp FROM user_tags GROUP BY id_user) t2 ON t1.id_user = t2.id_user AND t1.timestamp = t2.timestamp") or die(mysql_error());
	//$query = mysql_query("select * from allringkasan") or die(mysql_error());

	$sound = array();
	for($i = 0; $fields = mysql_fetch_assoc($query); $i++) {
		$inner_sound = array();
		foreach($fields as $column => $row) {
			$inner_sound[$column] = trim($row);
		}
		if($inner_sound['type'] == -1)  continue;
		array_push($sound, $inner_sound);
	}

	echo json_encode($sound);

?>