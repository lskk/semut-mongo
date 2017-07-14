<!DOCTYPE html>
<html>
<head>

<title>Login - BSTS </title>


</head>

<body>
<!-- Login Container -->
<div class="controller">
<section class="login">
   
	<?php
	if (!empty($_GET['status']) && $_GET['status'] == 'gagal') {
		echo '<h2>Username atau Password salah</h2>';
	}
	?>
    <form  method="post" action="proseslogindata.php" role="form">
    	
        <!-- The Username Field -->
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" required/>
    	</div>
        <div class="form-group">
        <!-- The Password Field -->
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required/>
        
        </div>
		
		  <a href="regdata.php "> <font color="#8cbdef" face="calibri">or Register</font></a> 
		 </br>
        <!-- Sign In Button -->
        <input type="submit" value="Login" class="btn btn-default" />
		
		</form>

    </section>
</div>
</body>
</html>
