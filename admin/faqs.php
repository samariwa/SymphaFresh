<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/FAQs</span></h1>
            <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
         <?php
           include "dashboard_tabs.php";
          ?>
         <div class="row">
      <?php
        $faqsrowcount = mysqli_num_rows($faqsList);
      ?>
      <div class="col-md-7">   
      <h6 class="offset-9">Total Number: <?php echo $faqsrowcount; ?></h6>
    </div>
      <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
     <div class="col-md-5">   
      <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-success btn-md active offset-8" role="button" aria-pressed="true"><i class="fa fa-plus-circle"></i>&ensp;Add FAQ</a>
       <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">New FAQ</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                 <div class="row">
                 <textarea name="question" id="question" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Question..." required></textarea>
                  </div>
                  <br>
                  <div class="row">
                 <textarea name="answer" id="answer" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Answer..." required></textarea>
                  </div>
                  <input type="hidden" name="where" id= "where"  value="faq">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="addFAQ">Add FAQ</button>
            </form>
            </div>
          </div>
        </div>
      </div>
        <?php
        }
        ?>
     </div>   
    </div><br> 
    <?php
        foreach($faqsList as $row){
         $id = $row['id'];
        $question = $row['question'];
        $answer = $row['answer'];
      ?>
      <div class="jumbotron">
        <h5 class="display-5">FAQ#: <?php echo $id; ?></h5>
        <h4>Question</h4>
        <p class="lead"><?php echo $question; ?></p>
        <hr class="my-4">
        <h4>Answer</h4>
        <p><?php echo $answer; ?></p>
        <?php
            if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {
           ?>
           <div class="row">
           <div class="col-6">
              <button data-toggle="modal" data-target="#exampleModalScrollable<?php echo $id; ?>" id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-primary" role="button" aria-pressed="true" ><i class="fa fa-edit"></i>&ensp;Edit</button>
              <div class="modal fade" id="exampleModalScrollable<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle" style="color: grey;">Edit FAQ</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <div class="row">
                                        <textarea name="question" id="question<?php echo $id; ?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Question..." required><?php echo $question; ?></textarea>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <textarea name="answer" id="answer<?php echo $id; ?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Answer..." required><?php echo $answer; ?></textarea>
                                    </div>
                                    <br>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary editFAQ" style="margin-right: 50px" id="<?php echo $id; ?>">Done</button>
                                </div>    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-6">
                <a class="btn btn-danger btn-md deleteFAQ offset-9" href="#" id="<?php echo $id; ?>"  role="button"><i class="fa fa-trash"></i>&ensp;Delete</a>
                </div>
            </div>    
           <?php
            }
            ?>
        
     </div>
           
    <?php
        }
    ?>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 