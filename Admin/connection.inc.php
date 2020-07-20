<?php
session_start();
$conn=mysqli_connect("localhost","root","","login_test");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/jaiswal/Admin/');
define('SITE_PATH','http://localhost:1080/jaiswal/Admin/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');
?>