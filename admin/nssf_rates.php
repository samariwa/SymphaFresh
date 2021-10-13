<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 
 <!-- Begin Page Content -->
        <div class="container-fluid">
  <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Staff</span><span style="font-size: 15px;"> /Employee Payroll</span><span style="font-size: 12px;"> /NSSF Rates</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <?php
           include "dashboard_tabs.php";
          ?>

         <div class="row">
          <div class="col-md-2">
            <a href="payroll.php" class="btn btn-primary btn-md active float-left ml-3" role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
            </div>
            <div class="col-md-8">
              <h6 class="offset-4">Latest NSSF Deductable Rates Issued.</h6>
            </div>
    </div><br>
        <table  class="table table-striped table-hover" style="overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="25%">Employee Earnings</th>
      <th scope="col" width="25%">Employee Deduction</th>
      <th scope="col" width="25%">Employer Contribution</th>  
      <th scope="col" width="25%">Total Contribution</th>    
    </tr>
  </thead>
  <tbody >
    <tr>
      <td>Ksh. 3,000</td>
      <td>Ksh. 180</td>
      <td >Ksh. 180</td>
      <td >Ksh. 360</td>
    </tr>
    <tr>
      <td>Ksh. 4,500</td>
      <td>Ksh. 270</td>
      <td >Ksh. 270</td>
      <td >Ksh. 540</td>
    </tr>
    <tr>
      <td>Ksh. 6,000</td>
      <td>Ksh. 360</td>
      <td >Ksh. 360</td>
      <td >Ksh. 720</td>
    </tr>
    <tr>
      <td>Ksh. 10,000</td>
      <td>Ksh. 360</td>
      <td >Ksh. 360</td>
      <td >Ksh. 720</td>
    </tr>
   <tr>
      <td>Ksh. 14,000</td>
      <td>Ksh. 360</td>
      <td >Ksh. 360</td>
      <td >Ksh. 720</td>
    </tr>
   <tr>
      <td>Ksh. 18,000</td>
      <td>Ksh. 360</td>
      <td >Ksh. 360</td>
      <td >Ksh. 720</td>
    </tr>
    <tr>
      <td>Ksh. 20,000</td>
      <td>Ksh. 360</td>
      <td >Ksh. 360</td>
      <td >Ksh. 720</td>
    </tr>
    <tr>
      <td>Ksh. 100,000</td>
      <td>Ksh. 360</td>
      <td >Ksh. 360</td>
      <td >Ksh. 720</td>
    </tr>
    <tr>
      <td>Ksh. 500,000</td>
      <td>Ksh. 360</td>
      <td >Ksh. 360</td>
      <td >Ksh. 720</td>
    </tr>
  </tbody>
</table><br>
        <div class="row">
          <div class="col-md-10 offset-1">
           <p>According to the new NSSF Act, employer will contribute 50% and employee will contribute the other 50% of the total contribution expected based on the income of employee. For more information or queries, <a href="https://www.nssf.or.ke/downloads">Visit NSSF Page <i class="fa fa-globe"></i></a></p>
         </div>
        </div>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 