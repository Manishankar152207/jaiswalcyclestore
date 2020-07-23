<?php
require('top.inc.php');
isAdmin();
$categories='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
    $id=get_safe_value($conn,$_GET['id']);
    $res=mysqli_query($conn,"select * from categories where id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
        $row=mysqli_fetch_assoc($res);
        $categories=$row['categories'];
    }else{
        header('location:categories.php');
        die();
    }
    
}
if(isset($_POST['submit'])){
    $categories=get_safe_value($conn,$_POST['categories']);
    $res=mysqli_query($conn,"select * from categories where categories='$categories'");
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData=mysqli_fetch_assoc($res);
            if($id==$getData['id']){

            }else{
                $msg="Categories already exit!";
            }
        }else{
            $msg="Categories already exit!";
        }
    }
    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=''){
        mysqli_query($conn,"update categories set categories='$categories',status='1' where id='$id'");
        }else{
        mysqli_query($conn,"insert into categories(categories,status) values('$categories','1')");
        }
        header('location:categories.php');
        die();
    }
} 
?>
 <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form method="post">
                           <div class="form-group">
                               <label for="categories" class=" form-control-label">Categories</label><input type="text" name="categories" placeholder="Enter your categories name." class="form-control" value="<?php echo $categories; ?>" required></div>
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