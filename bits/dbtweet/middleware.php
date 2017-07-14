<?php
	mysql_connect('localhost', 'root', 'Vicky12345');
	mysql_select_db('smarttransportasi');

	//$query = mysql_query('SELECT * FROM ringkasanfix ORDER BY lokasi DESC, id_str DESC');
	$query_tables = mysql_query('SHOW TABLES');
	$tables = $result = [];
	while($data_tables = mysql_fetch_array($query_tables)){
		array_push($tables, $data_tables[0]);
	}
	foreach($tables as $table){
		//echo $tables[$i];
		$query = mysql_query('SELECT * FROM '.$table);
		$sound = array();
	for($i = 0; $fields = mysql_fetch_assoc($query); $i++) {
		$inner_sound = array();
		foreach($fields as $column => $row) {
			$inner_sound[$column] = $row;
		}
		array_push($sound, $inner_sound);
	}


	$result[$table] = $sound;
	}

	echo json_encode($result);
	