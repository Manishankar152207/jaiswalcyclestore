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
                        <th class="product-price"><span class="nobr"> Address</span></th>
                        <th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
                        <th class="product-add-to-cart"><span class="nobr">Payment Status</span></th>
                        <th class="product-add-to-cart"><span class="nobr">Order Status</span></th>
                        </tr>
                     </thead>                                               
                     <tbody><?php
                      $res=mysqli_query($conn,"select product_order.*,order_status.status from product_order,order_status where product_order.order_status=order_status.id");
                      while($row=mysqli_fetch_assoc($res)){ ?>
                      <tr>
                          <td class="product-add-to-cart"><a href="order_detail_master.php?id=<?php echo $row['id'];?>"><?php echo $row['id'];?></a></td>
                          <td class="product-name"><a href="#"><?php echo $row['added_on'];?></a></td>
                          <td class="product-name"><?php echo $row['address'];?><br>
                          <?php echo $row['city'];?><br>
                          <?php echo $row['pincode'];?><br></td>
                          <td class="product-name"><a href="#"><?php echo $row['payment_type'];?></a></td>
                          <td class="product-price"><span class="amount"><?php echo $row['payment_status'];?></span></td>
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