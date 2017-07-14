<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register - BSTS Database Input</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>

</head>

<body>
<!-- Login Container -->
<div class="controller">
<center>
<section class="login">
    <h1> Register</h1>
	<?php
	if (!empty($_GET['message']) && $_GET['message'] == 'success') {
		echo '<h2>Berhasil register, silahkan kembali ke halaman login!</h2>';
	}
	?>
	
    <form  action="insertdata.php" method="post" role="form">
    	
		<!-- The Name Field -->
         <div class="form-group">
        <label for="username">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" required/>
        </div>
		
        <!-- The Username Field -->
        <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" required/>
    	</div>
        
        <!-- The Password Field -->
        <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" required/>
        </div>
		
		<!-- The Password Field
        <label for="password">Repeat Password
        <input type="password" name="password" />
        </label>  -->

		<!-- Backt to login -->
		<a href="index.php "> <font color="#8cbdef" face="calibri">or Login</font></a> 
		</br>
		
        <!-- Sign In Button -->
        <input type="submit" value="Sign Up" class="btn btn-default" />
    </form>
    </section>
    </center>
</div>

</body>
</html>
