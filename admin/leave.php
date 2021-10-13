<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 
 <!-- Begin Page Content -->
        <div class="container-fluid">
  <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Staff</span><span style="font-size: 15px;"> /Employee Leave</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <!-- Content Row -->
          <<?php
           include "dashboard_tabs.php";
          ?>

         <div class="row">
      <div class="col-md-6 offset-6">
        <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-success btn-md active float-left offset-7" role="button" aria-pressed="true"><i class="fa fa-plus-circle"></i>&ensp;Leave Application</a>
         <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Leave Application</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                <div class="row">
                 <select type="text" name="employee" id="employee" class="form-control col-md-9" style="padding-right:15px;padding-left:15px;margin-left: 60px" required onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();' required>
                  <option value="" selected="selected" disabled>Employee Name...</option>
                  <?php
                    $count = 0;
                    foreach($employeesList as $row){
                     $count++;
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $id = $row['staffID'];
                  ?>
                   <option value="<?php echo $id; ?>"><?php echo $firstname .' '. $lastname; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                  </div><br>
                 <div class="row">
                 <label for="leaveStart" style="margin-left: 60px">Start Date:</label>
                 <input type="date" name="leaveStart" id="leaveStart" class="form-control col-md-9" required style="padding:15px;margin-left: 60px">
                  </div><br>
                 <div class="row">
                 <input type="number" name="leaveNumber" id= "leaveNumber"class="form-control col-md-9" required style="padding:15px;margin-left: 60px" placeholder="Number of Days...">
                  </div><br>
                  <div class="row">
                 <select type="text" name="standIn" id="standIn" class="form-control col-md-9" style="padding-right:15px;padding-left:15px;margin-left: 60px" required onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();' required>
                  <option value="" selected="selected" disabled>Stand In Employee Name...</option>
                  <?php             
                    $count = 0;
                    foreach($employeesList as $row3){
                     $count++;
                    $firstname = $row3['firstname'];
                    $lastname = $row3['lastname'];
                    $staffid = $row3['staffID'];
                  ?>
                   <option value="<?php echo $staffid; ?>"><?php echo $firstname .' '. $lastname; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="addLeaveApplication">Apply</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div><br>
     <div class="row">
        <h6 class="col-md-8 offset-2">Employee leave data for the past month. The maximum leave days annually is 21 days.</h6><br>
        </div>
        <div class="row">
       <div class="col-md-8">
           <?php
        $leaverowcount = mysqli_num_rows($leaveList);
      ?>
      <h6 class="offset-8">Total Number: <?php echo $leaverowcount; ?></h6>
      </div>
    </div>
        <table id="leaveEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="9%">Staff #</th>
      <th scope="col" width="14%">Name</th>
      <th scope="col" width="9%">Contact</th>
      <th scope="col" width="10%">Department</th>
      <th scope="col" width="12%">Days Left</th>
      <th scope="col" width="12%">Start Date</th>
      <th scope="col" width="12%">Days Taken</th>
      <th scope="col" width="17%">Resumption Date</th>
      <th scope="col" width="12%">Stand In</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($leaveList as $row){
         $count++;
         $id = $row['staffID'];
         $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $contact = $row['contact'];
        $department = $row['department'];
        $standIn = $row['standIn'];
        $replace = mysqli_query($connection,"SELECT firstname , lastname, staffID from users where staffID = '$standIn'")or die($connection->error);
         $row2 = mysqli_fetch_array($replace);
        $replacement1 = $row2['firstname'];
        $replacement2 = $row2['lastname'];
        $left = $row['daysLeft'];
        $start = $row['start'];
        $days = $row['days'];
        $end = $row['end'];
        $standInId = $row['staffID'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="uneditable" id="name<?php echo $count; ?>"><?php echo $firstname .' '. $lastname; ?></td>
      <td class="uneditable"id="contact<?php echo $count; ?>"><?php echo $contact ?></td>
      <td class="uneditable" id="department<?php echo $count; ?>"><?php echo $department ?></td>
      <td class="uneditable" id="left<?php echo $count; ?>"><?php echo $left ?></td>
      <td class="editable" id="start<?php echo $count; ?>"><?php echo $start ?></td>
      <td class="editable" id="days<?php echo $count; ?>"><?php echo $days ?></td>
      <td class="uneditable" id="end<?php echo $count; ?>"><?php echo $end ?></td>
      <td class="editable" id="standIn<?php echo $count; ?>"><?php echo $replacement1 .' '. $replacement2; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table><br>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 