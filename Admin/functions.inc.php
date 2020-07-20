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
        return mysqli_real_escape_string($conn,$str);
    }
}
function getsoldproductbyproductid($conn,$pid){
    $sql="select sum(order_detail.qty) as qty from order_detail,product_order where order_detail.order_id=product_order.id and 
    order_detail.product_id=$pid and product_order.order_status!=4 and ((product_order.payment_type='payu' and product_order.payment_status='Success') or (product_order.payment_type='COD' and product_order.payment_status!=''))";
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['qty'];
}

?>