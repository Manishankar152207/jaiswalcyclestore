<?php
require('top.php');
$msg='';
$msge='';
$cat_res=mysqli_query($conn,"select * from categories where status=1");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res)){
    $cat_arr[]=$row;
}
if(isset($_POST['submit'])){
    $time=time()-30;
    $ip_address=getIpAddr();
    $Check_login_row=mysqli_fetch_assoc(mysqli_query($conn,"select count(*) as total_count from login_log where ip_address='$ip_address' and 
    try_time>$time "));
    if($Check_login_row['total_count']==3){
        $msg='To many failed login attempts.<br>Please Login after 30sec.';
    }else{
        $username=get_safe_value($conn,$_POST['Username']);
        $password=get_safe_value($conn,$_POST['Password']);
        $res=mysqli_query($conn,"select * from admin_users where name='$username' and pass='$password'");
        $rec=mysqli_query($conn,"select * from test where email='$username' and pass='$password'");
        $row=mysqli_fetch_assoc($res);
        $data=mysqli_fetch_assoc($rec);
        if(mysqli_num_rows($res)){
            $_SESSION['Admin_Login']='yes';
            $_SESSION['Admin_Status']=$row['status'];
            $_SESSION['Admin_Id']=$row['id'];
            $_SESSION['Admin_Role']=$row['role'];
            $_SESSION['Admin_username']=$username;
            $_SESSION['Admin_password']=$password;
            mysqli_query($conn,"delete from login_log where ip_address='$ip_address'");?>
            <script>
                window.location.href='../../Admin/dashboard.php';
                die();
            </script><?php
        }elseif(mysqli_num_rows($rec)){
            $_SESSION['User_Login']='yes';
            $_SESSION['User_Id']=$data['id'];
            $_SESSION['User_username']=$username;
            $_SESSION['User_password']=$password;
            mysqli_query($conn,"delete from login_log where ip_address='$ip_address'");?>
            <script>
                window.location.href='myorder.php';
                die();
            </script><?php
        }else{
            $Check_login_row['total_count']++;
            $rem_attm=3-$Check_login_row['total_count'];
            if($rem_attm==0){
                $msg='To many failed login attempts.<br>Please Login after 30sec.';
            }else{
                $msg="Please enter valid Login Detail.<br>$rem_attm attempts remaining.";
            }
            $try_time=time();
            mysqli_query($conn,"insert into login_log(ip_address,try_time) values('$ip_address','$try_time')");
        }
    }
    
}
function getIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ipAddr=$_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipAddr=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ipAddr=$_SERVER['REMOTE_ADDR'];
    }
    return $ipAddr;
}
if(isset($_POST['Register'])){
    $name=get_safe_value($conn,$_POST['name']);
    $email=get_safe_value($conn,$_POST['email_content']);
    $phone=get_safe_value($conn,$_POST['phone']);
    $password=get_safe_value($conn,$_POST['Password']);
    $date=date('Y-m-d h:i:s');
        mysqli_query($conn,"insert into test(name,email,pass,Phone,date_time) values('$name','$email','$password','$phone','$date')");
        $msge="Registration Successful: Now you can Login.";
    
}
?>

        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Login</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="contact-form" action="" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="Username" placeholder="Your Email*" style="width:100%" required>
										</div>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="Password" placeholder="Your Password*" style="width:100%" required>
										</div>
									</div>
									
									<div class="contact-btn">
										<button type="submit" name="submit" class="fv-btn">Login</button>
                                        <a href="forgot_password.php" class="forgot_password">Forgot Password</a>
                                    </div>
                                    <div class="error_field"><?php echo $msg ?></div>
								</form>
								<div class="form-output">
									<p class="form-messege"></p>
								</div>
							</div>
                        </div> 
                    </div>
				<style>.error_field{
                            color:red;
                        }
                        .email_verify_otp{display:none;}
                        .height_60px{height:61px;}
                        #email_otp_result{
                            margin-top: 15px;
                            font-size: 20px;
                            font-weight: bold;
                        }
                        .forgot_password{
                            margin-left: 10px;
                            font-size: 20px;
                        }

                </style>

					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Register</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="" action="" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="name" placeholder="Your Name*" style="width:100%" required>
										</div>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="email" id="email" placeholder="Your Email*" style="width:45%" required>
                                            
                                            <button type="button" class="fv-btn email_sent_otp height_60px" onclick="email_sent_otp()">Send OTP</button>
											
											<input type="text" id="email_otp" placeholder="OTP" style="width:45%" class="email_verify_otp">
											
											
											<button type="button" class="fv-btn email_verify_otp height_60px" onclick="email_verify_otp()">Verify OTP</button>
											<input type="hidden" id="email_content" name="email_content">
											
											
                                            
                                        </div>
                                        <span id="email_otp_result" class="error_field"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="phone" placeholder="Your Mobile*" style="width:100%" required>
										</div>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="Password" placeholder="Your Password*" style="width:100%" required>
										</div>
									</div>
									
									<div class="contact-btn">
										<button type="submit" name="Register" id="btn_register" class="fv-btn" disabled>Register</button><div class="error_field"><?php echo $msge ?></div>
                                    </div>
                                    
								</form>
								<div class="form-output">
									<p class="form-messege"></p>
								</div>
							</div>
						</div> 
                
				</div>
					
            </div>
        </section>
        <input type="hidden" id="is_email_verified"/>
		<input type="hidden" id="is_mobile_verified"/>
		<script>
		
		function email_sent_otp(){
			jQuery('#email_otp_result').html('');
			var email=jQuery('#email').val();
            jQuery('#email').attr('disabled',true);
			if(email==''){
				jQuery('#email_otp_result').html('Please enter email id');
				jQuery('#email').attr('disabled',false);
			}else{
				jQuery('.email_sent_otp').html('Please wait..');
				jQuery('.email_sent_otp').attr('disabled',true);
				jQuery.ajax({
					url:'send_otp.php',
					type:'post',
					data:'email='+email+'&type=email',
					success:function(result){
						if(result=='done'){
							//jQuery('#email').attr('disabled',true);
							jQuery('.email_verify_otp').show();
							jQuery('.email_sent_otp').hide();
							jQuery('#email_content').val(email);
							
						}else if(result=='email_present'){
							jQuery('.email_sent_otp').html('Send OTP');
							jQuery('.email_sent_otp').attr('disabled',false);
							jQuery('#email_otp_result').html('Email id already exists');
						}else{
							jQuery('.email_sent_otp').html('Send OTP');
							jQuery('.email_sent_otp').attr('disabled',false);
							jQuery('#email_otp_result').html('Either Please try after sometime or check your email.');
							jQuery('#email').attr('disabled',false);
						}
					}
				});
			}
		}
		function email_verify_otp(){
			jQuery('#email_otp_result').html('');
			var email_otp=jQuery('#email_otp').val();
			if(email_otp==''){
				jQuery('#email_otp_result').html('Please enter OTP');
			}else{
				jQuery.ajax({
					url:'check_otp.php',
					type:'post',
					data:'otp='+email_otp+'&type=email',
					success:function(result){
						if(result=='done'){
							jQuery('.email_verify_otp').hide();
							jQuery('#email_otp_result').html('Email id verified');
							jQuery('#is_email_verified').val('1');
							if(jQuery('#is_email_verified').val()==1){
								jQuery('#btn_register').attr('disabled',false);
							}
						}else{
							jQuery('#email_otp_result').html('Please enter valid OTP');
						}
					}
					
				});
			}
		}
        
    </script>
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/main.js"></script>
<?php

require('footer.php');
?>