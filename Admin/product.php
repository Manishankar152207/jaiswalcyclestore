<?php
require('top.inc.php');
if(isset($_GET['type'])&& $_GET['type']!=''){
    $type=get_safe_value($conn,$_GET['type']);
    if($type=='status'){
       $operation=get_safe_value($conn,$_GET['operation']);
       $id=get_safe_value($conn,$_GET['id']);
       if($operation=='Available'){
         $status=1;
       }else{
         $status=0;
       }
      mysqli_query($conn,"update product set status='$status' where id='$id'");
    }
    if($type=='delete'){
      $id=get_safe_value($conn,$_GET['id']);
      mysqli_query($conn,"delete from product where id='$id'");
   }
}
$sql="select product.*,categories.categories from product,categories 
where product.categories_id=categories.id order by product.id desc";
$rec=mysqli_query($conn,$sql);
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h3 class="box-title" style="font-size:25px;">Product </h3>
                  <h5 class="box-title" style="color:#000;text-decoration:underline;"><a href="manage_product.php">Add Product </a></h5>
               </div>
               <div class="card-body--">
                  <div class="table-stats order-table ov-h">
                     <table class="table ">
                        <thead>
                           <tr>
                              <th class="serial">#</th>
                              <th>ID</th>
                              <th>categories</th>
                              <th>Name</th>
                              <th>Image</th>
                              <th>MRP</th>
                              <th>price</th>
                              <th>Qty</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $i=1;
                           while($row=mysqli_fetch_assoc($rec)){ ?>
                              <tr>
                              <td class="serial"><?php echo $i;?></td>
                              <td><?php echo $row['id'];?> </td>
                              <td><?php echo $row['categories'];?> </td>
                              <td><?php echo $row['name'];?> </td>
                              <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'];?>"> </td>
                              <td><?php echo $row['mrp'];?> </td>
                              <td><?php echo $row['price'];?> </td>
                              <td><?php echo $row['qty'];?> <br />
                              <?php
                              $getsoldproductbyproductid=getsoldproductbyproductid($conn,$row['id']);
                              $productqty_pending=$row['qty']-$getsoldproductbyproductid;?>
                              Pending QTY:<?php echo $productqty_pending; ?>
                              </td>
                              <td>
                              <?php
                              if($row['status']==1){
                                 echo "<span class='badge badge-complete'><a href='?type=status&operation=UnAvailable&id=".$row['id']."' style='color:#fff;'>Available</a></span>&nbsp;";
                              }else{
                                 echo "<span class='badge badge-pending'><a href='?type=status&operation=Available&id=".$row['id']."' style='color:#fff;'>UnAvailable</a></span>&nbsp;";  
                              } 
                              echo "<span class='badge badge-edit' style='background:#33A2ff;'><a href='manage_product.php?id=".$row['id']."' style='color:#fff;'>Edit</a></span>&nbsp;";
                              echo "<span class='badge badge-delete' style='background:#ff0000;'><a href='?type=delete&id=".$row['id']."' style='color:#fff;'>Delete</a></span>&nbsp;";
                              
                              ?>
                              </td>
                           </tr>
                          <?php $i++; } ?>
                           
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