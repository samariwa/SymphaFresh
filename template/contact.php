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
                                <li>Contact Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->



            <!-- contact section start -->
            <section class="contact-section section-ptb">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 mb-4 mb-lg-0">
                            <div class="contact-info-wrapper">
                                <div class="contact-info">
                                    <h4>Get In Touch</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. consequuntur quibusdam enim expedita sed nesciunt incidunt </p>
                                    <ul class="contact-details">
                                        <li>
                                            <span class="title">Address</span>
                                            <span class="desc"><?php echo $physical_address; ?></span>
                                        </li>
                                        <li>
                                            <span class="title">Phone</span>
                                            <span class="desc"><?php echo $contact_number; ?> - Office <br> <?php echo $contact_number; ?> - Mobile</span>
                                        </li>
                                        <li>
                                            <span class="title">Email</span>
                                            <span class="desc"><?php echo $authenticator_email; ?> <br> <?php echo $authenticator_email; ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="contact-form-area">
                                <form action="#" class="contact-form">
                                <?php
                                $details_form =  '
                                <div class="input-item">
                                        <input type="text" name="name" id="full_name" placeholder="Full Name" required>
                                        <i class="fas fa-user"></i>
                                    </div>

                                    <div class="input-item">
                                        <input type="text" name="phone" id="mobile_number" placeholder="Your Phone Number" required>
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>

                                    <div class="input-item">
                                        <input type="email" name="email" id="email_address" placeholder="Email Address" required>
                                        <i class="fas fa-envelope"></i>
                                    </div>

                                    <div class="input-item">
                                        <input type="text" name="subject" id="subject" placeholder="Subject" required>
                                        <i class="fas fa-heading"></i>
                                    </div>
                                    

                                    <div class="input-item">
                                        <textarea name="message" id="message" placeholder="Type Here Message" required></textarea>
                                        <i class="fas fa-paper-plane"></i>
                                    </div>
                                    
                                    <div>
                                        <input type="hidden" class="contact_page_token" id="token" name="token">
                                        <button type="submit" class="submit" id="anonymous_contact" >Send Message</button>
                                    </div>
                                ';
                                    if (isset($_SESSION['logged_in'])) {
                                        if ($_SESSION['logged_in'] == TRUE) {
                                            ?>
                                            <input type="hidden" class="contact_page_token" id="token" name="token">
                                            <input type="hidden" name="hidden_email" id="hidden_email" value="<?php echo $logged_in_email; ?>">
                                            <div class="input-item">
                                            <input type="text" name="subject" id="subject" placeholder="Subject">
                                            <i class="fas fa-heading"></i>
                                        </div>
                                            <div class="input-item">
                                                <textarea name="message" id="message" placeholder="Type Here Message"></textarea>
                                                <i class="fas fa-paper-plane"></i>
                                            </div>
                                            <div>
                                                <button type="submit" class="submit" id="user_contact">Send Message</button>
                                            </div>
                                            <?php
                                         }
                                        else{
                                    echo $details_form;
                                            }
                                        }
                                        else{
                                    echo $details_form;
                                    }
                                    ?> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- contact section end -->
<?php
  include('footer.php');
?>