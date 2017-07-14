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
	<table>
	<form name="formcari" method="post" action="stopword.php">
	<tr>
		<td><input type="text" name="jml"></td>
		<td><input type="SUBMIT" name="SUBMIT" id="SUBMIT" value="Tampilkan" ></form> </td>
		<td><a href="http://localhost/bsts_murni/normalisasi.php"><button>Reset</button></a></td>
	</tr>
	</table>
<table border="1px">
	<tr>
		<th>ID</th>
		<th>NORMALISASI</th>
		<th>PASS</th>
		<th>REJECT</th>
	</tr
<?php 
	include "dbtweet/koneksi.php";
	// mengambil data twitter
		if (isset($_POST['jml'])){
					$jml =$_POST['jml'];
					$remove = array('#','|','@',':', '.','http','?','-','lalinBDG');
					$querytweet = mysql_query("SELECT * from tweetreal ORDER BY id_str ASC limit $jml"); 

			while ($r1 = mysql_fetch_array($querytweet)) {
					// $normal=trim(strip_tags(substr($r1['text_raw'],17)));
					// $status=explode("http",$normal);
					// $stt=explode("|",$status[0]);
					// $kataakhir=strtolower($stt[0]);

					// //echo $kataakhir;
			
					// $hapusword = explode(" ",$kataakhir);

					$tweet = $r1['text_raw'];
					$arrayTweet = explode(' ', $tweet);
					$arrayCatch = array();
					for($i = 0; $i < count($arrayTweet); $i++){
						$safe = true;
						for($j = 0; $j < count($remove); $j++){
							if(strpos($arrayTweet[$i], $remove[$j]) !== false or is_numeric($arrayTweet[$i])){
								$safe = false;
								break;
							}
						}
						if($safe){
							array_push($arrayCatch, $arrayTweet[$i]);	
						}
					}
					$stt= implode(' ', $arrayCatch);
					$st =strtolower($stt);

					$hapusword = explode(" ",trim(preg_replace('/\s\s+/', ' ', $st)));

					$tampil=" ";
					$buang="";
						for($i = 0; $i < count($hapusword); $i++){
							//$q = $this->tweet_m->hapusstopword($hapusword[$i]);
							//echo "aray ke".$i.$hapusword[$i]."</br>";
							//$querystopword =mysql_query("SELECT count(*) from stop_word where stopword ='.$hapusword[$i].'");
							//echo $querystopword;
							//$hitung =$q->num_rows();
							//echo $hapusword[$i];
							$result = mysql_query("SELECT stopword from stop_word where stopword ='$hapusword[$i]'");
							$num_rows = mysql_num_rows($result);
						//	echo $num_rows;

							if($num_rows < 1){
								$tampil = $tampil.$hapusword[$i]." ";
											
							}
							else{

								$buang .= $hapusword[$i]." | ";

							}
										
						}
						echo "<tr>
							<td>".$r1['id_str']."</td>
							<td style='text-align:left'>".$st."</td>
							<td style='text-align:left'>".$tampil."</td>
							<td style='text-align:left'>".$buang."</td>
						</tr>";

			}
				}		
?> 
</table>

</body>

</html>

