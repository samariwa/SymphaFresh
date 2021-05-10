<?php
    include('header.php');
?>  
            <!-- blog section start -->
            <section class="blog-section section-ptb">
                <div class="container">
                    <div class="row align-items-center">
                        <?php
                        foreach($blogsList as $row){
                        $id = $row['id'];
                        $title = $row['title'];
                        $blog = $row['blog'];
                        $image = $row['image'];
                        $Date = $row['Created_at'];
                        $date = date( 'F d, Y', strtotime($Date) );
                        ?>
                        <div class="col-md-6 col-lg-4 mb--30">
                            <div class="post-item">
                                <div class="post-thumb">
                                    <a href="blog-single.php?id=<?php echo $id; ?>"><img src="../assets/images/blog/<?php echo $image; ?>" alt="thumb"></a>
                                </div>
                                <div class="post-content border-effect">
                                    <ul class="meta-post list-unstyled pl-0 d-flex justify-content-between">
                                        <li>
                                            <span class="icon"><i class="far fa-clock"></i></span>
                                            <span class="meta-content"><?php echo $date; ?></span>
                                        </li>
                                        <li>
                                            <span class="icon"><i class="far fa-comment-alt"></i></span>
                                            <a href="blog-single.php?id=<?php echo $id; ?>#comments-section" class="meta-link">26 Comments</a>
                                        </li>
                                    </ul>
                                    <h4 class="title mb-3"><?php echo $title; ?></h4>
                                    <h5 class="title mb-3"><a href="blog-single.php?id=<?php echo $id; ?>"><?php echo text_limit($blog, 100); ?></a></h5>
                                    <a href="blog-single.php" class="blog-btn">Read More</a>
                                </div>
                            </div>
                        </div>
                         <?php
                            }
                         ?>
                        
                        <div class="col-12 pt--30">
                            <ul class="pagination justify-content-center justify-content-lg-start">
                                <li><a class="d-flex" href="#"><i class="icon fas fa-angle-left"></i><span class="text">Prev</span></a></li>
                                <li class="d-none d-md-block"><a href="#">1</a></li>
                                <li class="d-none d-md-block"><a href="#">2</a></li>
                                <li class="d-none d-md-block"><a class="active" href="#">3</a></li>
                                <li class="d-none d-md-block"><a href="#">4</a></li>
                                <li class="d-none d-md-block"><a href="#">5</a></li>
                                <li><a class="d-flex" href="#"> <span class="text">Next</span><i class="icon fas fa-angle-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- blog section end -->
<?php
    include('footer.php');
?>