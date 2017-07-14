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
   	<h1>Kata Kondisi </h1>
	<form method="post" action="prosesinsertkatakondisi.php">
    	
        <!-- The Username Field -->
        <label for="username">kata Kondisi
         	 <input type="text" name="kk">
    	</label>
                            
        <!-- Input Button -->
        <input type="submit" value="Save"> </br> </br>
		
		 <!-- The Username Field -->
        <!-- <label for="username"> Result 
        <input type="text" name="ka" id="ka" />
    	</label> -->
    </form>
    <form method="post" action="insertkatakondisi.php"> 
			<input type="text" name="sw">
			<input type="submit" value="cari">
		</form>
		<table border="1px">
		<th>Id</th>
		<th>Kata Kondisi</th>
		<th>Aksi</th>

		<?php 
