<?php 
	include_once('class.nlp.php');
	$class = new nlp();
?>
<html>
	<head>
		<title>Ringkasan Jalan</title>
		<style>
			.card-street {
				width: 500px;
				padding: 10px;
				float: left;
				box-shadow: 2px 2px 4px 0 #999;
			}
			
			.card-street p {
				font-size: 24pt;
				font-weight: lighter;
			}
			
			.card-street p span {
				font-size: 15pt;
				float: right;
			}
		</style>
	</head>
	<body>
		<?php 
		$data_street = $class->fetchRingkasanStreet("street");
			for($i = 0; $i < count($data_street); $i++) {
			$data_street_detail = $class->fetchRingkasanStreet("detail", $data_street[$i]['tempat']);
				foreach($data_street_detail as $rows_detail) {
					$data_street[$i]['content'] = "
						<div class='card-street'>
							<p>".$data_street[$i]['tempat']."<span>$rows_detail[kondisi]</span></p>
							<div>Hari: $rows_detail[daystamp] | Tanggal: $rows_detail[datestamp] | Jam: $rows_detail[timestamp] </div>
						</div>
					";
				}
			}
			for($i = 0; $i < count($data_street); $i++) {
				echo $data_street[$i]['content'];
			}
		?>
	</body>
</html>