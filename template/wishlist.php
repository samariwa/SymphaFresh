<?php
  include('header.php');
  $profile_details = mysqli_query($connection,"SELECT firstname,lastname,email,location,mobile FROM users where email = '$logged_in_email' ")or die($connection->error);
$result = mysqli_fetch_array($profile_details);
$firstname = $result['firstname'];
$lastname = $result['lastname'];
$mobile = $result['mobile'];
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



            <!-- admin-page start -->
            <section class="admin-page-section d-flex align-items-center" style="background-image: url('assets/images/admin/profile-bg.jpg'); background-size: cover;">
                <div class="aps-wrapper w-100">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-start">
                            <div class="admin-content-area">
                                <div class="admin-thumb">
                                    <img src="assets/images/admin/thumbnail-avatar.png" alt="">
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
                            <div class="wishlist-item product-item d-flex align-items-center">
                                <span class="close-item"><i class="fas fa-times"></i></span>
                                <div class="thumb">
                                    <a onclick="openModal()"><img src="assets/images//products/cart/01.png" alt="products"></a>
                                </div>
                                <div class="product-content">
                                    <a href="product-detail.php" class="product-title">Daisy Cont Oil</a>
                                    <div class="product-cart-info">
                                        1x 31b
                                    </div>
                                    <div class="product-price">
                                        <del>$8.00</del><span class="ml-4">$5.00</span>
                                    </div>
                                    <div class="cart-btn-toggle" onclick="cartopen()">
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
                                </div>
                            </div>

                            <div class="wishlist-item product-item d-flex align-items-center">
                                <span class="close-item"><i class="fas fa-times"></i></span>
                                <div class="thumb">
                                    <a onclick="openModal()"><img src="assets/images//products/cart/02.png" alt="products"></a>
                                </div>
                                <div class="product-content">
                                    <a href="product-detail.php" class="product-title">Daisy Cont Oil</a>
                                    <div class="product-cart-info">
                                        1x 31b
                                    </div>
                                    <div class="product-price">
                                        <del>$8.00</del><span class="ml-4">$5.00</span>
                                    </div>
                                    <div class="cart-btn-toggle" onclick="cartopen()">
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
                                </div>
                            </div>

                            <div class="wishlist-item product-item d-flex align-items-center">
                                <span class="close-item"><i class="fas fa-times"></i></span>
                                <div class="thumb">
                                    <a onclick="openModal()"><img src="assets/images//products/cart/03.png" alt="products"></a>
                                </div>
                                <div class="product-content">
                                    <a href="product-detail.php" class="product-title">Daisy Cont Oil</a>
                                    <div class="product-cart-info">
                                        1x 31b
                                    </div>
                                    <div class="product-price">
                                        <del>$8.00</del><span class="ml-4">$5.00</span>
                                    </div>
                                    <div class="cart-btn-toggle" onclick="cartopen()">
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
                                </div>
                            </div>

                            <div class="wishlist-item product-item d-flex align-items-center">
                                <span class="close-item"><i class="fas fa-times"></i></span>
                                <div class="thumb">
                                    <a onclick="openModal()"><img src="assets/images//products/cart/04.png" alt="products"></a>
                                </div>
                                <div class="product-content">
                                    <a href="product-detail.php" class="product-title">Daisy Cont Oil</a>
                                    <div class="product-cart-info">
                                        1x 31b
                                    </div>
                                    <div class="product-price">
                                        <del>$8.00</del><span class="ml-4">$5.00</span>
                                    </div>
                                    <div class="cart-btn-toggle" onclick="cartopen()">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- dashboard-section end -->
<?php
  include('footer.php');
?>