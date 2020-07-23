<?php
require('top.inc.php');
isAdmin();
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
      mysqli_query($conn,"update coupon_detail set status='$status' where id='$id'");
    }
    if($type=='delete'){
      $id=get_safe_value($conn,$_GET['id']);
      mysqli_query($conn,"delete from coupon_detail where id='$id'");
   }
}
$sql="select * from coupon_detail order by id desc";
$rec=mysqli_query($conn,$sql);
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h3 class="box-title" style="font-size:25px;">Coupon Detail</h3>
                  <h5 class="box-title" style="color:#000;text-decoration:underline;"><a href="manage_coupon.php">Add Coupon </a></h5>
               </div>
               <div class="card-body--">
                  <div class="table-stats order-table ov-h">
                     <table class="table ">
                        <thead>
                           <tr>
                              <th class="serial">#</th>
                              <th>ID</th>
                              <th>Coupon Code</th>
                              <th>Image Type</th>
                              <th>Coupon Value</th>
                              <th>Cart Min Value</th>
                              <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $i=1;
                           while($row=mysqli_fetch_assoc($rec)){ ?>
                              <tr>
                              <td class="serial"><?php echo $i;?></td>
                              <td><?php echo $row['id'];?> </td>
                              <td><?php echo $row['coupon_code'];?> </td>
                              <td><?php echo $row['coupon_type'];?> </td>
                              <td><?php echo $row['coupon_value'];?> </td>
                              <td><?php echo $row['cart_min_value'];?> <br /></td>
                              <td>
                              <?php
                              if($row['status']==1){
                                 echo "<span class='badge badge-complete'><a href='?type=status&operation=UnAvailable&id=".$row['id']."' style='color:#fff;'>Available</a></span>&nbsp;";
                              }else{
                                 echo "<span class='badge badge-pending'><a href='?type=status&operation=Available&id=".$row['id']."' style='color:#fff;'>UnAvailable</a></span>&nbsp;";  
                              } 
                              echo "<span class='badge badge-edit' style='background:#33A2ff;'><a href='manage_coupon.php?id=".$row['id']."' style='color:#fff;'>Edit</a></span>&nbsp;";
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