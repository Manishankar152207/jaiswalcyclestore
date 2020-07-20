<?php
function pr($arr){
    echo '<pre>';
    print_r($arr);
}

function prx($arr){
    echo '<pre>';
    print_r($arr);
}
function get_safe_value($conn,$str){
    if($str!=''){
        $str=trim($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
        return mysqli_real_escape_string($conn,$str);
    }
}

function get_product($conn,$limit='',$cat_id='',$pro_id='',$search_str='',$sort_order='',$is_best_seller=''){
    $sql="select product.*,categories.categories from product,categories where product.status=1 ";
   if($cat_id!=''){
    $sql.=" and product.categories_id=$cat_id ";
   }
   if($pro_id!=''){
    $sql.=" and product.id=$pro_id ";
   }
   if($is_best_seller!=''){
    $sql.=" and product.best_seller=1 ";
   }
   $sql.=" and product.categories_id=categories.id ";
   if($search_str!=''){
    $sql.=" and (product.name like '%$search_str%' or product.description like '%$search_str%') ";
   }
   
   if($sort_order!=''){
    $sql.=$sort_order;
   }else{
    $sql.=" order by product.id desc";
   }

   if($limit!=''){
    $sql.=" limit $limit";
   }
   //echo $sql;
   $res=mysqli_query($conn,$sql);
   $cat_arr=array();
   
   while($row=mysqli_fetch_assoc($res)){
       $cat_arr[]=$row;
   }
   return $cat_arr;
}

function getsoldproductbyproductid($conn,$pid){
    $sql="select sum(order_detail.qty) as qty from order_detail,product_order where order_detail.order_id=product_order.id and 
    order_detail.product_id=$pid and product_order.order_status!=4 and ((product_order.payment_type='payu' and product_order.payment_status='Success') or (product_order.payment_type='COD' and product_order.payment_status!=''))";
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['qty'];
}
function productqty($conn,$pid){
    $sql="select * from product where id=$pid";
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['qty'];
}
?>