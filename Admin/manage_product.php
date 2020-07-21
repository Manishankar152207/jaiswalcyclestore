<?php
require('top.inc.php');
$categories='';
$msg='';
$categories_id='';
$name='';
$mrp='';
$price='';
$qty='';
$image='';
$best_seller='';
$short_desc='';
$description='';
$meta_title='';
$meta_desc='';
$meta_keyword='';
$image_required='required';
if(isset($_GET['id']) && $_GET['id']!=''){
    $image_required='';
    $id=get_safe_value($conn,$_GET['id']);
    $res=mysqli_query($conn,"select * from product where id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
        $row=mysqli_fetch_assoc($res);
        $categories_id=$row['categories_id'];
        $name=$row['name'];
        $mrp=$row['mrp'];
        $price=$row['price'];
        $qty=$row['qty'];
        $best_seller=$row['best_seller'];
        $short_desc=$row['short_desc'];
        $description=$row['description'];
        $meta_title=$row['meta_title'];
        $meta_desc=$row['meta_desc'];
        $meta_keyword=$row['meta_keyword'];
    }else{
        header('location:product.php');
        die();
    }
    
}
if(isset($_POST['submit'])){
    $categories_id=get_safe_value($conn,$_POST['categories_id']);
    $name=get_safe_value($conn,$_POST['p_name']);
    $mrp=get_safe_value($conn,$_POST['mrp']);
    $price=get_safe_value($conn,$_POST['price']);
    $qty=get_safe_value($conn,$_POST['qty']);
    $best_seller=get_safe_value($conn,$_POST['best_seller']);
    $short_desc=get_safe_value($conn,$_POST['short_desc']);
    $description=get_safe_value($conn,$_POST['description']);
    $meta_title=get_safe_value($conn,$_POST['meta_title']);
    $meta_desc=get_safe_value($conn,$_POST['meta_desc']);
    $meta_keyword=get_safe_value($conn,$_POST['meta_keyword']);

    $res=mysqli_query($conn,"select * from product where name='$name'");
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData=mysqli_fetch_assoc($res);
            if($id==$getData['id']){

            }else{
                $msg="product already exit!";
            }
        }else{
            $msg="product already exit!";
        }
   }
    /*if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
       $msg="Please select png,jpg or jpeg format file.";
    }*/
    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=''){
           if($_FILES['image']['name']!=''){
               $image=rand(11111111,99999999).'_'.$_FILES['image']['name'];
               move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
               $update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',
               price='$price',qty='$qty',best_seller='$best_seller',short_desc='$short_desc',description='$description',meta_title='$meta_title',
               meta_desc='$meta_desc',meta_keyword='$meta_keyword',status='1',image='$image' where id='$id'";
         }else{
            $update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',
            price='$price',qty='$qty',best_seller='$best_seller',short_desc='$short_desc',description='$description',meta_title='$meta_title',
            meta_desc='$meta_desc',meta_keyword='$meta_keyword',status='1' where id='$id'";
           }
            mysqli_query($conn,$update_sql);
        }else{
            $image=rand(11111111,99999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
            mysqli_query($conn,"insert into product(categories_id,name,mrp,price,qty,image,best_seller,short_desc,description,meta_title,meta_desc,meta_keyword,status) 
            values('$categories_id','$name','$mrp','$price','$qty','$image','$best_seller','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword','1')");
         }
         header('location:product.php');
         die();
      }
   }

?>
 <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form method="post" enctype="multipart/form-data">
                           <div class="form-group">
                               <label for="categories_id" class=" form-control-label">Categories Id</label>
                               <select class=" form-control" name="categories_id">
                                   <option>Select Categories</option>
                                   <?php
                                   $res=mysqli_query($conn,"select id,categories from categories order by categories asc");
                                   while($row=mysqli_fetch_assoc($res)){
                                       if($row['id']==$categories_id){
                                        echo "<option selected value=".$row['id'].">".$row['categories']."</option>"; 
                                       }else{
                                        echo "<option value=".$row['id'].">".$row['categories']."</option>"; 
                                       }
                                      
                                   }
                                   ?>
                               </select>
                            </div>
                           <div class="form-group">
                               <label for="name" class=" form-control-label">name</label><input type="text" 
                               name="p_name" placeholder="Enter your Product name." class="form-control" 
                               value="<?php echo $name; ?>" required>
                            </div>
                            <div class="form-group">
                               <label for="best_seller" class=" form-control-label">Best Seller</label>
                               <select class=" form-control" name="best_seller">
                                   <option>Select</option>
                                   <?php
                                   if($best_seller==1){
                                      echo "<option value='1' selected>YES</option>
                                      <option value='0'>NO</option>";
                                   }elseif($best_seller==0){
                                      echo "<option value='1'>YES</option>
                                      <option value='0' selected>NO</option>";
                                   }else{
                                      echo "<option value='1'>YES</option>
                                      <option value='0'>NO</option>";
                                   }
                                   ?>
                               </select>
                            </div>
                            <div class="form-group">
                               <label for="MRP" class=" form-control-label">MRP</label><input type="text" 
                               name="mrp" placeholder="Enter Product MRP" class="form-control" 
                               value="<?php echo $mrp; ?>" required>
                            </div>
                            <div class="form-group">
                               <label for="price" class=" form-control-label">Price</label><input type="text" 
                               name="price" placeholder="Enter Product Price" class="form-control" 
                               value="<?php echo $price; ?>" required>
                            </div>
                           <div class="form-group">
                               <label for="qty" class=" form-control-label">QTY</label><input type="text" 
                               name="qty" placeholder="Enter Quantity" class="form-control" 
                               value="<?php echo $qty; ?>" required>
                            </div>
                            <div class="form-group">
                               <label for="Image" class=" form-control-label">Upload Product Image</label><input type="file" 
                               class="form-control" name="image" <?php echo $image_required ?> >
                            </div>
                            <div class="form-group">
                               <label for="short_desc" class=" form-control-label">Short Description</label><textarea
                               class="form-control" name="short_desc" placeholder="Enter Short Description" required><?php echo $short_desc;?></textarea>
                            </div>
                            <div class="form-group">
                               <label for="description" class=" form-control-label">Description</label><textarea
                               class="form-control" name="description" placeholder="Enter Description" required><?php echo $description;?></textarea>
                            </div>
                            <div class="form-group">
                               <label for="meta_title" class=" form-control-label">Meta Title</label><textarea
                               class="form-control" name="meta_title" placeholder="Enter Meta Title" required><?php echo $meta_title;?></textarea>
                            </div>
                            <div class="form-group">
                               <label for="meta_desc" class=" form-control-label">Meta Description</label><textarea
                               class="form-control" name="meta_desc" placeholder="Enter Meta Description" required><?php echo $meta_desc;?></textarea>
                            </div>
                            <div class="form-group">
                               <label for="meta_keyword" class=" form-control-label">Meta Keyword</label><textarea
                               class="form-control" name="meta_keyword" placeholder="Enter Meta Keyword" required><?php echo $meta_keyword;?></textarea>
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