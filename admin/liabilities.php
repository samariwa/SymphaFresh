<?php
 include "admin_nav.php";
  include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Liabilities</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <?php
           include "dashboard_tabs.php";
          ?>
          
  <div class="row">
    <div class="col-md-2 offset-5">
           <?php
        $liabilitiesrowcount = mysqli_num_rows($liabilitiesList);
      ?>
      <h6 >Total Number: <?php echo $liabilitiesrowcount; ?></h6>
    </div>
 </div><br>

        <table  class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="25%">Expense Name</th>
      <th scope="col" width="20%">Party Name</th>
      <th scope="col" width="11%">Due Amount</th>
      <th scope="col" width="13%">Payment Date</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($liabilitiesList as $row){
         $count++;
         $id = $row['id'];
        $name = $row['Name'];
        $party = $row['Party'];
        $total = $row['Total_amount'];
        $paid = $row['Paid_amount'];
        $due = $total - $paid;
        $date = $row['Payment_date'];
      ?>
    <tr>
      <th scope="row" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td id="name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td id="contact<?php echo $count; ?>"><?php echo $party; ?></td>
      <td id="staffId<?php echo $count; ?>">Ksh. <?php echo number_format($due); ?></td>
      <td id="nationalId<?php echo $count; ?>"><?php echo $date; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>       

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 