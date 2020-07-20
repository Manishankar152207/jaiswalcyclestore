<?php
require('top.php');
if($_GET['id']!=''){
    $pro_id=get_safe_value($conn,$_GET['id']);
    if($pro_id>0){
        $get_product=get_product($conn,'','',$pro_id);
    }else{
        ?>
        <script>
            window.location.href='categorie.php?id=1';
        </script>
        <?php
    }
}
?>
<!-- Start Product Details Area -->
    <section class="htc__product__details bg__white ptb--100">
            <!-- Start Product Details Top -->
            <div class="htc__product__details__top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                            <div class="htc__product__details__tab__content">
                                <!-- Start Product Big Images -->
                                <div class="product__big__images">
                                    <div class="portfolio-full-image tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image'] ?>" alt="full-image">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Big Images -->
                                
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                            <div class="ht__product__dtl">
                                <h2><?php echo $get_product['0']['name'] ?></h2>
                                <ul  class="pro__prize">
                                    <li><?php echo $get_product['0']['price'] ?></li>
                                </ul>
                                <p class="pro__info"><?php echo $get_product['0']['short_desc'] ?>
                                     <div class="ht__pro__desc">
                                    <div class="sin__desc">
                                    <?php echo $getsoldproductbyproductid=getsoldproductbyproductid($conn,$pro_id);
                                        $productqty=productqty($conn,$pro_id);
                                        $productqty_pending=$productqty-$getsoldproductbyproductid;
                                        $cart_show='yes';
                                        if($get_product['0']['qty']>$getsoldproductbyproductid){
                                            $stock="In Stock";
                                        }else{
                                            $stock="Out of Stock";
                                            $cart_show='';
                                        }
                                    ?>
                                        <p><span>Availability:</span><?php echo $stock;?></p>
                                    </div>
                                    <div class="sin__desc">
                                        <p><span>Quantity:</span> 
                                        <select name="qty" id="qty" style="border:1px solid brown;height:30px;">
                                        <?php
                                            for($i=1;$i<=$productqty_pending;$i++){
                                                echo "<option >$i</option>";
                                            }
                                        ?>
                                        </select></p>
                                    </div>
                                    <div class="sin__desc align--left">
                                        <p><span>Categories:</span></p>
                                        <ul class="pro__cat__list">
                                            <li><a href="categorie.php?id=<?php echo $get_product['0']['categories_id'] ?>"><?php echo $get_product['0']['categories'] ?></a></li>
                                        </ul>
                                    </div>
                                    
                                    </div>
                                    <div class="contact-btn">
                                    <?php if($cart_show!=''){ ?>
                                        <button type="submit" name="cart" class="fv-btn" href="javascript:void(0)" onclick="add_to_cart('<?php echo $get_product['0']['id'] ?>','add')">Add to Cart</button>
                                    <?php } ?> 
										
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Details Top -->
            <script>
                function add_to_cart(pid,type){
                    var qty=jQuery('#qty').val();
                    jQuery.ajax({
                        url:'manage_cart.php',
                        type:'post',
                        data:'pid='+pid+'&qty='+qty+'&type='+type,
                        success:function(result){
                            if(result=='not'){
                                alert('Quantity not Available.');
                            }else{
                                jQuery('.htc__qua').html(result);
                            }
                        }
                    });
                }
            </script>
        </section>
        <!-- End Product Details Area -->
         <!-- Start Product Description -->
         <section class="htc__produc__decription bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- Start List And Grid View -->
                        <ul class="pro__details__tab" role="tablist">
                            <li role="presentation" class="description active"><a href="#description" role="tab" data-toggle="tab">description</a></li>
                        </ul>
                        <!-- End List And Grid View -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="ht__pro__details__content">
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                                <div class="pro__tab__content__inner">
                                <?php echo $get_product['0']['description'] ?></div>
                            </div>
                            <!-- End Single Content -->
                            
                        </div>
                    </div>
                </div>
            </div>
    </section>
     <!-- End Product Description -->                
                     
<?php
require('footer.php');
?>