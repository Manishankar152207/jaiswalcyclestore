<?php
require('top.php');
?>
<!-- cart-main-area start -->
<?php if(isset($_SESSION['cart'])){ ?>
    <div class="cart-main-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">products</th>
                                    <th class="product-name">name of products</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($_SESSION['cart'] as $key=>$val){
                                        $productArr=get_product($conn,'','',$key);
                                        $pname=$productArr['0']['name'];
                                        $mrp=$productArr['0']['mrp'];
                                        $price=$productArr['0']['price'];
                                        $image=$productArr['0']['image'];
                                        $qty=$val['qty'];
                                ?>
                                <tr>
                                    <td class="product-thumbnail"><a href="#"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image; ?>"
                                                alt="product img" /></a></td>
                                    <td class="product-name"><a href="#"><?php echo $pname; ?></a>
                                        <ul class="pro__prize">
                                            <li class="old__prize"><?php echo $mrp; ?></li>
                                            <li><?php echo $price; ?></li>
                                        </ul>
                                    </td>
                                    <td class="product-price"><span class="amount"><?php echo $price; ?></span></td>
                                    <td class="product-quantity"><input type="number" id="qty" value="<?php echo $qty; ?>" /><br>
                                    <a href="javascript:void(0)" onclick="add_to_cart('<?php echo $key; ?>','update')" style="color:black;font-size:15px;"><b>Update</a></td>
                                    
                                    <td class="product-subtotal"><?php echo $qty*$price; ?></td>
                                    <td class="product-remove"><a href="javascript:void(0)" onclick="add_to_cart('<?php echo $key; ?>','remove')">
                                    <i class="icon-trash icons"></i></a></td>
                                </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <script>
                        function add_to_cart(pid,type){
                                var qty=jQuery("#qty").val();
                            jQuery.ajax({
                                url:'manage_cart.php',
                                type:'post',
                                data:'pid='+pid+'&qty='+qty+'&type='+type,
                                success:function(result){
                                    if(type=='update' || type=='remove'){
                                     window.location.href='cart.php';
                                 }
                                jQuery('.htc__qua').html(result);
                                }
                            });
                        }
                    </script>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="buttons-cart--inner">
                                <div class="buttons-cart">
                                    <a href="categorie.php?id=1">Continue Shopping</a>
                                </div>
                                <div class="buttons-cart checkout--btn">
                                    <a href="ccheckout.php">checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
<?php }else{
    echo "<b>Your Cart is Empty.";
}?>
<!-- cart-main-area end -->
<!-- End Banner Area -->
<?php
require('footer.php');
?>