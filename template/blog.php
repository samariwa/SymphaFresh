
<?php
    include('header.php');
?>  
            <!-- blog section start -->
            <section class="blog-section section-ptb">
                <div class="container pagination_data">
                    <div class="row align-items-center">
                        <?php
                        $records_per_page = 9;
                        $page = 1;
                        $start_from = ($page - 1) * $records_per_page;
                        $blogsrowcount = mysqli_num_rows($blogsList);
                        $total_pages = ceil($blogsrowcount / $records_per_page);
                        $blogList = mysqli_query($connection,"SELECT * FROM blogs ORDER BY id ASC LIMIT $start_from,$records_per_page")or die($connection->error);
                        foreach($blogList as $row){
                        $id = $row['id'];
                        $title = $row['title'];
                        $blog = $row['blog'];
                        $image = $row['image'];
                        $Date = $row['Created_at'];
                        $date = date( 'F d, Y', strtotime($Date) );
                        $comments = mysqli_query($connection,"SELECT * FROM comments WHERE blog_id = '$id' AND belongs_to = 'blog'")or die($connection->error);
                        $comments_count = mysqli_num_rows($comments); 
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
                                            <a href="blog-single.php?id=<?php echo $id; ?>#comments-section" class="meta-link"><?php echo $comments_count; ?> Comment<?php if($comments_count != 1){ ?>s<?php } ?></a>
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
                     </div>
                        <div class="col-12 pt--30">
                                <ul class="pagination justify-content-center justify-content-lg-start">
                                    <li><a class="d-flex pagination_link" href="#" style="pointer-events: none;"></a></li>
                                    <?php
                                   for($i=1; $i<=$total_pages; $i++){
                                    ?>
                                   <li class="d-none d-md-block"><a class="pagination_link
                                   <?php
                                    if( $page == $i ){
                                    ?>
                                        active 
                                    <?php    
                                    }
                                    ?>
                                    " href="#" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php 
                                   }
                                   ?>
                                    <li><a class="d-flex pagination_link" href="#" id="<?php echo $page + 1; ?>"> <span class="text">Next</span><i class="icon fas fa-angle-right"></i></a></li>
                                </ul>
                        </div>
                </div>
            </section>
            <!-- blog section end -->
<?php
    include('footer.php');
?>


