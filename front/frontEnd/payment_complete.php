<?php
require('connection.inc.php');
require('functions.inc.php');
echo '<b>Transaction In Process, Please do not reload</b>';
$payment_mode=$_POST['mode'];
$pay_id=$_POST['mihpayid'];
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$MERCHANT_KEY = "gtKFFx"; 
$SALT = "eCwWELxi";
$udf5='';
$keyString 	= $MERCHANT_KEY .'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|||||'.$udf5.'|||||';
$keyArray 	= explode("|",$keyString);
$reverseKeyArray = array_reverse($keyArray);
$reverseKeyString =	implode("|",$reverseKeyArray);
$saltString     = $SALT.'|'.$status.'|'.$reverseKeyString;
$sentHashString = strtolower(hash('sha512', $saltString));


if($sentHashString != $posted_hash){
	//mysqli_query($conn,"update product_order set payment_status='$status', mihpayid='$pay_id' where txnid='$txnid'");
	?>
		<script>
			window.location.href='payment_fail.php';
		</script>
		<?php	
}else{
	mysqli_query($conn,"update product_order set payment_status='$status',payu_status='$status', mihpayid='$pay_id' where txnid='$txnid'");	
	$order_detail=mysqli_fetch_assoc(mysqli_query($conn,"select id from product_order where txnid='$txnid'"));
	
	sentInvoice($conn,$order_detail['id']);
	?>
		<script>
			window.location.href='Thank_you.php';
		</script>
		<?php
}
?>