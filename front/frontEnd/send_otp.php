<?php
require('connection.inc.php');
require('functions.inc.php');

$type=get_safe_value($conn,$_POST['type']);
if($type=='email'){
	$email=get_safe_value($conn,$_POST['email']);
	$check_user=mysqli_num_rows(mysqli_query($conn,"select * from test where email='$email'"));
	if($check_user>0){
		echo "email_present";
		die();
	}
	
	$otp=rand(1111,9999);
	$_SESSION['EMAIL_OTP']=$otp;
	
	$to_email = $email;
    $subject = "Email Verification";
    $body ="$otp is your otp";
    $headers = "From: manishjaiswal152207@gmail.com";
	if(mail($to_email, $subject, $body, $headers)){
		echo "done";
	}else{
		//echo "Error occur";
	}
}

/*if($type=='mobile'){
	$mobile=get_safe_value($con,$_POST['mobile']);
	$check_mobile=mysqli_num_rows(mysqli_query($con,"select * from users where mobile='$mobile'"));
	if($check_mobile>0){
		echo "mobile_present";
		die();
	}
	$otp=rand(1111,9999);
	$_SESSION['MOBILE_OTP']=$otp;
	$message="$otp is your otp";
	
	$mobile='91'.$mobile;
	$apiKey = urlencode('API_KEY');
	$numbers = array($mobile);
	$sender = urlencode('TXTLCL');
	$message = rawurlencode($message);
	$numbers = implode(',', $numbers);
 	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	echo "done";
}*/
?>