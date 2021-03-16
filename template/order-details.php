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
            <section class="dashboard-section">
                <div class="container">
                    <div class="track-order-item bg-color-white">
                        <div class="d-flex justify-content-between track-number-link align-items-center">
                            <div>
                                <h6 class="order-number">Order#48376837</h6>
                                <p class="date">09/21/2020</p>
                                <p class="price">USD 2342</p>
                            </div>
                            <div>
                                <a href="track-order-single.php" class="order-btn">Track Order</a>
                            </div>
                        </div>
                        <div class="order-details">
                            <div class="order-details-head">
                                <h6>Order Details</h6>
                            </div>
                            <div class="order-details-container">
                                <div class="order-details-item d-flex flex-wrap align-items-center justify-content-between">
                                    <div class="thumb d-flex flex-wrap align-items-center">
                                        <a  onclick="openModal()"><img src="assets/images//products/cart/03.png" alt="products"></a>
                                        <div class="product-content">
                                            <a  onclick="openModal()" class="product-title">Daisy Cont Oil</a>
                                        </div>
                                    </div>
                                    
                                    <div class="product-content pl-0">
                                        <div class="product-cart-info">
                                            1kg
                                        </div>
                                    </div>
                                    <div class="product-content pl-0">
                                        <div class="product-price">
                                            <del>$8.00</del><span class="ml-4">$5.00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="order-details-item d-flex flex-wrap align-items-center justify-content-between">
                                    <div class="thumb d-flex flex-wrap align-items-center">
                                        <a  onclick="openModal()"><img src="assets/images//products/cart/03.png" alt="products"></a>
                                        <div class="product-content">
                                            <a  onclick="openModal()" class="product-title">Daisy Cont Oil</a>
                                        </div>
                                    </div>
                                    
                                    <div class="product-content pl-0">
                                        <div class="product-cart-info">
                                            1kg
                                        </div>
                                    </div>
                                    <div class="product-content pl-0">
                                        <div class="product-price">
                                            <del>$8.00</del><span class="ml-4">$5.00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="order-details-item d-flex flex-wrap align-items-center justify-content-between">
                                    <div class="thumb d-flex flex-wrap align-items-center">
                                        <a  onclick="openModal()"><img src="assets/images//products/cart/03.png" alt="products"></a>
                                        <div class="product-content">
                                            <a  onclick="openModal()" class="product-title">Daisy Cont Oil</a>
                                        </div>
                                    </div>
                                    
                                    <div class="product-content pl-0">
                                        <div class="product-cart-info">
                                            1kg
                                        </div>
                                    </div>
                                    <div class="product-content pl-0">
                                        <div class="product-price">
                                            <del>$8.00</del><span class="ml-4">$5.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="track-order-info">
                            <ul class="to-list">
                                <li class="d-flex flex-wrap justify-content-between">
                                    <span class="t-title">Sub Total</span>
                                    <span class="desc">$2.0</span>
                                </li>
                                <li class="d-flex flex-wrap justify-content-between">
                                    <span class="t-title">Delevary Fee</span>
                                    <span class="desc">$2.0</span>
                                </li>
                                <li class="d-flex flex-wrap justify-content-between">
                                    <span class="t-title">Discount</span>
                                    <span class="desc">$2.0</span>
                                </li>
                                <li class="inc-vat d-flex flex-wrap justify-content-between">
                                    <span class="t-title">Total(inc) Vat</span>
                                    <span class="desc">$2.0</span>
                                </li>
                            </ul>
                        </div>
                        <div class="delevary-time">
                            <p>Ddelevary Time 10 may, 10am - 12am</p>
                        </div>
                        <div class="track-order-footer">
                            <p>Helpline - <a href="#">Call Us</a></p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- dashboard-section end -->
<?php
    include('footer.php');
?>