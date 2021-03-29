<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Documents</span></h1>
            <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
         <?php
           include "dashboard_tabs.php";
          ?>
         <div class="row">
          <div class="col-md-7">
         <button data-toggle="modal" data-target="#exampleModalScrollable" type="button" class="btn btn-primary"><i class="fa fa-plus"></i>&ensp;New Folder</button>
         <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">New Folder</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                 <div class="row">
                 <input type="text" name="name" id="name" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Folder Name" required>
                  </div><br>
                  <div class="row">
                    <p style="margin-left: 100px;">Accessibility:</p>
                    <div class="form-check" style="margin-left: 20px;">
                        <input class="form-check-input" type="radio" name="access" id="public" value="1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                          Department&ensp;<i class="fa fa-globe"></i>
                        </label>
                      </div>     
                  </div>
                  <div class="form-check" style="margin-left: 200px;">
                        <input class="form-check-input" type="radio" name="access" id="private" value="0">
                        <label class="form-check-label" for="exampleRadios2">
                          Individual&ensp;<i class="fa fa-shield"></i>
                        </label>
                      </div><br>
                   <div class="row">
                 <select type="text" name="location" id="location" class="form-control col-md-9" style="padding-right:15px;padding-left:15px;margin-left: 60px" required onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                  <option value="" selected="selected" disabled>Location...</option>
                  <?php
                    $count = 0;
                    foreach($categoriesList as $row){
                     $count++;
                     $category_id = $row['id'];
                    $category = $row['Category_Name'];
                  ?>
                   <option value="<?php echo $category_id; ?>"><?php echo $category; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                  </div><br>
                  <div class="row">
                 <select type="text" name="location" id="location" class="form-control col-md-9" style="padding-right:15px;padding-left:15px;margin-left: 60px" required onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                  <option value="" selected="selected" disabled>Location...</option>
                  <?php
                    $count = 0;
                    foreach($categoriesList as $row){
                     $count++;
                     $category_id = $row['id'];
                    $category = $row['Category_Name'];
                  ?>
                   <option value="<?php echo $category_id; ?>"><?php echo $category; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                  </div><br>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="uploadFile">Add Folder</button>
            </form>
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="col-md-5">
         <button data-toggle="modal" data-target="#exampleModalScrollable2" type="button" class="btn btn-success offset-8"><i class="fa fa-upload"></i>&ensp;Upload File</button>
         <div class="modal fade" id="exampleModalScrollable2" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Upload File</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                 <div class="row">
                 <input type="text" name="name" id="name" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="File Name" required>
                  </div><br>
                  <div class="row">
                 <input type="text" name="description" id="description" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="File Description" required>
                  </div><br>
                  <div class="row">
                 <label for="upload" style="margin-left: 60px">Select a file:</label>
                 <input type="file" id="upload" name="upload" style="padding:15px;margin-left: 50px" onchange="displayname(this,$(this))" required>
                  </div><br>
                   <div class="row">
                 <select type="text" name="location" id="location" class="form-control col-md-9" style="padding-right:15px;padding-left:15px;margin-left: 60px" required onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                  <option value="" selected="selected" disabled>Location...</option>
                  <?php
                    $count = 0;
                    foreach($categoriesList as $row){
                     $count++;
                     $category_id = $row['id'];
                    $category = $row['Category_Name'];
                  ?>
                   <option value="<?php echo $category_id; ?>"><?php echo $category; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                  </div><br>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="uploadFile">Upload</button>
            </form>
            </div>
          </div>
        </div>
      </div>
      </div>   
      </div>
      <br>
      <h4>Public Folder&ensp;<i class="fa fa-folder-open"></i></h4>

      <br>
      <h4>Private Folder&ensp;<i class="fa fa-folder-open"></i></h4>

      <br>
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 