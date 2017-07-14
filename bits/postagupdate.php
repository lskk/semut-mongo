<?php 
	include_once('class.nlp.php');
	$class = new nlp();
?>
<html>
	<head>
		<title>Postagging</title>
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
	<h1>Hasil Postagging</h1>
	<p id='counter'></p>
		<center>
		<table>
			<form name="formcari" method="post" action="postagupdate.php">
			<tr>
				<td><input type="text" name="jml"></td>
				<td><input type="SUBMIT" name="SUBMIT" id="SUBMIT" value="Tampilkan" ></form> </td>
				<td><a href="http://localhost/bsts_murni_dik/postagupdate.php"><button>Reset</button></a></td>
			</tr>
		</table>
		<table border="1px">
					 <tr>
						<th>Nomor</th>
						<th>Id Tweet</th>
			            <th>Stop Word</th>