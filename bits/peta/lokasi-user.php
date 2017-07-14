<?php 		
	$server = "localhost";
	$username = "root";
	$password = "Vicky12345";
	$database = "smarttransportasi";	
	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_query('SET CHARACTER SET utf8');
	mysql_select_db($database, $con);

//	include 'koneksi.php';


	$sql = "SELECT t1. * FROM tb_location t1 JOIN (SELECT UserID, MAX(timespan) timespan FROM tb_location GROUP BY UserID) t2 ON t1.UserID = t2.UserID AND t1.timespan = t2.timespan";
	//$sql = "SELECT * from tb_Location";
	$result = mysql_query($sql) or die ("Query error: " . mysql_error());
	
	$records = array();

	while($row = mysql_fetch_assoc($result)) {
	$records[] = $row;
	}

	mysql_close($con);
	
	$data =json_encode($records);
	echo $data;
?>
