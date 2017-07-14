<?php
	include 'dbtweet/koneksi.php';

	$ambil = mysql_query("SELECT * from tbl_angkot where longlat !=''" );

?>

<html>
	
	<form id='cari-rute-angkot'>
	<div class="form-group">	
	<label>Rute Angkot</label>
		<select name="jalur"  class="form-control">
		<?php

				while ($data = mysql_fetch_array($ambil)) {

					$kode =$data['kode'];
					$jalur = $data['jalur'];

				echo "<option value='$kode'>".$kode." ".$jalur."</option>";
				}
		?>
		</select>
		</div>
		<input type="submit" name="rute" value="Cari Rute" class="btn btn-default">
	</form>
</html>
