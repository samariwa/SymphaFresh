<?php
include('header.php');
?>             <!-- page-header-section start -->
            <div class="page-header-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between justify-content-md-start">
                            <ul class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li><span>/</span></li>
                                <li>Fruits & Vegetables</li>
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
                            <div class="form-item contact-number-item bg-color-white box-shadow p-3 p-lg-5 border-radius5">
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
                            </div>

                            <div class="form-item billing-item bg-color-white box-shadow p-3 p-lg-5 border-radius5">
                                <h6>User Accounts</h6>
                                <form action="#" class="billing-form">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-item">
                                                <label>First Name*</label>
                                                <input type="text" name="name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-item">
                                                <label>Last Name*</label>
                                                <input type="text" name="name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-item">
                                                <label>Country*</label>
                                                <div class="flux-custom-select">
                                                    <select>
                                                      <option value="0">Country</option>
                                                      <option value="1">USA</option>
                                                      <option value="2"> UK</option>
                                                      <option value="3">Spain</option>
                                                      <option value="4">Italy</option>
                                                      <option value="5">Portgal</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-item">
                                                <label>Address*</label>
                                                <input type="text" name="address">
                                                <input type="text" name="address">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-item">
                                                <label>Town or City*</label>
                                                <div class="flux-custom-select">
                                                    <select>
                                                      <option value="0">City</option>
                                                      <option value="1">British Columbia</option>
                                                      <option value="2">Manitoba</option>
                                                      <option value="3">New Brunswick</option>
                                                      <option value="4">Nova Scotia</option>
                                                      <option value="5">Ontario</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-item">
                                                <label>Email*</label>
                                                <input type="text" name="email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-item">
                                                <label>Mobile*</label>
                                                <input type="text" name="mobile">
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
                                        <label>Cash on delivary</label>
                                    </div>

                                    <div class="input-item radio">
                                        <input type="radio" name="payment" value="paypal">
                                        <label>Paypal</label>
                                    </div>
                                </form>
                                <div class="payment-image">
                                    <img src="assets/images/payment/01.png" alt="payment">
                                </div>
                                <div class="text-right">
                                    <a href="#" class="place-order-btn">Place Order</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="cart-item sitebar-cart bg-color-white box-shadow p-3 p-lg-5 border-radius5">
                                <div class="cart-product-container">
                                    <div class="cart-product-item">
                                        <div class="row align-items-center">
                                            <div class="col-6 p-0">
                                                <div class="thumb">
                                                    <a onclick="openModal()"><img src="assets/images//products/cart/01.png" alt="products"></a>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="product-content">
                                                    <a onclick="openModal()" class="product-title">Daisy Cont Oil</a>
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
                                                    <del>Ksh8.00</del><span class="ml-4">Ksh5.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="cart-product-item">
                                        <div class="row align-items-center">
                                            <div class="col-6 p-0">
                                                <div class="thumb">
                                                    <a onclick="openModal()"><img src="assets/images//products/cart/02.png" alt="products"></a>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="product-content">
                                                    <a onclick="openModal()" class="product-title">Daisy Cont Oil</a>
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
                                                    <del>Ksh8.00</del><span class="ml-4">Ksh5.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="cart-product-item">
                                        <div class="row align-items-center">
                                            <div class="col-6 p-0">
                                                <div class="thumb">
                                                    <a onclick="openModal()"><img src="assets/images//products/cart/04.png" alt="products"></a>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="product-content">
                                                    <a onclick="openModal()" class="product-title">Daisy Cont Oil</a>
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
                                                    <del>Ksh8.00</del><span class="ml-4">Ksh5.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="cart-product-item">
                                        <div class="row align-items-center">
                                            <div class="col-6 p-0">
                                                <div class="thumb">
                                                    <a onclick="openModal()"><img src="assets/images//products/cart/03.png" alt="products"></a>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="product-content">
                                                    <a onclick="openModal()" class="product-title">Daisy Cont Oil</a>
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
                                                    <del>Ksh8.00</del><span class="ml-4">Ksh5.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                        <p class="saving d-flex justify-content-between">
                                            <span>Total Savings</span> 
                                            <span>Ksh11.00</span>
                                        </p>
                                        <p class="total-price d-flex justify-content-between">
                                            <span>Total</span> 
                                            <span>KSh20.00</span>
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