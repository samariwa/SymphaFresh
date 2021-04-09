<?php
include('header.php');
$profile_details = mysqli_query($connection,"SELECT firstname,lastname,email,location,number FROM users where email = '$logged_in_email' ")or die($connection->error);
$result = mysqli_fetch_array($profile_details);
$firstname = $result['firstname'];
$lastname = $result['lastname'];
$mobile = $result['number'];
$email = $result['email'];
$location = $result['location'];
?>             <!-- page-header-section start -->
            <div class="page-header-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between justify-content-md-start">
                            <ul class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li><span>/</span></li>
                                <li>Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->



            <!-- dashboard-section start -->
            <section class="dashboard-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <!--<div class="form-item contact-number-item bg-color-white box-shadow p-3 p-lg-5 border-radius5">
                                <h6>Contact Number</h6>
                                <p>We need your phone number so we can inform you about any delay or problem.<br>5 digits code send your phone <strong>+111223366548</strong></p>
                                <div class="mb-2">
                                    <form action="#" class="send-code-form">
                                        <input type="text" name="code">
                                        <button class="submit" type="submit">Send Code</button>
                                    </form>
                                </div>
                                
                                <div>
                                    <h6>Enter Code</h6>
                                    <form action="#" class="varify-code-form">
                                        <input type="text" name="code">
                                        <input type="text" name="code">
                                        <input type="text" name="code">
                                        <input type="text" name="code">
                                        <input type="text" name="code">
                                        <button class="submit" type="submit">Next</button>
                                        <div>
                                            <a href="#" class="resend-code">Resend Code</a>
                                        </div>
                                    </form>
                                </div>
                            </div>-->

                            <div class="form-item billing-item bg-color-white box-shadow p-3 p-lg-5 border-radius5">
                                <h6>Kindly Confirm your Details</h6>
                                <form action="#" class="billing-form">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-item">
                                                <label>First Name*</label>
                                                <input type="text" name="name" value="<?php echo $firstname; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-item">
                                                <label>Last Name*</label>
                                                <input type="text" name="name" value="<?php echo $lastname; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-item">
                                                <label>Physical Address*</label>
                                                <input type="text" name="address" value="<?php echo $location; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-item">
                                                <label>Email*</label>
                                                <input type="text" name="email" value="<?php echo $email; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-item">
                                                <label>Mobile*</label>
                                                <input type="text" name="mobile" value="<?php echo $mobile; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="form-item time-schedule bg-color-white box-shadow p-3 p-lg-5 border-radius5">
                                <h6>Delivery Schedule</h6>

                                <div class="time-schedule-container">
                                    <p class="title">Express-Delivery</p>
                                    <div class="time-schedule-box">
                                        <ul>
                                            <li>Monday</li>
                                            <li>11/11/2021</li>
                                            <li>8.00AM - 10.00AM</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="form-item payment-item bg-color-white box-shadow p-3 p-lg-5 border-radius5">
                                <h6>Payment</h6>

                                <form action="#" class="payment-form">
                                    
                                    <div class="input-item radio">
                                        <input type="radio" name="payment" value="check payment">
                                        <label>Check Payment</label>
                                    </div>

                                    <div class="input-item radio">
                                        <input type="radio" name="payment" value="cash on delivary">
                                        <label>Cash on delivery</label>
                                    </div>

                                    <div class="input-item radio">
                                        <input type="radio" name="payment" value="paypal">
                                        <label>M-pesa</label>
                                    </div>
                                </form>
                                <div class="payment-method d-flex flex-wrap">
                                            <a href="#"><img src="../assets/images/payment/Mpesa-Logo.png" height="35px" width="55px" alt="payment"></a>
                                            <a href="#"><img src="../assets/images/payment/visa.png" alt="payment"></a>
                                            <a href="#"><img src="../assets/images/payment/Mastercard-Logo.png" height="30px" width="50px" alt="payment"></a>
                                            <a href="#"><img src="../assets/images/payment/paypal.png" alt="payment"></a>
                                        </div>
                                <div class="text-right">
                                    <a href="#" class="place-order-btn">Place Order</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="cart-item sitebar-cart bg-color-white box-shadow p-3 p-lg-5 border-radius5">
                                <div class="cart-product-container">
                                <?php
                                $total = 0;
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
                                                    <a onclick="openModal()"><img src="../assets/images/products/<?php echo $values["item_image"]; ?>" alt="products"></a>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="product-content">
                                                    <a onclick="openModal()" class="product-title"><?php echo $values["item_name"]; ?></a>
                                                    <div class="product-cart-info">
                                                    <?php if($values['item_discount'] > 0){ ?> <del>Ksh<?php echo number_format($values["item_price"],2); ?> /unit</del> <br><?php }?>
                                                    Ksh<?php echo number_format($values["item_price"] - $values["item_discount"],2); ?> /unit
                                                    <br>
                                                    x<span id="checkout_unit_qty<?php echo $values['item_id']; ?>"><?php echo $values["item_quantity"]; ?></span> <?php echo $values["item_unit"]; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <div class="price-increase-decrese-group d-flex">
                                                    <span class="decrease-btn">
                                                        <button type="button"
                                                            class="btn quantity-left-minus checkout_cart_decrease" id="<?php echo $values['item_id']; ?>" data-type="minus" data-field="">-
                                                        </button> 
                                                    </span>
                                                    <input type="text" name="quantity" disabled class="form-controls input-number" id="checkout_cart_qty<?php echo $values["item_id"]; ?>" value="<?php echo $values["item_quantity"]; ?>">
                                                    <span class="increase">
                                                        <button type="button"
                                                            class="btn quantity-right-plus checkout_cart_increase" id="<?php echo $values['item_id']; ?>" data-type="plus" data-field="">+
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <!--<div class="product-price">-->
                                                   <span class="ml-4">Ksh<span id="checkout_subtotal<?php echo $values['item_id']; ?>"><?php echo number_format($values["item_quantity"] * ($values["item_price"] - $values["item_discount"]),2); ?></span></span>
                                                <!--</div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    $total = $total + ($values["item_quantity"] * ($values["item_price"] - $values["item_discount"])); 
                                        }      
                                    }
                                    ?>
                                </div>
                                <div class="cart-footer">
                                    <div class="product-other-charge">
                                        <p class="d-flex justify-content-between">
                                            <span>Delevery charge</span> 
                                            <span>Ksh8.00</span>
                                        </p>
                                        <a href="#">Do you have a voucher?</a>
                                    </div>
                            
                                    <div class="cart-total">
                                        <!--<p class="saving d-flex justify-content-between">
                                            <span>Total Savings</span> 
                                            <span>Ksh11.00</span>
                                        </p>-->
                                        <p class="total-price d-flex justify-content-between">
                                            <span>Total</span> 
                                            <input type="hidden" id="checkout_total" value="<?php echo $total; ?>" >
                                            <span>KSh<span id="checkout_total_value"><?php echo number_format($total,2); ?></span></span>
                                        </p>
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