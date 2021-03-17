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
                                <li>Fruits & Vegetables</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->

            <!-- page-content -->
            <section class="page-content section-ptb-90">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row product-list">
                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/01.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/02.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/03.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/04.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/05.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/06.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/07.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/01.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/02.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/03.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/04.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/05.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/01.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/02.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/03.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/04.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/05.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/06.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/07.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/01.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/02.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/03.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/04.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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

                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/05.png" alt="product"></a>
                                            <span class="batch sale">Sale</span>
                                            <a class="wish-link" href="#">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata">Catagory</a>
                                            <h6><a href="product-detail.php" class="product-title">Product Title Here</a></h6>
                                            <p class="quantity">1 kg</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">$85.00 <del>$100.00</del></div>

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
                                <div class="col-12 text-center mt-4">
                                    <button class="loadMore">Load More</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- page-content -->
<?php
    include('footer.php');
?>