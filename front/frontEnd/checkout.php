<?php
require('top.php');
if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
    ?><script>
        window.location.href='../shopfront/index.php';
    </script><?php
}

$cart_total=0;
foreach($_SESSION['cart'] as $key=>$val){
    $productArr=get_product($conn,'','',$key);
    $price=$productArr['0']['price'];
    $qty=$val['qty'];   
    $cart_total+=($price*$qty);     
}
if(isset($_POST['submit'])){
    $add=get_safe_value($conn,$_POST['add']);
    $city=get_safe_value($conn,$_POST['city']);
    $pin=get_safe_value($conn,$_POST['pincode']);
    $payment_type=get_safe_value($conn,$_POST['payment']);
    $user_id=$_SESSION['User_Id'];
    $payment_status='pending';
    $total_price= $cart_total;
    if($payment_type=='COD'){
        $payment_status='success';
    }
    $order_status='1';
    $add_on=date('Y-m-d h:i:s');

    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    if(isset($_SESSION['COUPON_ID'])){
		$coupon_id=$_SESSION['COUPON_ID'];
		$coupon_code=$_SESSION['COUPON_CODE'];
		$coupon_value=$_SESSION['COUPON_VALUE'];
		$total_price=$total_price-$coupon_value;
		unset($_SESSION['COUPON_ID']);
		unset($_SESSION['COUPON_CODE']);
		unset($_SESSION['COUPON_VALUE']);
	}else{
		$coupon_id='';
		$coupon_code='';
		$coupon_value='';	
	}	
    mysqli_query($conn,"insert into product_order(user_id,address,city,pincode,payment_type,total_price,payment_status,order_status,added_on,txnid,coupon_id,coupon_code,coupon_value)
     values('$user_id','$add','$city','$pin','$payment_type','$total_price','$payment_status','$order_status','$add_on','$txnid','$coupon_id','$coupon_code','$coupon_value')");

     $order_id=mysqli_insert_id($conn);
    foreach($_SESSION['cart'] as $key=>$val){
        $productArr=get_product($conn,'','',$key);
        $price=$productArr['0']['price'];
        $qty=$val['qty'];     
        mysqli_query($conn,"insert into order_detail(order_id,product_id,qty,price) values('$order_id','$key','$qty','$price')");
     
    }
    unset($_SESSION['cart']);
    if($payment_type=='payu'){
		$MERCHANT_KEY = "gtKFFx"; 
		$SALT = "eCwWELxi";
		$hash_string = '';
		//$PAYU_BASE_URL = "https://secure.payu.in";
		$PAYU_BASE_URL = "https://test.payu.in";
		$action = '';
		$posted = array();
		if(!empty($_POST)) {
		  foreach($_POST as $key => $value) {    
			$posted[$key] = $value; 
		  }
		}
		
		$userArr=mysqli_fetch_assoc(mysqli_query($conn,"select * from test where id='$user_id'"));
		
		$formError = 0;
		$posted['txnid']=$txnid;
		$posted['amount']=$total_price;
		$posted['firstname']=$userArr['name'];
		$posted['email']=$userArr['email'];
		$posted['phone']=$userArr['Phone'];
		$posted['productinfo']="productinfo";
		$posted['key']=$MERCHANT_KEY ;
		$hash = '';
		$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
		if(empty($posted['hash']) && sizeof($posted) > 0) {
		  if(
				  empty($posted['key'])
				  || empty($posted['txnid'])
				  || empty($posted['amount'])
				  || empty($posted['firstname'])
				  || empty($posted['email'])
				  || empty($posted['phone'])
				  || empty($posted['productinfo'])
				 
		  ) {
			$formError = 1;
		  } else {    
			$hashVarsSeq = explode('|', $hashSequence);
			foreach($hashVarsSeq as $hash_var) {
			  $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
			  $hash_string .= '|';
			}
			$hash_string .= $SALT;
			$hash = strtolower(hash('sha512', $hash_string));
			$action = $PAYU_BASE_URL . '/_payment';
		  }
		} elseif(!empty($posted['hash'])) {
		  $hash = $posted['hash'];
		  $action = $PAYU_BASE_URL . '/_payment';
		}


		$formHtml ='<form method="post" name="payuForm" id="payuForm" action="'.$action.'"><input type="hidden" name="key" value="'.$MERCHANT_KEY.'" /><input type="hidden" name="hash" value="'.$hash.'"/><input type="hidden" name="txnid" value="'.$posted['txnid'].'" /><input name="amount" type="hidden" value="'.$posted['amount'].'" /><input type="hidden" name="firstname" id="firstname" value="'.$posted['firstname'].'" /><input type="hidden" name="email" id="email" value="'.$posted['email'].'" /><input type="hidden" name="phone" value="'.$posted['phone'].'" /><textarea name="productinfo" style="display:none;">'.$posted['productinfo'].'</textarea><input type="hidden" name="surl" value="http://localhost:1080/jaiswal/front/frontEnd/payment_complete.php" /><input type="hidden" name="furl" value="http://localhost:1080/jaiswal/front/frontEnd/payment_fail.php"/><input type="submit" style="display:none;"/></form>';
		echo $formHtml;
		echo '<script>document.getElementById("payuForm").submit();</script>';
	}else{	
        sentInvoice($conn,$order_id);
		?>
		<script>
			window.location.href='Thank_you.php';
		</script>
		<?php
	}	   
}
?>
 <!-- cart-main-area start -->
 <div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                            <form action="" method='post'>
                                <div class="accordion">
                                    <div class="accordion__title">
                                        Address Information
                                    </div>
                                    <div class="accordion__body">
                                        <div class="bilinfo">
                                            
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name="add" placeholder="Street Address" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="city" placeholder="City/State" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="pincode" placeholder="Post code/ zip" required>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="accordion__title">
                                        payment information
                                    </div>
                                    <div class="accordion__body">
                                        <div class="paymentinfo">
                                            <div class="single-method">
                                                <i class="zmdi zmdi-long-arrow-right"></i> <input type="radio" name="payment" value="COD"> <b>Cash On Delivery 
                                            </div>
                                            <div class="single-method">
                                                <i class="zmdi zmdi-long-arrow-right"></i> <input type="radio" name="payment" value="payu"> <b>PayU
                                            </div>
                                        </div>
                                    </div>
                                    <div class="contact-btn">
										<button type="submit" name="submit" id="submit" class="fv-btn">Submit</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="order-details">
                            <h5 class="order-details__title">Your Order</h5>
                            <div class="order-details__item">
                            <?php
                            $cart_total=0;
                            foreach($_SESSION['cart'] as $key=>$val){
                                $productArr=get_product($conn,'','',$key);
                                $pname=$productArr['0']['name'];
                                $price=$productArr['0']['price'];
                                $image=$productArr['0']['image'];
                                $qty=$val['qty'];   
                                $cart_total+=($price*$qty);     
                            ?>
                                <div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image; ?>" alt="ordered item">
                                    </div>
                                    <div class="single-item__content">
                                        <a href="#"><?php echo $pname; ?></a>
                                        <span class="price"><?php echo $price; ?></span>
                                    </div>
                                    <div class="single-item__remove">
                                        <a href="javascript:void(0)" onclick="add_to_cart('<?php echo $key; ?>','remove')"><i class="zmdi zmdi-delete"></i></a>
                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                            <div class="ordre-details__total" id="coupon_box" style="display:none;">
                                <h5>Coupon Value</h5>
                                <span class="price" id="coupon_price"></span>
                            </div>
                            <div class="ordre-details__total" >
                                <h5>Order total</h5>
                                <span class="price" id="order_total_price"><?php echo $cart_total; ?></span>
                            </div>
                            <div class="ordre-details__total">
                                <div class="single-input">
                                    <input type="textbox" id="coupon" name="coupon" placeholder="Coupon here...">
                                </div><button type="submit" name="apply" id="apply" class="fv-btn" value="apply" onclick="set_coupon()">Apply</button>
                            </div>
                            <div id="coupon_result" style="padding: 33px;padding-top: 0px;font-size: 15px;font-weight: bold;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->
        <script>
            function add_to_cart(pid,type){
                            jQuery.ajax({
                                url:'manage_cart.php',
                                type:'post',
                                data:'pid='+pid+'&type='+type,
                                success:function(result){
                                    if(type=='update' || type=='remove'){
                                     window.location.href='checkout.php';
                                 }
                                jQuery('.htc__qua').html(result);
                                }
                            });
                        }
			function set_coupon(){
				var coupon_str=jQuery('#coupon').val();
				if(coupon_str!=''){
					jQuery('#coupon_result').html('');
					jQuery.ajax({
						url:'set_coupon.php',
						type:'post',
						data:'coupon_str='+coupon_str,
						success:function(result){
							var data=jQuery.parseJSON(result);
							if(data.is_error=='yes'){
								jQuery('#coupon_box').hide();
								jQuery('#coupon_result').html(data.dd);
								jQuery('#order_total_price').html(data.result);
							}
							if(data.is_error=='no'){
								jQuery('#coupon_box').show();
								jQuery('#coupon_price').html(data.dd);
								jQuery('#order_total_price').html(data.result);
							}
						}
					});
				}else{
                    jQuery('#coupon_result').html('Please Enter valid Coupon Code.')
                }
            }		
        </script>
<?php
if(isset($_SESSION['COUPON_ID'])){
	unset($_SESSION['COUPON_ID']);
	unset($_SESSION['COUPON_CODE']);
	unset($_SESSION['COUPON_VALUE']);
}
require('footer.php');
?>

