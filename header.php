<?php
 session_start();
 require('config.php');
 require('functions.php');
 require('queries.php');
 include('cart.php');
 include('wishlist_process.php');
 if (isset($_SESSION['logged_in'])) {
   if ($_SESSION['logged_in'] == TRUE) {
 //valid user has logged-in to the website
 //Check for unauthorized use of user sessions
     $signaturerecreate = $_SESSION['signature'];
 
 //Extract original salt from authorized signature
     $saltrecreate = substr($signaturerecreate, 0, $length_salt);
 
 //Extract original hash from authorized signature
     $originalhash = substr($signaturerecreate, $length_salt, 40);
 
 //Re-create the hash based on the user IP and user agent
 //then check if it is authorized or not
     $hashrecreate = sha1($saltrecreate . $iptocheck . $useragent);
     if (!($hashrecreate == $originalhash)) {
 
 //Signature submitted by the user does not matched with the
 //authorized signature
 //This is unauthorized access
 //Block it
         header("Location: $home_url");
         exit;
     }
     $logged_in_user = $_SESSION['user'];
     $logged_in_email = $_SESSION['email'];
        $result1 = mysqli_query($connection,"SELECT `active` FROM `users` WHERE `email`='$logged_in_email'");
         $row = mysqli_fetch_array($result1);
         $active = $row['active'];

        $customer = mysqli_query($connection,"SELECT customers.id as id FROM `customers` inner join users on customers.User_id = users.id WHERE users.email='$logged_in_email'");
        $customer_row = mysqli_fetch_array($customer);
        $customer_id = $customer_row['id'];  
        //transfer cart cookie to database 
        if(isset($_COOKIE['shopping_cart']))
        {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $cart_data = json_decode($cookie_data, true);
            foreach($cart_data as $keys => $values)
            {  
                $product_id = $values["item_id"];
                $cart_duplicate = mysqli_query($connection,"SELECT * FROM `cart` WHERE customer_id ='$customer_id' AND product_id = '$product_id'");
                $cart_duplicate_result = mysqli_fetch_array($cart_duplicate);
                if ( $cart_duplicate_result == FALSE) {
                    $quantity = $values["item_quantity"];
                    mysqli_query($connection,"INSERT INTO `cart` (`customer_id`,`product_id`,`quantity`) VALUES ('$customer_id','$product_id','$quantity')");
                }     
            }
            setcookie('shopping_cart', '', $cart_expiry);
        }
        //transfer wishlist cookie to database
        if(isset($_COOKIE["shopping_wishlist"]))
        {
            $wishlist_data = stripslashes($_COOKIE['shopping_wishlist']);
            $wishlist_data = json_decode($wishlist_data, true);
            foreach($wishlist_data as $keys => $values)
            {
                $product_id = $values["item_id"];
                $wishlist_duplicate = mysqli_query($connection,"SELECT * FROM `wishlist` WHERE customer_id ='$customer_id' AND product_id = '$product_id'");
                $wishlist_duplicate_result = mysqli_fetch_array($wishlist_duplicate);
                if ( $wishlist_duplicate_result == FALSE) {
                    mysqli_query($connection,"INSERT INTO `wishlist` (`customer_id`,`product_id`) VALUES ('$customer_id','$product_id')");
                }
            }
            setcookie('shopping_wishlist', '', $cart_expiry);
        }

 //Session Lifetime control for inactivity
     if ((isset($_SESSION['LAST_ACTIVITY'])) && (time() - $_SESSION['LAST_ACTIVITY'] > $sessiontimeout) || (isset($_SESSION['LAST_ACTIVITY'])) && ($active == 2)) {
 //redirect the user back to login page for re-authentication
          header('Location: '.$logout_url.'?page_url='.$redirect_link );
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
    <title><?php echo $organization ?> - Fresh at your doorstep!</title>
    <link rel="shortcut icon" type="image/png" sizes="196x196" href="assets/images/sympha_fresh_white.png" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">
    <link rel="stylesheet" href="assets/css/custom-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo $public_key; ?>"></script>
</head>
<style type="text/css">
      .error-page {
  padding-top: calc(60px + 5.20vw);
  padding-bottom: calc(60px + 5.20vw);
}
.error-page h1 {
  font-size: calc(100px + 5.20vw);
  color: #59b828;
  line-height: calc(90px + 5.20vw);
}
.error-page h3 {
  font-size: calc(22px + 0.52vw);
  color: #222533;
}
.error-page p {
  font-size: calc(15px + 0.20vw);
  color: #222533;
  margin-bottom: 30px;
}
.error-page .backhome {
  font-size: 14px;
  width: 180px;
  height: 48px;
  line-height: 48px;
  font-size: 16px;
  font-weight: 600;
  background-color: #59b828;
  color: white;
  display: inline-block;
  border-radius: 4px;
  text-align: center;
  transition: all 0.3s ease;
}
@media only screen and (min-width: 1200px) {
  .error-page .backhome {
    font-size: 16px;
    width: 240px;
    height: 60px;
    line-height: 60px;
  }
}
.error-page .backhome:hover {
  background-color: #222533;
}
    </style>
<body id="top-page">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label"><?php echo $organization ?></p>
        </div>
    </div>
    <a class="position-absolute" href="javascript:void(0)" onclick="cartopen()">
    <!-- you can add class 'sitebar-drawar' in the div below-->
        <div id="sitebar-drawar" >
           <!-- <div class="cart-count d-flex align-items-center">
                <i class="fas fa-shopping-basket"></i>
                <span>3 Items</span>
            </div>
            <div class="total-price">Ksh 3415.00</div>-->
        </div> 
    </a> 
     <div class="modal fade" id="useradmin1" tabindex="-1" aria-labelledby="useradmin1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="header-top-action-dropdown">
                        <ul>
                        <?php
                             if (isset($_SESSION['logged_in'])) {
                                if ($_SESSION['logged_in'] == TRUE) {
                            ?> 
                             <li><a href="<?php echo $logout_url.'?page_url='.$redirect_link; ?>"><i class="fas fa-sign-out-alt mr-2"></i> Sign Out</a></li>
                             <li><a href="profile.php#dashboard-nav"><i class="fas fa-user mr-2"></i> Profile</a></li>
                            <?php
                                }
                                else{
                                ?>
                              <li class="signin-option"><a href="<?php echo  $login_url.'?page_url='.$redirect_link; ?>"><i class="fas fa-key mr-2"></i>Sign In</a></li>
                                <?php
                                }
                            }
                            else{
                                ?>
                                <li class="signin-option"><a href="<?php echo  $login_url.'?page_url='.$redirect_link; ?>"><i class="fas fa-key mr-2"></i>Sign In</a></li>
                                <?php
                            }
                            ?>
                            <li><a
                            <?php if (isset($_SESSION['logged_in'])) {
                                 if ($_SESSION['logged_in'] == TRUE) {
                                ?>    
                                href="wishlist.php#dashboard-nav"
                                <?php
                                    }
                                else{
                                ?>
                                href="auth/login.php?page_url=<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/wishlist.php#dashboard-nav' ?>"
                                <?php    
                                }   
                            } 
                            else{
                            ?>
                                href="auth/login.php?page_url=<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/wishlist.php#dashboard-nav' ?>"
                            <?php
                            }
                                ?>
                            ><i class="fas fa-heart mr-2"></i> Wishlist</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> 

     
     <div class="modal fade" id="siteinfo1" tabindex="-1" aria-labelledby="siteinfo1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="header-top-action-dropdown">
                        <ul>
                            <li class="site-phone"><a href="tel:<?php echo $contact_number; ?>"><i class="fas fa-phone"></i> <?php echo $contact_number; ?></a></li>
                            <li class="site-help"><a href="#"><i class="fas fa-question-circle"></i> Help & More</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
     <div class="modal fade" id="search-select-id" tabindex="-1" aria-labelledby="search-select-id" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="select-search-option">
                        <div class="flux-custom-select">
                            <select id="Cat_Select">
                              <option id="cat0" value="0">Select Category</option>
                              <?php
                                foreach($categoriesList as $row){
                                $id = $row['id'];
                                $category = $row['Category_Name'];
                            ?>
                              <option id="Cat<?php echo $id; ?>" value="<?php echo $id; ?>"><?php echo $category; ?></option>
                            <?php
                                }
                            ?>  
                            </select>
                        </div>

                        <form action="search" method="POST" class="search-form">
                            <input type="text" name="search" id="Product_Search" placeholder="Search for Products">
                            <button type="submit" class="submit-btn" name="searchSubmit"><i class="fas fa-search"></i></button>
                        </form>
                        <div class="col-12" style="position: relative;z-index: 4;">
                            <div class="list-group" id="Show_List" >
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div> 


     
     <div class="modal fade" id="menu-id" tabindex="-1" aria-labelledby="menu-id" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <ul class="menu d-xl-flex flex-wrap pl-0 list-unstyled">
                        <li class="nav-item"><a href="index.php"> Home</a></li>
                        <li class="item-has-children"><a data-toggle="collapse" href="#mainmenuid2" role="button" aria-expanded="false" aria-controls="mainmenuid2"><span>About Us</span> <i class="fas fa-angle-down"></i></a>
                         <ul class="submenu collapse" id="mainmenuid2">
                                    <li><a href="about.php#who_we_are">Who We Are</a></li>
                                    <li><a href="about.php#mission&vision">Mission & Vision</a></li>
                                    <li><a href="faq.php">FAQs</a></li>
                        </ul>            
                        <li class="nav-item"><a href="product-list.php">Our Products</a></li>
                        <li class="nav-item"><a href="blog.php">Blog</a></li>
                        <li class="nav-item"><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> 



    <?php
      //  if (isset($_SESSION['logged_in'])) {
       // if ($_SESSION['logged_in'] == TRUE) {
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
                   <?php
                        $cart_count=0;
                        if (isset($_SESSION['logged_in'])) {
                            if ($_SESSION['logged_in'] == TRUE) {
                              $cart_checker = mysqli_query($connection,"SELECT s.id AS id,s.Name as Name,cart.quantity as cartQty,image,i_u.Name as unit_name,s.Discount as Discount,sf.Selling_price as Price,c.Category_Name as Category_Name,s.Restock_Level as Restock_Level,s.Quantity as Quantity FROM `cart` inner join stock s on cart.product_id = s.id INNER JOIN stock_flow sf ON s.id = sf.Stock_id JOIN inventory_units i_u ON s.Unit_id = i_u.id JOIN category c ON s.Category_id=c.id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at WHERE cart.customer_id='$customer_id';");
                              $cart_count = mysqli_num_rows($cart_checker);
                            }
                            else{
                                if(isset($_COOKIE['shopping_cart'])){
                                    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                                    $cart_data = json_decode($cookie_data, true); 
                                    foreach($cart_data as $cart){
                                        $cart_count++;
                                    }
                                }
                            }
                        }else{
                            if(isset($_COOKIE['shopping_cart'])){
                                $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                                $cart_data = json_decode($cookie_data, true); 
                                foreach($cart_data as $cart){
                                    $cart_count++;
                                }
                            }
                        }
                        
                    ?>
                   <span><?php echo $cart_count; ?> Items</span>
                </div>
                <span onclick="cartclose()" class="close-icon"><i class="fas fa-times"></i></span>
        </div>
    <div class="cart-product-container">
        <?php
        $total = 0;
        if (isset($_SESSION['logged_in'])) {
            if ($_SESSION['logged_in'] == TRUE) {
              $cart_checker = mysqli_query($connection,"SELECT s.id AS id,s.Name as Name,cart.quantity as cartQty,image,i_u.Name as unit_name,s.Discount as Discount,sf.Selling_price as Price,c.Category_Name as Category_Name,s.Restock_Level as Restock_Level,s.Quantity as Quantity FROM `cart` inner join stock s on cart.product_id = s.id INNER JOIN stock_flow sf ON s.id = sf.Stock_id JOIN inventory_units i_u ON s.Unit_id = i_u.id JOIN category c ON s.Category_id=c.id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at WHERE cart.customer_id='$customer_id';");
              $cart_count = mysqli_num_rows($cart_checker);
              if($cart_count > 0){
              foreach($cart_checker as $row)
             {
                 ?>
                    <div class="cart-product-item">
                <div class="row align-items-center">
                    <div class="col-6 p-0">
                        <div class="thumb">
                            <a href="#"><img src="assets/images/products/<?php echo $row["image"]; ?>" alt="products"></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="product-content">
                            <a href="#" class="product-title"><?php echo $row["Name"]; ?></a>
                            <div class="product-cart-info">
                            <?php if($row['Discount'] > 0){ ?> <del>Ksh<?php echo number_format($row["Price"],2); ?> /unit</del> <br><?php }?>
                            Ksh<?php echo number_format($row["Price"] - $row["Discount"],2); ?> /unit
                            <br>
                            x<span id="cart_unit_qty<?php echo $row['id']; ?>"><?php echo $row["cartQty"]; ?></span> <?php echo $row["unit_name"]; ?>
                            </div>
                        </div>
                    </div>
                </div>
  
                <div class="row align-items-center mt-1">
                    <div class="col-6">
                        <div class="price-increase-decrese-group d-flex">
                        
                            <span class="decrease-btn">
                                <button type="button"
                                    class="btn quantity-left-minus cart_decrease" id="<?php echo $row['id']; ?>" data-type="minus" data-field="">-
                                </button> 
                            </span>
                            <input type="text" name="quantity" disabled class="form-controls input-number" id="cart_qty<?php echo $row["id"]; ?>" value="<?php echo $row["cartQty"]; ?>">
                            
                            <span class="increase">
                                <button type="button"
                                    class="btn quantity-right-plus cart_increase" id="<?php echo $row['id']; ?>" data-type="plus" data-field="" >+
                                </button>
                            </span>
                          
                        </div>
                    </div>
                    <div class="col-6">
                        <div >
                            <span class="ml-2">Ksh<span id="cart_subtotal<?php echo $row['id']; ?>"><?php echo number_format($row["cartQty"] * ($row["Price"] - $row["Discount"]),2); ?></span></span>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center mt-1">
                <div class="col-6">

                </div>
                  <div class="col-6">
                    <a href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/product-list.php?action=delete&id='.$row["id"] ?>" class="ml-5 text-danger"><i class="fas fa-times"></i> Remove</a>
                  </div>
                </div>
            </div>   
        <?php 
          $total = $total + ($row["cartQty"] * ($row["Price"] - $row["Discount"])); 
             }
            }
            else{
                echo'
            <h4 style="text-align:center;" class="mt-5">No Item in Cart</h4>
            ';
            }
            }
            else{
                if(isset($_COOKIE['shopping_cart']))
        {     
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $cart_data = json_decode($cookie_data, true);
            foreach($cart_data as $keys => $values)
            {
                
        ?>
            <div class="cart-product-item">
                <div class="row align-items-center">
                    <div class="col-6 p-0">
                        <div class="thumb">
                            <a href="#"><img src="assets/images/products/<?php echo $values["item_image"]; ?>" alt="products"></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="product-content">
                            <a href="#" class="product-title"><?php echo $values["item_name"]; ?></a>
                            <div class="product-cart-info">
                            <?php if($values['item_discount'] > 0){ ?> <del>Ksh<?php echo number_format($values["item_price"],2); ?> /unit</del> <br><?php }?>
                            Ksh<?php echo number_format($values["item_price"] - $values["item_discount"],2); ?> /unit
                            <br>
                            x<span id="cart_unit_qty<?php echo $values['item_id']; ?>"><?php echo $values["item_quantity"]; ?></span> <?php echo $values["item_unit"]; ?>
                            </div>
                        </div>
                    </div>
                </div>
  
                <div class="row align-items-center mt-1">
                    <div class="col-6">
                        <div class="price-increase-decrese-group d-flex">
                        
                            <span class="decrease-btn">
                                <button type="button"
                                    class="btn quantity-left-minus cart_decrease" id="<?php echo $values['item_id']; ?>" data-type="minus" data-field="">-
                                </button> 
                            </span>
                            <input type="text" name="quantity" disabled class="form-controls input-number" id="cart_qty<?php echo $values["item_id"]; ?>" value="<?php echo $values["item_quantity"]; ?>">
                            
                            <span class="increase">
                                <button type="button"
                                    class="btn quantity-right-plus cart_increase" id="<?php echo $values['item_id']; ?>" data-type="plus" data-field="" >+
                                </button>
                            </span>
                          
                        </div>
                    </div>
                    <div class="col-6">
                        <div >
                            <span class="ml-2">Ksh<span id="cart_subtotal<?php echo $values['item_id']; ?>"><?php echo number_format($values["item_quantity"] * ($values["item_price"] - $values["item_discount"]),2); ?></span></span>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center mt-1">
                <div class="col-6">

                </div>
                  <div class="col-6">
                    <a href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/product-list.php?action=delete&id='.$values["item_id"] ?>" class="ml-5 text-danger"><i class="fas fa-times"></i> Remove</a>
                  </div>
                </div>
            </div>   
        <?php 
          $total = $total + ($values["item_quantity"] * ($values["item_price"] - $values["item_discount"])); 
            }      
        }
        else{
            echo'
            <h4 style="text-align:center;" class="mt-5">No Item in Cart</h4>
            ';
        }
            }   
        }
        else{
            if(isset($_COOKIE['shopping_cart']))
            {     
                $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                $cart_data = json_decode($cookie_data, true);
                foreach($cart_data as $keys => $values)
                {
            ?>
                <div class="cart-product-item">
                    <div class="row align-items-center">
                        <div class="col-6 p-0">
                            <div class="thumb">
                                <a href="#"><img src="assets/images/products/<?php echo $values["item_image"]; ?>" alt="products"></a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="product-content">
                                <a href="#" class="product-title"><?php echo $values["item_name"]; ?></a>
                                <div class="product-cart-info">
                                <?php if($values['item_discount'] > 0){ ?> <del>Ksh<?php echo number_format($values["item_price"],2); ?> /unit</del> <br><?php }?>
                                Ksh<?php echo number_format($values["item_price"] - $values["item_discount"],2); ?> /unit
                                <br>
                                x<span id="cart_unit_qty<?php echo $values['item_id']; ?>"><?php echo $values["item_quantity"]; ?></span> <?php echo $values["item_unit"]; ?>
                                </div>
                            </div>
                        </div>
                    </div>
      
                    <div class="row align-items-center mt-1">
                        <div class="col-6">
                            <div class="price-increase-decrese-group d-flex">
                            
                                <span class="decrease-btn">
                                    <button type="button"
                                        class="btn quantity-left-minus cart_decrease" id="<?php echo $values['item_id']; ?>" data-type="minus" data-field="">-
                                    </button> 
                                </span>
                                <input type="text" name="quantity" disabled class="form-controls input-number" id="cart_qty<?php echo $values["item_id"]; ?>" value="<?php echo $values["item_quantity"]; ?>">
                                
                                <span class="increase">
                                    <button type="button"
                                        class="btn quantity-right-plus cart_increase" id="<?php echo $values['item_id']; ?>" data-type="plus" data-field="" >+
                                    </button>
                                </span>
                              
                            </div>
                        </div>
                        <div class="col-6">
                            <div >
                                <span class="ml-2">Ksh<span id="cart_subtotal<?php echo $values['item_id']; ?>"><?php echo number_format($values["item_quantity"] * ($values["item_price"] - $values["item_discount"]),2); ?></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mt-1">
                    <div class="col-6">
    
                    </div>
                      <div class="col-6">
                        <a href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/product-list.php?action=delete&id='.$values["item_id"] ?>" class="ml-5 text-danger"><i class="fas fa-times"></i> Remove</a>
                      </div>
                    </div>
                </div>   
            <?php 
              $total = $total + ($values["item_quantity"] * ($values["item_price"] - $values["item_discount"])); 
                }      
            }
            else{
                echo'
                <h4 style="text-align:center;" class="mt-5">No Item in Cart</h4>
                ';
            }
        }
        
        ?>
        <br><br><br>
        </div> 
        <div class="cart-footer">
           <!-- <div class="product-other-charge">
                <p class="d-flex justify-content-between">
                    <span>Delivery charge</span> 
                    <span>Ksh8.00</span> 
                </p>
                  <a href="#">Do you have a voucher?</a> 
            </div> -->
    
            <div class="cart-total">
              <!--  <p class="saving d-flex justify-content-between">
                    <span>Total Savings</span> 
                    <span>Ksh11.00</span>
                </p> -->
                <p class="total-price d-flex justify-content-between">
                    <span>Total</span> 
                    <input type="hidden" id="cart_total" value="<?php echo $total; ?>" >
                    <span>Ksh<span id="total_value"><?php echo number_format($total,2); ?><span></span>   
                </p>
                <a <?php if(($cart_count == 0)){
                ?> 
                href="#" 
                <?php 
                  } else{ 
                    if (isset($_SESSION['logged_in'])) {
                        if ($_SESSION['logged_in'] == TRUE) {
                ?> 
                     href="checkout.php" 
                <?php 
                        }
                        else{ ?>
                            href="auth/login.php?page_url=<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/checkout.php' ?>"
                        <?php }
                    }  
                    else{
                        ?>
                        href="auth/login.php?page_url=<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/checkout.php' ?>"
                    <?php
                    } 
                  } 
                ?> class="procced-checkout"  style=" background-color: #59b828;color: white;display: block;text-align: center;padding: 10px 30px;border-radius: 5px;margin-top: 10px;">Proceed to Checkout</a>
                <a <?php if($cart_count == 0){?> href="#" <?php } else{ ?>href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/product-list.php?action=clear' ?>" <?php } ?> class="clear-cart" style=" background-color: #df4759;color: white;display: block;text-align: center;padding: 10px 30px;border-radius: 5px;margin-top: 10px;">Clear Cart</a>
            </div>
        </div>
    </div>
    <!--end of side cart-->
    <?php
      //  }
    //}
    ?>

    <!-- header section start -->
    <header class="header">
        <div class="header-top">
            <div class="mobile-header d-flex justify-content-between align-items-center d-xl-none">
                 <div class="d-flex align-items-center">
                   <!-- <div class="all-category-option mobile-device">
                        <a class="bar-btn"><i class="fas fa-bars"></i>All Categories</a>
                        <a class="close-btn"><i class="fas fa-times"></i>All Categories</a>
                    </div>-->
                    <a href="index.php" class="logo"><img src="assets/images/logo-navbar.png" width="70px" alt="logo"></a>
                </div> 


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
                    <a href="index.php" class="logo"><img src="assets/images/logo-navbar.png" width="110px"  alt="logo"></a>
                </div>
                <div class="col-5 col-md-9 col-lg-5">
                   
                    <div class="select-search-option d-none d-md-flex">
                        <div class="flux-custom-select">
                            <select id="Cat_select">
                              <option id="cat0" value="0">Select Category</option>
                              <?php
                                foreach($categoriesList as $row){
                                $id = $row['id'];
                                $category = $row['Category_Name'];
                            ?>
                              <option id="cat<?php echo $id; ?>" value="<?php echo $id; ?>"><?php echo $category; ?></option>
                            <?php
                                }
                            ?>  
                            </select>
                        </div>
                        <form action="search" method="POST" class="search-form">
                            <input type="text" name="search" id="product_Search" placeholder="Search for Products">
                            <button type="submit" class="submit-btn" name="searchSubmit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="col-7 offset-4" style="position: absolute;z-index: 4;">
                        <div class="list-group" id="show_list" >
                        </div>
                    </div>
                </div>
                <div class="col-2 col-md-1 col-lg-5">
                    <ul class="site-action d-none d-lg-flex align-items-center justify-content-between  ml-auto">
                        <li class="site-phone"><a href="tel:<?php echo $contact_number; ?>"><i class="fas fa-phone"></i> <?php echo $contact_number; ?></a></li>
                        <li class="site-help"><a href="#"><i class="fas fa-question-circle"></i> Help & More</a></li>
                        <li class="wish-list"><a 
                        <?php
                        $wishlist_count=0;
                        if (isset($_SESSION['logged_in'])) {
                            if ($_SESSION['logged_in'] == TRUE) {
                              $wishlist_checker = mysqli_query($connection,"SELECT * FROM `wishlist` WHERE wishlist.customer_id='$customer_id';");
                              $wishlist_count = mysqli_num_rows($wishlist_checker);
                            }
                            else{
                                if(isset($_COOKIE['shopping_wishlist'])){
                                    $wishlist_data = stripslashes($_COOKIE['shopping_wishlist']);
                                    $wishlist_data = json_decode($wishlist_data, true); 
                                    foreach($wishlist_data as $cart){
                                        $wishlist_count++;
                                    }
                                }
                            }
                        }
                        else{
                            if(isset($_COOKIE['shopping_wishlist'])){
                                $wishlist_data = stripslashes($_COOKIE['shopping_wishlist']);
                                $wishlist_data = json_decode($wishlist_data, true); 
                                foreach($wishlist_data as $cart){
                                    $wishlist_count++;
                                }
                            }
                        }
                        
                        if (isset($_SESSION['logged_in'])) {
                            if ($_SESSION['logged_in'] == TRUE) {
                        ?>    
                        href="wishlist.php#dashboard-nav"
                        <?php
                            }
                        else{
                        ?>
                         href="auth/login.php?page_url=<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/wishlist.php#dashboard-nav' ?>"
                        <?php    
                        }   
                       } 
                       else{
                       ?>
                        href="auth/login.php?page_url=<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/wishlist.php#dashboard-nav' ?>"
                       <?php
                       }
                        ?>
                        ><i class="fas fa-heart"></i> <span class="count"><?php echo $wishlist_count; ?></span></a></li>
                        <?php
                        if (isset($_SESSION['logged_in'])) {
                          if ($_SESSION['logged_in'] == TRUE) {
                        ?>
                        <li class="my-account"><a class="dropdown-toggle" href="#" role="button" id="myaccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user mr-1"></i> Hello, <?php echo $logged_in_user; ?></a>
                            <ul class="submenu dropdown-menu" aria-labelledby="myaccount">
                                <li><a href="profile.php#dashboard-nav">Profile</a></li>
                                <li><a href="<?php echo $logout_url.'?page_url='.$redirect_link; ?>">Sign Out</a></li>
                            </ul>
                        </li>
                        <?php
                          }
                            else{
                            ?>
                              <li class="signin-option"><a href="<?php echo  $login_url.'?page_url='.$redirect_link; ?>"><i class="fas fa-user mr-2"></i>Sign In</a></li>    
                            <?php
                          }
                        }
                          else{
                        ?>
                        <li class="signin-option"><a href="<?php echo  $login_url.'?page_url='.$redirect_link; ?>"><i class="fas fa-user mr-2"></i>Sign In</a></li>
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
                    <div class="all-category-option">
                        <a class="bar-btn"><i class="fas fa-bars"></i>All Categories</a>
                        <a class="close-btn"><i class="fas fa-times"></i>All Categories</a>
                    </div>
                </div>
                -->
                <div class="col-md-12">
                    <div class="menu-area d-none d-xl-flex justify-content-between align-items-center">
                        <ul class="menu d-xl-flex flex-wrap list-unstyled">
                            <li class="nav-item"><a href="index.php"> Home</a></li>
                            <li class="item-has-children" ><a href="#">About Us<i class="fas fa-angle-down"></i></a>
                            <ul class="submenu">
                                    <li><a href="about.php#who_we_are">Who We Are</a></li>
                                    <li><a href="about.php#mission&vision">Mission & Vision</a></li>
                                    <li><a href="faq.php">FAQs</a></li>
                            </ul>  
                            </li>      
                            <li class="nav-item"><a href="product-list.php">Our Products</a></li>
                            <li class="nav-item"><a href="blog.php">Blog</a></li>
                            <li class="nav-item"><a href="contact.php">Contact Us</a></li>
                        </ul>
                        <ul class="menu-action d-none d-lg-block">
                             <input type="hidden" id="navbar_cart_hidden" value="<?php echo $total; ?>" >
                            <li class="cart-option"><a onclick="cartopen()" href="#"><span class="cart-icon"><i class="fas fa-shopping-cart"></i><span class="count" ><?php echo $cart_count; ?></span></span> <span class="cart-amount">Ksh <span id="navbar_cart_total"><?php echo number_format($total,2); ?></span></span></a>
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