<!DOCTYPE html>
<html>
<head>
	<title>
		Stopword
	</title>
</head>
<style>
			body {
				background: #f3f3f3;
				font-family: Segoe UI, Arial, sans-serif;				
			}
			
			h1, p {
				text-align: center;
			}	
			
			h1 {
				font-weight: lighter;
			}
			
			.table-container {
				width: 80%;
				margin: 10px auto;
			}
			
			table {
				width: 100%;
				border-collapse: collapse;
				box-shadow: 2px 2px 4px 0 #999;
				text-align: center
			}
			
			th, tr:not(:last-child) td {
				border-bottom: 1px solid #ccc;
			}
			
			td, th {
				padding: 10px 20px;
			}
			
			td {
				background: #fff;
			}
			
			th {
				background: green;
				color: #fff;
			}
		</style>
<body>
<h1>Hasil Stopword</h1>
<table border="1px">
	<tr>
		<th>Nomor</th>
		<th>ID</th>
		<th>TWEET</th>
	</tr
<?php 
	include "dbtweet/koneksi.php";
	// mengambil data twitter
	//$querytweet = mysql_query("SELECT * from tweetreal"); 
			 $querytweet = mysql_query("SELECT *,STR_TO_DATE(CONCAT(datestamp,' ',time),'%d %M %Y %H:%i')as newtimestamp from tweetreal");
			 $j = 0;
			 $show = array ();
			while ($r1 = mysql_fetch_array($querytweet)) {
					$normal=trim(strip_tags(substr($r1['text_raw'],17)));
					$status=explode("http",$normal);
					$stt=explo