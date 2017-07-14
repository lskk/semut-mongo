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
						<th>Result</th>
			         </tr>
			<?php 
			include "dbtweet/koneksi.php";
			$remove = array('#','|','@',':', '.','http','?','-','lalinBDG');
			if (isset($_POST['jml'])){
				$jml =$_POST['jml'];		
				
				
				$ambil = mysql_query("SELECT *,STR_TO_DATE(CONCAT(datestamp,' ',time),'%d %M %Y %H:%i')as newtimestamp from tweetreal limit $jml");
				$nomor = 0;
				//$lowerCase = array();
				while ($data = mysql_fetch_array($ambil)) 
				{
					$nomor = $nomor + 1;
					$kalimatAwal = $data['text_raw'];
					$idStr = $data['id_str'];
						//$dateStamp = $data['datestamp'];
					$timeStamp = $data['newtimestamp'];
					$tampils = $class->stopword($kalimatAwal,$remove);
					$hapusspase = trim($tampils);
					//$tampil = substr($hapusspase, 0, -1);
					$token = explode(" ",$hapusspase);
					$jumlahToken = 0;
					$jumlahToken = count($token);
					echo "<tr>";
					echo "<td rowspan='".$jumlahToken."'>".$nomor."</td>";
					echo "<td rowspan='".$jumlahToken."'>".$data['id_str']."</td>";
					echo "<td rowspan='".$jumlahToken."'>".$tampils."</td>";
					for($i = 0; $i < count($token); $i++)
					{
						$lower = strtolower($token[$i]);
						echo "<td>".$lower."</td>";
						$class->isKataTempat($lower,$kalimatAwal,$timeStamp,$id_str);
						
					}
					echo "<td>" . $class->tampilImplode () . "</td>";
					echo "</tr>";
				}
			}
			else{
				$ambil = mysql_query("SELECT *,STR_TO_DATE(CONCAT(datestamp,' ',time),'%d %M %Y %H:%i')as newtimestamp from tweetreal");
				$nomor = 0;
				//$lowerCase = array();
				while ($data = mysql_fetch_array($ambil)) 
				{
					$nomor = $nomor + 1;
					$kalimatAwal = $data['text_raw'];
					$tampils = $class->stopword($kalimatAwal,$remove);
					$hapusspase = trim($tampils);
					//$tampil = substr($hapusspase, 0, -1);
					$token = explode(" ",$hapusspase);
					$jumlahToken = 0;
					$jumlahToken = count($token) + 1;
					echo "<tr>";
					echo "<td rowspan='".$jumlahToken."'>".$nomor."</td>";
					echo "<td rowspan='".$jumlahToken."'>".$data['id_str']."</td>";
					echo "<td rowspan='".$jumlahToken."'>".$tampils."</td>";
					for($i = 0; $i < count($token); $i++)
					{
						$lower = strtolower($token[$i]);
						echo "<td>".$lower."</td>";
						$class->isKataTempat($lower);
						echo "</tr>";
						if($i == (count($token) - 1)) echo "<tr><td colspan='6'><b><i>" . $class->tampilImplode () . "</i></b></td></tr>";
					
					}
				}
			}
			?>
		</table>
	</body>
</html>	