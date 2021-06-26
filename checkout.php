<?php
include('header.php');
$profile_details = mysqli_query($connection,"SELECT id,firstname,lastname,location,number FROM users where email = '$logged_in_email' ")or die($connection->error);
$result = mysqli_fetch_array($profile_details);
$firstname = $result['firstname'];
$lastname = $result['lastname'];
$mobile = $result['number'];
$id = $result['id'];
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
<?php
echo $message;
?>
            <!-- dashboard-section start -->
            <section class="dashboard-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                        <form method="post" id="confirmDetails">
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
                                <div class="billing-form">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-item">
                                                <label>First Name*</label>
                                                <input type="text" name="name" id="confirmFirstname" value="<?php echo $firstname; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-item">
                                                <label>Last Name*</label>
                                                <input type="text" name="name" id="confirmLastname" value="<?php echo $lastname; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-item">
                                                <label>Physical Address*</label>
                                                <input type="text" name="address" id="confirmLocation" value="<?php echo $location; ?>" required>
                                            </div>
                                        </div>
                                                <input type="hidden" name="id" id="customerId" value="<?php echo $id; ?>" required>
                                        <div class="col-lg-12">
                                            <div class="input-item">
                                                <label>Mobile*</label>
                                                <input type="text" name="mobile" id="confirmMobile" value="<?php echo $mobile; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-item time-schedule bg-color-white box-shadow p-3 p-lg-5 border-radius5">
                                <h6>Delivery</h6>
                                <div class="col-lg-12">
                                    <div class="input-item radio">
                                        <input type="radio" name="delivery_location" id="delivery_address" checked value="<?php echo $location; ?>">
                                        <label><b>Deliver to your address</b></label>  
                                    </div>
                                    <div class="time-schedule-container">
                                    <p class="title">Delivery Schedule</p>
                                    <div class="time-schedule-box">
                                        <ul>
                                            <li>Monday</li>
                                            <li>11/11/2021</li>
                                            <li>8.00AM - 10.00AM</li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                                
                                <br>
                                <div class="col-lg-12">
                                            <div class="input-item radio">
                                                <input type="radio" name="delivery_location" id="delivery_outlet_pickup" value="outlet_pickup">
                                                <label><b>Pick up from our outlet</b></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                    <label for="expiry" class="ml-3">Pick a delivery/pick up date:</label>
                                    <input type="date" name="order_date" id="order_date" class="form-control ml-3" required style="padding:15px" min="<?php $currentTime = time() + 3600; if (((int) date('H', $currentTime)) <= 17) { echo date('Y-m-d'); }else{ echo date('Y-m-d', strtotime('tomorrow'));} ?>" value="<?php $currentTime = time() + 3600; if (((int) date('H', $currentTime)) <= 17) { echo date('Y-m-d'); }else{ echo date('Y-m-d', strtotime('tomorrow'));} ?>">
                                    </div><br>        
                                    </div>

                            <div class="form-item payment-item bg-color-white box-shadow p-3 p-lg-5 border-radius5">
                                <h6>Payment</h6>

                                <div class="payment-form">
                                    <div class="input-item radio">
                                        <input type="radio" name="payment" value="paypal" checked>
                                        <label>M-pesa</label>
                                    </div>

                                    <div class="input-item radio">
                                        <input type="radio" name="payment" value="cash on delivery">
                                        <label>Cash on delivery</label>
                                    </div>

                                    <div class="input-item radio">
                                        <input type="radio" name="payment" value="check payment">
                                        <label>Check Payment</label>
                                    </div>

                                    
                                </div>
                                <div class="payment-method d-flex flex-wrap">
                                            <a href="#"><img src="assets/images/payment/Mpesa-Logo.png" height="35px" width="55px" alt="payment"></a>
                                            <a href="#"><img src="assets/images/payment/visa.png" alt="payment"></a>
                                            <a href="#"><img src="assets/images/payment/Mastercard-Logo.png" height="30px" width="50px" alt="payment"></a>
                                            <a href="#"><img src="assets/images/payment/paypal.png" alt="payment"></a>
                                        </div>
                                <div class="text-right">
                                    <input type="submit" class="btn place-order-btn btn-md" id="completeOrder" value="Place Order">
                                </div>
                            </div>
                        </form>    
                        </div>
                        <div class="col-lg-5">
                            <div class="cart-item sitebar-cart bg-color-white box-shadow p-3 p-lg-5 border-radius5">
                                <div class="cart-product-container">
                                <?php
                                $total = 0;
                                $cart_checker = mysqli_query($connection,"SELECT s.id AS id,s.Name as Name,cart.quantity as cartQty,image,i_u.Name as unit_name,s.Discount as Discount,sf.Selling_price as Price,c.Category_Name as Category_Name,s.Restock_Level as Restock_Level,s.Quantity as Quantity FROM `cart` inner join stock s on cart.product_id = s.id INNER JOIN stock_flow sf ON s.id = sf.Stock_id JOIN inventory_units i_u ON s.Unit_id = i_u.id JOIN category c ON s.Category_id=c.id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at WHERE cart.customer_id='$customer_id';");
                                $cart_count = mysqli_num_rows($cart_checker);
                                foreach($cart_checker as $row)
                               {
                                ?>
                                    <div class="cart-product-item <?php if($row['Quantity'] < $row['cartQty'] ){ ?>stock-out<?php }?>" id="item<?php echo $row['id']; ?>">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <?php 
                                                if($row['Quantity'] < $row['cartQty'] ){ 
                                                ?>
                                                    <input type="hidden" name="hiddenAvailableQty" id="hiddenAvailableQty<?php echo $row["id"]; ?>" value="<?php echo $row['Quantity']-1; ?>">
                                                    <input type="hidden" name="hiddenAvailableCost" id="hiddenAvailableCost<?php echo $row["id"]; ?>" value="<?php echo number_format(($row["Price"] - $row["Discount"]),2); ?>">
                                                <?php 
                                                }
                                                ?>
                                            </div>
                                            <div class="col-6">
                                                <span class="close-item mr-3"><a href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/checkout.php?action=delete&id='.$row["id"]; ?>" class="ml-5 text-danger">Remove <i class="fas fa-times"></i></a></span>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-6 p-0">
                                                <div class="thumb">
                                                    <a ><img src="assets/images/products/<?php echo $row["image"]; ?>" alt="products"></a>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="product-content">
                                                    <a onclick="openModal()" class="product-title"><?php echo $row["Name"]; ?></a>
                                                    <div class="product-cart-info">
                                                    <?php if($row["Discount"] > 0){ ?> <del>Ksh<?php echo number_format($row["Price"],2); ?> /unit</del> <br><?php }?>
                                                    Ksh<?php echo number_format($row["Price"] - $row["Discount"],2); ?> /unit
                                                    <br>
                                                    x<span id="checkout_unit_qty<?php echo $row['id']; ?>"><?php echo $row["cartQty"]; ?></span> <?php echo $row["unit_name"]; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center mt-2">
                                            <div class="col-6">
                                                <div class="price-increase-decrese-group d-flex ml-4">
                                                    <span class="decrease-btn">
                                                        <button type="button"
                                                            class="btn quantity-left-minus checkout_cart_decrease" <?php if($row["cartQty"] == 0){?> disabled <?php } ?> id="<?php echo $row['id']; ?>" data-type="minus" data-field="">-
                                                        </button> 
                                                    </span>
                                                    <input type="text" name="quantity" disabled class="form-controls input-number" id="checkout_cart_qty<?php echo $row["id"]; ?>" value="<?php echo $row["cartQty"]; ?>">
                                                    <span class="increase">
                                                        <button type="button"
                                                            class="btn quantity-right-plus checkout_cart_increase" id="<?php echo $row['id']; ?>" data-type="plus" data-field="">+
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <!--<div class="product-price">-->
                                                   <span class="ml-4">Ksh<span id="checkout_subtotal<?php echo $row['id']; ?>"><?php echo number_format($row["cartQty"] * ($row["Price"] - $row["Discount"]),2); ?></span></span>
                                                <!--</div>-->
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <?php 
                                    $total = $total + ($row["cartQty"] * ($row["Price"] - $row["Discount"]));  
                                        }      
                                    ?>
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