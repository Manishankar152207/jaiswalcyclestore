<?php
    session_start();
    if(!isset($_SESSION['Admin_Login']) && !isset($_SESSION['Admin_username'])){
        header('location:login.php');
        die();
    }
?>

<h3>Welcome Sir.</h3>
<a href="logout.php">Logout</a>