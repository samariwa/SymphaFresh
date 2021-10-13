<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 
 <!-- Begin Page Content -->
        <div class="container-fluid">
  <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Staff</span><span style="font-size: 15px;"> /Employee Payroll</span><span style="font-size: 12px;"> /KRA Tax Rates</span></h1>
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
              <h6 class="offset-4">Latest PAYE Rates Issued.</h6>
            </div>
    </div><br>
     
        <table  class="table table-striped table-hover" style="overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="60%">Taxable Income Brackets</th>
      <th scope="col" width="40%">Tax Rate</th>
    </tr>
  </thead>
  <tbody >  
    <tr>
      <td>Ksh. 0 - Ksh. 24,000</td>
      <td>10%</td>
    </tr>
    <tr>
      <td>Ksh. 24,001 - Ksh. 40,667</td>
      <td>15%</td>
    </tr>
    <tr>
      <td>Ksh. 40,668 - Ksh. 57,333</td>
      <td>20%</td>
    </tr>
    <tr>
      <td>Ksh. 35,473 - Ksh. 47,059</td>
      <td>25%</td>
    </tr>
    <tr>
      <td>Above Ksh. 57,333</td>
      <td>25%</td>
    </tr>
  </tbody>
</table><br>
        <div class="row">
          <div class="col-md-12 offset-3">
           <p>For more information or queries, <a href="https://www.kra.go.ke/en/individual/filing-paying/types-of-taxes/paye">Visit KRA Page <i class="fa fa-globe"></i></a></p>
         </div>
        </div>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 