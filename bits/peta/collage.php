<?php 		
	$server = "localhost";
	$username = "root";
	$password = "Vicky12345";
	$database = "smarttransportasi";		
	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_query('SET CHARACTER SET utf8');
	mysql_select_db($database, $con);

		//include 'koneksi.php';

	$sql = "SELECT * FROM `tb_place` where TypeID = 6 ";
	$result = mysql_query($sql) or die ("Query error: " . mysql_error());
	
	$records = array();

	while($row = mysql_fetch_assoc($result)) {
	$records[] = $row;
	}

	mysql_close($con);
	
	$data =json_encode($records);
	echo $data;
?>
	