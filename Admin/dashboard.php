<?php
require('top.inc.php');
isAdmin();
if(isset($_GET['type'])&& $_GET['type']!=''){
    $type=get_safe_value($conn,$_GET['type']);
    if($type=='status'){
       $operation=get_safe_value($conn,$_GET['operation']);
       $id=get_safe_value($conn,$_GET['id']);
       if($operation=='Active'){
         $status=1;
       }else{
         $status=0;
       }
      mysqli_query($conn,"update categories set status='$status' where id='$id'");
    }
    if($type=='delete'){
      $id=get_safe_value($conn,$_GET['id']);
      mysqli_query($conn,"delete from categories where id='$id'");
   }
}
$sql="select * from categories order by categories asc";
$rec=mysqli_query($conn,$sql);
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h3 class="box-title" style="font-size:25px;">Categories </h3>
                  <h5 class="box-title" style="color:#000;text-decoration:underline;"><a href="manage_categories.php">Add categories </a></h5>
               </div>
               <div class="card-body--">
                  <div class="table-stats order-table ov-h">
                     <table class="table ">
                        <thead>
                           <tr>
                              <th class="serial">#</th>
                              <th>ID</th>
                              <th>categories</th>
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
                              <td>
                              <?php
                              if($row['status']==1){
                                 echo "<span class='badge badge-complete'><a href='?type=status&operation=Deactive&id=".$row['id']."' style='color:#fff;'>Active</a></span>&nbsp;";
                              }else{
                                 echo "<span class='badge badge-pending'><a href='?type=status&operation=Active&id=".$row['id']."' style='color:#fff;'>Deactive</a></span>&nbsp;";  
                              } 
                              echo "<span class='badge badge-edit' style='background:#33A2ff;'><a href='manage_categories.php?id=".$row['id']."' style='color:#fff;'>Edit</a></span>&nbsp;";
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