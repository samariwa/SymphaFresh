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
                                <li>Site Map</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->



            <!-- about section start -->
            <section class="about-section section-ptb">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12 order-lg-last pr-xl-5">
                            <div class="about-content mb-4 mb-lg-0 pr-lg-5">
                                <h3>About Us</h3>
                                <ul>
                                    <li><a href="about.php#who_we_are">Who We Are</a></li>
                                    <li><a href="about.php#mission&vision">Mission & Vision</a></li>
                                    <li><a href="faq.php">FAQs</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="row align-items-center">
                        <div class="col-lg-12 order-lg-last pr-xl-5">
                            <div class="about-content mb-4 mb-lg-0 pr-lg-5">
                                <h3>Our Products</h3>
                                <div class="row">
                                    <?php
                                        foreach($categoriesList as $row){
                                            $stockmenu = mysqli_query($connection,"SELECT id, Name from stock where Category_id = '".$row['id']."'")or die($connection->error);                                        
                                    ?>
                                    <div class="col-3">
                                        <h5><?php echo $row['Category_Name']; ?></h5>
                                        <ul>
                                            <?php
                                                foreach($stockmenu as $row2){   
                                            ?>
                                            <li><a href="product-list.php#<?php echo $row2['Name']; ?>"><?php echo $row2['Name']; ?></a></li>
                                            <?php
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="row align-items-center">
                        <div class="col-lg-12 order-lg-last pr-xl-5">
                            <div class="about-content mb-4 mb-lg-0 pr-lg-5">
                                <h3>Contact Us</h3>
                                <ul>
                                    <li><a href="contact.php">Contact Us</a></li>
                                    <li><a href="#">Facebook</a></li>
                                    <li><a href="#">Twitter</a></li>
                                    <li><a href="#">Instagram</a></li>
                                    <li><a href="#">YouTube</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="row align-items-center">
                        <div class="col-lg-12 order-lg-last pr-xl-5">
                            <div class="about-content mb-4 mb-lg-0 pr-lg-5">
                                <h3>Learn More</h3>
                                <ul>
                                    <li><a href="blog.php">Blog</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </section>


<?php
include('footer.php');
?>