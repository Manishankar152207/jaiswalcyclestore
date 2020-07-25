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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <title>Jaiswal Cycle Store</title>
</head>
<body>
    <section>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Jaiswal Cycle Store</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li> 
      <?php
        foreach($cat_arr as $list){ ?>
        <li class="nav-item"><a class="nav-link" href="categorie.php?id=<?php echo $list['id']; ?>"><?php echo $list['categories']?></a></li>
      <?php  }                                           
      ?>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
      
  </div>
</nav>
    </section>
    
</body>
</html>