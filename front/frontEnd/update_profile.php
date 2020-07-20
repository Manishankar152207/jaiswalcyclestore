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
$name=get_safe_value($conn,$_POST['name']);
$uid=$_SESSION['User_Id'];
mysqli_query($conn,"update test set name='$name' where id='$uid'");
echo "Your name is updated";
?>