<?php
require('top.inc.php');
isAdmin();
$msg='';
$coupon_code='';
$coupon_type='';
$coupon_value='';
$cart_min_value='';
if(isset($_GET['id']) && $_GET['id']!=''){
    $id=get_safe_value($conn,$_GET['id']);
    $res=mysqli_query($conn,"select * from coupon_detail where id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
         $row=mysqli_fetch_assoc($res);
         $coupon_code=$row['coupon_code'];
         $coupon_type=$row['coupon_type'];
         $coupon_value=$row['coupon_value'];
         $cart_min_value=$row['cart_min_value'];
    }else{
        header('location:coupon_master.php');
        die();
    }
    
}
if(isset($_POST['submit'])){
    $coupon_code=get_safe_value($conn,$_POST['coupon_code']);
    $coupon_type=get_safe_value($conn,$_POST['coupon_type']);
    $coupon_value=get_safe_value($conn,$_POST['coupon_value']);
    $cart_min_value=get_safe_value($conn,$_POST['cart_min_value']);

    $res=mysqli_query($conn,"select * from coupon_detail where coupon_code='$coupon_code'");
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData=mysqli_fetch_assoc($res);
            if($id==$getData['id']){

            }else{
                $msg="Coupon code already exit!";
            }
        }else{
            $msg="Coupon code already exit!";
        }
    }
    /*if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
       $msg="Please select png,jpg or jpeg format file.";
    }*/
    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $update_sql="update coupon_detail set coupon_code='$coupon_code',coupon_type='$coupon_type',coupon_value='$coupon_value',
            cart_min_value='$cart_min_value',status='1' where id='$id'";
             mysqli_query($conn,$update_sql);
        }else{
            mysqli_query($conn,"insert into coupon_detail(coupon_code,coupon_type,coupon_value,cart_min_value,status) 
            values('$coupon_code','$coupon_type','$coupon_value','$cart_min_value','1')");
         }
         header('location:coupon_master.php');
         die();
      }
   }

?>
 <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Coupon</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form method="post">
                           <div class="form-group">
                               <label for="coupon_code" class=" form-control-label">Coupon Code</label><input type="text" 
                               name="coupon_code" placeholder="Enter your Coupon Code." class="form-control" 
                               value="<?php echo $coupon_code; ?>" required>
                            </div>
                            <div class="form-group">
                               <label for="coupon_type" class=" form-control-label">Coupon Type</label>
                               <select class=" form-control" name="coupon_type" required>
                                   <option value=''>Select</option>
                                   <?php
                                   if($coupon_type=='percent'){
                                      echo "<option value='percent' selected>PERCENTAGE</option>
                                      <option value='Rupee'>Rupee</option>";
                                   }elseif($coupon_type=='Rupee'){
                                      echo "<option value='percent'>PERCENTAGE</option>
                                      <option value='Rupee' selected>Rupee</option>";
                                   }else{
                                      echo "<option value='percent'>PERCENTAGE</option>
                                      <option value='Rupee'>Rupee</option>";
                                   }
                                   ?>
                               </select>
                            </div>
                            <div class="form-group">
                               <label for="coupon_value" class=" form-control-label">Coupon Value</label><input type="text" 
                               name="coupon_value" placeholder="Enter your Coupon Value." class="form-control" 
                               value="<?php echo $coupon_value; ?>" required>
                            </div>
                            <div class="form-group">
                               <label for="cart_min_value" class=" form-control-label">Cart Min Value</label><input type="text" 
                               name="cart_min_value" placeholder="Enter your Cart Min Value ." class="form-control" 
                               value="<?php echo $cart_min_value; ?>" required>
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