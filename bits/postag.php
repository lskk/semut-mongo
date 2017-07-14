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
		<table border="1px">
					 <tr>
						<th>Nomor</th>
						<th>Id Tweet</th>
			            <th>Asal Kata</th>
						<th>Perbaikan Kata</th>
						<th>Post Tag</th>
			         </tr>
			<?php 
				
				include "dbtweet/koneksi.php";
				$ambil = mysql_query("SELECT *,STR_TO_DATE(CONCAT(datestamp,' ',time),'%d %M %Y %H:%i')as newtimestamp from tweetreal");
				$nomor = 0;
				//$lowerCase = array();
				while ($data = mysql_fetch_array($ambil)) 
				{
						$nomor = $nomor + 1;
						$kalimatAwal = $data['text_raw'];
						$normal = substr($data['text_raw'],17);
						$katanormal = explode("http",$normal);// di pisah dari kalimat http
						$stt=explode("|",$katanormal [0]);//di pisah bila ada tanda "|"
						$kataakhir=strtolower($stt[0]); 
						$hapusword = explode(" ",$kataakhir);
						$tampil="";
						
						//$isTweetSampah = 0;
						
						//fungsihapusstopword
						for($i = 0; $i < count($hapusword); $i++){			
							$result = mysql_query("SELECT stopword from stop_word where stopword ='$hapusword[$i]'");//mengecek kata stopword pada database
							$num_rows = mysql_num_rows($result);
							//echo $num_rows;
							if($num_rows < 1){
								$tampil = $tampil.$hapusword[$i]." ";
							}
						}
						
						$token = explode(" ",$tampil);//di pecah berdasarkan spasi 
						$lowerCase = array();
						
						for($i = 0; $i < count($token); $i++)
						{
									$shortestTempat = -1;
									$lower[$i] = strtolower($token[$i]);
									$queryArrayTempat = $class->selectTokenKataTempatCompare();//query dari class.nlp.php
									//var_dump($queryArrayTempat);
									
									include "levenshtein/LevenshteinTempat.php";//levenshtein Kata Tempat
									
									$htgKondisi = $class->selectTokenKataKondisi($lower[$i]);
									$htgArah = $class->selectTokenKataArah($lower[$i]);
									$htgNeg = $class->selectTokenNegasi($lower[$i]);
									
									if ($htgKondisi > 0)
									{
												echo "<tr><td>".$nomor."</td><td>".$data['id_str']."</td><td>".$lower[$i]."/KK</td><td>KK</td></tr>";
												$lowerCase[$i] = $lower[$i]."/KK";
												$isTweetSampah = 0;
									}
									else if ($htgTempat > 0)
									{
												echo "<tr><td>".$nomor."</td><td>".$data['id_str']."</td><td>".$lower[$i]."/KT</td><td>".$closest[$i]."</td><td>KT</td></tr>";
												$mostClosest[$i] = rtrim($closest[$i]);
												//$mostClosest[$i] = rtrim($kt);
												$token = explode(" ",$mostClosest[$i]);
												for($n = 0; $n < count($token); $n++){
														  //echo "<br><br>token [".$n."] =".strtolower($token[$n])."<br>";
														  $arrayKt[$n] = $token[$n];
												}
												$joinKt =  join("",$arrayKt);
												//echo "join: ".$joinKt."<br>";
												$trims = rtrim($joinKt);
												$lowerCase[$i] = $trims."/KT";
												//$stringKt = $joinKt."/KT";
												//unset($arrayKt);
												$isTweetSampah = 0;
												//echo "<tr><td>".$nomor."</td><td>".$lower[$i]."/KT</td><td></td><td>KT</td><td></td></tr>";
												//$lowerCase[$i] = $lower[$i]."/KT";
									}
									else if ($htgArah > 0)
									{
												//$test = $lower."/ka";
												//$lower = strtolower($token[$i]);
												echo "<tr><td>".$nomor."</td><td>".$data['id_str']."</td><td>".$lower[$i]."/KA</td><td>KA</td></tr>";
												$lowerCase[$i] = $lower[$i]."/KA";
												$isTweetSampah = 0;
									}
									else if ($htgNeg > 0)
									{
												//$test = $lower."/kn";
												echo "<tr><td>".$nomor."</td><td>".$data['id_str']."</td><td>".$lower[$i]."/NEG</td><td>NEG</td></tr>";
												$lowerCase[$i] = $lower[$i]."/NEG";
												$isTweetSampah = 0;
									}
									else
									{
												//$test = $lower."/x";
												echo "<tr><td>".$nomor."</td><td>".$data['id_str']."</td><td>".$lower[$i]."/X</td><td>X</td></tr>";
												$isTweetSampah = 1;
												//$lowerCase[$i] = $lower[$i]."/X";
									}
						}
						
						$testImplode = implode("|",$lowerCase);
						//var_dump ($testImplode);
						//echo "<br>".$testImplode."<br>";d
						$idStr = $data['id_str'];
						//$dateStamp = $data['datestamp'];
						$timeStamp = $data['newtimestamp'];
						//$dayStamp = $data['daystamp'];
						//echo "<br><br> id Kata 