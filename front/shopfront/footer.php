<section id="contact">
        <h1 style="text-align: center;font-size:2.3rem;">Contact Us</h1>
        <h1 style="text-align: center;">We would love to hear from you!</h1>
        <div class="contact_box">
            <form method="POST" id="frmContact">
                <div class="form_item">
                    <label for="Name">Name:</label>
                    <input type="text" name="name" id="name" placeholder="Please Enter your name!" value="" required>
                    <span class="error" style="color: #FF0000;">*</span>
                </div>
                <div class="form_item">
                    <label for="E-mail">E-mail:</label>
                    <input type="email" name="email" id="email" placeholder="Please Enter your email!" value=""
                        required>
                    <span class="error" style="color: #FF0000;">*</span>
                </div>
                <div class="form_item">
                    <label for="Phone Number">Phone Number:</label>
                    <input type="phone" name="phone" id="phone" placeholder="Please Enter your Phone!" value=""
                        required>
                    <span class="error" style="color: #FF0000;">*</span>
                </div>
                <div class="form_item">
                    <label for="Message">Message:</label>
                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Please Enter your message!"
                        value=""></textarea>
                </div>
                <div class="form_Button">
                    <button  type="submit" class="btn" id="submit" >Submit</button>
                    <span style="color: red;" id="msg"></span>
                </div>
            </form>
        </div>
        <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">
            <a class="text-indigo-500"><b style="color: black;">indaljaiswal152207@gmail.com</b></a>
            <p class="leading-normal my-5">Call Us at:
                <br>+9779807253226
            </p>
        </div>
        </div>
        </div>
        </div>
    </section>

    <script>
        jQuery('#frmContact').on('submit',function(e){
            var cmt=jQuery('#message').val();
            if(cmt==""){
                alert('Please enter Message.');
            }else{
                jQuery('#msg').html('');
            jQuery('#submit').html('Please wait');
            jQuery('#submit').attr('disabled',true);
            jQuery.ajax({
                url:'formValidate.php',
                type:'post',
                data:jQuery('#frmContact').serialize(),
                success:function(result){
                    if(result){
                        jQuery('#msg').html('Thank you for your Feedback!');
                    }else{
                        jQuery('#msg').html('Please Enter correct details!');
                    }
                    jQuery('#submit').html('Submit');
                    jQuery('#submit').attr('disabled',false);
                    jQuery('#frmContact')[0].reset();
                }

            });
            e.preventDefault();
            }
            
        });

    </script>
    <hr>
    <footer class="text-gray-700 body-font">
        <div
            class="container px-5 py-24 mx-auto flex md:items-center lg:items-start md:flex-row md:flex-no-wrap flex-wrap flex-col">
            <div class="w-64 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left">
                <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
                    <img src="Logo.png" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-10 h-10 text-white p-2 bg-blue-500 rounded-full" viewBox="0 0 24 24">
                    <span class="ml-3 text-xl">Jaiswal Cycle Store</span>
                </a>
                <p class="mt-2 text-sm text-gray-500">Where you can repair your Cycle</p>
            </div>
            <div class="flex-grow flex flex-wrap md:pl-20 -mb-10 md:mt-0 mt-10 md:text-left text-center">
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3" style="font-weight:bold;">About us</h2>
                    <nav class="list-none mb-10">
                        <li>
                            <a class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Owner:Sasi Kala Kumari</a>
                        </li>
                        <li>
                            <a class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Propriter:Mohan Pd. Jaiswal</a>
                        </li>
                        <li>
                            <a class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Phone:+9779807253226</a>
                        </li>
                        <li>
                            <a class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Kolhabi,main Road</a>
                        </li>
                    </nav>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3" style="font-weight:bold;">Buy bicycle For</h2>
                    <nav class="list-none mb-10">
                        <li>
                            <a class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Gents</a>
                        </li>
                        <li>
                            <a class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Ladies</a>
                        </li>
                        <li>
                            <a class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Kids</a>
                        </li>
                        <li>
                            <a class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Small Baby</a>
                        </li>
                    </nav>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3" style="font-weight:bold;">Bicycle Parts</h2>
                    <nav class="list-none mb-10">
                        <li>
                            <a class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Second-Hand Bicycle</a>
                        </li>
                        <li>
                            <a class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Tyres</a>
                        </li>
                        <li>
                            <a class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Tubes</a>
                        </li>
                        <li>
                            <a class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Others Parts</a>
                        </li>
                    </nav>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3" style="font-weight:bold;">Bikes Parts</h2>
                    <nav class="list-none mb-10">
                        <li>
                            <a class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Tyres(All size)</a>
                        </li>
                        <li>
                            <a class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Tube(All size)</a>
                        </li>
                        <li>
                            <a class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Ball and Bearing</a>
                        </li>
                        <li>
                            <a class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Others Parts</a>
                        </li>
                    </nav>
                </div>
            </div>
        </div>
        <div class="bg-gray-200">
            <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
                <p class="text-gray-500 text-sm text-center sm:text-left"> Copyrights © www.jaiswalcycle.com. All rights
                    reserved!
                    <a href="https://twitter.com/knyttneve" rel="noopener noreferrer" class="text-gray-600 ml-1"
                        target="_blank"></a>
                </p>
                <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
                    <a class="text-gray-500">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                        </svg>
                    </a>
                </span>
            </div>
        </div>
    </footer>

</body>

</html>