<?php
require('top.inc.php');
$msg='';
$name='';
$password='';
$email='';
$phone='';
if(isset($_GET['id']) && $_GET['id']!=''){
    $id=get_safe_value($conn,$_GET['id']);
    $res=mysqli_query($conn,"select * from admin_users where id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
         $row=mysqli_fetch_assoc($res);
         $name=$row['name'];
         $password=$row['pass'];
         $email=$row['email'];
         $phone=$row['phone'];
    }else{
        header('location:vendor_management.php');
        die();
    }
    
}
if(isset($_POST['submit'])){
    $name=get_safe_value($conn,$_POST['name']);
    $password=get_safe_value($conn,$_POST['password']);
    $email=get_safe_value($conn,$_POST['email']);
    $phone=get_safe_value($conn,$_POST['phone']);

    $res=mysqli_query($conn,"select * from admin_users where name='$name'");
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData=mysqli_fetch_assoc($res);
            if($id==$getData['id']){
               
            }else{
                $msg="Vendor already exit!";
            }
        }else{
            $msg="Vendor already exit!";
        }
    }
    /*if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
       $msg="Please select png,jpg or jpeg format file.";
    }*/
    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $update_sql="update admin_users set name='$name',pass='$password',email='$email',
            phone='$phone',role='1',status='1' where id='$id'";
             mysqli_query($conn,$update_sql);
        }else{
            mysqli_query($conn,"insert into admin_users(name,pass,email,phone,role,status) 
            values('$name','$password','$email','$phone','1','1')");
         }
         header('location:vendor_management.php');
         die();
      }
   }

?>
 <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Vendors</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form method="post">
                           <div class="form-group">
                               <label for="name" class=" form-control-label">Vender's Name</label><input type="text" 
                               name="name" placeholder="Enter Vendor Name." class="form-control" 
                               value="<?php echo $name; ?>" required>
                            </div>
                            <div class="form-group">
                               <label for="password" class=" form-control-label">Password</label><input type="text" 
                               name="password" placeholder="Enter Password." class="form-control" 
                               value="<?php echo $password; ?>" required>
                            </div>
                            <div class="form-group">
                               <label for="email" class=" form-control-label">Vendor's Email</label><input type="text" 
                               name="email" placeholder="Enter Email ." class="form-control" 
                               value="<?php echo $email; ?>" required>
                            </div>
                            <div class="form-group">
                               <label for="phone" class=" form-control-label">Vendor's Mobile</label><input type="text" 
                               name="phone" placeholder="Enter Phone Number ." class="form-control" 
                               value="<?php echo $phone; ?>" required>
                            </div>
                           <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="submit">
                           <span id="payment-button-amount">Submit</span>
                           </button>
                           <span style="color:red;"><?php echo $msg ?></span>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
<?php
require('footer.inc.php');
?>