<?php
    session_start();

    unset($_SESSION['userid']);
    unset($_SESSION['level']);
    header('Location: index.php');
     exit();
?>