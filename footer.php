<?php

?>
<!-- footer section -->
<footer class="footer">
                <div class="container">
                    <div class="footer-newsletter">
                            <div class="row align-items-center">
                                <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                                    <div class="newsletter-heading">
                                        <h5>Know it all first</h5>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center justify-content-md-end">
                                <?php
                                    if (isset($_SESSION['logged_in'])) {
                                    if ($_SESSION['logged_in'] == TRUE) {
                                ?>
                                   <input type="hidden" class="newsletter_token" id="token" name="token">
                                   <button class="btn btn-md active userSubscription" value="<?php echo $logged_in_email; ?>" style="background-color: #59b828; color: white;" role="button" aria-pressed="true" >SUBSCRIBE</button>
                                <?php
                                    }
                                    else{
                                ?>
                                    <div class="newsletter-form">
                                        <input type="email" name="email" id="anonymousEmail" placeholder="E-mail Address">
                                        <input type="hidden" class="newsletter_token" id="token" name="token">
                                        <button class="submit-btn anonymousSubscription">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><path style="fill:#2196F3;" d="M511.189,259.954c1.649-3.989,0.731-8.579-2.325-11.627l-192-192 c-4.237-4.093-10.99-3.975-15.083,0.262c-3.992,4.134-3.992,10.687,0,14.82l173.803,173.803H10.667 C4.776,245.213,0,249.989,0,255.88c0,5.891,4.776,10.667,10.667,10.667h464.917L301.803,440.328 c-4.237,4.093-4.355,10.845-0.262,15.083c4.093,4.237,10.845,4.354,15.083,0.262c0.089-0.086,0.176-0.173,0.262-0.262l192-192 C509.872,262.42,510.655,261.246,511.189,259.954z"/><path d="M309.333,458.546c-5.891,0.011-10.675-4.757-10.686-10.648c-0.005-2.84,1.123-5.565,3.134-7.571L486.251,255.88 L301.781,71.432c-4.093-4.237-3.975-10.99,0.262-15.083c4.134-3.992,10.687-3.992,14.82,0l192,192 c4.164,4.165,4.164,10.917,0,15.083l-192,192C314.865,457.426,312.157,458.546,309.333,458.546z"/><path d="M501.333,266.546H10.667C4.776,266.546,0,261.771,0,255.88c0-5.891,4.776-10.667,10.667-10.667h490.667 c5.891,0,10.667,4.776,10.667,10.667C512,261.771,507.224,266.546,501.333,266.546z"/></svg>
                                        </button>
                                    </div>  
                                    <?php
                                         }
                                    }
                                    else{
                                    ?>
                                        <div class="newsletter-form">
                                            <input type="email" name="email" id="anonymousEmail" placeholder="E-mail Address">
                                            <input type="hidden" class="newsletter_token" id="token" name="token">
                                            <button class="submit-btn anonymousSubscription">
                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><path style="fill:#2196F3;" d="M511.189,259.954c1.649-3.989,0.731-8.579-2.325-11.627l-192-192 c-4.237-4.093-10.99-3.975-15.083,0.262c-3.992,4.134-3.992,10.687,0,14.82l173.803,173.803H10.667 C4.776,245.213,0,249.989,0,255.88c0,5.891,4.776,10.667,10.667,10.667h464.917L301.803,440.328 c-4.237,4.093-4.355,10.845-0.262,15.083c4.093,4.237,10.845,4.354,15.083,0.262c0.089-0.086,0.176-0.173,0.262-0.262l192-192 C509.872,262.42,510.655,261.246,511.189,259.954z"/><path d="M309.333,458.546c-5.891,0.011-10.675-4.757-10.686-10.648c-0.005-2.84,1.123-5.565,3.134-7.571L486.251,255.88 L301.781,71.432c-4.093-4.237-3.975-10.99,0.262-15.083c4.134-3.992,10.687-3.992,14.82,0l192,192 c4.164,4.165,4.164,10.917,0,15.083l-192,192C314.865,457.426,312.157,458.546,309.333,458.546z"/><path d="M501.333,266.546H10.667C4.776,266.546,0,261.771,0,255.88c0-5.891,4.776-10.667,10.667-10.667h490.667 c5.891,0,10.667,4.776,10.667,10.667C512,261.771,507.224,266.546,501.333,266.546z"/></svg>
                                            </button>
                                         </div>      
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                    </div>

                    <div class="footer-top">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="footer-widget">
                                    <a href="index.php" class="footer-logo"><img src="assets/images/logo-footer.png" width="170px" alt="logo"></a>
                                    
                                    <ul class="social-media-list d-flex flex-wrap">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                    </ul>
                                    <img src="assets/images/halal.png" class="ml-4" width="120px" height="120px" alt="halal">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="footer-widget">
                                    <h5 class="footer-title">Get to know us</h5>
                                    <div class="widget-wrapper">
                                        <ul>
                                        <li><a href="about.php#who_we_are">Who We Are</a></li>
                                        <li><a href="about.php#mission&vision">Mission and Vision</a></li>
                                        <li><a href="faq.php">FAQs</a></li>
                                        <li><a href="privacy-policy.php">Privacy policy</a></li>
                                        <li><a href="cookie-policy.php">Cookies</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="footer-widget">
                                    <h5 class="footer-title">Useful Links</h5>
                                    <div class="widget-wrapper">
                                        <ul>
                                            <li><a href="product-list.php">Our Products</a></li>
                                            <li><a href="blog.php">Blog</a></li>
                                            <!--<li><a href="#">Careers</a></li>-->
                                            <li><a href="contact.php">Contact Us</a></li>
                                            <li><a href="site-map.php">Site Map</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="footer-widget">
                                    <h5 class="footer-title">Download Apps</h5>
                                    <div class="widget-wrapper">
                                        <div class="apps-store">
                                            <a href=""><img src="assets/images/app-store/apple.png" alt="app"></a>
                                            <a href=""><img src="assets/images/app-store/google.png" alt="app"></a>
                                        </div>
                                        <div class="payment-method d-flex flex-wrap">
                                            <a href="#"><img src="assets/images/payment/Mpesa-Logo.png" height="35px" width="55px" alt="payment"></a>
                                            <a href="#"><img src="assets/images/payment/visa.png" alt="payment"></a>
                                            <a href="#"><img src="assets/images/payment/Mastercard-Logo.png" height="30px" width="50px" alt="payment"></a>
                                            <a href="#"><img src="assets/images/payment/paypal.png" alt="payment"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-bottom">
                        <div class="row">
                            <div class="col-md-5 text-center text-md-left mb-3 mb-md-0">
                            <?php
                            $currentYear = date("Y");
                            ?>
                                <p class="copyright">Copyright &copy; <?php echo $currentYear; ?> <a href=""><?php echo $organization ?></a>&emsp;|&emsp;All Rights Reserved.</p>
                            </div>

                            <div class="col-md-7 d-flex justify-content-center justify-content-md-end">
                            <p>This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a href="https://policies.google.com/terms">Terms of Service</a> apply.</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </footer>
            <!-- footer section -->
        </div>
    </div>



    <!-- product-details-popup start -->
    <section id="product-details-popup" class="product-details-popup">
        <div class="modal-overlay" onclick="closeModal()"></div></div>
        <div class="container">
            <div class="product-zoom-info-container">
                <div id="closed-modal" class="closed-modal" onclick="closeModal()">X</div>
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="product-zoom-area">
                            <span class="batch">30%</span>
                            <div class="cart-btn-toggle d-lg-none">
                                <span class="cart-btn"><i class="fas fa-shopping-cart"></i> Cart</span>

                                <div class="price-btn">
                                    <div class="price-increase-decrese-group d-flex">
                                        <span class="decrease-btn">
                                            <button type="button"
                                                class="btn quantity-left-minus" data-type="minus" data-field="">-
                                            </button> 
                                        </span>
                                        <input type="text" name="quantity" class="form-controls input-number" value="1">
                                        <span class="increase">
                                            <button type="button"
                                                class="btn quantity-right-plus" data-type="plus" data-field="">+
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="product-slick" >
                            <!--<div id="modal-product-image"></div>-->
                                <div><img src="assets/images/product-detail/02.jpg" alt="image"
                                        class="img-fluid blur-up lazyload image_zoom_cls-1"></div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="slider-nav">
                                        <div><img src="assets/images/product-detail/01.jpg" alt=""
                                                class="img-fluid blur-up lazyload"></div>
                                        <div><img src="assets/images/product-detail/02.jpg" alt=""
                                                class="img-fluid blur-up lazyload"></div>
                                        <div><img src="assets/images/product-detail/03.jpg" alt=""
                                                class="img-fluid blur-up lazyload"></div>
                                        <div><img src="assets/images/product-detail/01.jpg" alt=""
                                                class="img-fluid blur-up lazyload"></div>
                                        <!-- <div><img src="assets/images/product-detail/02.jpg" alt=""
                                                class="img-fluid blur-up lazyload"></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details-content">
                            <a class="wish-link" href="#">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                            </a>
                            <a href="#" class="cata" id="modal-product-category"></a>
                            <h2 id="modal-product-name"></h2>
                            <p class="quantity" id="modal-product-unit"></p>
                            <h3 class="price" id="modal-product-price">Ksh329 <del>Ksh400</del></h3>
                            <div class="price-increase-decrese-group d-flex">
                                <span class="decrease-btn">
                                    <button type="button"
                                        class="btn quantity-left-minus" data-type="minus" data-field="">-
                                    </button> 
                                </span>
                                <input type="text" name="quantity" class="form-controls input-number" value="1">
                                <span class="increase">
                                    <button type="button"
                                        class="btn quantity-right-plus" data-type="plus" data-field="">+
                                    </button>
                                </span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penas et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
                            <div class="d-flex justify-content-end">
                                <a href="#" class="buy-now">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product-details-popup end -->



     <!--login-area 
    <section id="login-area" class="login-area">
        <div onclick="CloseSignUpForm()" class="overlay"></div>
        <div class="login-body-wrapper">
            <div class="login-body">
                <div class="close-icon" onclick="CloseSignUpForm()">
                    <i class="fas fa-times"></i>
                </div>
                <div class="login-header">
                    <h4>Sign In</h4>
                    <p>Login with your email & password</p>
                </div>
                <div class="login-content">
                    <form action="#" class="login-form">
                        <input type="text" name="name" placeholder="Name">
                        <input type="email" name="email" placeholder="Email">
                        <button type="submit" class="submit">Sign In</button>
                    </form>
                    <div class="text-center seperator">
                        <span>Or</span>
                    </div>
                    <div class="othersignup-option">
                        <a class="facebook" href="#"><i class="fab fa-facebook-square"></i>Continue with Facebook</a>
                        <a class="google" href="#"><i class="fab fa-google-plus"></i>Continue with Google</a>
                    </div>
                    <div class="text-center dont-account py-4">
                        <p class="mb-0">Don't have an account? <a href="#">Sign Up</a></p>
                    </div>
                </div>
            </div>
            <div class="forgot-password text-center">
                <p><a href="#">Forgot Password?</a></p>
            </div>
        </div>
    </section>
    login-area -->



    <!-- mobile-footer -->
    <div class="mobile-footer d-flex justify-content-between align-items-center d-xl-none">
        <button class="info" type="button" data-toggle="modal" data-target="#siteinfo1"><i class="fas fa-info-circle"></i></button>

        <div class="footer-cart">
            <a onclick="cartopen()" href="#" class="d-flex align-items-center"><span class="cart-icon"><i class="fas fa-shopping-cart"></i><span class="count"><?php echo $cart_count; ?></span></span> <span class="cart-amount ml-2">Ksh <span id="mobile_cart_total"><?php echo number_format($total,2); ?></span></span></a>
        </div>

        <div class="footer-admin-area">
            <!-- <span class="user-admin">
                <i class="fas fa-user"></i>
            </span> -->
            <button class="user-admin" type="button" data-toggle="modal" data-target="#useradmin1"><i class="fas fa-user"></i></button>
        </div>
    </div>
    <!-- mobile-footer -->



   <!--ad popup--> 
       <div id="popup" class="popup" style="display: none">
        <div class="popup-overlay"></div>
        <div class="popup-wrapper">
            <div class="popupbox">
               <div class="container cookieContainer">
                   <h4>Cookies</h4>
                   <hr>
                   <p>This site uses cookies to give you the best experience on our site and show you personalised ads.
                     By accepting you agree to our <a href="privacy-policy.php" style="color: #59b828;">privacy</a> and <a href="cookie-policy.php" style="color: #59b828;">cookie</a> policies.</p>
                     <hr>
                     <div class='row'>  
                    <button class="btn cookie-btn offset-1 rounded-pill">Accept</button>
                    <button class="btn btn-danger cookie-exit offset-2 rounded-pill">Decline</button> 
                    </div>
            </div>
                <!--<button class="popup-close"><img src="assets/images/popup-close.png" alt="popup-close"></button>-->
            </div>
        </div>
    </div>

    <a href="#top-page" class="to-top js-scroll-trigger"><span><i class="fas fa-arrow-up"></i></span></a>
    <script src='assets/js/jquery.min.js'></script>
    <script src='assets/js/bootstrap.bundle.min.js'></script>
    <script src='assets/js/swiper.min.js'></script>
    <script src="assets/js/slick.js"></script>
    <script src='assets/js/jquery-easeing.min.js'></script>
    <script src='assets/js/scroll-nav.js'></script>
    <script src="assets/js/jquery.elevatezoom.js"></script>
    <script src='assets/js/price-range.js?29345082'></script>
    <script src='assets/js/custom-select.js'></script>
    <script src='assets/js/fly-cart.js?359597'></script>
    <script src='assets/js/multi-countdown.js'></script>
    <script src='assets/js/theia-sticky-sidebar.js'></script>
    <script src='assets/js/functions.js?8934454'></script>
   <!--Start of Tawk.to Script-->
<script type="text/javascript">
$(function() {
    "use strict";
    $(function() {
        $(".preloader").fadeOut(); 
    });
});
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6044ce9b385de407571d74b6/1f0d3bvve';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();

grecaptcha.ready(function() {
    // do request for recaptcha token
    // response is promise with passed token
        grecaptcha.execute('<?php echo $public_key; ?>', {action:'validate_captcha'})
                  .then(function(token) {
            // add token value to form
            document.getElementById('token').value = token;
        });
    });

</script>
<!--End of Tawk.to Script-->
</body>
</html>