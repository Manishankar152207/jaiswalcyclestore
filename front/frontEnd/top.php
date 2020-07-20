<?php
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');
$cat_res=mysqli_query($conn,"select * from categories where status=1");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res)){
    $cat_arr[]=$row;
}
$obj=new add_to_cart();

$meta_title="Jaiswal Cycle Store";
$meta_desc="Jaiswal Cycle Store";
$meta_keyword="Jaiswal Cycle Store";
$script_name=$_SERVER['SCRIPT_NAME'];
$script_name_arr=explode('/',$script_name);
$mypage=$script_name_arr[count($script_name_arr)-1];
if($mypage=="product_detail.php"){
    $product_id=get_safe_value($conn,$_GET['id']);
    $product_meta=mysqli_fetch_assoc(mysqli_query($conn,"select * from product where id='$product_id'"));
    $meta_title=$product_meta['meta_title'];
    $meta_desc=$product_meta['meta_desc'];
    $meta_keyword=$product_meta['meta_keyword'];
}if($mypage=="cart.php"){
    $meta_title="My Cart";
    $meta_desc="My Cart";
    $meta_keyword="My Cart";
}

?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $meta_title;?></title>
    <meta name="description" content="<?php echo $meta_desc;?>">
    <meta name="keyword" content="<?php echo $meta_keyword;?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <link rel="stylesh eet" href="mystyle.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    
</head>
<body>
    <div class="wrapper">
        <header id="htc__header" class="htc__header__area header--one">
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header" style="background-color: gainsboro;position: sticky;top:4px;z-index: 100">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5"> 
                                <div class="logo">
                                     <a href="../shopfront/index.php"><h3><b>Jaiswal Cycle Store</b></h3></a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="../shopfront/index.php">Home</a></li>
                                        <?php
                                            foreach($cat_arr as $list){ ?>
                                                <li><a href="categorie.php?id=<?php echo $list['id']; ?>"><?php echo $list['categories']?></a></li>
                                          <?php  }                                           
                                        ?>
                                        <li><a href="../shopfront/index.php#contact">contact</a></li>
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="../shopfront/index.php">Home</a></li>
                                            <?php
                                            foreach($cat_arr as $list){ ?>
                                                <li><a href="categorie.php?id=<?php echo $list['id']; ?>"><?php echo $list['categories']?></a></li>
                                          <?php  }                                           
                                           ?>
                                            <li><a href="../shopfront/index.php#contact">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>  
                            </div>
                            <div class="col-md-7 col-lg-2 col-sm-4 col-xs-4">
                            </div>
                            
                            <div class="col-md-7 col-lg-2 col-sm-4 col-xs-4">
                                <div class="header__right">
                                    
                                    <div class="header__account">
                                    <?php if(isset($_SESSION['User_Login'])){
                                        echo '<a href="Logout.php">Logout</a>';
                                    }else{
                                        echo '<a href="login.php">Login/Register<i class="icon-user icons"></i></a>';
                                    }
                                    ?>
                                    </div>
                                    <div class="header__account">
                                        <?php if(isset($_SESSION['User_Login'])){
                                            echo '<a href="myorder.php">MyOrder</a>';}
                                            ?>
                                    </div>
                                    <div class="header__account" style="margin-right:15px;padding-top:17px;">
                                        <?php if(isset($_SESSION['User_Login'])){
                                            echo '<a href="profile.php"><img src="https://img.icons8.com/color/48/000000/test-account.png"/></a>';}
                                            ?>
                                    </div>
                                    <div class="htc__shopping__cart">
                                        <a class="cart__menu" href="cart.php"><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php"><span class="htc__qua"><?php echo $obj->totalProduct(); ?></span></a>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
        </header>
       
        
        