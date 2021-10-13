<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 
 <!-- Begin Page Content -->
        <div class="container-fluid">
  <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Staff</span><span style="font-size: 15px;"> /Employee Payroll</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

         <?php
           include "dashboard_tabs.php";
          ?>

         <div class="row">
          <div class="col-md-4">
            <a href="kra_rates.php" class="btn btn-secondary btn-md active float-left ml-3" role="button" aria-pressed="true">KRA Tax Rates</a>
          </div>
          <div class="col-md-4">
            <a href="nssf_rates.php" class="btn btn-warning btn-md active float-left offset-4" role="button" aria-pressed="true">NSSF Rates</a>
          </div>
          <div class="col-md-4">
            <a href="nhif_rates.php" class="btn btn-info btn-md active float-left offset-7" role="button" aria-pressed="true">NHIF Rates</a>
          </div>
    </div><br>
     <div class="row">
      <div class="col-md-10 offset-2">
        <h6 class="col-md-6 offset-3">Select employee to print pay slip.</h6>
        </div>
     </div>
     <div class="row">
       <div class="col-md-8">
           <?php
        $employeesrowcount = mysqli_num_rows($employeesList);
      ?>
      <h6 class="offset-8">Total Number: <?php echo $employeesrowcount; ?></h6>
      </div>
     </div>
     <form>
        <table id="employeePayslipSearch" class="table table-striped table-hover" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="5%">Select</th>
      <th scope="col" width="3%">Staff #</th>
      <th scope="col" width="13%">Name</th>
      <th scope="col" width="10%">National #</th>
      <th scope="col" width="12%">Gross Income</th>
      <th scope="col" width="10%">KRA Deduction</th>
      <th scope="col" width="10%">NSSF Deduction</th>
      <th scope="col"width="10%">NHIF Deduction</th>
      <th scope="col"width="11%">Payable Income</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($employeesList as $row){
         $count++;
         $id = $row['staffID'];
         $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $salary = $row['salary'];
        $national = $row['nationalID'];
        $KRA = $row['KRA'];
        $NSSF = $row['NSSF'];
        $NHIF = $row['NHIF'];
        $kra = 0;
        if($KRA != ''){
        if ($salary > 0 && $salary <= 24000) {
          $kra = 0.1 * $salary;
        }
        else if ($salary >= 24001 && $salary <= 40667) {
          $kra = 0.15 * $salary;
        }
        else if ($salary >= 40668 && $salary <= 57333) {
          $kra = 0.2 * $salary;
        }
        else if ($salary >= 57334 ) {
          $kra = 0.25 * $salary;
        }
        }
        $nssf = 0;
        if($NSSF != ''){
        if ($salary > 0 && $salary < 3000) {
          $nssf = 0;
        }
        else if ($salary >= 3000 && $salary < 4500) {
          $nssf = 180;
        }
        else if ($salary >= 4500 && $salary < 6000) {
          $nssf = 270;
        }
        else if ($salary >= 6000 ) {
          $nssf = 360;
        }
        }
        $nhif = 0;
        if($NHIF != ''){
        if ($salary > 0 && $salary <= 5999) {
          $nhif = 150;
        }
        else if ($salary >= 6000 && $salary <= 7999) {
          $nhif = 300;
        }
        else if ($salary >= 8000 && $salary <= 11999) {
          $nhif = 400;
        }
        else if ($salary >= 12000 && $salary <= 14999) {
          $nhif = 500;
        }
        else if ($salary >= 15000 && $salary <= 19999) {
          $nhif = 600;
        }
        else if ($salary >= 20000 && $salary <= 24999) {
          $nhif = 750;
        }
        else if ($salary >= 25000 && $salary <= 29999) {
          $nhif = 850;
        }
        else if ($salary >= 30000 && $salary <= 34999) {
          $nhif = 900;
        }
        else if ($salary >= 35000 && $salary <= 39999) {
          $nhif = 950;
        }
        else if ($salary >= 40000 && $salary <= 44999) {
          $nhif = 1000;
        }
        else if ($salary >= 45000 && $salary <= 49999) {
          $nhif = 1100;
        }
        else if ($salary >= 50000 && $salary <= 59999) {
          $nhif = 1200;
        }
        else if ($salary >= 60000 && $salary <= 69999) {
          $nhif = 1300;
        }
        else if ($salary >= 70000 && $salary <= 79999) {
          $nhif = 1400;
        }
        else if ($salary >= 80000 && $salary <= 89999) {
          $nhif = 1500;
        }
        else if ($salary >= 90000 && $salary <= 99999) {
          $nhif = 1600;
        }
        else if ($salary >= 100000 ) {
          $nhif = 1700;
        }
        }
        $net = $salary - $kra - $nssf - $nhif;
      ?>
    <tr>
      <td ><input type="radio" id='selectedEmployee' onclick="selectEmployee(this);" name="selectedEmployee" required value="<?php echo $id; ?>"></td>
      <th scope="row" id="id<?php echo $id; ?>"><?php echo $id; ?></th>
      <td id="name<?php echo $id; ?>"><?php echo $firstname .' '. $lastname; ?></td>
       <td id="national<?php echo $id; ?>"><?php echo $national; ?></td>
      <td id="gross<?php echo $id; ?>">Kshs. <?php echo $salary ?></td>
      <td id="kra<?php echo $id; ?>">Kshs. <?php echo $kra; ?></td>
      <td id="nssf<?php echo $id; ?>">Kshs. <?php echo $nssf; ?></td>
      <td id="nhif<?php echo $id; ?>">Kshs. <?php echo $nhif; ?></td>
      <td id="net<?php echo $id; ?>">Kshs. <?php echo $net; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table><br>
</form>
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 