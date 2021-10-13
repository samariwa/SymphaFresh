<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 
 <!-- Begin Page Content -->
        <div class="container-fluid">
  <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Staff</span><span style="font-size: 15px;"> /Employee Sickoff</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <?php
           include "dashboard_tabs.php";
          ?>

         <div class="row">
      <div class="col-md-6 offset-6">
        <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-success btn-md active float-left offset-7" role="button" aria-pressed="true"><i class="fa fa-plus-circle"></i>&ensp;Sick Off Application</a>
         <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Sick Off Application</h5>
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
                  <label for="sickoffReason" style="margin-left: 60px">Reason:</label><br>
                   </div>
                <div class="row" style="margin-left: 60px">
                 <textarea class="form-control col-md-9" aria-label="Default" aria-describedby="inputGroup-sizing-default" style="font-family: FontAwesome, Arial; font-style: normal;"  name="sickoffReason" id="sickoffReason"  required></textarea> 
                  </div><br>
                 <div class="row">
                 <label for="sickOffStart" style="margin-left: 60px">Start Date:</label>
                 <input type="date" name="sickOffStart" id="sickOffStart" class="form-control col-md-9" required style="padding:15px;margin-left: 60px">
                  </div><br>
                 <div class="row">
                 <input type="number" name="sickoffNumber" id= "sickoffNumber"class="form-control col-md-9" required style="padding:15px;margin-left: 60px" placeholder="Number of Days...">
                  </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="addSickoffApplication">Apply</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div><br>
     <div class="row">
        <h6 class="col-md-6 offset-4">Employee sick leave data for the past month</h6><br>
        </div>
        <div class="row">
       <div class="col-md-8">
           <?php
        $sickoffrowcount = mysqli_num_rows($sickoffList);
      ?>
      <h6 class="offset-8">Total Number: <?php echo $sickoffrowcount; ?></h6>
      </div>
    </div>
        <table id="sickoffEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="8%">Staff #</th>
      <th scope="col" width="14%">Name</th>
      <th scope="col" width="10%">Contact</th>
      <th scope="col" width="10%">Department</th>
      <th scope="col" width="20%">Reason</th>
      <th scope="col" width="12%">Start Date</th>
      <th scope="col" width="12%">Days Off</th>
      <th scope="col" width="12%">Resumption Date</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($sickoffList as $row){
         $count++;
         $id = $row['staffID'];
         $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $contact = $row['contact'];
        $department = $row['department'];
        $reason = $row['Reason'];
        $start = $row['start'];
        $days = $row['days'];
        $end = $row['end'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="uneditable" id="name<?php echo $count; ?>"><?php echo $firstname .' '. $lastname; ?></td>
      <td class="uneditable"id="contact<?php echo $count; ?>"><?php echo $contact ?></td>
      <td class="uneditable" id="department<?php echo $count; ?>"><?php echo $department ?></td>
      <td class="editable" id="reason<?php echo $count; ?>"><?php echo $reason ?></td>
      <td class="editable" id="start<?php echo $count; ?>"><?php echo $start ?></td>
      <td class="editable" id="days<?php echo $count; ?>"><?php echo $days ?></td>
      <td class="uneditable" id="end<?php echo $count; ?>"><?php echo $end ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table><br>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 