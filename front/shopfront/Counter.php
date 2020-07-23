<?php
require('functions.inc.php');
$conn=mysqli_connect("localhost","root","","login_test");
$id=get_safe_value($conn,$_POST['id']);
if($id==1){
    mysqli_query($conn,"update like_dislike set like_count=like_count+1 where id=1");
}else{
    mysqli_query($conn,"update like_dislike set dislike_count=dislike_count+1 where id=1");
}
?>