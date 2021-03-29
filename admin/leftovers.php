<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Stock</span><span style="font-size: 15px;"> /Leftover Cereals</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
           <?php
           include "dashboard_tabs.php";
          ?>
          <div class="row">
            <div class="col-md-2">
      <a href="stock.php" class="btn btn-primary btn-md active float-left" role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
      </div>
      <div class="col-md-10">
      <p class="offset-3">Cereal Leftovers from today's orders.</p>
    </div>
    </div><br>
     
     <table id="leftoversEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="9%">Prep #</th>
      <th scope="col" width="18%">Stock Name</th>
      <th scope="col"width="15%">Qty Ordered (Kgs)</th>
      <th scope="col"width="15%">Qty Prepared (Kgs)</th>
      <th scope="col"width="15%">Qty Returned (Kgs)</th>
      <th scope="col"width="20%">Qty Difference (+/-)</th>
      <th scope="col"width="10%">Shortage/Surplus (Kgs)</th>
       <th scope="col"width="10%">Value Lost (Kshs.)</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($leftovers as $row){
         $count++;
         $id = $row['id'];
         $stockID = $row['stockID'];
        $name = $row['Name'];
        $ordered = $row['ordered'];
        $prepared = $row['prepared'];
        $difference = $row['difference'];
        $returned = $row['returned'];
        $leftover = $prepared - $ordered + $returned;
        $selling_price = mysqli_query($connection,"SELECT  Selling_price FROM (SELECT s.id as sid,sf.Selling_price as Selling_Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id join orders o on s.id = o.Stock_id ) q WHERE rn = 1 AND sid = '$stockID'")or die($connection->error);
        $row2 = mysqli_fetch_array($selling_price);
        $price = $row2['Selling_price'];
        $value = '';
        if ($leftover < 0) {
          $value = $price * $leftover * -1;
        }
        else{
          $value = $price * $leftover;
        }
      ?>
    <tr>
      <th class="uneditable" scope="row"  id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="uneditable" id="name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="uneditable" id="ordered<?php echo $count; ?>"><?php echo number_format($ordered); ?></td>
      <td class="uneditable"id="prepared<?php echo $count; ?>"><?php echo number_format($prepared); ?></td>
      <td class="uneditable"id="returned<?php echo $count; ?>"><?php echo number_format($returned); ?></td>
      <td  class="editable" id="difference<?php echo $count; ?>"><?php echo number_format($difference); ?></td>
      <td  class="uneditable" id="leftover<?php echo $count; ?>"><?php echo number_format($leftover); ?></td>
      <td  class="uneditable" id="value<?php echo $count; ?>"><?php echo number_format($value); ?></td>
    </tr>
    <?php
    }
    ?>
    <tr>
      <th colspan="7">Total  Value Lost</th>
      <td id="totalLeftoverValue">0</td>
    </tr>
  </tbody>
</table>   

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 