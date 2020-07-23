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

    mysqli_query($conn,"insert into form(name,email,phone,message,date_time) values('$name','$email','$phone','$message','$date')");  
    $to_email = "manishjaiswal152207@gmail.com";
    $subject = "New Contact Us";
    $body ="Name=".$name." E-mail=".$email." Phone=".$phone." Message=".$message;
    $headers = "From: manishjaiswal152207@gmail.com";
    mail($to_email, $subject, $body, $headers);
    echo "yes";
  }
?>
  

