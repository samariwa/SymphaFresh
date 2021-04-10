<?php
  include('header.php');
  $profile_details = mysqli_query($connection,"SELECT firstname,lastname,email,location,number FROM users where email = '$logged_in_email' ")or die($connection->error);
$result = mysqli_fetch_array($profile_details);
$firstname = $result['firstname'];
$lastname = $result['lastname'];
$mobile = $result['number'];
$email = $result['email'];
$location = $result['location'];
?>
            <!-- page-header-section start -->
            <div class="page-header-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between justify-content-md-start">
                            <ul class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li><span>/</span></li>
                                <li>Wishlist</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->
          <?php  echo $message;  ?>
            <!-- admin-page start -->
            <section class="admin-page-section d-flex align-items-center" style="background-image: url('../assets/images/admin/profile-bg.jpg'); background-size: cover;">
                <div class="aps-wrapper w-100">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-start">
                            <div class="admin-content-area">
                                <div class="admin-thumb">
                                    <img src="../assets/images/admin/thumbnail-avatar.png" alt="">
                                    <a href="#" class="image-change-option"><i class="fas fa-camera"></i></a>
                                </div>
                                <div class="admin-content">
                                    <h4 class="name"><?php echo $firstname.' '.$lastname; ?></h4>
                                    <p class="desc"><?php echo $email; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- admin-page end -->



            <!-- dashboard-section start -->
            <section id="dashboard-nav" class="dashboard-section">
                <div class="container">
                    <ul class="dashboard-nav d-lg-flex flex-wrap align-items-center justify-content-between">
                        <li><a href="user-dashboard.php#dashboard-nav"><i class="far fa-list-alt"></i>Your Orders</a></li>
                        <li><a href="track-order.php#dashboard-nav"><i class="fas fa-shipping-fast"></i>Track Orders</a></li>
                        <li><a href="profile.php#dashboard-nav"><i class="far fa-user"></i>Your Profile</a></li>
                        <li><a class="active" href="wishlist.php#dashboard-nav"><i class="far fa-heart"></i>Wish List</a></li>
                    </ul>
                </div>

                <div class="container">
                    <div class="dashboard-body wishlist">
                        <div class="wishlist-header">
                            <h6>Shopping Wishlist</h6>
                        </div>
                        <div class="wish-list-container">
                        <?php
                        $total = 0;
                        if(isset($_COOKIE['shopping_wishlist']))
                        {     
                            $wishlist_data = stripslashes($_COOKIE['shopping_wishlist']);
                            $wishlist_data = json_decode($wishlist_data, true);
                            foreach($wishlist_data as $keys => $values)
                            {
                        ?>
                            <div class="wishlist-item product-item d-flex align-items-center <?php if($quantity > $restock_level ){ ?>stock-out<?php }?>">
                                <span class="close-item"><a href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/wishlist.php?action=wishlist_delete&id='.$values["item_id"] ?>" class="ml-5 text-danger">Remove <i class="fas fa-times"></i></a></span>
                                <div class="thumb">
                                <?php if($values["item_discount"] > 0){?><span class="batch sale">Sale</span><?php } ?>
                                    <a onclick="openModal()"><img src="../assets/images/products/<?php echo $values["item_image"]; ?>" width="200px" height="170px" alt="products"></a>
                                </div>
                                <div class="product-content">
                                    <a href="product-detail.php" class="product-title"><?php echo $values["item_name"]; ?></a>
                                    <div class="product-cart-info">
                                    <?php echo $values["item_category"]; ?>
                                    </div>
                                    <div class="product-price">
                                    <?php if($values['item_discount'] > 0){ ?> <del>Ksh<?php echo number_format($values["item_price"],2); ?> /unit</del> <br><?php }?>
                                       Ksh<?php echo number_format($values["item_price"] - $values["item_discount"],2); ?> /unit
                                    </div>
                                    <div class="cart-btn-toggle">
                                    <form method="POST">
                                    <input type="hidden" name="hidden_id" value="<?php echo $values["item_id"] ?>">
                                    <input type="hidden" name="hidden_name" value="<?php echo $values["item_name"]; ?>">
                                    <input type="hidden" name="hidden_unit" value="<?php echo $values["item_unit"]; ?>">
                                    <input type="hidden" name="hidden_discount" value="<?php echo $values["item_discount"]; ?>">
                                    <input type="hidden" name="hidden_price" value="<?php echo $values["item_price"]; ?>">
                                    <input type="hidden" name="hidden_image" value="<?php echo $values["item_image"]; ?>">
                                    <button type="submit" class="cart-btn" name="cart_button">
                                        <span ><i class="fas fa-shopping-cart"></i> Cart</span>
                                    </button>
                                    </form>

                                     <!--    <div class="price-btn">
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
                                        </div> -->
                                    </div>           
                                </div>
                            </div>
                    <?php
                       }      
                    }
                    ?>
                        </div>
                    </div>
                    <a <?php if($wishlist_count == 0){?> href="#" <?php } else{ ?>href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/wishlist.php?action=wishlist-cart-all' ?>" <?php } ?>  style=" background-color: #59b828;color: white;display: block;text-align: center;padding: 10px 30px;border-radius: 5px;margin-top: 10px;">Add all to Cart</a>
                        <a <?php if($wishlist_count == 0){?> href="#" <?php } else{ ?>href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/wishlist.php?action=wishlist-clear' ?>" <?php } ?>  style=" background-color: #df4759;color: white;display: block;text-align: center;padding: 10px 30px;border-radius: 5px;margin-top: 10px;">Clear Wishlist</a>
                </div>
            </section>
            <!-- dashboard-section end -->
<?php
  include('footer.php');
?>