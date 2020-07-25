<?php
require('top.php');
if(!isset($_SESSION['User_Login']) && $_SESSION['User_Login']!='yes'){
    ?><script>
        window.location.href='login.php';
    </script><?php
}
if(isset($_GET['id']) && isset($_GET['order_id'])){
if($_GET['id']!='' && $_GET['order_id']!='' && $_GET['id']>0 && $_GET['order_id']>0 ){
    $id=get_safe_value($conn,$_GET['id']);
    $order_id=get_safe_value($conn,$_GET['order_id']);
    mysqli_query($conn,"delete from product_order where id='$order_id' and user_id='$id'");
}
}
?>
<!-- wishlist-area start -->
<div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
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
                                            $User_id=$_SESSION['User_Id'];
                                            $res=mysqli_query($conn,"select product_order.*,order_status.status from product_order,order_status where product_order.user_id=$User_id and product_order.order_status=order_status.id");
                                            while($row=mysqli_fetch_assoc($res)){ ?>
                                            <tr>
                                                <td class="product-add-to-cart"><a href="my_order_detail.php?id=<?php echo $row['id'];?>"><?php echo $row['id'];?></a></td>
                                                <td class="product-name"><a href="#"><?php echo $row['added_on'];?></a></td>
                                                <td class="product-name"><?php echo $row['address'];?><br>
                                                <?php echo $row['city'];?><br>
                                                <?php echo $row['pincode'];?><br></td>
                                                <td class="product-name"><a href="#"><?php echo $row['payment_type'];?></a></td>
                                                <td class="product-price"><span class="amount"><?php echo $row['payment_status'];?></span></td>
                                                <td class="product-stock-status"><span class="wishlist-in-stock"><?php echo $row['status'];?></span><br/><br>
                                                <a href="?id=<?php echo $User_id;?>&order_id=<?php echo $row['id'];?>">Cancel</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- wishlist-area end -->       
<?php
require('footer.php');
?>
