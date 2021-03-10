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
                                <li>FAQ Page</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->



            <!-- faq section start -->
            <section class="faq-section section-ptb">
                <div class="container">
                    <div class="faq-container">
                        <div class="accordion" id="faqaccordion">
                            <div class="faq">
                                <div class="faq-header" id="faq1">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        <span class="icon">
                                            <i class="fas fa-plus"></i>
                                            <i class="fas fa-minus"></i>
                                        </span>
                                        What is Eflux?
                                    </button>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="faq1" data-parent="#faqaccordion">
                                    <div class="faq-body">
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel,</p>
                                    </div>
                                </div>
                            </div>
                            <div class="faq">
                                <div class="faq-header" id="faq2">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <span class="icon">
                                            <i class="fas fa-plus"></i>
                                            <i class="fas fa-minus"></i>
                                        </span>
                                        How to update application new features?
                                    </button>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="faq2" data-parent="#faqaccordion">
                                    <div class="faq-body">
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel,</p>
                                    </div>
                                </div>
                            </div>
                            <div class="faq">
                                <div class="faq-header" id="faq3">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <span class="icon">
                                            <i class="fas fa-plus"></i>
                                            <i class="fas fa-minus"></i>
                                        </span>
                                        How can i handle refund policy
                                    </button>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="faq3" data-parent="#faqaccordion">
                                    <div class="faq-body">
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel,</p>
                                    </div>
                                </div>
                            </div>

                            <div class="faq">
                                <div class="faq-header" id="faq4">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                        <span class="icon">
                                            <i class="fas fa-plus"></i>
                                            <i class="fas fa-minus"></i>
                                        </span>
                                        How to connect with the support to improve app experience
                                    </button>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="faq4" data-parent="#faqaccordion">
                                    <div class="faq-body">
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel,</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- faq section end -->
<?php
include('footer.php');
?>