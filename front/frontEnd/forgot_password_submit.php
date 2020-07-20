<?php
require('connection.inc.php');
require('functions.inc.php');

$email=get_safe_value($conn,$_POST['email']);
$res=mysqli_query($conn,"select * from test where email='$email'");
$check_user=mysqli_num_rows($res);

if($check_user>0){
	$row=mysqli_fetch_assoc($res);
	$pwd=$row['pass'];
	$html="Your password is $pwd";
	$to_email = $email;
    $subject = "Your password";
    $body =$html;
    $headers = "From: manishjaiswal152207@gmail.com";
	if(mail($to_email, $subject, $body, $headers)){
		echo "Please check your email id for password";
	}else{
		echo "Either your email is wrong or please try after some time.";
	}
}else{
	echo "Email id not registered with us";
	die();
}
?>