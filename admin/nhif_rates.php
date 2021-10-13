<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 
 <!-- Begin Page Content -->
        <div class="container-fluid">
  <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Staff</span><span style="font-size: 15px;"> /Employee Payroll</span><span style="font-size: 12px;"> /NHIF Rates</span></h1>
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
              <h6 class="offset-4">Latest NHIF Deductable Rates Issued.</h6>
            </div>
    </div><br>
    
        <table  class="table table-striped table-hover" style="overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="60%">Employee Earning Groups</th>  
      <th scope="col" width="40%">Amount Payable</th>    
    </tr>
  </thead>
  <tbody >
    <tr>
      <td>Ksh. 0 - Ksh. 5,999</td>
      <td>Ksh. 150</td>
    </tr>
    <tr>
      <td>Ksh. 6,000 - Ksh. 7,999</td>
      <td>Ksh. 300</td>
    </tr>
    <tr>
      <td>Ksh. 8,000 - Ksh. 11,999</td>
      <td>Ksh. 400</td>
    </tr>
    <tr>
      <td>Ksh. 12,000 - Ksh. 14,999</td>
      <td>Ksh. 500</td>
    </tr>
   <tr>
     <td>Ksh. 15,000 - Ksh. 19,999</td>
      <td>Ksh. 600</td>
    </tr>
   <tr>
      <td>Ksh. 20,000 - Ksh. 24,999</td>
      <td>Ksh. 750</td>
    </tr>
    <tr>
      <td>Ksh. 25,000 - Ksh. 29,999</td>
      <td>Ksh. 850</td>
    </tr>
    <tr>
      <td>Ksh. 30,000 - Ksh. 34,999</td>
      <td>Ksh. 950</td>
    </tr>
    <tr>
      <td>Ksh. 40,000 - Ksh. 44,999</td>
      <td>Ksh. 1,000</td>
    </tr>
    <tr>
      <td>Ksh. 45,000 - Ksh. 49,999</td>
      <td>Ksh. 1,100</td>
    </tr>
    <tr>
      <td>Ksh. 50,000 - Ksh. 59,999</td>
      <td>Ksh. 1,200</td>
    </tr>
    <tr>
      <td>Ksh. 60,000 - Ksh. 69,999</td>
      <td>Ksh. 1,300</td>
    </tr>
    <tr>
      <td>Ksh. 70,000 - Ksh. 79,999</td>
      <td>Ksh. 1,400</td>
    </tr>
    <tr>
      <td>Ksh. 80,000 - Ksh. 89,999</td>
      <td>Ksh. 1,500</td>
    </tr>
    <tr>
      <td>Ksh. 90,000 - Ksh. 99,999</td>
      <td>Ksh. 1,600</td>
    </tr>
    <tr>
      <td>Ksh. 100,000 and above</td>
      <td>Ksh. 1,700</td>
    </tr>
  </tbody>
</table><br>
        <div class="row">
          <div class="col-md-10 offset-1">
           <p>They above is the payment criteria for employed members only. Self-employed/voluntary members pay Ksh. 500 per month. For more information or queries, <a href="http://www.nhif.or.ke/healthinsurance/">Visit NHIF Page <i class="fa fa-globe"></i></a></p>
         </div>
        </div>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 