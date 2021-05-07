<?php
 include "admin_nav.php";
  include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/NoteBook</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
          <?php
           include "dashboard_tabs.php";
          ?>
         <br>
         <div class="row">
          <div class="col-md-2 offset-10">
         <button data-toggle="modal" data-target="#exampleModalScrollable" type="button" class="btn btn-success"><i class="fa fa-plus"></i>&ensp;Place Note</button>
         <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Add Note</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                 <div class="row">
                 <input type="text" name="title" id="title" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Note Title..." required>
                  </div><br>
                   <div class="row">
                 <textarea type="text" name="body" id="body" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Message..." required></textarea>
                  </div><br>
                  <div class="row">
                    <p style="margin-left: 100px;">Accessibility:</p>
                    <div class="form-check" style="margin-left: 20px;">
                        <input class="form-check-input" type="radio" name="access" id="public" value="1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                          Public&ensp;<i class="fa fa-globe"></i>
                        </label>
                      </div>     
                  </div>
                  <div class="form-check" style="margin-left: 200px;">
                        <input class="form-check-input" type="radio" name="access" id="private" value="0">
                        <label class="form-check-label" for="exampleRadios2">
                          Private&ensp;<i class="fa fa-shield"></i>
                        </label>
                      </div><br>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="addNote">Place Note</button>
            </form>
            </div>
          </div>
        </div>
      </div>
      </div>
      </div>
         <hr>
        <h2 style="margin-left: 20px;">Public Notes</h2>
        <hr>
        <?php
        $count = 0;
        foreach($publicNotes as $row){
         $count++;
         $id = $row['id'];
         $title = $row['Title'];
         $name = $row['username'];
        $note = $row['Note'];
        $date = $row['Created_at'];
        $day = date( 'l, F d, Y h:i A', strtotime($date) );
        if ($_SESSION['user'] == $name) {
      ?>
        <div class="card mb-3" id = "card<?php echo $id ?>" style="max-width: 50rem;margin-left: 200px;">
        <h5 class="card-header"><?php echo $title; ?></h5>
        <div class="card-body">
          <h5 class="card-title"><?php echo $name; ?></h5>
          <h6><?php echo $day; ?></h6>
          <p class="card-text"><?php echo $note; ?></p>
           <button data-toggle="modal" data-target="#exampleModalScrollable2" id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-primary" role="button" aria-pressed="true" ><i class="fa fa-edit"></i>&ensp;Edit</button>
           <div class="modal fade" id="exampleModalScrollable2" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Note</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                 <div class="row">
                 <input type="text" name="title" id="title<?php echo $id; ?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px" value="<?php echo $title ?>" required>
                  </div><br>
                   <textarea type="text" name="body" id="body<?php echo $id; ?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px"  required><?php echo $note ?></textarea>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary editPublicNote" style="margin-right: 50px" id="<?php echo $id; ?>">Done</button>
            </form>
            </div>
          </div>
        </div>
      </div>
          <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger deletePublicNote" role="button" aria-pressed="true" style="margin-left: 580px"><i class="fa fa-trash"></i>&ensp;Delete</button>
        </div>
        </div>
      <?php
    }
    else{
      ?>
      <div class="card mb-3" style="max-width: 50rem;">
        <h5 class="card-header"><?php echo $title; ?></h5>
        <div class="card-body">
          <h5 class="card-title"><?php echo $name; ?></h5>
          <h6><?php echo $day; ?></h6>
          <p class="card-text"><?php echo $note; ?></p>
        </div>
        </div>
    <?php
    }
    }
    ?><br>
    <hr>
        <h2 style="margin-left: 20px;">Private Notes</h2>
        <hr>
<?php
        $count = 0;
        foreach($privateNotes as $row){
         $count++;
         $id = $row['id'];
         $title = $row['Title'];
         $name = $row['username'];
        $note = $row['Note'];
        $date = $row['Created_at'];
        if ($_SESSION['user'] == $name) {
      ?>
        <div class="card text-white bg-secondary mb-3" style="max-width: 50rem;">
        <h6 class="card-header text-white bg-dark"><?php echo $title; ?></h6>
        <div class="card-body">
          <h5 class="card-title"><?php echo $day; ?></h5>
          <p class="card-text"><?php echo $note; ?></p>
          <button data-toggle="modal" data-target="#exampleModalScrollable3" id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-primary" role="button" aria-pressed="true" ><i class="fa fa-edit"></i>&ensp;Edit</button>
          <div class="modal fade" id="exampleModalScrollable3" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle" style="color: grey;">Edit Note</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                 <div class="row">
                 <input type="text" name="title" id="title<?php echo $id; ?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px" value="<?php echo $title ?>" required>
                  </div><br>
                   <textarea type="text" name="body" id="body<?php echo $id; ?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px"  required><?php echo $note ?></textarea>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary editPrivateNote" style="margin-right: 50px" id="<?php echo $id; ?>">Done</button>
              </form>
            </div>
          </div>
        </div>
      </div>
          <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger deletePrivateNote" role="button" aria-pressed="true" style="margin-left: 580px"><i class="fa fa-trash"></i>&ensp;Delete</button>
        </div>
        </div>
      <?php
    }
    }
    ?><br>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 