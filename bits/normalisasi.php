<html>
	<head>
		<title>Normalisasi</title>
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
	<h1>Hasil Normalisasi, Case Floding</h1>
	<table>
	<form name="formcari" method="post" action="normalisasi.php">
	<tr>
		<td><input type="text" name="jml"></td>
		<td><input type="SUBMIT" name="SUBMIT" id="SUBMIT" value="Tampilkan" ></form> </td>
		<td><a href="http://localhost/bsts_murni/normalisasi.php"><button>Reset</button></a></td>
	</tr>
	</table>

	
		<center><table border="1px">
			<tr>
				<th>Id str</th>
				<th>Tweet</th>
				<th>Normalisasi</th>
				<th>Case Floding</th>
				
			</tr>
			<?php 
				include "dbtweet/koneksi.php";
				
				if (iss