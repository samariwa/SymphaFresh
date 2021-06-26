<?php
  include('header.php');
?> 
            <!-- page-header-section start -->
            <div class="page-header-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between justify-content-md-end">
                            <ul class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li><span>/</span></li>
                                <li>Product List</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->
            <div id="actionAlert">
              <?php echo $message; ?>
            </div>
            <!-- page-content -->
            <section class="page-content section-ptb-90">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 sidebar order-lg-first">
                            <div class="widget widget-head">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Filter</h6>
                                    <a href="product-list.php" id="clear_filter">Clear All</a>
                                </div>
                            </div>
                            <div class="widget">
                                <h4 class="widget-title d-none d-lg-block">Filter by name</h4>
                                <a class="widget-title d-lg-none" data-toggle="collapse" href="#scatagory-widget01" role="button" aria-expanded="false" aria-controls="scatagory-widget01">Catagories<i class="fas fa-angle-down"></i></a>

                                <div class="widget-wrapper" id="scatagory-widget01">
                                    <ul class="catagory-menu collapse show" id="catagory-main">
                                    <?php 
                                    $count = 0;
                                    foreach($categoriesList as $row){
                                        $count++;
                                    ?>    
                                        <li><a class="collapsed"  data-toggle="collapse" href="#catagory-widget-s<?php echo $count; ?>" role="button" aria-expanded="false" aria-controls="catagory-widget-s<?php echo $count; ?>"><?php echo $row['Category_Name']; ?> <span class="plus-minus"></span></a>
                                            <ul class="catagory-submenu collapse" id="catagory-widget-s<?php echo $count; ?>">
                                            <?php
                                            $stockSubmenu = mysqli_query($connection,"SELECT id, Name from stock where Category_id = '".$row['id']."';")or die($connection->error);                              
                                                foreach($stockSubmenu as $row2){
                                            ?>
                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="category_selector" id="<?php echo $row2['id']; ?>" value="<?php echo $row2['Name']; ?>">
                                                    <span class="checkbox" value="<?php echo $row2['Name']; ?>"></span>
                                                    <span class="label"><?php echo $row2['Name']; ?></span>
                                                </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="widget">
                                <h4 class="widget-title d-none d-lg-block">Filter by price</h4>
                                <a class="widget-title d-lg-none" data-toggle="collapse" href="#scatagory-widget02" role="button" aria-expanded="false" aria-controls="scatagory-widget02">Filter by Price<i class="fas fa-angle-down"></i></a>

                                <div class="widget-wrapper" id="scatagory-widget02">
                                    <div class="range-slider">
                                        <input type="text" class="js-range-slider" value="" />
                                        <input type="hidden" id="hidden_minimum_price" value="0"/>
                                        <input type="hidden" id="hidden_maximum_price" value="2000"/>
                                        <input type="hidden" class="organization_name" value="<?php echo $organization; ?>">
                                    </div>
                                </div>
                            </div>

                            <!--<div class="widget">
                                <h4 class="widget-title d-none d-lg-block">Filter by Brand Name</h4>
                                <a class="widget-title d-lg-none" data-toggle="collapse" href="#scatagory-widget03" role="button" aria-expanded="false" aria-controls="scatagory-widget03">Filte by Brand Name<i class="fas fa-angle-down"></i></a>

                                <div class="widget-wrapper" id="scatagory-widget03">
                                
                                <div class="flux-custom-select">
                                        <select>
                                            <option value="0">Select Brand</option>
                                            <option value="1">Nesle</option>
                                            <option value="2">Dano</option>
                                            <option value="3">Fresh</option>
                                            <option value="3">Uniliver</option>
                                            <option value="3">Pepsi</option>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-lg-9 order-lg-last">
                            <div class="row product-list">
                            <?php
                                foreach($stockList as $row){
                            ?> 
                                <div class="col-sm-6 col-xl-4" id="<?php echo $row['Name']; ?>">
                                    <div class="product-item <?php if($row['Quantity'] < $row['Restock_Level'] ){ ?> stock-out <?php }?>" id="<?php echo $row['Name']; ?>">
                                        <div class="product-thumb">
                                            <!--you can add this onclick to anchor tag below when necessary-->
                                                <!--onclick="openModal()"-->
                                            <a  class="modalOpen" id="<?php echo $row['id']; ?>"><img src="assets/images/products/<?php echo $row['image']; ?>" alt="product"></a>
                                            <?php if($row['Discount'] > 0){?><span class="batch sale">Sale</span><?php } ?>  
                                                <?php
                                                $item_in_wishlist = '';
                                                $item_in_wishlist_id = '';
                                                if (isset($_SESSION['logged_in'])) {
                                                    //session set to true
                                                    if ($_SESSION['logged_in'] == TRUE) {
                                                $product_in_wishlist = mysqli_query($connection,"SELECT * FROM `wishlist` WHERE customer_id ='$customer_id' AND product_id = '".$row['id']."'");
                                                $product_wishlist_result = mysqli_fetch_array($product_in_wishlist);
                                                if ( $product_wishlist_result == true) {
                                                    $item_in_wishlist = true;
                                                    $item_in_wishlist_id = $product_wishlist_result['product_id'];
                                                }
                                                else{
                                                    $item_in_wishlist = false;
                                                }
                                                }
                                                //session set to false
                                                else{
                                                    //wishlist cookie set
                                                    if(isset($_COOKIE["shopping_wishlist"]))
                                                    {
                                                        $wishlist_data = stripslashes($_COOKIE['shopping_wishlist']);
                                                        $wishlist_data = json_decode($wishlist_data, true);
                                                        $item_id = array_column($wishlist_data, 'item_id');
                                                    if(in_array( $row['id'], $item_id))
                                                    {
                                                        foreach($wishlist_data as $keys => $values)
                                                        {
                                                            if($wishlist_data[$keys]["item_id"] == $row['id'])
                                                            {
                                                                $item_in_wishlist = true;
                                                                $item_in_wishlist_id = $values["item_id"];
                                                            }
                                                        }
                                                    }
                                                    else{
                                                        $item_in_wishlist = false;
                                                    }
                                                }
                                                //wishlist cookie not set
                                                else{
                                                    $item_in_wishlist = false; 
                                                }
                                                }
                                            }
                                            //session not set
                                            else{
                                                //wishlist cookie set
                                                if(isset($_COOKIE["shopping_wishlist"]))
                                                    {
                                                        $wishlist_data = stripslashes($_COOKIE['shopping_wishlist']);
                                                        $wishlist_data = json_decode($wishlist_data, true);
                                                        $item_id = array_column($wishlist_data, 'item_id');
                                                    if(in_array( $row['id'], $item_id))
                                                    {
                                                        foreach($wishlist_data as $keys => $values)
                                                        {
                                                            if($wishlist_data[$keys]["item_id"] == $row['id'])
                                                            {
                                                                $item_in_wishlist = true;
                                                                $item_in_wishlist_id = $values["item_id"];
                                                            }
                                                        }
                                                    }
                                                    else{
                                                        $item_in_wishlist = false;
                                                    }
                                                }
                                                //wishlist cookie not set
                                                else{
                                                    $item_in_wishlist = false; 
                                                }
                                            } 
                                            ?>
                                            <a class="wish-link"
                                            href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/product-list.php?action=add_wishlist&id='.$row['id'] ?>">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path
                                                    <?php
                                                       if($item_in_wishlist == true){
                                                    ?>
                                                    style="fill:red;"
                                                     <?php
                                                       }
                                                     ?>
                                                d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                               
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata" id="itemCategory<?php echo $row['id']; ?>"><?php echo $row['Category_Name']; ?></a>
                                            <h6><a href="product-detail.php" class="product-title"><?php echo $row['Name']; ?></a></h6>
                                            <p class="quantity"><?php echo $row['unit_name']; ?></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">Ksh.<?php echo number_format($row['Price'] - $row['Discount'],2); if($row['Discount'] > 0){?> <del>Ksh.<?php echo number_format($row['Price'],2); ?></del><?php } ?></div>
                                                <?php
                                                    $item_in_cart = '';
                                                    $item_in_cart_qty = '';
                                                    $item_in_cart_id = '';
                                                    if (isset($_SESSION['logged_in'])) {
                                                        //session set to true
                                                        if ($_SESSION['logged_in'] == TRUE) {
                                                    $product_in_cart = mysqli_query($connection,"SELECT * FROM `cart` WHERE customer_id ='$customer_id' AND product_id = '".$row['id']."'");
                                                    $product_cart_result = mysqli_fetch_array($product_in_cart);
                                                    if ( $product_cart_result == true) {
                                                        $item_in_cart = true;
                                                        $item_in_cart_id = $product_cart_result['product_id'];
                                                        $item_in_cart_qty = $product_cart_result['quantity'];
                                                    }
                                                    else{
                                                        $item_in_cart = false;
                                                    }
                                                    }
                                                    //session set to false
                                                    else{
                                                        //cart cookie set
                                                        if(isset($_COOKIE["shopping_cart"]))
                                                        {
                                                            $cart_data = stripslashes($_COOKIE['shopping_cart']);
                                                            $cart_data = json_decode($cart_data, true);
                                                            $item_id = array_column($cart_data, 'item_id');
                                                        if(in_array( $row['id'], $item_id))
                                                        {
                                                            foreach($cart_data as $keys => $values)
                                                            {
                                                                if($cart_data[$keys]["item_id"] == $row['id'])
                                                                {
                                                                    $item_in_cart = true;
                                                                    $item_in_cart_id = $values["item_id"];
                                                                    $item_in_cart_qty = $values["item_quantity"];
                                                                }
                                                            }
                                                        }
                                                        else{
                                                            $item_in_cart = false;
                                                        }
                                                    }
                                                    //cart cookie not set
                                                    else{
                                                        $item_in_cart = false; 
                                                    }
                                                    }
                                                }
                                                //session not set
                                                else{
                                                    //cart cookie set
                                                    if(isset($_COOKIE["shopping_cart"]))
                                                        {
                                                            $cart_data = stripslashes($_COOKIE['shopping_cart']);
                                                            $cart_data = json_decode($cart_data, true);
                                                            $item_id = array_column($cart_data, 'item_id');
                                                        if(in_array( $row['id'], $item_id))
                                                        {
                                                            foreach($cart_data as $keys => $values)
                                                            {
                                                                if($cart_data[$keys]["item_id"] == $row['id'])
                                                                {
                                                                    $item_in_cart = true;
                                                                    $item_in_cart_id = $values["item_id"];
                                                                    $item_in_cart_qty = $values["item_quantity"];
                                                                }
                                                            }
                                                        }
                                                        else{
                                                            $item_in_cart = false;
                                                        }
                                                    }
                                                    //cart cookie not set
                                                    else{
                                                        $item_in_cart = false; 
                                                    }
                                                } 
                                                    ?>
                                                <div class="cart-btn-toggle">
                                                    <?php
                                                    if($item_in_cart == true)
                                                        {        
                                                    ?>
                                                            <div class="price-button">
                                                         <!--   <input type="hidden" name="hidden_id" id="hidden_id<?php/* echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
                                                        <input type="hidden" name="hidden_name" id="hidden_name<?php echo $row['id']; ?>" value="<?php echo $row['Name']; ?>">
                                                        <input type="hidden" name="hidden_unit" id="hidden_unit<?php echo $row['id']; ?>" value="<?php echo $row['unit_name']; ?>">
                                                        <input type="hidden" name="hidden_discount" id="hidden_discount<?php echo $row['id']; ?>" value="<?php echo $row['Discount']; ?>">
                                                        <input type="hidden" name="hidden_price" id="hidden_price<?php echo $row['id']; ?>" value="<?php echo $row['Price']; ?>">
                                                        <input type="hidden" name="hidden_image" id="hidden_image<?php echo $row['id']; ?>" value="<?php echo $row['image'];*/ ?>"> -->
                                                                <div class="price-increase-decrese-group d-flex">
                                                                    <span class="decrease-btn">
                                                                        <button type="button"
                                                                            class="btn quantity-left-minus productlist_decrease" data-type="minus" id="<?php echo $item_in_cart_id; ?>" data-field="">-
                                                                        </button> 
                                                                    </span>
                                                                    <input type="text" name="quantity" id="productlist_qty<?php echo $item_in_cart_id; ?>" disabled class="form-controls input-number" value="<?php echo $item_in_cart_qty; ?>">
                                                                    <span class="increase">
                                                                        <button type="button"
                                                                            class="btn quantity-right-plus productlist_increase" data-type="plus" id="<?php echo $item_in_cart_id; ?>" data-field="">+
                                                                        </button>
                                                                    </span>
                                                                </div>
                                                            </div> 
                                                        <?php   
                                                        }
                                                        else{
                                                    ?>
                                                    <form method="POST">
                                                        <input type="hidden" name="hidden_id" id="hidden_id<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
                                                        <input type="hidden" name="hidden_name" id="hidden_name<?php echo $row['id']; ?>" value="<?php echo $row['Name']; ?>">
                                                        <input type="hidden" name="hidden_unit" id="hidden_unit<?php echo $row['id']; ?>" value="<?php echo $row['unit_name']; ?>">
                                                        <input type="hidden" name="hidden_discount" id="hidden_discount<?php echo $row['id']; ?>" value="<?php echo $row['Discount']; ?>">
                                                        <input type="hidden" name="hidden_price" id="hidden_price<?php echo $row['id']; ?>" value="<?php echo $row['Price']; ?>">
                                                        <input type="hidden" name="hidden_image" id="hidden_image<?php echo $row['id']; ?>" value="<?php echo $row['image']; ?>">
                                                        <button type="submit" class="cart-btn" name="cart_button" id="<?php echo $row['id']; ?>">
                                                            <span ><i class="fas fa-shopping-cart"></i> Cart</span>
                                                        </button>
                                                        </form>
                                                    <?php
                                                        }
                                                    ?>               
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <?php
                                }  
                                ?>
                                <!--<div class="col-12 text-center mt-4">
                                    <button class="loadMore">Load More</button>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- page-content -->
<?php
    include('footer.php');
?>