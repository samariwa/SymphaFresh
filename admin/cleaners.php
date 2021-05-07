<?php
 include "admin_nav.php";
  include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Staff</span><span style="font-size: 15px;"> /Cleaners</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

         <?php
           include "dashboard_tabs.php";
          ?>

   <div class="row">
    <div class="col-md-2">
             <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-success btn-md active" role="button" aria-pressed="true" ><i class="fa fa-plus-circle"></i>&ensp;New Cleaner</a>
       <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">New Cleaner</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                 <div class="row">
                 <input type="text" name="fname" id="fname" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder=" First Name..." required>
                  </div><br>
                  <div class="row">
                 <input type="text" name="lname" id="lname" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Last Name..." required>
                  </div><br>
                  <div class="row">
                 <input type="text" name="contact" id="contact" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Contact Number..." required>
                  </div><br>
                  <div class="row">
                 <input type="text" name="staffId" id="staffId" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Staff Id..." required>
                  </div><br>
                  <div class="row">
                 <input type="text" name="nationalId" id="nationalId" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="National Id..." required>
                  </div><br>
                  <div class="row">
                 <input type="text" name="yob" id="yob" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Year of Birth..." required>
                  </div><br>
                  <div class="row">
                 <select id="gender" name="gender" class="form-control col-md-9" required style="margin-left: 60px">
                                    <option value="">Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                    </select>
                  </div><br>
                  <div class="row">
                 <input type="text" name="salary" id="salary" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Salary..." required>
                  </div>
                  <input type="hidden" name="where" id= "where"  value="cleaner">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="addCleaner">Add Cleaner</button>
            </form>
            </div>
          </div>
        </div>
      </div>
      </div>
       <div class="col-md-3">
      <a href="payroll.php" class="btn btn-warning btn-md active offset-1" role="button" aria-pressed="true" >Employee Payroll</a>
      </div>
      <div class="col-md-2">
           <?php
        $cleanersrowcount = mysqli_num_rows($cleanersStaffList);
      ?>
      <h6 class="offset-1">Total Number: <?php echo $cleanersrowcount; ?></h6>
      </div>
      <div class="col-md-2">
      <a href="sickoff.php" class="btn btn-light btn-md active offset-4" role="button" aria-pressed="true" >Employee Sick Off</a>
      </div>
    <div class="col-md-2">
      <a href="leave.php" class="btn btn-primary btn-md active offset-7" role="button" aria-pressed="true" >Employee Leave</a>
      </div>
        </div><br>

        <table id="cleanersEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="5%">#</th>
      <th scope="col" width="18%">Name</th>
      <th scope="col" width="13%">Contact</th>
      <th scope="col" width="8%">Gender</th>
      <th scope="col" width="10%">Staff ID</th>
      <th scope="col" width="13%">National ID</th>
       <th scope="col" width="8%">Age</th>
      <th scope="col" width="13%">Salary</th>
      <th scope="col" width="13%">KRA</th>
        <th scope="col" width="13%">NSSF</th>
        <th scope="col" width="13%">NHIF</th>
      <th scope="col"width="32%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($cleanersStaffList as $row){
         $count++;
        $id = $row['id'];
        $fname = $row['firstname'];
        $lname = $row['lastname'];
        $contact = $row['number'];
        $gender = $row['gender'];
        $staffId = $row['staffID'];
        $nationalId = $row['nationalID'];
        $yob = $row['yob'];
        $salary = $row['salary'];
        $kra = $row['KRA'];
        $nssf = $row['NSSF'];
        $nhif = $row['NHIF'];
        $name = $fname.' '.$lname;
        $current = date("Y");
        $age = $current - $yob;
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="uneditable" id="name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="editable" id="contact<?php echo $count; ?>"><?php echo $contact; ?></td>
      <td class="uneditable" id="gender<?php echo $count; ?>"><?php echo $gender; ?></td>
      <td class="editable" id="staffId<?php echo $count; ?>"><?php echo $staffId; ?></td>
      <td class="editable" id="nationalId<?php echo $count; ?>"><?php echo $nationalId; ?></td>
      <td class="uneditable" id="age<?php echo $count; ?>"><?php echo $age; ?></td>
      <td class="editable" id="salary<?php echo $count; ?>">Ksh. <?php echo $salary; ?></td>
       <td class="editable" id="kra<?php echo $count; ?>"><?php echo $kra; ?></td>
        <td class="editable" id="nssf<?php echo $count; ?>"><?php echo $nssf; ?></td>
         <td class="editable" id="nhif<?php echo $count; ?>"><?php echo $nhif; ?></td>
       <td>
        <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteCook" role="button" aria-pressed="true" ><i class="fa fa-user-times"></i>&ensp;Delete</button>
       </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>      

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 