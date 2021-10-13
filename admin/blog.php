<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Blogs</span></h1>
            <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
         <?php
           include "dashboard_tabs.php";
          ?>
         <div class="row">
      <?php
        $blogsrowcount = mysqli_num_rows($blogsList);
      ?>
      <div class="col-md-7">   
      <h6 class="offset-9">Total Number: <?php echo $blogsrowcount; ?></h6>
    </div>
      <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
     <div class="col-md-5">   
      <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-success btn-md active offset-8" role="button" aria-pressed="true"><i class="fa fa-plus-circle"></i>&ensp;Add Blog</a>
       <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">New Blog</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
              <div class="row">
                 <input type="text" name="title" id="title" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Blog Title..." required>
              </div><br>   
                 <div class="row">
                 <textarea name="blog" id="blog" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Blog..." required></textarea>
                  </div>
                  <br>
                  <div class="row">
                 <label for="upload" style="margin-left: 60px">Upload blog image:</label>
                 <input type="file" id="upload" name="upload" style="padding:15px;margin-left: 50px" onchange="displayname(this,$(this))" required>
                  </div><br>
                  <input type="hidden" name="where" id= "where"  value="blog">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="addBlog">Post Blog</button>
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
        foreach($blogsList as $row){
         $id = $row['id'];
         $title = $row['title'];
        $blog = $row['blog'];
        $image = $row['image'];
      ?>
      <div class="jumbotron">
       <div style="text-align:center;">
             <img src="../assets/images/blog/<?php echo $image; ?>" alt="thumb">
        </div>
      <hr class="my-4">
        <h5 class="display-5">Blog#: <?php echo $id; ?></h5>
        <h4><?php echo $title; ?></h4>
        <p class="lead"><?php echo $blog; ?></p>
        <hr class="my-4">
        <h5>Comments</h5>
        <p><?php echo $blog; ?></p>
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
                                <h5 class="modal-title" id="exampleModalScrollableTitle" style="color: grey;">Edit Blog</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                <div class="row">
                                    <input type="text" name="title" id="title<?php echo $id; ?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Blog Title..." value="<?php echo $title; ?>" required>
                                </div><br>
                                    <div class="row">
                                        <textarea name="blog" id="blog<?php echo $id; ?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Blog..." required><?php echo $blog; ?></textarea>
                                    </div>
                                    <br>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary editBlog" style="margin-right: 50px" id="<?php echo $id; ?>">Done</button>
                                </div>    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-6">
                <a class="btn btn-danger btn-md deleteBlog offset-9" href="#" id="<?php echo $id; ?>"  role="button"><i class="fa fa-trash"></i>&ensp;Delete</a>
                </div>
            </div>    
           <?php
            }
            ?>
        
     </div>
           
    <?php
        }
    ?>
<script src="https://cdn.tiny.cloud/1/bgd4u2lbm4kzx7qa4b0f6iqv1ntdafbfq2uewnpfctjgcfsf/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
plugins: [
    "advlist autolink lists link image charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table contextmenu paste "
],
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter      alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 