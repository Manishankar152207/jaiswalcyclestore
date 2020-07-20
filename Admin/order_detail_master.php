<?php
require('top.inc.php');
$order_id=get_safe_value($conn,$_GET['id']);
if($order_id>0){

}else{
    ?>
<script>
   window.location.href = 'order_master.php';
</script><?php
}
if(isset($_POST['submit'])){
   $update_order_status=$_POST['update_order_status'];
   mysqli_query($conn,"update product_order set order_status='$update_order_status' where id='$order_id'");
}
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h3 class="box-title" style="font-size:25px;">Order Master</h3>
               </div>
               <div class="card-body--">
                  <div class="table-stats order-table ov-h">
                     <table class="table ">
                        <thead>
                           <tr>
                              <th class="product-thumbnail">Product Name</th>
                              <th class="product-name"><span class="nobr">Image</span></th>
                              <th class="product-price"><span class="nobr"> Price</span></th>
                              <th class="product-stock-stauts"><span class="nobr"> Quantity </span></th>
                              <th class="product-add-to-cart"><span class="nobr">Total Price</span></th>
                           </tr>
                        </thead>
                        <tbody><?php 
                        $res=mysqli_query($conn,"select distinct(order_detail.id),order_detail.*,product.name,
                        product.image,product_order.address,product_order.city,product_order.pincode from order_detail,product,product_order where order_detail.order_id=$order_id 
                        and product.id=order_detail.product_id");
                        $total_price=0;
                        while($row=mysqli_fetch_assoc($res)){
                           $address=$row['address'];
                           $city=$row['city'];
                           $pincode=$row['pincode'];
                           $total_price+=($row['qty']*$row['price'])?>
                                           
                           <tr>
                              <td class="product-name"><a href="#"><?php echo $row['name'];?></a></td>
                              <td class="product-name"><a href="#"><img
                                       src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']; ?>"
                                       alt="product img" /></a></td>
                              <td class="product-name"><?php echo $row['price'];?><br>
                              <td class="product-name"><a href="#"><?php echo $row['qty'];?></a></td>
                              <td class="product-name"><a href="#"><?php echo $row['qty']*$row['price'];?></a></td>
                           </tr>
                           <?php } ?>
                           <tr>
                              <td colspan="3"></td>
                              <td class="product-name"><a href="#">Total Price</a></td>
                              <td class="product-name"><a href="#"><?php echo $total_price?></a></td>
                           </tr>
                        </tbody>
                     </table>
                     <div class="address_details">
                        <strong>Address:</strong>
                           <?php echo $address; ?>, <?php echo $city; ?>, <?php echo $pincode; ?><br /><br>
                        <strong>Order Status:</strong>
                        <?php
                        $sql="select order_status.status from order_status,product_order where product_order.id=$order_id and order_status.id=product_order.order_status";
                        $order_status_arr=mysqli_fetch_assoc(mysqli_query($conn,$sql));
                        echo $order_status_arr['status'];?>
                     </div><br>
                     <div><form action="" method="post">
                        <select class=" form-control" name="update_order_status">
                                   <option>Select Status</option>
                                   <?php
                                   $res=mysqli_query($conn,"select * from order_status");
                                   while($row=mysqli_fetch_assoc($res)){
                                        echo "<option value=".$row['id'].">".$row['status']."</option>"; 
                                   }
                                   ?>
                               </select><br>
                               <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="submit">
                              <span id="payment-button-amount">Submit</span>
                           </button>
                        </form></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
require('footer.inc.php');
?>