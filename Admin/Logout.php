<?php
session_start();
session_destroy();
header('location:../front/frontEnd/login.php');
die();
?>