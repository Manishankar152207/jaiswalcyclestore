<?php
require('top.php');
$high_low_selected='';
$low_high_selected='';
$old_selected='';
$new_selected='';
$sort_order='';
if(isset($_GET['sort'])){
    $sort=get_safe_value($conn,$_GET['sort']);
    if($sort=="high_low"){
        $sort_order=" order by product.price desc ";
        $high_low_selected="selected";
    }
    if($sort=="low_high"){
        $sort_order=" order by product.price asc ";
        $low_high_selected="selected";
    }
    if($sort=="old"){
        $sort_order=" order by product.id asc ";
        $old_selected="selected";
    }
    if($sort=="new"){
        $sort_order=" order by product.id desc ";
        $new_selected="selected";
    }
}
if($_GET['id']!=''){
    $id=get_safe_value($conn,$_GET['id']);
    if($id>0){
        $get_product=get_product($conn,'',$id,'','',$sort_order);
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
    style="width:40%;height:40px;float:left;background-color:white;margin-top:4px;margin-left:4%;border:2px solid gainsboro;border-radius:15px;box-shadow: 1px 2px 10px 5px white;color:blue;">
    <select class="ht__select" onchange="sorting('<?php echo $id ?>')" id="product_sort">
        <option value=''>Sort by..</option>
        <option <?php echo $high_low_selected;?> value="high_low">High to low</option>
        <option <?php echo $low_high_selected;?> value="low_high">low to high</option>
        <option <?php echo $old_selected;?> value="old">Sort by old one</option>
        <option <?php echo $new_selected;?> value="new">Sort by new one</option>
    </select>
</div>
<form action="search.php" method="get">
    <div class="body__overlay"></div>
    <div id="myDropdown" class="dropdown-content">
        <input type="text" placeholder="   Search your product here.." id="myInput" name="str"
            style="width:45%;height:40px;float:right;background-color:white;margin-top:4px;margin-right:4%;border:2px solid gainsboro;border-radius:15px;box-shadow: 1px 2px 10px 5px white;color:blue;">
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
                 echo "<b>The Product is not available Now.";
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
                </div>
            </div>
        </div>
        <div class="row">
            <div class="product__wrap clearfix">
                <!-- Start Single Category -->
                <div class="container px-5 py-24 mx-auto">
                    <?php
                    $get_product=get_product($conn,'','','','','','YES'); 
                    if(count($get_product)>0) { ?>
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
                                <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">
                                    <?php echo $list['name'] ?></h3>
                                <p class="mt-1"><?php echo $list['price'] ?></p>
                            </div>
                            <!-- <div class="contact-btn">
                    <button type="submit" id="submit1" name="cart" class="fv-btn">Add to Cart</button>
                </div>-->
                        </div>
                        <?php } ?>
                    </div>
                    <?php }else{
                 echo "<b>The Product is not available Now.";
            }?>
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