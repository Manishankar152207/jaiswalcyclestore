<?php
require('connection.inc.php');
require('functions.inc.php');
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
        $res=mysqli_query($conn,"select * from admin_users where email='$username' and pass='$password'");
        $rec=mysqli_query($conn,"select * from test where email='$username' and pass='$password'");
        $row=mysqli_fetch_assoc($res);
        $data=mysqli_fetch_assoc($rec);
        if(mysqli_num_rows($res)){
            $_SESSION['Admin_Login']='yes';
            $_SESSION['Admin_Id']=$row['id'];
            $_SESSION['Admin_username']=$username;
            $_SESSION['Admin_password']=$password;
            mysqli_query($conn,"delete from login_log where ip_address='$ip_address'");
            header('location:../../Admin/dashboard.php');
            die();
        }elseif(mysqli_num_rows($rec)){
            $_SESSION['User_Login']='yes';
            $_SESSION['User_Id']=$data['id'];
            $_SESSION['User_username']=$username;
            $_SESSION['User_password']=$password;
            mysqli_query($conn,"delete from login_log where ip_address='$ip_address'");
            header('location:index.php');
            die();
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
    $email=get_safe_value($conn,$_POST['email']);
    $phone=get_safe_value($conn,$_POST['phone']);
    $password=get_safe_value($conn,$_POST['Password']);
    $date=date('Y-m-d h:i:s');
    $check=mysqli_num_rows(mysqli_query($conn,"select * from test where email='$email'"));
    if($check>0){
        $msge="E-mail already exit: Try another One";
    }else{
        mysqli_query($conn,"insert into test(name,email,pass,Phone,date_time) values('$name','$email','$password','$phone','$date')");
        $msge="Registration Successful: Now you can Login.";
    }
    
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Jaiswal Cycle Store</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <link rel="stylesheet" href="mystyle.css">
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
                            <div class="col-md-3 col-lg-2 col-sm-4 col-xs-4">
                                <div class="header__right">
                                    <div class="header__account">
                                        <a href="login.php"><i class="icon-user icons"></i></a>
                                    </div>
                                    <div class="htc__shopping__cart">
                                        <a class="cart__menu" href="cart.php"><i class="icon-handbag icons"></i></a>
                                        <a href="#"><span class="htc__qua">2</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
        </header>
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
                </style>

					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Register</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="contact-form" action="" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="name" placeholder="Your Name*" style="width:100%" required>
										</div>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="email" placeholder="Your Email*" style="width:100%" required>
										</div>
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
										<button type="submit" name="Register" class="fv-btn">Register</button><div class="error_field"><?php echo $msge ?></div>
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
        <!-- End Contact Area -->
        <?php
        require('footer.php');
        ?>