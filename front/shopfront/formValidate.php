<?php
require('functions.inc.php');
$conn =mysqli_connect("localhost","root","","login_test");
$msg='';
/*$nameErr = $emailErr == $phoneErr = '';*/
if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['message'])){
    $name=get_safe_value($conn,$_POST['name']);
    /*if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }*/
    $email=get_safe_value($conn,$_POST['email']);
    /*if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }*/
    $phone=get_safe_value($conn,$_POST['phone']);
    /*if (!preg_match("/^[9]{1}[8]{1}[0-9]{8}$/",$phone)) {
      $nameErr = "Invalid phone Number.";*/

   $date=date('Y-m-d h:i:s');
   $message=get_safe_value($conn,$_POST['message']);
  include('../frontEnd/smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="indaljaiswal152207@gmail.com";
	$mail->Password="manish152207";
	$mail->SetFrom("indaljaiswal152207@gmail.com");
	$mail->addAddress($email);
	$mail->IsHTML(true);
	$mail->Subject="New Contact Us";
	$mail->Body="Name=".$name."<br>E-mail=".$email."<br>Phone=".$phone."<br>Message=".$message;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
    echo "yes";
    die();
	}else{
		//echo "Error occur";
  }
  mysqli_query($conn,"insert into form(name,email,phone,message,date_time) values('$name','$email','$phone','$message','$date')");
  }
?>
  

