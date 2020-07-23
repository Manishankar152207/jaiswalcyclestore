<?php
require('top.inc.php');
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
                        <th class="product-thumbnail">Order ID</th>
                        <th class="product-name"><span class="nobr">Order Date</span></th>
                        <th class="product-price"><span class="nobr"> Product name</span></th>
                        <th class="product-stock-stauts"><span class="nobr"> Quantity </span></th>
                        <th class="product-add-to-cart"><span class="nobr">Order Status</span></th>
                        </tr>
                     </thead>                                               
                     <tbody><?php
                      $res=mysqli_query($conn,"select product_order.*,product.name,order_detail.qty,order_status.status from product_order,product,order_status,order_detail where product_order.order_status=order_status.id and order_detail.order_id=product_order.id and product.added_by='".$_SESSION['Admin_Id']."' and order_detail.product_id=product.id");
                      while($row=mysqli_fetch_assoc($res)){ ?>
                      <tr>
                          <td class="product-add-to-cart"><?php echo $row['id'];?></td>
                          <td class="product-name"><a href="#"><?php echo $row['added_on'];?></a></td>
                          <td class="product-name"><a href="#"><?php echo $row['name'];?></a></td>
                          <td class="product-price"><span class="amount"><?php echo $row['qty'];?></span></td>
                          <td class="product-stock-status"><span class="wishlist-in-stock"><?php echo $row['status'];?></span></td>
                      </tr>
                      <?php } ?>
                  </tbody>
              </table>                                             
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