<?php
 include "admin_nav.php";
 include('../queries.php');
 ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
             <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Sales </span><span style="font-size: 15px;">/Extra Sales</span></h1>
                        <h6 class="text-gray-600" style="margin-left: 470px;">Time: <span id="time"></span></h6>
            <button class="btn btn-light btn-md active printExtraSales mr-3" role="button" aria-pressed="true" ><i class="fa fa-print"></i>&ensp;Print</button>
          </div>
          <?php
       }
       else{
        ?>
         <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Sales</span></h1>
            <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
        <?php
         }
           include "dashboard_tabs.php";
          ?>
      <div class="row">
        <div class="col-md-2">
      <a href="sales.php" class="btn btn-primary btn-md active ml-3" role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
      </div>
      <div class="col-md-2">
      <a <?php if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Stores Manager' || $view == 'Stores Supervisor') { ?> href="sales_invoice.php" <?php }else{ ?> href = "#" <?php } ?> class="btn btn-secondary btn-md active"  role="button" aria-pressed="true">Sales Invoice</a>
      </div>
      <div class="col-md-2">
      <a  class="btn btn-warning btn-md active offset-3" <?php if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Stores Supervisor') { ?> href="credit_note.php" <?php }else{ ?> href = "#" <?php } ?> role="button" aria-pressed="true">Credit Note</a>
      </div>
      <div class="col-md-2">
      <a  class="btn btn-info btn-md active offset-5" <?php if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Data Entry Clerk') { ?> href="payment_status.php" <?php }else{ ?> href = "#" <?php } ?> role="button" aria-pressed="true">Payment Status</a>
      </div>
    <div class="col-md-2">
      <a href="goods_requisition.php" class="btn btn-success btn-md active offset-9" role="button" aria-pressed="true"><i class="fa fa-plus-circle"></i>&ensp;Goods Requisition</a>
    </div>
    </div><br>
          <div class="tab-content">
            <div id="menu1" class="tab-pane fade">
        <?php
        $extraSalesLastMonthrowcount = mysqli_num_rows($extraSalesListLastMonth );
      ?>
      <div class="row">
         <div class="col-md-12">
      <h6 class="offset-5">Total Number: <?php echo $extraSalesLastMonthrowcount; ?></h6>
    </div>
      </div> 
      <table id="extraSalesEditableLastMonth" class="table table-striped table-hover table-responsive  paginate" style="overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Sales Done This Month</caption>
  <thead class="thead-dark">
    <tr>
     <th scope="col" width="5%">#</th>
      <th scope="col" width="5%">Name</th>
      <th scope="col" width="10%">Contact No.</th>
      <th scope="col" width="20%">Product</th>
      <th scope="col"width="5%">Quantity</th>
      <th scope="col"width="5%">Cost</th>
      <th scope="col"width="5%">Discount</th>
      <th scope="col"width="5%">C/F/Debt</th>
      <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Data Entry Clerk' || $view == 'Stores Manager' || $view == 'Stores Supervisor') {

        ?>
      <th scope="col"width="5%">MPesa</th>
      <th scope="col"width="5%">Deposit</th>
      <th scope="col"width="5%">Balance</th>
      <th scope="col"width="10%">Sales Date</th>
      <th scope="col"width="5%">Returned</th>
      <th scope="col"width="5%">Banked</th>
      <th scope="col"width="5%">Slip No.</th>
      <th scope="col"width="5%">Banked By</th>
      <th scope="col"width="30%"></th>
      <?php
       }
      ?>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($extraSalesListLastMonth  as $row){
         $count++;
         $id = $row['id'];
       $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $contact = $row['Number'];
        $product = $row['name'];
        $qty = $row['Quantity'];
        $discount = $row['Discount'];
        //MariaDB Only
        $selling_price = mysqli_query($connection,"SELECT Selling_price FROM (SELECT s.Name as sname,sf.Selling_price as Selling_Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id join orders o on s.id = o.Stock_id ) q WHERE rn = 1 AND sname = '$product'")or die($connection->error);
        //MySQL Only
        //$selling_price = mysqli_query($connection,"SELECT sf.Selling_Price as Selling_Price FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at WHERE s.name = '$product';")or die($connection->error);
         $row2 = mysqli_fetch_array($selling_price);
        $price = $row2['Selling_price'];
        $newCost = $price - $discount;
        $cost = $qty * $newCost; 
        $debt = $row['Debt'];
        $mpesa = $row['MPesa'];
        $cash = $row['Cash'];
        $date = $row['date'];
        $balance = ($mpesa + $cash) + $debt - $cost;
        $returned = $row['Returned'];
        $banked = $row['Banked'];
        $slip = $row['Slip_Number'];
        $banked_by = $row['Banked_By'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="idLastMonth<?php echo $count; ?>"><?php echo $id; ?></th>
      <?php
        if ($balance == "0.0" ) {
       ?>
      <td style = "background-color: #2ECC71;color: white"class="uneditable" id="nameLastMonth<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
        if ($balance  < "0.0" && $balance  >= "-100.0" ) {
       ?>
      <td style = "background-color: grey;color: white"class="uneditable" id="nameLastMonth<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
        if ($balance > "0.0" ) {
       ?>
      <td style = "background-color: orange;color: white"class="uneditable" id="nameLastMonth<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
        if ($balance < "-100.0" ) {
       ?>
      <td style = "background-color: red;color: white"class="uneditable" id="nameLastMonth<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
      ?>
      <td class="uneditable" id="numberLastMonth<?php echo $count; ?>"><?php echo $contact; ?></td>
      <td class="uneditable" id="productLastMonth<?php echo $count; ?>"><?php echo $product; ?></td>
      <td <?php if( $view == 'Software' ){?>class="editable"<?php }else{ ?> class="uneditable"<?php } ?> id="qtyLastMonth<?php echo $count; ?>"><?php echo $qty; ?></td>
      <td class="uneditable" id="costLastMonth<?php echo $id; ?>"><?php echo $cost; ?></td>
      <td class="uneditable" id="discountLastMonth<?php echo $count; ?>"><?php echo $discount; ?></td>
      <td class="uneditable" id="debtLastMonth<?php echo $count; ?>"><?php echo $debt; ?></td>
       <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Data Entry Clerk' || $view == 'Stores Manager' || $view == 'Stores Supervisor') {

        ?>
      <td class="editable" id="mpesaLastMonth<?php echo $count; ?>"><?php echo $mpesa; ?></td>
      <td class="editable" id="cashLastMonth<?php echo $count; ?>"><?php echo $cash; ?></td>
      <td class="uneditable" id="balanceLastMonth<?php echo $id; ?>"><?php echo $balance; ?></td>
      <td class="uneditable" id="dateLastMonth<?php echo $count; ?>"><?php echo $date; ?></td>
      <td class="editable" id="returnedLastMonth<?php echo $count; ?>"><?php echo $returned; ?></td>
      <td class="editable" id="bankedLastMonth<?php echo $count; ?>"><?php echo $banked; ?></td>
      <td class="editable" id="slipLastMonth<?php echo $count; ?>"><?php echo $slip; ?></td>
      <td class="editable" id="bankerLastMonth<?php echo $count; ?>"><?php echo $banked_by; ?></td>
       <td>
          <?php
       if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {

        ?>
          <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteSalesLastMonth" role="button" aria-pressed="true" onclick="deleteSalesLastMonth(this,<?php echo $id; ?>)"><i class="fa fa-trash"></i>&ensp;Delete</button>
          <?php
          }
          ?>
       </td>
       <?php
         }
       ?>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
    </div>
    <div id="menu2" class="tab-pane fade">
        <?php
        $ordersrowcount = mysqli_num_rows($extraSalesListYesterday);
      ?>
      <div class="row">
         <div class="col-md-12">
      <h6 class="offset-5">Total Number: <?php echo $ordersrowcount; ?></h6>
    </div>
      </div> 
      <table id="extraSalesEditableYesterday" class="table table-striped table-hover table-responsive  paginate" style="display:block;overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Sales Done Yesterday</caption>
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="5%">#</th>
      <th scope="col" width="5%">Name</th>
      <th scope="col" width="10%">Contact No.</th>
      <th scope="col" width="20%">Product</th>
      <th scope="col"width="5%">Quantity</th>
      <th scope="col"width="5%">Cost</th>
      <th scope="col"width="5%">Discount</th>
      <th scope="col"width="5%">C/F/Debt</th>
      <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Data Entry Clerk' || $view == 'Stores Manager' || $view == 'Stores Supervisor') {

        ?>
      <th scope="col"width="5%">MPesa</th>
      <th scope="col"width="5%">Deposit</th>
      <th scope="col"width="5%">Balance</th>
      <th scope="col"width="5%">Returned</th>
      <th scope="col"width="5%">Banked</th>
      <th scope="col"width="5%">Slip No.</th>
      <th scope="col"width="5%">Banked By</th>
      <th scope="col"width="30%"></th>
      <?php
       }
      ?>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($extraSalesListYesterday as $row){
         $count++;
         $id = $row['id'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $contact = $row['Number'];
        $product = $row['name'];
        //MariaDB Only
        $selling_price = mysqli_query($connection,"SELECT Selling_price FROM (SELECT s.Name as sname,sf.Selling_price as Selling_Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id join orders o on s.id = o.Stock_id ) q WHERE rn = 1 AND sname = '$product'")or die($connection->error);
        //MySQL Only
        //$selling_price = mysqli_query($connection,"SELECT sf.Selling_price as Selling_Price FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at AND s.name = '$product';")or die($connection->error);
         $row2 = mysqli_fetch_array($selling_price);
        $price = $row2['Selling_price'];
        $qty = $row['Quantity'];
        $discount = $row['Discount'];
        $newCost = $price - $discount;
        $cost = $qty * $newCost; 
        $debt = $row['Debt'];
        $mpesa = $row['MPesa'];
        $cash = $row['Cash'];
        $balance = ($mpesa + $cash) + $debt - $cost;
        $returned = $row['Returned'];
        $banked = $row['Banked'];
        $slip = $row['Slip_Number'];
        $banked_by = $row['Banked_By'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="idYesterday<?php echo $count; ?>"><?php echo $id; ?></th>
      <?php
        if ($balance == "0.0" ) {
       ?>
      <td style = "background-color: #2ECC71;color: white"class="uneditable" id="nameYesterday<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
        if ($balance  < "0.0" && $balance  >= "-100.0" ) {
       ?>
      <td style = "background-color: grey;color: white"class="uneditable" id="nameYesterday<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
        if ($balance > "0.0" ) {
       ?>
      <td style = "background-color: orange;color: white"class="uneditable" id="nameYesterday<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
        if ($balance < "-100.0" ) {
       ?>
      <td style = "background-color: red;color: white"class="uneditable" id="nameYesterday<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
      ?>
      <td class="uneditable" id="numberYesterday<?php echo $count; ?>"><?php echo $contact; ?></td>
      <td class="uneditable" id="productYesterday<?php echo $count; ?>"><?php echo $product; ?></td>
      <td <?php if( $view == 'Software' ){?>class="editable"<?php }else{ ?> class="uneditable"<?php } ?> id="qtyYesterday<?php echo $count; ?>"><?php echo $qty; ?></td>
      <td class="uneditable" id="costYesterday<?php echo $id; ?>"><?php echo $cost; ?></td>
      <td class="uneditable" id="discountYesterday<?php echo $count; ?>"><?php echo $discount; ?></td>
      <td class="uneditable" id="debtYesterday<?php echo $count; ?>"><?php echo $debt; ?></td>
       <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Data Entry Clerk' || $view == 'Stores Manager' || $view == 'Stores Supervisor') {

        ?>
      <td class="editable" id="mpesaYesterday<?php echo $count; ?>"><?php echo $mpesa; ?></td>
      <td class="editable" id="cashYesterday<?php echo $count; ?>"><?php echo $cash; ?></td>
      <td class="uneditable" id="balanceYesterday<?php echo $id; ?>"><?php echo $balance; ?></td>
      <td class="editable" id="returnedYesterday<?php echo $count; ?>"><?php echo $returned; ?></td>
      <td class="editable" id="bankedYesterday<?php echo $count; ?>"><?php echo $banked; ?></td>
      <td class="editable" id="slipYesterday<?php echo $count; ?>"><?php echo $slip; ?></td>
      <td class="editable" id="bankerYesterday<?php echo $count; ?>"><?php echo $banked_by; ?></td>
       <td>
          <?php
       if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {

        ?>
          <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteSalesYesterday" role="button" aria-pressed="true" onclick="deleteSalesYesterday(this,<?php echo $id; ?>)"><i class="fa fa-trash"></i>&ensp;Delete</button>
          <?php
          }
          ?>
       </td>
       <?php
         }
       ?>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
    </div>
    <div id="menu3" class="tab-pane fade main show active">
        <?php
        $ordersrowcount = mysqli_num_rows($extraSalesListToday);
      ?>
      <div class="row">
         <div class="col-md-12">
      <h6 class="offset-5">Total Number: <?php echo $ordersrowcount; ?></h6>
    </div>
      </div> 
      <table id="extraSalesEditableToday" class="table table-striped table-hover table-responsive  paginate" style="display:block;overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Sales Done Today</caption>
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="5%">#</th>
      <th scope="col" width="5%">Sales Person</th>
      <th scope="col" width="10%">Contact No.</th>
      <th scope="col" width="20%">Product</th>
      <th scope="col"width="5%">Quantity</th>
      <th scope="col"width="5%">Cost</th>
      <th scope="col"width="5%">Discount</th>
      <th scope="col"width="5%">C/F/Debt</th>
      <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Data Entry Clerk' || $view == 'Stores Manager' || $view == 'Stores Supervisor') {

        ?>
      <th scope="col"width="5%">MPesa</th>
      <th scope="col"width="5%">Deposit</th>
      <th scope="col"width="5%">Balance</th>
      <th scope="col"width="5%">Returned</th>
      <th scope="col"width="5%">Banked</th>
      <th scope="col"width="5%">Slip No.</th>
      <th scope="col"width="5%">Banked By</th>
      <th scope="col"width="30%"></th>
      <?php
       }
      ?>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($extraSalesListToday as $row){
         $count++;
         $id = $row['id'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $contact = $row['Number'];
        $product = $row['name'];
        $qty = $row['Quantity'];
        //MariaDB Only
        $selling_price = mysqli_query($connection,"SELECT Selling_price FROM (SELECT s.Name as sname,sf.Selling_price as Selling_Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id join orders o on s.id = o.Stock_id ) q WHERE rn = 1 AND sname = '$product'")or die($connection->error);
        //MySQL Only
        //$selling_price = mysqli_query($connection,"SELECT sf.Selling_price as Selling_Price FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at AND s.name = '$product';")or die($connection->error);
         $row2 = mysqli_fetch_array($selling_price);
        $price = $row2['Selling_price'];
        $discount = $row['Discount'];
        $newCost = $price - $discount;
        $cost = $qty * $newCost; 
        $debt = $row['Debt'];
        $mpesa = $row['MPesa'];
        $cash = $row['Cash'];
        $balance = ($mpesa + $cash) + $debt - $cost;
        $returned = $row['Returned'];
        $banked = $row['Banked'];
        $slip = $row['Slip_Number'];
        $banked_by = $row['Banked_By'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="idToday<?php echo $count; ?>"><?php echo $id; ?></th>
      <?php
        if ($balance == "0.0" ) {
       ?>
      <td style = "background-color: #2ECC71;color: white"class="uneditable" id="nameToday<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
        if ($balance  < "0.0" && $balance  >= "-5000.0" ) {
       ?>
      <td style = "background-color: grey;color: white"class="uneditable" id="nameToday<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
        if ($balance > "0.0" ) {
       ?>
      <td style = "background-color: orange;color: white"class="uneditable" id="nameToday<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
        if ($balance < "-5000.0" ) {
       ?>
      <td style = "background-color: red;color: white"class="uneditable" id="nameToday<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
      ?>
      <td class="uneditable" id="numberToday<?php echo $count; ?>"><?php echo $contact; ?></td>
      <td class="uneditable" id="productToday<?php echo $count; ?>"><?php echo $product; ?></td>
      <td <?php if( $view == 'Software' ){?>class="editable"<?php }else{ ?> class="uneditable"<?php } ?> id="qtyToday<?php echo $count; ?>"><?php echo $qty; ?></td>
      <td class="uneditable" id="costToday<?php echo $id; ?>"><?php echo $cost; ?></td>
      <td class="editable" id="discountToday<?php echo $count; ?>"><?php echo $discount; ?></td>
      <td class="uneditable" id="debtToday<?php echo $count; ?>"><?php echo $debt; ?></td>
       <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Data Entry Clerk' || $view == 'Stores Manager' || $view == 'Stores Supervisor') {

        ?>
      <td class="editable" id="mpesaToday<?php echo $count; ?>"><?php echo $mpesa; ?></td>
      <td class="editable" id="cashToday<?php echo $count; ?>"><?php echo $cash; ?></td>
      <td class="uneditable" id="balanceToday<?php echo $id; ?>"><?php echo $balance; ?></td>
      <td class="editable" id="returnedToday<?php echo $count; ?>"><?php echo $returned; ?></td>
      <td class="editable" id="bankedToday<?php echo $count; ?>"><?php echo $banked; ?></td>
      <td class="editable" id="slipToday<?php echo $count; ?>"><?php echo $slip; ?></td>
      <td class="editable" id="bankerToday<?php echo $count; ?>"><?php echo $banked_by; ?></td>
       <td>
          <?php
       if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {

        ?>
          <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteSalesToday" role="button" aria-pressed="true" onclick="deleteSalesToday(this,<?php echo $id; ?>)"><i class="fa fa-trash"></i>&ensp;Delete</button>
          <?php
          }
          ?>
       </td>
       <?php
         }
       ?>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
    </div>  
    <div id="menu4" class="tab-pane fade">
        <?php
        $ordersrowcount = mysqli_num_rows($extraSalesListTomorrow);
      ?>
      <div class="row">
         <div class="col-md-12">
      <h6 class="offset-5">Total Number: <?php echo $ordersrowcount; ?></h6>
    </div>
      </div> 
      <table id="extraSalesEditableTomorrow" class="table table-striped table-hover table-responsive  paginate" style="display:block;overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Goods Requested for tomorrow</caption>
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="5%">#</th>
      <th scope="col" width="5%">Sales Person</th>
      <th scope="col" width="10%">Contact No.</th>
      <th scope="col" width="20%">Product</th>
      <th scope="col"width="5%">Quantity</th>
      <th scope="col"width="5%">Cost</th>
      <th scope="col"width="5%">Discount</th>
      <th scope="col"width="5%">C/F/Debt</th>
      <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Data Entry Clerk' || $view == 'Stores Manager' || $view == 'Stores Supervisor') {

        ?>
      <th scope="col"width="5%">MPesa</th>
      <th scope="col"width="5%">Deposit</th>
      <th scope="col"width="5%">Balance</th>
      <th scope="col"width="5%">Returned</th>
      <th scope="col"width="5%">Banked</th>
      <th scope="col"width="5%">Slip No.</th>
      <th scope="col"width="5%">Banked By</th>
      <th scope="col"width="30%"></th>
      <?php
       }
      ?>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($extraSalesListTomorrow as $row){
         $count++;
         $id = $row['id'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $contact = $row['Number'];
        $product = $row['name'];
        $qty = $row['Quantity'];
        //MariaDB Only
        $selling_price = mysqli_query($connection,"SELECT Selling_price FROM (SELECT s.Name as sname,sf.Selling_price as Selling_Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id join orders o on s.id = o.Stock_id ) q WHERE rn = 1 AND sname = '$product'")or die($connection->error);
        //MySQL Only
        //$selling_price = mysqli_query($connection,"SELECT sf.Selling_price as Selling_Price FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at AND s.name = '$product';")or die($connection->error);
         $row2 = mysqli_fetch_array($selling_price);
        $price = $row2['Selling_price'];
        $discount = $row['Discount'];
        $newCost = $price - $discount;
        $cost = $qty * $newCost; 
        $debt = $row['Debt'];
        $mpesa = $row['MPesa'];
        $cash = $row['Cash'];
        $balance = ($mpesa + $cash) + $debt - $cost;
        $returned = $row['Returned'];
        $banked = $row['Banked'];
        $slip = $row['Slip_Number'];
        $banked_by = $row['Banked_By'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="idTomorrow<?php echo $count; ?>"><?php echo $id; ?></th>
      <?php
        if ($balance == "0.0" ) {
       ?>
      <td style = "background-color: #2ECC71;color: white"class="uneditable" id="nameTomorrow<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
        if ($balance  < "0.0" && $balance  >= "-5000.0" ) {
       ?>
      <td style = "background-color: grey;color: white"class="uneditable" id="nameTomorrow<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
        if ($balance > "0.0" ) {
       ?>
      <td style = "background-color: orange;color: white"class="uneditable" id="nameTomorrow<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
        if ($balance < "-5000.0" ) {
       ?>
      <td style = "background-color: red;color: white"class="uneditable" id="nameTomorrow<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
      ?>
      <td class="uneditable" id="numberTomorrow<?php echo $count; ?>"><?php echo $contact; ?></td>
      <td class="uneditable" id="productTomorrow<?php echo $count; ?>"><?php echo $product; ?></td>
      <td <?php if( $view == 'Software' ){?>class="editable"<?php }else{ ?> class="uneditable"<?php } ?> id="qtyTomorrow<?php echo $count; ?>"><?php echo $qty; ?></td>
      <td class="uneditable" id="costTomorrow<?php echo $id; ?>"><?php echo $cost; ?></td>
      <td class="editable" id="discountTomorrow<?php echo $count; ?>"><?php echo $discount; ?></td>
      <td class="uneditable" id="debtTomorrow<?php echo $count; ?>"><?php echo $debt; ?></td>
       <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Data Entry Clerk' || $view == 'Stores Manager' || $view == 'Stores Supervisor') {

        ?>
      <td class="uneditable" id="mpesaTomorrow<?php echo $count; ?>"><?php echo $mpesa; ?></td>
      <td class="uneditable" id="cashTomorrow<?php echo $count; ?>"><?php echo $cash; ?></td>
      <td class="uneditable" id="balanceTomorrow<?php echo $id; ?>"><?php echo $balance; ?></td>
      <td class="uneditable" id="returnedTomorrow<?php echo $count; ?>"><?php echo $returned; ?></td>
      <td class="uneditable" id="bankedTomorrow<?php echo $count; ?>"><?php echo $banked; ?></td>
      <td class="uneditable" id="slipTomorrow<?php echo $count; ?>"><?php echo $slip; ?></td>
      <td class="uneditable" id="bankerTomorrow<?php echo $count; ?>"><?php echo $banked_by; ?></td>
       <td>
          <?php
       if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {

        ?>
          <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteSalesTomorrow" role="button" aria-pressed="true" onclick="deleteSalesTomorrow(this,<?php echo $id; ?>)"><i class="fa fa-trash"></i>&ensp;Delete</button>
          <?php
          }
          ?>
       </td>
       <?php
         }
       ?>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
    </div> 
     <div id="menu5" class="tab-pane fade">
        <?php
        $ordersrowcount = mysqli_num_rows($extraSalesListNextMonth);
      ?>
      <div class="row">
         <div class="col-md-12">
      <h6 class="offset-5">Total Number: <?php echo $ordersrowcount; ?></h6>
    </div>
      </div> 
      <table id="extraSalesEditableNextMonth" class="table table-striped table-hover table-responsive  paginate" style="display:block;overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Goods Requested for the Next Month</caption>
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="5%">#</th>
      <th scope="col" width="5%">Sales Person</th>
      <th scope="col" width="10%">Contact No.</th>
      <th scope="col" width="20%">Product</th>
      <th scope="col"width="5%">Quantity</th>
      <th scope="col"width="5%">Cost</th>
      <th scope="col"width="5%">Discount</th>
      <th scope="col"width="5%">C/F/Debt</th>
      <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Data Entry Clerk' || $view == 'Stores Manager' || $view == 'Stores Supervisor') {

        ?>
      <th scope="col"width="5%">MPesa</th>
      <th scope="col"width="5%">Deposit</th>
      <th scope="col"width="5%">Balance</th>
       <th scope="col"width="10%">Sales Date</th>
      <th scope="col"width="5%">Returned</th>
      <th scope="col"width="5%">Banked</th>
      <th scope="col"width="5%">Slip No.</th>
      <th scope="col"width="5%">Banked By</th>
      <th scope="col"width="30%"></th>
      <?php
       }
      ?>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($extraSalesListNextMonth as $row){
         $count++;
         $id = $row['id'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $contact = $row['Number'];
        $product = $row['name'];
        $qty = $row['Quantity'];
        //MariaDB Only
        $selling_price = mysqli_query($connection,"SELECT Selling_price FROM (SELECT s.Name as sname,sf.Selling_price as Selling_Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id join orders o on s.id = o.Stock_id ) q WHERE rn = 1 AND sname = '$product'")or die($connection->error);
        //MySQL Only
        //$selling_price = mysqli_query($connection,"SELECT sf.Selling_price as Selling_Price FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at AND s.name = '$product';")or die($connection->error);
         $row2 = mysqli_fetch_array($selling_price);
        $price = $row2['Selling_price'];
        $discount = $row['Discount'];
        $newCost = $price - $discount;
        $cost = $qty * $newCost; 
        $debt = $row['Debt'];
        $mpesa = $row['MPesa'];
        $cash = $row['Cash'];
        $date = $row['date'];
        $balance = ($mpesa + $cash) + $debt - $cost;
        $returned = $row['Returned'];
        $banked = $row['Banked'];
        $slip = $row['Slip_Number'];
        $banked_by = $row['Banked_By'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="idNextMonth<?php echo $count; ?>"><?php echo $id; ?></th>
      <?php
        if ($balance == "0.0" ) {
       ?>
      <td style = "background-color: #2ECC71;color: white"class="uneditable" id="nameNextMonth<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
        if ($balance  < "0.0" && $balance  >= "-5000.0" ) {
       ?>
      <td style = "background-color: grey;color: white"class="uneditable" id="nameNextMonth<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
        if ($balance > "0.0" ) {
       ?>
      <td style = "background-color: orange;color: white"class="uneditable" id="nameNextMonth<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
        if ($balance < "-5000.0" ) {
       ?>
      <td style = "background-color: red;color: white"class="uneditable" id="nameNextMonth<?php echo $count; ?>"><?php echo $firstname.' '.$lastname; ?></td>
      <?php
       }
      ?>
      <td class="uneditable" id="numberNextMonth<?php echo $count; ?>"><?php echo $contact; ?></td>
      <td class="uneditable" id="productNextMonth<?php echo $count; ?>"><?php echo $product; ?></td>
      <td <?php if( $view == 'Software' ){?>class="editable"<?php }else{ ?> class="uneditable"<?php } ?> id="qtyNextMonth<?php echo $count; ?>"><?php echo $qty; ?></td>
      <td class="uneditable" id="costNextMonth<?php echo $id; ?>"><?php echo $cost; ?></td>
      <td class="editable" id="discountNextMonth<?php echo $count; ?>"><?php echo $discount; ?></td>
      <td class="uneditable" id="debtNextMonth<?php echo $count; ?>"><?php echo $debt; ?></td>
       <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Data Entry Clerk' || $view == 'Stores Manager' || $view == 'Stores Supervisor') {

        ?>
      <td class="uneditable" id="mpesaNextMonth<?php echo $count; ?>"><?php echo $mpesa; ?></td>
      <td class="uneditable" id="cashNextMonth<?php echo $count; ?>"><?php echo $cash; ?></td>
      <td class="uneditable" id="balanceNextMonth<?php echo $id; ?>"><?php echo $balance; ?></td>
      <td class="uneditable" id="dateNextMonth<?php echo $count; ?>"><?php echo $date; ?></td>
      <td class="uneditable" id="returnedNextMonth<?php echo $count; ?>"><?php echo $returned; ?></td>
      <td class="uneditable" id="bankedNextMonth<?php echo $count; ?>"><?php echo $banked; ?></td>
      <td class="uneditable" id="slipNextMonth<?php echo $count; ?>"><?php echo $slip; ?></td>
      <td class="uneditable" id="bankerNextMonth<?php echo $count; ?>"><?php echo $banked_by; ?></td>
       <td>
          <?php
       if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {

        ?>
          <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteSalesNextMonth" role="button" aria-pressed="true" onclick="deleteSalesTomorrow(this,<?php echo $id; ?>)"><i class="fa fa-trash"></i>&ensp;Delete</button>
          <?php
          }
          ?>
       </td>
       <?php
         }
       ?>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
    </div> 
  </div>

    <ul class="nav nav-tabs">
      <li><a data-toggle="tab" class="nav-link salesTab" href="#menu1" style="color: inherit;">Last 1 Month's Sales</a></li>
    <li><a data-toggle="tab" class="nav-link salesTab" href="#menu2" style="color: inherit;">Yesterday's Sales</a></li>
    <li class="active"><a data-toggle="tab" class="nav-link salesTab active" href="#menu3" style="color: inherit;">Today's Sales</a></li>
    <li ><a data-toggle="tab" class="nav-link salesTab" href="#menu4" style="color: inherit;">Tomorrow's Requisitions</a></li>
    <li ><a data-toggle="tab" class="nav-link salesTab" href="#menu5" style="color: inherit;">Next 1 Month's Requisitions</a></li>
  </ul>


  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?>
