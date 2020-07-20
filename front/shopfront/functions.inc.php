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

function get_product($conn,$type='',$limit=''){
   $sql="select * from product where status=1";
   if($type=='latest'){
       $sql.=" order by id desc";
   }
   if($limit!=''){
    $sql.=" limit $limit";
   }
   $res=mysqli_query($conn,$sql);
   $cat_arr=array();
   while($row=mysqli_fetch_assoc($res)){
       $cat_arr[]=$row;
   }
   return $cat_arr;
}
?>