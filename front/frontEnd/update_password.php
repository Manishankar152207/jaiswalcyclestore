<?php
require('connection.inc.php');
require('functions.inc.php');
if(!isset($_SESSION['User_Login'])){
	?>
	<script>
	window.location.href='Login.php';
	</script>
	<?php
}
$current_password=get_safe_value($conn,$_POST['current_password']);
$new_password=get_safe_value($conn,$_POST['new_password']);
$uid=$_SESSION['User_Id'];

$row=mysqli_fetch_assoc(mysqli_query($conn,"select pass from test where id='$uid'"));

if($row['pass']!=$current_password){
	echo "Please enter your current valid password";
}else{
	mysqli_query($conn,"update test set pass='$new_password' where id='$uid'");
	echo "Password updated";
}
?>