<?php 
	include_once('class.nlp.php');
	$class = new nlp();
?>
<html>
	<head>
		<title>Ringkasan</title>
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
				background:  green;
				color: #fff;
			}
		</style>
	</head>
	<body>
		<h1>Ringkasan</h1>
		<p id='counter'></p>
		<div class='table-container'>
			<table>
				<tr>
					<th>No.</th>
					<th>Tanggal/Jam</th>
					<th>Lokasi</th>
					<th>Point</th>
					<th>Twitter</th>
					<th>CCTV</th>
					<th>User</th>
				</tr>
				<?php 
				//$this->load->model('tweet_m');
				$data = $class->fetchRingkasanFix();
				//var_dump ($data);
				
				for($i = 0; $i < count($data); $i++) {
					foreach($data[$i] as $field => $record) {
						
						if($field == 'twitter') {
							if ($data[$i]['twitter'] == Null){
									$data[$i]['twitter'] = "n/a";
							}
						}
						else if ($field == 'cctv'){
							if ($data[$i]['cctv'] == Null){
									$data[$i]['cctv'] = "n/a";
							}
						}
						else if ($field == 'user'){
							if ($data[$i]['user'] == Null){
									$data[$i]['user'] = "n/a";
							}
						}
						
					}
				}
				for($i = 1; $i < count($data); $i++) {
						echo "<tr><td>$i</td>";
						foreach($data[$i-1] as $record) {
							echo "<td>$record</td>";
						}
						echo "</tr>";
				}
				?>
			</table>
		</div>
	</body>
	<script>
		var increment = 30;
		setInterval(function(){
			location.reload();
		}, 30000);
		setInterval(function(){
			increment--;
			var el = document.getElementById('counter');
			el.innerHTML = "Reloading in " + increment + " seconds...";
		}, 1000);
	</script>
</html>