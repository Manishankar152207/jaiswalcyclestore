<?php
require('connection.inc.php');
require('functions.inc.php');
$row=mysqli_fetch_assoc(mysqli_query($conn,"select * from like_dislike where id=1"));
$like=$row['like_count'];
$dislike=$row['dislike_count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <link rel="stylesheet" href="mystyle.css">
    <title>Jaiswal Cycle Store</title>
</head>

<body>
    <header class="text-gray-700 body-font" style="background-color: gainsboro;position: sticky;top:4px;z-index: 100">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <nav class="flex lg:w-2/5 flex-wrap items-center text-base md:ml-auto">
                <a class="mr-5 hover:text-gray-900" href="index.php">Home</a>
                <a class="mr-5 hover:text-gray-900" href="#products">Services and Products</a>
                <a class="mr-5 hover:text-gray-900" href="aboutUs.php">About Us</a>
                <a class="mr-5 hover:text-gray-900" href="mailto:manishjaiswal152207@gmail.com">Mail Us</a>
                <a class="hover:text-gray-900" href="../frontEnd/categorie.php?id=1">Categories</a>
            </nav>
            <a
                class="flex order-first lg:order-none lg:w-1/5 title-font font-medium items-center text-gray-900 lg:items-center lg:justify-center mb-4 md:mb-0">

                <img src="Logo.png" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="5" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full">


                <span class="ml-3 text-xl">Jaiswal Cycle Store</span>

            </a>
            <div class="lg:w-2/5 inline-flex lg:justify-end ml-5 lg:ml-0">
            <?php if(isset($_SESSION['User_Login'])){
                 echo '<a href="../frontEnd/Logout.php"><b>Logout</a>';
        }else{
            echo '<a href="../frontEnd/login.php"><b>Login</a>';
        }
            ?>
            </div>
        </div>
    </header>
    <hr>
    <section class="text-gray-700 body-font" id="home" style="background-color: #dfe3c9;">
        <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
            <div class="image"></div>

            <div class="text-center lg:w-2/3 w-full">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Jaiswal Cycle Store</h1>
                <p><strong>Main-Road Kolhabi,Bara(Nepal)</strong></p>
                <p>Jaiswal Cycle Store is the place where Bicycle are repaired and customer can buy new Bicycle. </p>
                <p>All parts of Bicycle are Available with handsome price.</p>
                <p>Bike's Tyres and Tubes are also available.</p>
                <!-- <div class="flex justify-center">
                    <button
                        class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg" onclick="update_Count('like',1)">Like(<span id="like"><?php echo $like;?></span>)</button>
                    <button
                        class="ml-4 inline-flex text-gray-700 bg-gray-200 border-0 py-2 px-6 focus:outline-none hover:bg-gray-300 rounded text-lg" onclick="update_Count('dislike',0)">Dislike(<span id="dislike"><?php echo $dislike;?></span>)
                    </button>
                </div> -->
            </div>
        </div>
    </section>

    <!-- <script>
        function update_Count(value,id){
            jQuery.ajax({
                url:'Counter.php',
                type:'post',
                data:'id='+id,
                success:function(result){
                    var count=jQuery('#'+value).html();
                    count++;
                    jQuery('#'+value).html(count);
                }
            });
        }

    </script> -->
    <hr>