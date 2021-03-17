<?php
 include "admin_nav.php";
 include('queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Analytics</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

           <?php
       include "dashboard_tabs.php";

        ?>
 
<br>
<h4>Stock Flow</h4>
<div class="row offset-4"> <h6>Stock flow records shown are for as at now.</h6></div>
<h5>(Orders Made)</h5>  
    <?php
     $yesterday1 = date('d/m/Y',strtotime('-2 day'));
     $yesterday2 = date('d/m/Y',strtotime('-3 day'));
     $yesterday3 = date('d/m/Y',strtotime('-4 day'));
    ?>
    <table  class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="14%">Brand Name</th>
      <th scope="col" width="10%"><?php echo $yesterday3; ?></th>
      <th scope="col" width="10%"><?php echo $yesterday2; ?></th>
      <th scope="col" width="10%"><?php echo $yesterday1; ?></th>
      <th scope="col"width="10%">Yesterday</th>
      <th scope="col"width="10%">Today</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($stockFlowQuery as $row){
         $count++;
         $id = $row['sid'];
         $name = $row['sname'];
        $sum1 = $row['sum1'];
        $sum2 = $row['sum2'];
        $sum3 = $row['sum3'];
        $sum4 = $row['sum4'];
        $sum5 = $row['sum5'];
      ?>
    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td ><?php echo $name; ?></td>
      <td ><?php echo $sum1; ?></td>
      <td ><?php echo $sum2; ?></td>
      <td ><?php echo $sum3; ?></td>
      <td ><?php echo $sum4; ?></td>
      <td ><?php echo $sum5; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<br>
<h5>(Sales Done)</h5>
    <?php
     $yesterday1 = date('d/m/Y',strtotime('-2 day'));
     $yesterday2 = date('d/m/Y',strtotime('-3 day'));
     $yesterday3 = date('d/m/Y',strtotime('-4 day'));
    ?>
    <table  class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="14%">Brand Name</th>
      <th scope="col" width="10%"><?php echo $yesterday3; ?></th>
      <th scope="col" width="10%"><?php echo $yesterday2; ?></th>
      <th scope="col" width="10%"><?php echo $yesterday1; ?></th>
      <th scope="col"width="10%">Yesterday</th>
      <th scope="col"width="10%">Today</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($extraStockFlowQuery as $row){
         $count++;
         $id = $row['sid'];
         $name = $row['sname'];
        $sum1 = $row['sum1'];
        $sum2 = $row['sum2'];
        $sum3 = $row['sum3'];
        $sum4 = $row['sum4'];
        $sum5 = $row['sum5'];
      ?>
    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td ><?php echo $name; ?></td>
      <td ><?php echo $sum1; ?></td>
      <td ><?php echo $sum2; ?></td>
      <td ><?php echo $sum3; ?></td>
      <td ><?php echo $sum4; ?></td>
      <td ><?php echo $sum5; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<br>
<table  class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="14%">Brand Name</th>
      <th scope="col"width="10%">Opening Stock (Today)</th>
      <th scope="col"width="10%">Quantity (Now)</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($openingClosingQuery as $row){
         $count++;
         $id = $row['sid'];
         $name = $row['sname'];
        $opening = $row['Opening_stock'];
        $closing = $row['Quantity'];
      ?>
    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td ><?php echo $name; ?></td>
      <td ><?php echo $opening; ?></td>
      <td ><?php echo $closing; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<br>
<h4>Sales Per Deliverer</h4>
  <div id="chart_div" style="width: 1000px; height: 500px;" ></div>   
<br>
<div class="row">  
<div id="salesComparison1" style="width: 440px; height: 100px;"></div>&emsp;&emsp;&emsp;&emsp;&ensp;
<div id="salesComparison2" style="width: 440px; height: 100px;"></div>
<div id="salesComparison3" style="width: 440px; height: 100px;"></div>&emsp;&emsp;&emsp;&emsp;&ensp;
<div id="salesComparison4" style="width: 440px; height: 100px;"></div>
<div id="salesComparison5" style="width: 440px; height: 200px;"></div>&emsp;&emsp;&emsp;&emsp;&ensp;
<div id="salesComparison6" style="width: 440px; height: 200px;"></div>
</div>

<div class="row">
  <div class="col-md-6">
    <h4>Brand Sales Comparison (Orders Made)</h4>
  </div>
  <div class="col-md-6">
    <h4>Expenditure</h4>
  </div>
</div>
<div class="row">
  <div id="piechart" style="width: 420px; height: 400px;"></div>   
<div id="barchart_values" style="width: 500px; height: 400px;"></div>
</div>
<br>
<div class="row">
  <div class="col-md-6">
    <h4>Brand Sales Comparison (Sales Done)</h4>
  </div>
</div>
<div class="row">
  <div id="piechart2" style="width: 420px; height: 400px;"></div>   
</div>
<br>
<div class="row">
  <div class="col-md-6">
    <h4>Key Customers</h4>
  </div>
  <div class="col-md-6">
    <h4>Company Performance</h4>
  </div>
</div>
<div class="row">
    <div id="keyCutomersChart" style="width: 430px; height: 400px;"></div>
    <div id="chart_divide" style="width: 600px; height: 400px;"></div>    
</div>  
<br>
<div class="row">
  <div class="col-md-6">
    <h4>Sales Performance</h4>
  </div>
 <div id="curve_chart" style="width: 1100px; height: 500px"></div>
</div>
<br>
<div class="row">
  <div class="col-md-6">
    <h4>Profit / Loss</h4>
  </div>
</div>
<div class="row">
    <div id="profitchart" style="width: 1200px; height: 600px;"></div>   
</div>  
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 