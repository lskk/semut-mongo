<?php
//panggil file config.php untuk menghubung ke server
include('dbtweet/koneksi.php');
 
//tangkap data dari form
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
 
//simpan data ke database
$query = mysql_query("insert into tb_userdata values('', '$nama', '$username', '$password', 'user')") or die(mysql_error());
 
if ($query) {
    header('location:index.php?message=success');
}
?>