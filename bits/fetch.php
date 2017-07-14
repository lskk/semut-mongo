<?php 
	include 'config.php';
	//$query 	= mysql_query("SELECT id_cctv AS id, lokasi, longitude, latitude FROM cctv WHERE longitude !='' and latitude !=''");
	$query	= mysql_query("SELECT a.id_cctv as id,a.lokasi,b.longitude,b.latitude from cctv a inner join cctv_lokasi b on a.lokasi = b.lokasi where a.lokasi !=''");
	$arr = array();
	while($data = mysql_fetch_assoc($query)) {
		foreach($data as $field => $cell) {
			$arr["id".$data['id']][$field] =  $cell;
		}
	}
	echo json_encode($arr);
?>