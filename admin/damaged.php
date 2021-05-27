<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Stock</span><span style="font-size: 15px;"> /Damaged Stock</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
           <?php
           include "dashboard_tabs.php";
          ?>
          <div class="row">
          <div class="col-2">  
            <a href="stock.php" class="btn btn-primary btn-md active float-left ml-3" role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
          </div>      
           </div><br>
     
     <table id="damagedEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="5%">Batch #</th>
      <th scope="col" width="20%">Stock Name</th>
      <th scope="col"width="15%">Quantity Purchased</th>
      <th scope="col"width="15%">Undamaged Quantity</th>
      <th scope="col"width="15%">New Quantity Damaged</th>
      <th scope="col"width="15%">Total Quantity Damaged</th>
      <th scope="col"width="15%">Damaged Value (Kshs.)</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        $closing = '';
        $totalDamaged = 0;
        foreach($damaged as $row){
         $count++;
         $id = $row['id'];
        $name = $row['Name'];
        $purchased = $row['purchased'];
        $Quantity = $row['Quantity'];
        $damaged = $row['damaged'];
         if ($Quantity <= $purchased) {
           $closing = $Quantity;
         }    
        $unitValue = $row['unitValue'];
        $value = $unitValue * $damaged;
        $totalDamaged += $value;
        if ($Quantity > $purchased) {
          $closing = $purchased - $damaged;
       }
      ?>
    <tr>
      <th class="uneditable" scope="row"  id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="uneditable" id="name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="uneditable" id="purchased<?php echo $count; ?>"><?php echo number_format($purchased); ?></td>
      <td class="uneditable"id="undamaged<?php echo $count; ?>"><?php echo number_format($closing); ?></td>
      <td  class="editable" id="newDamaged<?php echo $count; ?>">0</td>
      <td  class="uneditable" id="damaged<?php echo $count; ?>"><?php echo number_format($damaged); ?></td>
      <td  class="uneditable" id="value<?php echo $count; ?>"><?php echo number_format($value); ?></td>
    </tr>
    <?php
    if ($Quantity > $purchased) {
      //MariaDB Only
      //$previousDamaged = mysqli_query($connection,"SELECT sfid as id,sid as stockid,damaged,Buying_price as unitValue, purchased,Quantity, sname as Name,received as Received_date, expiry as Expiry_date, Created_at FROM (SELECT s.id as sid, sf.id as sfid ,sf.Damaged as damaged, s.Name as sname ,s.Opening_stock as Opening_stock,sf.purchased as purchased,s.Quantity as Quantity,sf.Selling_price as Selling_Price,sf.Buying_price as Buying_price,sf.Received_date as received, sf.Expiry_date as expiry, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id  ) q WHERE rn = 2 AND sname = '$name'")or die($connection->error);
      //Hybrid
      $previousDamaged = mysqli_query($connection,"SELECT sf.id as id,s.id as stockid,sf.Damaged as damaged,sf.Buying_price as unitValue,sf.purchased as purchased,s.Quantity as Quantity, s.name as Name,sf.Received_date as  Received_date, sf.Expiry_date as Expiry_date FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id ) subQuery ON subQuery.max_id = s.id  WHERE s.name = '$name' ORDER BY sf.id DESC LIMIT 1,1;")or die($connection->error);
     $count = $count + 1;
      $row2 = mysqli_fetch_array($previousDamaged);
      $id2 = $row2['id'];
        $name2 = $row2['Name'];
        $purchased2 = $row2['purchased'];
        $damaged2 = $row2['damaged'];
        $Quantity2 = $Quantity - $purchased - $damaged2;
        $unitValue2 = $row2['unitValue'];
        $value2 = $unitValue2 * $damaged2;
        $totalDamaged += $value2;
        ?>
      <tr>
        <th class="uneditable" scope="row"  id="id<?php echo $count; ?>"><?php echo $id2; ?></th>
      <td class="uneditable" id="name<?php echo $count; ?>"><?php echo $name2; ?></td>
      <td class="uneditable" id="purchased<?php echo $count; ?>"><?php echo number_format($purchased2); ?></td>
      <td class="uneditable"id="undamaged<?php echo $count; ?>"><?php echo number_format($Quantity2); ?></td>
      <td  class="editable" id="newDamaged<?php echo $count; ?>">0</td>
      <td  class="uneditable" id="damaged<?php echo $count; ?>"><?php echo number_format($damaged2); ?></td>
      <td  class="uneditable" id="value<?php echo $count; ?>"><?php echo number_format($value2); ?></td>
    </tr>
    <?php
    }
    }
    ?>
  </tbody>
</table> 
 <br>
 <div style="text-align: center;"><b>Total Value of Damaged: Ksh. <?php echo number_format($totalDamaged); ?></b></div>  

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 