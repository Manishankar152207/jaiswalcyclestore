<?php
require('top.inc.php');
isAdmin();
if(isset($_GET['type'])&& $_GET['type']!=''){
    $type=get_safe_value($conn,$_GET['type']);
    if($type=='delete'){
      $id=get_safe_value($conn,$_GET['id']);
      mysqli_query($conn,"delete from test where id='$id'");
   }
}
$sql="select * from test order by id desc";
$rec=mysqli_query($conn,$sql);
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h3 class="box-title" style="font-size:25px;">Users</h3>
               </div>
               <div class="card-body--">
                  <div class="table-stats order-table ov-h">
                     <table class="table ">
                        <thead>
                           <tr>
                              <th class="serial">#</th>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Password</th>
                              <th>Date and Time</th>
                              <th>Delete</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $i=1;
                           while($row=mysqli_fetch_assoc($rec)){ ?>
                              <tr>
                              <td class="serial"><?php echo $i;?></td>
                              <td><?php echo $row['id'];?> </td>
                              <td><?php echo $row['name'];?></td>
                              <td><?php echo $row['email'];?></td>
                              <td><?php echo $row['pass'];?></td>
                              <td><?php echo $row['date_time'];?></td>
                              <td>
                              <?php
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