<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KT - BSTS Database Input</title>
<link rel="stylesheet" type="text/css" href="css/styleinput.css"/>
</head>

<body>
<div class="controller">
<!-- Login Container -->
<section class="login">
<h2> 
<a href="insertstopword.php">SW</a> |
<a href="insertkatatempat.php">KT</a> |
<a href="insertkatakondisi.php">KK</a> |
<a href="insertkataarah.php">KA</a> |
<a href="insertkatanegasi.php">KN</a> |
<a href="twitter.php">TWITTER</a> |
</h2>
   	<h1>Kata Arah </h1>
	<form method="post" action="prosesinsertkataarah.php">
    	
        <!-- The Username Field -->
        <label for="username">kata arah
         	<input type="text" name="ka">
    	</label>
                            
        <!-- Input Button -->
        <input type="submit" value="Save"> </br> </br>
		
		 <!-- The Username Field -->
        <!-- <label for="username"> Result 
        <input type="text" name="ka" id="ka" />
    	</label> -->
    </form>
    <form method="post" action="insertkataarah.php"> 
			<input type="text" name="sw">
			<input type="submit" value="cari">
		</form>
		<table border="1px">
		<th>Id</th>
		<th>Kata Arah</th>
		<th>Aksi</th>

		<?php 
		include "dbtweet/koneksi.php";
			if (isset($_POST['sw'])){
					$kt =$_POST['sw'];

					$ambil = mysql_query("SELECT * from kata_arah where kata like '%$kt%' ORDER BY kata ASC");
					while ($data = mysql_fetch_array($ambil)) {

					$id =$data['id_ka'];
					$kata = $data['kata'];

				echo "
				<tr>
					<td>".$id."</td>
					<td>".$kata."</td>
					<td>Edit ||<a href='prosesdeletestop.php?kata=$id'> Delete </a></td>
					</tr>";
				}
			}


				else{
					$ambil = mysql_query("SELECT * from kata_arah ORDER BY kata ASC" );

				while ($data = mysql_fetch_array($ambil)) {

					$id =$data['id_ka'];
					$kata = $data['kata'];

				echo "
				<tr>
					<td>".$id."</td>
					<td>".$kata."</td>
					<td>Edit ||<a href='prosesdeletekataarah.php?id=$id'> Delete </a></td>
					</tr>";
				}


				}

			
		?>
		</table>

    </section>
</div>
</body>
</html>