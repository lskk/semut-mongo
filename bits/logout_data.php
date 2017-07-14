<?php
    session_start();
    include 'dbtweet/koneksi.php';
    $query = mysql_query("INSERT INTO user_tags(id_user,type) VALUES ('$_SESSION[userid]',-1)");

    unset($_SESSION['userid']);
    unset($_SESSION['level']);
    header('Location: index.php');


     exit();
?>