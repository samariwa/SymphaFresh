<?php
 session_start();
 require('../config.php');
 require('../functions.php');
 if (isset($_SESSION['logged_in'])) {
   if ($_SESSION['logged_in'] == TRUE) {
 //valid user has logged-in to the website
 //Check for unauthorized use of user sessions
    
     $iprecreate = $_SERVER['REMOTE_ADDR'];
     $useragentrecreate = $_SERVER["HTTP_USER_AGENT"];
     $signaturerecreate = $_SESSION['signature'];
 
 //Extract original salt from authorized signature
 
     $saltrecreate = substr($signaturerecreate, 0, $length_salt);
 
 //Extract original hash from authorized signature
 
     $originalhash = substr($signaturerecreate, $length_salt, 40);
 
 //Re-create the hash based on the user IP and user agent
 //then check if it is authorized or not
 
     $hashrecreate = sha1($saltrecreate . $iprecreate . $useragentrecreate);
     if (!($hashrecreate == $originalhash)) {
 
 //Signature submitted by the user does not matched with the
 //authorized signature
 //This is unauthorized access
 //Block it
         header("Location: ../$home_url");
         exit;
     }
     $logged_in_user = $_SESSION['user'];
     $logged_in_email = $_SESSION['email'];
        $result1 = mysqli_query($connection,"SELECT `active` FROM `users` WHERE `email`='$logged_in_email'");
         $row = mysqli_fetch_array($result1);
         $active = $row['active'];
 //Session Lifetime control for inactivity
 
     if ((isset($_SESSION['LAST_ACTIVITY'])) && (time() - $_SESSION['LAST_ACTIVITY'] > $sessiontimeout) || (isset($_SESSION['LAST_ACTIVITY'])) && ($active == 2)) {
 //redirect the user back to login page for re-authentication
          header("Location: ../auth/$logout_url");
         exit;
     }
     $_SESSION['LAST_ACTIVITY'] = time();
 }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sympha Fresh - Fresh and on Time!</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/favicon.png" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/swiper.min.css">
    <link rel="stylesheet" type="../text/css" href="../assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/slick-theme.css">
    <link rel="stylesheet" href="../assets/css/custom-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body id="top-page">
<!--
    <a class="position-absolute" href="javascript:void(0)" onclick="cartopen()">
        <div id="sitebar-drawar" class="sitebar-drawar">
            <div class="cart-count d-flex align-items-center">
                <i class="fas fa-shopping-basket"></i>
                <span>3 Items</span>
            </div>
            <div class="total-price">Ksh 3415.00</div>
        </div>
    </a>
-->

     <!-- admin Modal 
     <div class="modal fade" id="useradmin1" tabindex="-1" aria-labelledby="useradmin1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="header-top-action-dropdown">
                        <ul>
                            <li class="signin-option"><a href="login.php"><i class="fas fa-user mr-2"></i>Sign In</a></li>
                            <li class="site-phone"><a href="tel:+254 713 932 911"><i class="fas fa-phone"></i> +254 713 932 911</a></li>
                            <li class="site-help"><a href="#"><i class="fas fa-question-circle"></i> Help & More</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

     <!--siteinfo Modal 
     <div class="modal fade" id="siteinfo1" tabindex="-1" aria-labelledby="siteinfo1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="header-top-action-dropdown">
                        <ul>
                            <li class="site-phone"><a href="tel:+254 713 932 911"><i class="fas fa-phone"></i> +254 713 932 911</a></li>
                            <li class="site-help"><a href="#"><i class="fas fa-question-circle"></i> Help & More</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
     <!--search Modal 
     <div class="modal fade" id="search-select-id" tabindex="-1" aria-labelledby="search-select-id" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="select-search-option">
                        <div class="flux-custom-select">
                            <select>
                              <option value="0">Select Catagory</option>
                              <option value="1">Vegetables</option>
                              <option value="2">Fruits</option>
                              <option value="3">Salads</option>
                              <option value="4">Fish & Seafood</option>
                              <option value="5">Fresh Meat</option>
                              <option value="6">Health Product</option>
                              <option value="7">Butter & Eggs</option>
                              <option value="8">Oils & Venegar</option>
                              <option value="9">Frozen Food</option>
                              <option value="10">Jam & Honey</option>
                            </select>
                        </div>
                        <form action="#" class="search-form">
                            <input type="text" name="search" placeholder="Search for Products">
                            <button class="submit-btn"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


     <!-- menu modal 
     <div class="modal fade" id="menu-id" tabindex="-1" aria-labelledby="menu-id" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <ul class="menu d-xl-flex flex-wrap pl-0 list-unstyled">
                        <li <a href="index.php">Home</a></li>
                        <li><a href="product-list.php">Our Products</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li class="item-has-children"><a data-toggle="collapse" href="#mainmenuid2" role="button" aria-expanded="false" aria-controls="mainmenuid2"><span>Pages</span> <i class="fas fa-angle-down"></i></a>
                            <ul class="submenu collapse" id="mainmenuid2">
                                <li><a href="product-leftsidebar.php">Product leftsidebar</a></li>
                                <li><a href="product-fullwidth.php">Product Fullwidth</a></li>
                                <li><a href="brand-product.php">Brand Page</a></li>
                                <li><a href="product-detail.php">Product Details</a></li>
                                <li><a href="faq.php">FAQ</a></li>
                                <li><a href="checkout.php">Checkout</a></li>
                                <li><a href="user-dashboard.php">User Dashboard</a></li>
                                <li><a href="profile.php">Profile</a></li>
                                <li><a href="track-order.php">Track Order</a></li>
                            </ul>
                        </li>
                        <li class="item-has-children"><a data-toggle="collapse" href="#mainmenuid3" role="button" aria-expanded="false" aria-controls="mainmenuid3"><span>Blog</span> <i class="fas fa-angle-down"></i></a>
                            <ul class="submenu collapse" id="mainmenuid3">
                                <li><a href="blog.php">Blog full width</a></li>
                                <li><a href="blog-rightsidebar.php">Blog Rightsidebar</a></li>
                                <li><a href="single.php">Blog Single</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->



    <?php
        if (isset($_SESSION['logged_in'])) {
        if ($_SESSION['logged_in'] == TRUE) {
    ?>
    <!-- sidebar-cart -->
    <div id="sitebar-cart" class="sitebar-cart">
        <div class="sc-head d-flex justify-content-between align-items-center">
            <div class="cart-count"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                width="20px" height="20px" viewBox="0 0 472.337 472.336" style="enable-background:new 0 0 472.337 472.336;"
                xml:space="preserve"><path d="M406.113,126.627c0-5.554-4.499-10.05-10.053-10.05h-76.377V91.715C319.684,41.143,278.543,0,227.969,0
                   c-50.573,0-91.713,41.143-91.713,91.715v24.862H70.45c-5.549,0-10.05,4.497-10.05,10.05L3.914,462.284
                   c0,5.554,4.497,10.053,10.055,10.053h444.397c5.554,0,10.057-4.499,10.057-10.053L406.113,126.627z M156.352,91.715
                   c0-39.49,32.13-71.614,71.612-71.614c39.49,0,71.618,32.13,71.618,71.614v24.862h-143.23V91.715z M146.402,214.625
                   c-9.92,0-17.959-8.044-17.959-17.961c0-7.269,4.34-13.5,10.552-16.325v17.994h14.337v-18.237
                   c6.476,2.709,11.031,9.104,11.031,16.568C164.363,206.586,156.319,214.625,146.402,214.625z M310.484,214.625
                   c-9.922,0-17.959-8.044-17.959-17.961c0-7.269,4.341-13.495,10.548-16.325v17.994h14.338v-18.241
                   c6.478,2.714,11.037,9.108,11.037,16.568C328.448,206.586,320.407,214.625,310.484,214.625z"/></svg>
                   <span>3 Items</span>
                </div>
                <span onclick="cartclose()" class="close-icon"><i class="fas fa-times"></i></span>
        </div>
        <div class="cart-product-container">
            <div class="cart-product-item">
                <div class="close-item"><i class="fas fa-times"></i></div>
                <div class="row align-items-center">
                    <div class="col-6 p-0">
                        <div class="thumb">
                            <a href="#"><img src="../assets/images/products/cart/01.png" alt="products"></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="product-content">
                            <a href="#" class="product-title">Daisy Cont Oil</a>
                            <div class="product-cart-info">
                                1x 31b
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-6">
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
                    <div class="col-6">
                        <div class="product-price">
                            <del>Ksh8.00</del><span class="ml-2">Ksh5.00</span>
                        </div>
                    </div>
                </div>
            </div>

            

            <div class="cart-product-item">
                <div class="close-item"><i class="fas fa-times"></i></div>
                <div class="row align-items-center">
                    <div class="col-6 p-0">
                        <div class="thumb">
                            <a href="#"><img src="../assets/images//products/cart/02.png" alt="products"></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="product-content">
                            <a href="#" class="product-title">Daisy Cont Oil</a>
                            <div class="product-cart-info">
                                1x 31b
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-6">
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
                    <div class="col-6">
                        <div class="product-price">
                            <del>Ksh8.00</del><span class="ml-2">Ksh5.00</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-product-item">
                <div class="close-item"><i class="fas fa-times"></i></div>
                <div class="row align-items-center">
                    <div class="col-6 p-0">
                        <div class="thumb">
                            <a href="#"><img src="../assets/images//products/cart/03.png" alt="products"></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="product-content">
                            <a href="#" class="product-title">Daisy Cont Oil</a>
                            <div class="product-cart-info">
                                1x 31b
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-6">
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
                    <div class="col-6">
                        <div class="product-price">
                            <del>Ksh350.00</del><span class="ml-2">Ksh300.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cart-footer">
            <div class="product-other-charge">
                <p class="d-flex justify-content-between">
                    <span>Delivery charge</span> 
                    <span>Ksh8.00</span>
                </p>
                <a href="#">Do you have a voucher?</a>
            </div>
    
            <div class="cart-total">
                <p class="saving d-flex justify-content-between">
                    <span>Total Savings</span> 
                    <span>Ksh11.00</span>
                </p>
                <p class="total-price d-flex justify-content-between">
                    <span>Total</span> 
                    <span>Ksh35.00</span>
                </p>
                <a href="checkout.php" class="procced-checkout">Proceed to Checkout</a>
            </div>
        </div>
    </div>
    <!--end of side cart-->
    <?php
        }
    }
    ?>

    <!-- header section start -->
    <header class="header">
        <div class="header-top">
            <div class="mobile-header d-flex justify-content-between align-items-center d-xl-none">
                <!-- <div class="d-flex align-items-center">
                    <div class="all-catagory-option mobile-device">
                        <a class="bar-btn"><i class="fas fa-bars"></i>All Catagories</a>
                        <a class="close-btn"><i class="fas fa-times"></i>All Catagories</a>
                    </div>
                    <a href="index.php" class="logo"><img src="../assets/images/logo.png" alt="logo"></a>
                </div> 

                <div class="all-catagory-option mobile-device">
                    <a class="bar-btn"><i class="fas fa-bars"></i><span class="ml-2 d-none d-md-inline">All Catagories</span></a>
                    <a class="close-btn"><i class="fas fa-times"></i><span class="ml-2 d-none d-md-inline">All Catagories</span></a>
                </div> -->
                <a href="index.php" class="logo"><img src="../assets/images/logo.png" alt="logo"></a>

                <!-- search select -->
                <div class="text-center mobile-search">
                    <button type="button" data-toggle="modal" data-target="#search-select-id"><i class="fas fa-search"></i></button>
                </div>

                <!-- menubar -->
                <div>
                    <button class="menu-bar" type="button" data-toggle="modal" data-target="#menu-id">
                        Home<i class="fas fa-caret-down"></i>
                    </button>
                </div>

            </div>
            <div class="d-none d-xl-flex row align-items-center">
                <div class="col-5 col-md-2">
                    <a href="index.php" class="logo"><img src="../assets/images/logo.png" alt="logo"></a>
                </div>
                <div class="col-5 col-md-9 col-lg-5">
                   
                    <div class="select-search-option d-none d-md-flex">
                        <div class="flux-custom-select">
                            <select>
                              <option value="0">Select Catagory</option>
                              <option value="1">Chicken Products</option>
                              <option value="2">Fish</option>
                              <option value="3">Vegetables</option>
                              <option value="4">Meat</option>
                            </select>
                        </div>
                        <form action="#" class="search-form">
                            <input type="text" name="search" placeholder="Search for Products">
                            <button class="submit-btn"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-2 col-md-1 col-lg-5">
                    <ul class="site-action d-none d-lg-flex align-items-center justify-content-between  ml-auto">
                        <li class="site-phone"><a href="tel:+254 713 932 911"><i class="fas fa-phone"></i> +254 713 932 911</a></li>
                        <li class="site-help"><a href="#"><i class="fas fa-question-circle"></i> Help & More</a></li>
                        <li class="wish-list"><a href="wishlist.php"><i class="fas fa-heart"></i> <span class="count">04</span></a></li>
                        <?php
                        if (isset($_SESSION['logged_in'])) {
                          if ($_SESSION['logged_in'] == TRUE) {
                        ?>
                        <li class="my-account"><a class="dropdown-toggle" href="#" role="button" id="myaccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user mr-1"></i> Hello, <?php echo $logged_in_user; ?></a>
                            <ul class="submenu dropdown-menu" aria-labelledby="myaccount">
                                <li><a href="profile.php">Profile</a></li>
                                <li><a href="../auth/logout.php">Sign Out</a></li>
                            </ul>
                        </li>
                        <?php
                          }
                        }
                          else{
                        ?>
                        <li class="signin-option"><a href="../auth/login.php"><i class="fas fa-user mr-2"></i>Sign In</a></li>
                        <?php
                          }
                        ?>
                    </ul>
                </div>

            </div>
        </div>
        <hr>
        <div class="header-bottom">
            <div class="row m-0 align-items-center">
            <!--
                <div class="col-md-2 p-0 d-none d-xl-block">
                    <div class="all-catagory-option">
                        <a class="bar-btn"><i class="fas fa-bars"></i>All Categories</a>
                        <a class="close-btn"><i class="fas fa-times"></i>All Categories</a>
                    </div>
                </div>
                -->
                <div class="col-md-12">
                    <div class="menu-area d-none d-xl-flex justify-content-between align-items-center">
                        <ul class="menu d-xl-flex flex-wrap list-unstyled">
                            <li class="nav-item"><a href="index.php"> Home</a></li>
                            <li class="item-has-children" ><a href="#">About Us <i class="fas fa-angle-down"></i></a>
                            <ul class="submenu">
                                    <li><a href="about.php">Who We Are</a></li>
                                    <li><a href="about.php">Mission & Vision</a></li>
                                    <li><a href="faq.php">FAQs</a></li>
                            </ul>  
                            </li>      
                            <li class="nav-item"><a href="product-list.php">Our Products</a></li>
                            <li class="nav-item"><a href="blog.php">Blog</a></li>
                            <li class="nav-item"><a href="contact.php">Contact Us</a></li>
                        </ul>
                        <ul class="menu-action d-none d-lg-block">
                            <li class="cart-option"><a onclick="cartopen()" href="#"><span class="cart-icon"><i class="fas fa-shopping-cart"></i><span class="count">3</span></span> <span class="cart-amount">Ksh 3415.00</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header section end -->


    <div class="page-layout">
    <!--
        <div class="catagory-sidebar-area">
            <div class="catagory-sidebar-area-inner">
                <div class="catagory-sidebar all-catagory-option">
                    <ul class="catagory-submenu">
                        <li><a data-toggle="collapse" href="#catagory-widget1" role="button" aria-expanded="false" aria-controls="catagory-widget1">Vegetables<i class="fas fa-angle-down"></i></a>
                            <ul class="catagory-submenu collapse show" id="catagory-widget1">
                                <li><a href="product-list.php">Artichoke.</a></li>
                                <li><a href="product-list.php">Aubergine (eggplant).</a></li>
                                <li><a href="product-list.php">Asparagus.</a></li>
                                <li><a href="product-list.php">Broccoflower (a hybrid).</a></li>
                                <li><a href="product-list.php">Broccoli (calabrese).</a></li>
                            </ul>
                        </li>
                        <li><a  data-toggle="collapse" href="#catagory-widget2" role="button" aria-expanded="false" aria-controls="catagory-widget2">Fruits<i class="fas fa-angle-down"></i></a>
                            <ul class="catagory-submenu collapse" id="catagory-widget2">
                                <li><a href="product-list.php">Artichoke.</a></li>
                                <li><a href="product-list.php">Aubergine (eggplant).</a></li>
                                <li><a href="product-list.php">Asparagus.</a></li>
                                <li><a href="product-list.php">Broccoflower (a hybrid).</a></li>
                                <li><a href="product-list.php">Broccoli (calabrese).</a></li>
                            </ul>
                        </li>
                        <li><a  data-toggle="collapse" href="#catagory-widget3" role="button" aria-expanded="false" aria-controls="catagory-widget3">Salads<i class="fas fa-angle-down"></i></a>
                            <ul class="catagory-submenu collapse" id="catagory-widget3">
                                <li><a href="product-list.php">Artichoke.</a></li>
                                <li><a href="product-list.php">Aubergine (eggplant).</a></li>
                                <li><a href="product-list.php">Asparagus.</a></li>
                                <li><a href="product-list.php">Broccoflower (a hybrid).</a></li>
                                <li><a href="product-list.php">Broccoli (calabrese).</a></li>
                            </ul>
                        </li>
                        <li><a  data-toggle="collapse" href="#catagory-widget4" role="button" aria-expanded="false" aria-controls="catagory-widget4">Fish & seafood<i class="fas fa-angle-down"></i></a>
                            <ul class="catagory-submenu collapse" id="catagory-widget4">
                                <li><a href="product-list.php">Artichoke.</a></li>
                                <li><a href="product-list.php">Aubergine (eggplant).</a></li>
                                <li><a href="product-list.php">Asparagus.</a></li>
                                <li><a href="product-list.php">Broccoflower (a hybrid).</a></li>
                                <li><a href="product-list.php">Broccoli (calabrese).</a></li>
                            </ul>
                        </li>
                        <li><a  data-toggle="collapse" href="#catagory-widget5" role="button" aria-expanded="false" aria-controls="catagory-widget5">Fresh Meat<i class="fas fa-angle-down"></i></a>
                            <ul class="catagory-submenu collapse" id="catagory-widget5">
                                <li><a href="product-list.php">Artichoke.</a></li>
                                <li><a href="product-list.php">Aubergine (eggplant).</a></li>
                                <li><a href="product-list.php">Asparagus.</a></li>
                                <li><a href="product-list.php">Broccoflower (a hybrid).</a></li>
                                <li><a href="product-list.php">Broccoli (calabrese).</a></li>
                            </ul>
                        </li>
                        <li><a  data-toggle="collapse" href="#catagory-widget6" role="button" aria-expanded="false" aria-controls="catagory-widget6">Health Products<i class="fas fa-angle-down"></i></a>
                            <ul class="catagory-submenu collapse" id="catagory-widget6">
                                <li><a href="product-list.php">Artichoke.</a></li>
                                <li><a href="product-list.php">Aubergine (eggplant).</a></li>
                                <li><a href="product-list.php">Asparagus.</a></li>
                                <li><a href="product-list.php">Broccoflower (a hybrid).</a></li>
                                <li><a href="product-list.php">Broccoli (calabrese).</a></li>
                            </ul>
                        </li>
                        <li><a  data-toggle="collapse" href="#catagory-widget7" role="button" aria-expanded="false" aria-controls="catagory-widget7">Butter & Eggs<i class="fas fa-angle-down"></i></a>
                            <ul class="catagory-submenu collapse" id="catagory-widget7">
                                <li><a href="product-list.php">Artichoke.</a></li>
                                <li><a href="product-list.php">Aubergine (eggplant).</a></li>
                                <li><a href="product-list.php">Asparagus.</a></li>
                                <li><a href="product-list.php">Broccoflower (a hybrid).</a></li>
                                <li><a href="product-list.php">Broccoli (calabrese).</a></li>
                            </ul>
                        </li>
                        <li><a  data-toggle="collapse" href="#catagory-widget8" role="button" aria-expanded="false" aria-controls="catagory-widget8">Oils and Venegar<i class="fas fa-angle-down"></i></a>
                            <ul class="catagory-submenu collapse" id="catagory-widget8">
                                <li><a href="product-list.php">Artichoke.</a></li>
                                <li><a href="product-list.php">Aubergine (eggplant).</a></li>
                                <li><a href="product-list.php">Asparagus.</a></li>
                                <li><a href="product-list.php">Broccoflower (a hybrid).</a></li>
                                <li><a href="product-list.php">Broccoli (calabrese).</a></li>
                            </ul>
                        </li>
                        <li><a  data-toggle="collapse" href="#catagory-widget9" role="button" aria-expanded="false" aria-controls="catagory-widget9">Frozen Food<i class="fas fa-angle-down"></i></a>
                            <ul class="catagory-submenu collapse" id="catagory-widget9">
                                <li><a href="product-list.php">Artichoke.</a></li>
                                <li><a href="product-list.php">Aubergine (eggplant).</a></li>
                                <li><a href="product-list.php">Asparagus.</a></li>
                                <li><a href="product-list.php">Broccoflower (a hybrid).</a></li>
                                <li><a href="product-list.php">Broccoli (calabrese).</a></li>
                            </ul>
                        </li>
                        <li><a  data-toggle="collapse" href="#catagory-widget10" role="button" aria-expanded="false" aria-controls="catagory-widget10">Jam & Honey<i class="fas fa-angle-down"></i></a>
                            <ul class="catagory-submenu collapse" id="catagory-widget10">
                                <li><a href="product-list.php">Artichoke.</a></li>
                                <li><a href="product-list.php">Aubergine (eggplant).</a></li>
                                <li><a href="product-list.php">Asparagus.</a></li>
                                <li><a href="product-list.php">Broccoflower (a hybrid).</a></li>
                                <li><a href="product-list.php">Broccoli (calabrese).</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>   
        -->      
        <div class="main-content-area">