<?php
require('top.php');
?>
 <section class="text-gray-700 body-font" id="products">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4">
                <?php
                    $get_product=get_product($conn,'latest','');
                    foreach($get_product as $list){ ?>
                <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                    <a class="block relative h-48 rounded overflow-hidden" href="../frontEnd/product_detail.php?id=<?php echo $list['id']; ?>">
                        <img alt="ecommerce" class="object-cover object-center w-full h-full block"
                            src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image'] ?>">
                    </a>
                    <div class="mt-4">
                        <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1"><?php echo $list['name'] ?></h3>
                        <p class="mt-1"><?php echo $list['price'] ?></p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <hr>
    <?php
    require('footer.php');
    ?>