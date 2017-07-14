<?php
	mysql_connect('localhost', 'root', 'Vicky12345');
	mysql_select_db('smarttransportasi');
	date_default_timezone_set("Asia/Bangkok");

	$jam_start = date("H");
	$menit_start = date("i");
	$selisih = $menit_start % 5;
	$menit_start = $menit_start - $selisih;
	$menit_end = $menit_start + 5;
	$jam_end = $jam_start;
	if($menit_end == 60){
		$menit_end = 0;
		$jam_end += 1;
	}

	$time_start = date("Y-m-d H:i:s", strtotime($jam_start . ":" . $menit_start));
	$time_end = date("Y-m-d H:i:s", strtotime($jam_end . ":" . $menit_end));



	$query_twitter = mysql_query("SELECT timestamp as time, lokasi as lokasi, point as poin, twitter as kondisi FROM ringkasanfix where timestamp between '$time_start' and '$time_end'  ORDER BY lokasi DESC, timestamp DESC") or die(mysql_error());
	$query_cctv = mysql_query("SELECT timee as time, lokasi as lokasi, poin as poin, kondisi as kondisi  FROM cctv where timee between '$time_start' and '$time_end' ORDER BY lokasi DESC, timee DESC");
	$query_user = mysql_query("SELECT time as time, lokasi as lokasi, point as poin, kondisi as kondisi  FROM users where time between '$time_start' and '$time_end' ORDER BY lokasi DESC, time DESC") or die(mysql_error());
	$query_operator = mysql_query("SELECT time as time, lokasi as lokasi, poin as poin, kondisi as kondisi FROM operatorinput where time between '$time_start' and '$time_end' ORDER BY lokasi DESC, time DESC");
// $query_twitter = mysql_query("SELECT timestamp as time, lokasi as lokasi, point as poin, twitter as kondisi FROM ringkasanfix") or die(mysql_error());
// 	$query_cctv = mysql_query("SELECT timee as time, lokasi as lokasi, poin as poin, kondisi as kondisi  FROM cctv");
// 	$query_user = mysql_query("SELECT time as time, lokasi as lokasi, point as poin, kondisi as kondisi  FROM users ") or die(mysql_error());
// 	$query_operator = mysql_query("SELECT time as time, lokasi as lokasi, poin as poin, kondisi as kondisi FROM operatorinput");

		while ($data_twitter = mysql_fetch_assoc($query_twitter)) {

			$time_twitter =$data_twitter['time'];
			$lokasi_twitter = $data_twitter['lokasi'];
			$poin_twitter = $data_twitter['poin'];
			$kondisi_twitter = $data_twitter['kondisi'];


			$query_insert = mysql_query("INSERT into allringkasan(time,lokasi,pt,kt) values ('$time_twitter', '$lokasi_twitter', '$poin_twitter' , '$kondisi_twitter')")or die(mysql_error());
		}

		while ($data_cctv = mysql_fetch_assoc($query_cctv)) {

			$time_cctv =$data_cctv['time'];
			$lokasi_cctv = $data_cctv['lokasi'];
			$poin_cctv = $data_cctv['poin'];
			$kondisi_cctv = $data