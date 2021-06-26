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
                                <li>About Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->



            <!-- about section start -->
            <section class="about-section section-ptb" id="who_we_are">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7 order-lg-last pr-xl-5">
                            <div class="about-content mb-4 mb-lg-0 pr-lg-5">
                                <h3>Who We Are</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. consequuntur quibusdam enim expedita sed nesciunt incidunt accusamus adipisci officia libero laboriosam!</p>
                                <p>Proin gravida nibh vel velit auctor aliquet. nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vultate cursus a sit amet mauris. Duis sed odio sit amet nibh vultate cursus a sit amet mauris.</p>
                            </div>
                        </div>
                        <div class="col-lg-5 order-lg-first">
                            <div class="about-image">
                                <img src="assets/images/about/bg3.jpeg" alt="about image">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

             <!-- about-coroussel-section start -->
             <section class="info-box-section">
                <div class="container">
                    <div class="info-box-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="info-box-item d-sm-flex text-center text-sm-left">
                                    <div class="info-icon">
                                        <img src="assets/images/info-item/quality.png" height="20px" width="30px" alt="info icon">
                                    </div>
                                    <div class="info-content">
                                        <h6>Superior Quality</h6>
                                        <p>Lorem ipsum dolor sit amet, conse ctetur adipisicing elit, sed do.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="info-box-item d-sm-flex text-center text-sm-left">
                                    <div class="info-icon">
                                        <img src="assets/images/info-item/fresh.png" height="20px" width="20px" alt="info icon">
                                    </div>
                                    <div class="info-content">
                                        <h6>Always Fresh</h6>
                                        <p>Lorem ipsum dolor sit amet, conse ctetur adipisicing elit, sed do.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="info-box-item d-sm-flex text-center text-sm-left">
                                    <div class="info-icon">
                                        <img src="assets/images/info-item/free_delivery.png" height="20px" width="55px" alt="info icon">
                                    </div>
                                    <div class="info-content">
                                        <h6>Free Delivery</h6>
                                        <p>Lorem ipsum dolor sit amet, conse ctetur adipisicing elit, sed do.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="info-box-item d-sm-flex text-center text-sm-left">
                                    <div class="info-icon">
                                        <img src="assets/images/info-item/support.png" alt="info icon">
                                    </div>
                                    <div class="info-content">
                                        <h6>24/7 Support</h6>
                                        <p>Lorem ipsum dolor sit amet, conse ctetur adipisicing elit, sed do.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- about-coroussel-section end -->
            <br><br>
            <div class="container" style="text-align:center" id="mission&vision">
            <div class="row align-items-center">
                <div class="col-lg-12 order-lg-last pr-xl-5">
                    <div class="about-content mb-4 ml-5 mb-lg-0 pr-lg-5">
                        <h4>Mission</h4>
                        <p><?php echo $mission; ?></p>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row align-items-center">
                <div class="col-lg-12 order-lg-last pr-xl-5">
                    <div class="about-content mb-4 ml-5 mb-lg-0 pr-lg-5">
                        <h4>Vision</h4>
                        <p><?php echo $vision; ?></p>
                    </div>
                </div>
            </div>
            </div>
            <section class="about-section section-ptb">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7 order-lg-last pr-xl-5">
                            <div class="about-content mb-4 mb-lg-0 pr-lg-5">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. consequuntur quibusdam enim expedita sed nesciunt incidunt accusamus adipisci officia libero laboriosam!</p>
                                <p>Proin gravida nibh vel velit auctor aliquet. nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vultate cursus a sit amet mauris. Duis sed odio sit amet nibh vultate cursus a sit amet mauris.</p>
                            </div>
                        </div>
                        <div class="col-lg-5 order-lg-first">
                            <div class="about-image">
                                <img src="assets/images/halal.png" alt="halal">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- about section end -->
<?php
include('footer.php');
?>