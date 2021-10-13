<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Stock</span><span style="font-size: 15px;"> /Stock Valuation</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <?php
           include "dashboard_tabs.php";
          ?>

          <div class="row">
          <div class="col-2">  
      <a href="stock.php" class="btn btn-primary btn-md active float-left ml-3" role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a> 
          </div>
      <div class="offset-4"> <h6 >Valuation based on live stock flow.</h6></div>
    </div><br>
    <table  class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;" id="valuationTable">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">Batch #</th>
      <th scope="col" width="14%">Brand Name</th>
      <th scope="col"width="10%">Purchased (Batch)</th>
      <th scope="col"width="10%">Quantity</th>
      <th scope="col"width="10%">Damaged (Batch)</th>
      <th scope="col"width="10%">Buying Price</th>
      <th scope="col"width="10%">Stock Value (Kshs.)</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        $closing = '';
        $totalValue = 0;
        foreach($valuationQuery as $row){
         $count++;
         $id = $row['sfid'];
         $name = $row['sname'];
        $purchase = $row['purchased'];
        $qty = $row['Quantity'];
         if ($qty <= $purchase) {
        $closing = $qty;
        }
        $damaged = $row['damaged'];
        $bp = $row['Buying_price'];
        //MariaDB Only
        //$previousValuation = mysqli_query($connection,"WITH qry AS (SELECT  s.id as sid, sf.id as sfid , s.Name as sname ,s.Opening_stock as Opening_stock,sf.Damaged as damaged,sf.purchased as purchased,s.Quantity as Quantity,sf.Buying_price as Buying_price,sf.Received_date as received, sf.Expiry_date as expiry, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.id DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id  )SELECT sfid, sname , Buying_price,damaged, purchased,  Quantity ,received FROM qry WHERE rn = 2 AND sname = '$name'")or die($connection->error);
        //Hybrid
        $previousValuation = mysqli_query($connection,"SELECT sf.id as sfid,sf.Damaged as damaged,sf.Buying_price as Buying_price,sf.purchased as purchased,s.Quantity as Quantity, s.name as sname,sf.Received_date as received FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id )subQuery  ON subQuery.max_id = s.id  WHERE s.name = '$name' ORDER BY sf.id DESC LIMIT 1,1;")or die($connection->error);   
        if ($qty > $purchase) {
          $closing = $purchase;
       }
       $value = $bp * $closing;
       $totalValue += $value;
      ?>
    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td ><?php echo $name; ?></td>
      <td ><?php echo number_format($purchase); ?></td>
      <td ><?php echo number_format($closing); ?></td>
      <td ><?php echo number_format($damaged); ?></td>
      <td ><?php echo number_format($bp); ?></td>
      <td id="value<?php echo $count; ?>"><?php echo number_format($value); ?></td>
    </tr>
    <?php
    if ($qty > $purchase) {
      $row2 = mysqli_fetch_array($previousValuation);
      $id2 = $row2['sfid'];
         $name2 = $row2['sname'];
        $purchase2 = $row2['purchased'];
        $damaged2 = $row2['damaged'];
        $bp2 = $row2['Buying_price'];
        $quantity = $qty - $purchase;
        $value2 = $bp2 * $quantity;
        $totalValue += $value2;
        ?>
      <tr>
      <th scope="row"><?php echo $id2; ?></th>
      <td ><?php echo $name2; ?></td>
      <td ><?php echo number_format($purchase2); ?></td>
      <td ><?php echo number_format($quantity); ?></td>
      <td ><?php echo number_format($damaged2); ?></td>
      <td ><?php echo number_format($bp2); ?></td>
      <td ><?php echo number_format($value2); ?></td>
    </tr>
    <?php
    }
    }
    ?>
  </tbody>
</table>
<br>
<div style="text-align: center;"><b>Total Value of Stock: Ksh. <?php echo number_format($totalValue); ?></b></div>       

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 