<?php
require('top.php');
$order_id=get_safe_value($conn,$_GET['id']);
$coupon_detail=mysqli_fetch_assoc(mysqli_query($conn,"select coupon_value from product_order where id=$order_id"));
$coupon_value=$coupon_detail['coupon_value'];
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
                                                <th class="product-thumbnail">Product Name</th>
                                                <th class="product-name"><span class="nobr">Image</span></th>
                                                <th class="product-price"><span class="nobr"> Price</span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Quantity </span></th>
                                                <th class="product-add-to-cart"><span class="nobr">Total Price</span></th>
                                            </tr>
                                        </thead>
                                        <tbody><?php
                                            $User_id=$_SESSION['User_Id'];
                                            $res=mysqli_query($conn,"select distinct(order_detail.id),order_detail.*,product.name,
                                            product.image from order_detail,product,product_order where order_detail.order_id=$order_id 
                                            and product_order.user_id=$User_id and product.id=order_detail.product_id");
                                            $total_price=0;
                                            while($row=mysqli_fetch_assoc($res)){
                                                 $total_price+=($row['qty']*$row['price'])?>
                                            <tr>
                                                <td class="product-name"><a href="#"><?php echo $row['name'];?></a></td>
                                                <td class="product-name"><a href="#"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']; ?>"
                                                alt="product img" /></a></td>
                                                <td class="product-name"><?php echo $row['price'];?><br>
                                                <td class="product-name"><a href="#"><?php echo $row['qty'];?></a></td>
                                                <td class="product-name"><a href="#"><?php echo $row['qty']*$row['price'];?></a></td>
                                            </tr>
                                            <?php }  
                                            if($coupon_value!='0'){
                                            ?>
                                                <tr>
                                                <td colspan="3"></td>
                                                <td class="product-name"><a href="#">Coupon Price</a></td>
                                                <td class="product-name"><a href="#"><?php echo $coupon_value?></a></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="product-name"><a href="#">Total Price</a></td>
                                                <td class="product-name"><a href="#"><?php echo $total_price-$coupon_value?></td>
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
