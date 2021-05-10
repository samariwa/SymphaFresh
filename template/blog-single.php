<?php
    include('header.php');
    $id = $_GET['id'];
    $blogSingle = mysqli_query($connection,"SELECT * FROM blogs WHERE id = '$id'")or die($connection->error);
    $row = mysqli_fetch_array($blogSingle);
    $title = $row['title'];
    $blog = $row['blog'];
    $image = $row['image'];
    $Date = $row['Created_at'];
    $date = date( 'F d, Y', strtotime($Date));
    $comments = mysqli_query($connection,"SELECT * FROM comments WHERE blog_id = '$id' AND belongs_to = 'blog'")or die($connection->error);
     $comments_count = mysqli_num_rows($comments); 
?>
            <!-- page-header-section start -->
            <div class="page-header-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between justify-content-md-end">
                            <ul class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li><span>/</span></li>
                                <li>Blog Page</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->



            <!-- about section start -->
            <section class="blog-section section-ptb">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 main-content">
                            <div class="entry-wrapper">
                                <div class="entry-single">
                                    <div class="entry-header">
                                       <img src="../assets/images/blog/<?php echo $image; ?>" alt="thumb">
                                    </div>
                                    <div class="entry-content">
                                        <ul class="meta-post list-unstyled pl-0 d-flex">
                                            <li>
                                                <span class="icon"><i class="far fa-user"></i></span>
                                                <a href="#" class="meta-link">Admin</a>
                                            </li>
                                            <li>
                                                <span class="icon"><i class="far fa-clock"></i></span>
                                                <span class="meta-content"><?php echo $date; ?></span>
                                            </li>
                                            <li>
                                                <span class="icon"><i class="far fa-comment-alt"></i></span>
                                                <a href="#" class="meta-link"><?php echo $comments_count; ?> Comment<?php if($comments_count != 1){ ?>s<?php } ?></a>
                                            </li>
                                            <!--<li>
                                                <span class="icon"><i class="far fa-heart"></i></span>
                                                <span class="meta-content">8 Likes</span>
                                            </li>-->
                                        </ul>
                                        <h2 class="title mb-3"><?php echo $title; ?></h2>
                                        <p><?php echo $blog; ?></p>
                                       <!-- <p>Claritas est etiam <span>processus dynamicus</span>, qui sequitur mutationem consuetudium lectorum. Mirum est notare </p>
                                        <blockquote>
                                            <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.</p>
                                            <span>John Dow <span>Company Name</span></span>
                                        </blockquote>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum.</p>
                                        <p>Qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum.</p>-->
                                    </div>
                                  <!--  <ul class="tag-list list-unstyled d-flex">
                                        <li class="mr-4">Tags</li>
                                        <li><a href="#">Mockups</a></li>
                                        <li><a href="#">Art</a></li>
                                        <li><a href="#">WordPress Theme</a></li>
                                        <li><a href="#">UI</a></li>
                                        <li><a href="#">Joomla</a></li>
                                    </ul>

                                    <ul class="share-list list-unstyled">
                                        <li class="mr-4">Share</li>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-tumblr"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                        <li><a href="#"><i class="fas fa-rss"></i></a></li>
                                    </ul>-->
                                </div>

                                <div class="comment-section pt--70 pb--40" id="comments-section">
                                    <h5 class="comment-title mb--30"><i class="far fa-comment-alt"></i> <?php echo $comments_count; ?> Comment<?php if($comments_count != 1){ ?>s<?php } ?></h5>

                                    <div class="comment-list">
                                    <?php
                                        foreach($comments as $row){
                                        $comment_id = $row['id'];
                                        $commenter = $row['commenter'];
                                        $comment = $row['comment'];
                                        $comment_Date = $row['Created_at'];
                                        $comment_date = date( 'l, F d, Y h:i A', strtotime($comment_Date) );
                                        $subcomments = mysqli_query($connection,"SELECT * FROM comments WHERE comment_id = '$comment_id' AND belongs_to = 'comment'")or die($connection->error);
                                        $words = explode(" ", $commenter);
                                        $acronym = "";
                                        foreach ($words as $w) {
                                        $acronym .= $w[0];
                                        }
                                    ?>
                                        <div class="comment-item">
                                            <div class="comment-author d-flex flex-wrap">
                                                <div class="author-image">
                                                    <?php echo $acronym; ?>
                                                </div>
                                                <div class="author-name-info">
                                                    <h6 class="name" id="commenter"><?php echo $commenter; ?></h6>
                                                    <p class="publish-date">Posted on <?php echo $comment_date; ?></p>
                                                    <button id="<?php echo $comment_id; ?>" class="reply-btn reply-button btn">Reply</button>
                                                </div>
                                            </div>
                                            <div class="comment-content">
                                               <?php echo $comment; ?>
                                            </div>
                                            <div class="subcomment-response-section<?php echo $comment_id; ?>">
                                            <?php
                                            if (isset($_SESSION['logged_in'])) {
                                                if ($_SESSION['logged_in'] == TRUE) {
                                                    ?>
                                            <div class="subcomment-response-user<?php echo $comment_id; ?>">

                                            </div>
                                            <?php
                                                }
                                                else{
                                            ?>
                                            <div class="subcomment-response-anonymous<?php echo $comment_id; ?>">

                                            </div>
                                                    <?php
                                                    }
                                                }
                                                else{
                                            ?>
                                            <div class="subcomment-response-anonymous<?php echo $comment_id; ?>">

                                            </div>
                                            <?php
                                            }
                                            ?>
                                            </div>
                                            <?php
                                                foreach($subcomments as $row){
                                                $subcomment_id = $row['id'];
                                                $subcommenter = $row['commenter'];
                                                $subcomment = $row['comment'];
                                                $subcomment_Date = $row['Created_at'];
                                                $subcomment_date = date( 'l, F d, Y h:i A', strtotime($comment_Date) );
                                                $subcomment_words = explode(" ", $commenter);
                                                $subcomment_acronym = "";
                                                foreach ($subcomment_words as $subcomment_w) {
                                                $subcomment_acronym .= $subcomment_w[0];
                                                }
                                            ?>    
                                            <div class="comment-item">
                                                <div class="comment-author d-flex flex-wrap">
                                                <div class="author-image">
                                                    <?php echo $subcomment_acronym; ?>
                                                </div>
                                                    <div class="author-name-info">
                                                        <h6 class="name"><?php echo $subcommenter; ?></h6>
                                                        <p class="publish-date">Posted on <?php echo $subcomment_date; ?></p>
                                                        <!--<a href="#" class="reply-btn">Reply</a>-->
                                                    </div>
                                                </div>
                                                <div class="comment-content">
                                                <?php echo $subcomment; ?>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    <?php
                                       }
                                    ?>

                                    </div>
                                </div>
                                <?php
                                $details_form =  '
                                        <div class="form-item col-lg-7 p-0">
                                            <input type="text" name="name" id="name" placeholder="Full Name" required>
                                            <i class="fas fa-user"></i>
                                        </div>

                                        <div class="form-item col-lg-7 p-0">
                                            <input type="text" name="email" id="email" placeholder="Email Address" required>
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="form-item col-lg-12 p-0">
                                            <textarea name="comment" id="comment" placeholder="Type your comment" required></textarea>
                                            <i class="fab fa-telegram-plane"></i>
                                        </div>
                                    <div>
                                        <input type="hidden" class="comment_token" id="token" name="token">
                                        <input type="hidden" class="blog_id" id="blog_id" name="blog_id" value="'.$id.'">
                                        <button type="submit" class="submit" id="anonymous_comment" >Post Comment</button>
                                    </div>
                                ';

                                ?>
                                <div class="response-comment-section">
                                    <h5 class="response-commen-title mb--30">Leave a comment</h5>

                                    <form action="#" class="respons-contact-form">
                                        <?php
                                    if (isset($_SESSION['logged_in'])) {
                                        if ($_SESSION['logged_in'] == TRUE) {
                                            ?>
                                            <input type="hidden" class="comment_token" id="token" name="token">
                                            <input type="hidden" class="blog_id" id="blog_id" name="blog_id" value="<?php echo $id; ?>">
                                            <input type="hidden" name="hidden_email" id="hidden_email" value="<?php echo $logged_in_email; ?>">
                                        <div class="form-item col-lg-12 p-0">
                                            <textarea name="comment" id="comment" placeholder="Type your comment" required></textarea>
                                            <i class="fab fa-telegram-plane"></i>
                                        </div>
                                            <div>
                                            <button  class="submit" id="user_comment">Post Comment</button>
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
                </div>
            </section>
            <!-- single section end -->
<?php
    include('footer.php');
?>