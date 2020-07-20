<?php
require('top.php');
if($_GET['str']!=''){
    $str=get_safe_value($conn,$_GET['str']);
    if($str!=''){
        $get_product=get_product($conn,'','','',$str);
    }else{
        ?>
<script>
    window.location.href = 'categorie.php?id=1';
</script>
<?php
    }
    
}
?>
<div class="htc__select__option"
    style="width:20%;height:40px;float:left;background-color:white;margin-top:4px;margin-left:4px;border:2px solid gainsboro;border-radius:15px;box-shadow: 1px 2px 10px 5px white;color:blue;">
    <select class="ht__select">
        <option>Sort by..</option>
        <option>Sort by popularity</option>
        <option>Sort by average rating</option>
        <option>Sort by newness</option>
    </select>
</div>
<form action="search.php" method="get">
    <div class="body__overlay"></div>
    <div id="myDropdown" class="dropdown-content">
        <input type="text" placeholder="   Search your product here.." id="myInput" name="str"
            style="width:35%;height:40px;float:right;background-color:white;margin-top:4px;margin-right:4px;border:2px solid gainsboro;border-radius:15px;box-shadow: 1px 2px 10px 5px white;color:blue;">
    </div>
</form>
<section class="text-gray-700 body-font" id="products">
    <div class="container px-5 py-24 mx-auto">
        <?php if(count($get_product)>0) { ?>
        <div class="flex flex-wrap -m-4">
            <?php
                    foreach($get_product as $list){ ?>
            <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                <a class="block relative h-48 rounded overflow-hidden"
                    href="product_detail.php?id=<?php echo $list['id']; ?>">
                    <img alt="ecommerce" class="object-cover object-center w-full h-full block"
                        src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image'] ?>">
                </a>
                <div class="mt-4">
                    <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1"><?php echo $list['name'] ?></h3>
                    <p class="mt-1"><?php echo $list['price'] ?></p>
                </div>
               <!-- <div class="contact-btn">
                    <button type="submit" id="submit1" name="cart" class="fv-btn">Add to Cart</button>
                </div>-->
            </div>
            <?php } ?>
        </div>
        <?php }else{
                 echo "<b>Product  not found.";
            }?>
    </div>
</section>
<!-- Start Product Area -->
<section class="ftr__product__area ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title--2 text-center">
                    <h2 class="title__line">Best Seller</h2>
                    <p>But I must explain to you how all this mistaken idea</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="product__wrap clearfix">
                <!-- Start Single Category -->
                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                    <div class="category">
                        <div class="ht__cat__thumb">
                            <a href="product-details.html">
                                <img src="images/product/9.jpg" alt="product images">
                            </a>
                        </div>
                        <div class="fr__product__inner">
                            <h4><a href="product-details.html">Special Wood Basket</a></h4>
                            <ul class="fr__pro__prize">
                                <li class="old__prize">$30.3</li>
                                <li>$25.9</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single Category -->
            </div>
        </div>
    </div>
</section>
<!-- End Product Area -->
<?php
require('footer.php');
?>