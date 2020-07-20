<?php
require('connection.inc.php');
require('functions.inc.php');

$pay_id=$_POST['mihpayid'];
$status=$_POST["status"];
$txnid=$_POST["txnid"];
mysqli_query($conn,"update product_order set payment_status='$status', mihpayid='$pay_id' where txnid='$txnid'");

?>
<h1>Sorry, your transaction is failed.Please try again Later.</h1>