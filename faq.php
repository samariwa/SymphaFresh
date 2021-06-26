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
                            <?php
                                foreach($faqsList as $row){
                                $id = $row['id'];
                                $question = $row['question'];
                                $answer = $row['answer'];
                            ?>
                                <div class="faq">
                                    <div class="faq-header" id="faq<?php echo $id; ?>">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $id; ?>" aria-expanded="false" aria-controls="collapse<?php echo $id; ?>">
                                            <span class="icon">
                                                <i class="fas fa-plus"></i>
                                                <i class="fas fa-minus"></i>
                                            </span>
                                            <?php echo $question; ?>
                                        </button>
                                    </div>

                                    <div id="collapse<?php echo $id; ?>" class="collapse show" aria-labelledby="faq<?php echo $id; ?>" data-parent="#faqaccordion">
                                        <div class="faq-body">
                                            <p><?php echo $answer; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </section>
            <!-- faq section end -->
<?php
include('footer.php');
?>