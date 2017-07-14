<?php

$koneksi = mysql_connect("localhost","root","");
mysql_select_db("smarttransportasi",$koneksi);

?>

<?php

session_start();
$username = $_POST['username'];
$password = $_POST['password'];
// query untuk mendapatkan record dari username
$query = "SELECT * FROM tb_userdata WHERE username = '$username'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
// cek kesesuaian password
if ($password == $data['password'])
{
echo "sukses";
    // menyimpan username dan level ke dalam session
    $_SESSION['level'] = $data['level'];
    $_SESSION['userid'] = $data['username'];
    header('location: index.php');
}
else {
header("location:logindata.php?status=gagal");
}
  ?>