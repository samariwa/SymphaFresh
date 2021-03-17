<?php
 include "admin_nav.php";
 include('queries.php');
 ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
             <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Sales</span></h1>
                        <h6 class="text-gray-600" style="margin-left: 530px;">Time: <span id="time"></span></h6>
            <button class="btn btn-light btn-md active printSales mr-3" role="button" aria-pressed="true" ><i class="fa fa-print"></i>&ensp;Print</button>
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
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Stores Manager') {
        ?>
      <div class="row">
        <div class="col-md-2">
      <a href="addOrder.php" class="btn btn-success btn-md active" role="button" aria-pressed="true"><i class="fa fa-plus-circle"></i>&ensp;New Order</a>
      </div>
      <div class="col-md-2">
      <a href="distribution.php" class="btn btn-warning btn-md active offset-3" role="button" aria-pressed="true" >Goods Distribution</a>
    </div>
      <div class="col-md-3">
      <a href="extra_sales.php" class="btn btn-primary btn-md active offset-6" role="button" aria-pressed="true" >Extra Sales</a>
    </div>
    <div class="col-md-3">
      <a href="gatePass.php" class="btn btn-dark btn-md active offset-4" role="button" aria-pressed="true" >Gate Pass</a>
    </div>
    <div class="col-md-2">
      <a href="returned.php" class="btn btn-info btn-md active" role="button" aria-pressed="true">Returned Goods</a>
    </div>
    </div><br>
     <?php
        }
        else{
        ?>
        <div class="row">
          <div class="col-md-4">
      <a href="addOrder.php" class="btn btn-success btn-md active ml-3" role="button" aria-pressed="true" ><i class="fa fa-plus-circle"></i>&ensp;New Order</a>
    </div>
      <div class="col-md-4">
      <a href="extra_sales.php" class="btn btn-primary btn-md active offset-3" role="button" aria-pressed="true" >Extra Sales</a>
    </div>
    <div class="col-md-4">
      <a href="returned.php" class="btn btn-info btn-md active offset-6" role="button" aria-pressed="true">Returned Goods</a>
    </div>
    </div><br>
        <?php
        }
        ?>
          <div class="tab-content">
            <div id="menu1" class="tab-pane fade">
        <?php
        $ordersrowcount = mysqli_num_rows($salesListLastMonth);
      ?>
      <div class="row">
         <div class="col-md-12">
      <h6 class="offset-5">Total Number: <?php echo $ordersrowcount; ?></h6>
    </div>
      </div> 
      <table id="salesEditableLastMonth" class="table table-striped table-hover table-responsive  paginate" style="overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Orders Made This Month</caption>
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
      <th scope="col"width="5%">Fine</th>
      <th scope="col"width="5%">Balance</th>
      <th scope="col"width="10%">Delivery Date</th>
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
        foreach($salesListLastMonth as $row){
         $count++;
         $id = $row['id'];
        $name = $row['Name'];
        $contact = $row['Number'];
        $product = $row['name'];
        $qty = $row['Quantity'];
        $discount = $row['Discount'];
        //MariaDB Only
        $selling_price = mysqli_query($connection,"SELECT Selling_price FROM (SELECT s.Name as sname,sf.Selling_price as Selling_Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id join orders o on s.id = o.Stock_id ) q WHERE rn = 1 AND sname = '$product'")or die($connection->error);
        //MySQL Only
        //$selling_price = mysqli_query($connection,"SELECT sf.Selling_price as Selling_Price FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at AND s.name = '$product';")or die($connection->error);
         $row2 = mysqli_fetch_array($selling_price);
        $price = $row2['Selling_price'];
        $newCost = $price - $discount;
        $cost = $qty * $newCost; 
        $debt = $row['Debt'];
        $mpesa = $row['MPesa'];
        $cash = $row['Cash'];
        $fine = $row['Fine'];
        $balance = ($mpesa + $cash) + $debt - $cost + $fine;
        $delivery_date = $row['Late_Order'];
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
      <td style = "background-color: #2ECC71;color: white"class="uneditable" id="nameLastMonth<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
        if ($balance  < "0.0" && $balance  >= "-100.0" ) {
       ?>
      <td style = "background-color: grey;color: white"class="uneditable" id="nameLastMonth<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
        if ($balance > "0.0" ) {
       ?>
      <td style = "background-color: orange;color: white"class="uneditable" id="nameLastMonth<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
        if ($balance < "-100.0" ) {
       ?>
      <td style = "background-color: red;color: white"class="uneditable" id="nameLastMonth<?php echo $count; ?>"><?php echo $name; ?></td>
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
      <td class="uneditable" id="fineLastMonth<?php echo $count; ?>"><?php echo $fine; ?></td>
      <td class="uneditable" id="balanceLastMonth<?php echo $id; ?>"><?php echo $balance; ?></td>
      <td class="editable" id="dateLastMonth<?php echo $count; ?>"><?php echo $delivery_date; ?></td>
      <td class="editable" id="returnedLastMonth<?php echo $count; ?>"><?php echo $returned; ?></td>
      <td class="editable" id="bankedLastMonth<?php echo $count; ?>"><?php echo $banked; ?></td>
      <td class="editable" id="slipLastMonth<?php echo $count; ?>"><?php echo $slip; ?></td>
      <td class="editable" id="bankerLastMonth<?php echo $count; ?>"><?php echo $banked_by; ?></td>
       <td>
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-dark btn-sm active fineCustomerLastMonth" onclick="fineCustomerLastMonth(<?php echo $id; ?>)"role="button" aria-pressed="true" >Fine</button>
          <?php
       if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {

        ?>
          <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteOrderLastMonth" role="button" aria-pressed="true" onclick="deleteOrderLastMonth(this,<?php echo $id; ?>)"><i class="fa fa-trash"></i>&ensp;Delete</button>
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
        $ordersrowcount = mysqli_num_rows($salesListYesterday);
      ?>
      <div class="row">
         <div class="col-md-12">
      <h6 class="offset-5">Total Number: <?php echo $ordersrowcount; ?></h6>
    </div>
      </div> 
      <table id="salesEditableYesterday" class="table table-striped table-hover table-responsive  paginate" style="display:block;overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Orders Made Yesterday</caption>
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
      <th scope="col"width="5%">Fine</th>
      <th scope="col"width="5%">Balance</th>
      <th scope="col"width="9%">Delivery Date</th>
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
        foreach($salesListYesterday as $row){
         $count++;
         $id = $row['id'];
        $name = $row['Name'];
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
        $fine = $row['Fine'];
        $balance = ($mpesa + $cash) + $debt - $cost + $fine;
        $delivery_date = $row['Late_Order'];
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
      <td style = "background-color: #2ECC71;color: white"class="uneditable" id="nameYesterday<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
        if ($balance  < "0.0" && $balance  >= "-100.0" ) {
       ?>
      <td style = "background-color: grey;color: white"class="uneditable" id="nameYesterday<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
        if ($balance > "0.0" ) {
       ?>
      <td style = "background-color: orange;color: white"class="uneditable" id="nameYesterday<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
        if ($balance < "-100.0" ) {
       ?>
      <td style = "background-color: red;color: white"class="uneditable" id="nameYesterday<?php echo $count; ?>"><?php echo $name; ?></td>
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
      <td class="uneditable" id="fineYesterday<?php echo $count; ?>"><?php echo $fine; ?></td>
      <td class="uneditable" id="balanceYesterday<?php echo $id; ?>"><?php echo $balance; ?></td>
      <td class="editable" id="dateYesterday<?php echo $count; ?>"><?php echo $delivery_date; ?></td>
      <td class="editable" id="returnedYesterday<?php echo $count; ?>"><?php echo $returned; ?></td>
      <td class="editable" id="bankedYesterday<?php echo $count; ?>"><?php echo $banked; ?></td>
      <td class="editable" id="slipYesterday<?php echo $count; ?>"><?php echo $slip; ?></td>
      <td class="editable" id="bankerYesterday<?php echo $count; ?>"><?php echo $banked_by; ?></td>
       <td>
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-dark btn-sm active fineCustomerYesterday" onclick="fineCustomerYesterday(<?php echo $id; ?>)"role="button" aria-pressed="true" >Fine</button>
          <?php
       if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {

        ?>
          <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteOrderYesterday" role="button" aria-pressed="true" onclick="deleteOrderYesterday(this,<?php echo $id; ?>)"><i class="fa fa-trash"></i>&ensp;Delete</button>
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
        $ordersrowcount = mysqli_num_rows($salesListToday);
      ?>
      <div class="row">
         <div class="col-md-12">
      <h6 class="offset-5">Total Number: <?php echo $ordersrowcount; ?></h6>
    </div>
      </div> 
      <table id="salesEditableToday" class="table table-striped table-hover table-responsive  paginate" style="display:block;overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Orders Made Today</caption>
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
      <th scope="col"width="5%">Fine</th>
      <th scope="col"width="5%">Balance</th>
      <th scope="col"width="9%">Delivery Date</th>
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
        foreach($salesListToday as $row){
         $count++;
         $id = $row['id'];
        $name = $row['Name'];
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
        $fine = $row['Fine'];
        $balance = ($mpesa + $cash) + $debt - $cost + $fine;
        $delivery_date = $row['Late_Order'];
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
      <td style = "background-color: #2ECC71;color: white"class="uneditable" id="nameToday<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
        if ($balance  < "0.0" && $balance  >= "-100.0" ) {
       ?>
      <td style = "background-color: grey;color: white"class="uneditable" id="nameToday<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
        if ($balance > "0.0" ) {
       ?>
      <td style = "background-color: orange;color: white"class="uneditable" id="nameToday<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
        if ($balance < "-100.0" ) {
       ?>
      <td style = "background-color: red;color: white"class="uneditable" id="nameToday<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
      ?>
      <td class="uneditable" id="numberToday<?php echo $count; ?>"><?php echo $contact; ?></td>
      <td class="uneditable" id="productToday<?php echo $count; ?>"><?php echo $product; ?></td>
      <td <?php if( $view == 'Software' ){?>class="editable"<?php }else{ ?> class="uneditable"<?php } ?> id="qtyToday<?php echo $count; ?>"><?php echo $qty; ?></td>
      <td class="uneditable" id="costToday<?php echo $id; ?>"><?php echo $cost; ?></td>
      <td class="uneditable" id="discountToday<?php echo $count; ?>"><?php echo $discount; ?></td>
      <td class="uneditable" id="debtToday<?php echo $count; ?>"><?php echo $debt; ?></td>
       <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Data Entry Clerk' || $view == 'Stores Manager' || $view == 'Stores Supervisor') {

        ?>
      <td class="editable" id="mpesaToday<?php echo $count; ?>"><?php echo $mpesa; ?></td>
      <td class="editable" id="cashToday<?php echo $count; ?>"><?php echo $cash; ?></td>
      <td class="uneditable" id="fineToday<?php echo $count; ?>"><?php echo $fine; ?></td>
      <td class="uneditable" id="balanceToday<?php echo $id; ?>"><?php echo $balance; ?></td>
      <td class="editable" id="dateToday<?php echo $count; ?>"><?php echo $delivery_date; ?></td>
      <td class="editable" id="returnedToday<?php echo $count; ?>"><?php echo $returned; ?></td>
      <td class="editable" id="bankedToday<?php echo $count; ?>"><?php echo $banked; ?></td>
      <td class="editable" id="slipToday<?php echo $count; ?>"><?php echo $slip; ?></td>
      <td class="editable" id="bankerToday<?php echo $count; ?>"><?php echo $banked_by; ?></td>
       <td>
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-dark btn-sm active fineCustomerToday" onclick="fineCustomerToday(<?php echo $id; ?>)"role="button" aria-pressed="true" >Fine</button>
          <?php
       if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {

        ?>
          <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteOrderToday" role="button" aria-pressed="true" onclick="deleteOrderToday(this,<?php echo $id; ?>)"><i class="fa fa-trash"></i>&ensp;Delete</button>
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
        $ordersrowcount = mysqli_num_rows($salesListTomorrow);
      ?>
      <div class="row">
         <div class="col-md-12">
      <h6 class="offset-5">Total Number: <?php echo $ordersrowcount; ?></h6>
    </div>
      </div> 
      <table id="salesEditableTomorrow" class="table table-striped table-hover table-responsive  paginate" style="display:block;overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Orders Made For Tomorrow</caption>
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
      <th scope="col"width="5%">Fine</th>
      <th scope="col"width="5%">Balance</th>
      <th scope="col"width="9%">Delivery Date</th>
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
        foreach($salesListTomorrow as $row){
         $count++;
         $id = $row['id'];
        $name = $row['Name'];
        $contact = $row['Number'];
        $product = $row['name'];
        $qty = $row['Quantity'];
        $discount = $row['Discount'];
        //MariaDB Only
        $selling_price = mysqli_query($connection,"SELECT Selling_price FROM (SELECT s.Name as sname,sf.Selling_price as Selling_Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id join orders o on s.id = o.Stock_id ) q WHERE rn = 1 AND sname = '$product'")or die($connection->error);
        //MySQL Only
        //$selling_price = mysqli_query($connection,"SELECT sf.Selling_price as Selling_Price FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at AND s.name = '$product';")or die($connection->error);
         $row2 = mysqli_fetch_array($selling_price);
        $price = $row2['Selling_price'];
        $newCost = $price - $discount;
        $cost = $qty * $newCost; 
        $debt = $row['Debt'];
        $mpesa = $row['MPesa'];
        $cash = $row['Cash'];
        $fine = $row['Fine'];
        $balance = ($mpesa + $cash) + $debt - $cost + $fine;
        $delivery_date = $row['Late_Order'];
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
      <td style = "background-color: #2ECC71;color: white"class="uneditable" id="nameTomorrow<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
        if ($balance  < "0.0" && $balance  >= "-100.0" ) {
       ?>
      <td style = "background-color: grey;color: white"class="uneditable" id="nameTomorrow<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
        if ($balance > "0.0" ) {
       ?>
      <td style = "background-color: orange;color: white"class="uneditable" id="nameTomorrow<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
        if ($balance < "-100.0" ) {
       ?>
      <td style = "background-color: red;color: white"class="uneditable" id="nameTomorrow<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
      ?>
      <td class="uneditable" id="numberTomorrow<?php echo $count; ?>"><?php echo $contact; ?></td>
      <td class="uneditable" id="productTomorrow<?php echo $count; ?>"><?php echo $product; ?></td>
      <td <?php if( $view == 'Software' ){?>class="editable"<?php }else{ ?> class="uneditable"<?php } ?> id="qtyTomorrow<?php echo $count; ?>"><?php echo $qty; ?></td>
      <td class="uneditable" id="costTomorrow<?php echo $id; ?>"><?php echo $cost; ?></td>
      <td class="uneditable" id="discountTomorrow<?php echo $count; ?>"><?php echo $discount; ?></td>
      <td class="uneditable" id="debtTomorrow<?php echo $count; ?>"><?php echo $debt; ?></td>
       <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Data Entry Clerk' || $view == 'Stores Manager' || $view == 'Stores Supervisor') {

        ?>
      <td class="editable" id="mpesaTomorrow<?php echo $count; ?>"><?php echo $mpesa; ?></td>
      <td class="editable" id="cashTomorrow<?php echo $count; ?>"><?php echo $cash; ?></td>
      <td class="uneditable" id="fineTomorrow<?php echo $count; ?>"><?php echo $fine; ?></td>
      <td class="uneditable" id="balanceTomorrow<?php echo $id; ?>"><?php echo $balance; ?></td>
      <td class="editable" id="dateTomorrow<?php echo $count; ?>"><?php echo $delivery_date; ?></td>
      <td class="editable" id="returnedTomorrow<?php echo $count; ?>"><?php echo $returned; ?></td>
      <td class="editable" id="bankedTomorrow<?php echo $count; ?>"><?php echo $banked; ?></td>
      <td class="editable" id="slipTomorrow<?php echo $count; ?>"><?php echo $slip; ?></td>
      <td class="editable" id="bankerTomorrow<?php echo $count; ?>"><?php echo $banked_by; ?></td>
       <td>
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-dark btn-sm active fineCustomerTomorrow" onclick="fineCustomerTomorrow(<?php echo $id; ?>)"role="button" aria-pressed="true" >Fine</button>
          <?php
       if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {

        ?>
          <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteOrderTomorrow" role="button" aria-pressed="true" onclick="deleteOrderTomorrow(this,<?php echo $id; ?>)"><i class="fa fa-trash"></i>&ensp;Delete</button>
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
        $ordersrowcount = mysqli_num_rows($salesListNextMonth);
      ?>
      <div class="row">
         <div class="col-md-12">
      <h6 class="offset-5">Total Number: <?php echo $ordersrowcount; ?></h6>
    </div>
      </div> 
      <table id="salesEditableLastMonth" class="table table-striped table-hover table-responsive  paginate" style="overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Orders Made For Coming Month</caption>
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
      <th scope="col"width="5%">Fine</th>
      <th scope="col"width="5%">Balance</th>
      <th scope="col"width="10%">Delivery Date</th>
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
        foreach($salesListNextMonth as $row){
         $count++;
         $id = $row['id'];
        $name = $row['Name'];
        $contact = $row['Number'];
        $product = $row['name'];
        $qty = $row['Quantity'];
        $discount = $row['Discount'];
        //MariaDB Only
        $selling_price = mysqli_query($connection,"SELECT Selling_price FROM (SELECT s.Name as sname,sf.Selling_price as Selling_Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id join orders o on s.id = o.Stock_id ) q WHERE rn = 1 AND sname = '$product'")or die($connection->error);
        //MySQL Only
        //$selling_price = mysqli_query($connection,"SELECT sf.Selling_price as Selling_Price FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at AND s.name = '$product';")or die($connection->error);
         $row2 = mysqli_fetch_array($selling_price);
        $price = $row2['Selling_price'];
        $newCost = $price - $discount;
        $cost = $qty * $newCost; 
        $debt = $row['Debt'];
        $mpesa = $row['MPesa'];
        $cash = $row['Cash'];
        $fine = $row['Fine'];
        $balance = ($mpesa + $cash) + $debt - $cost + $fine;
        $delivery_date = $row['Late_Order'];
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
      <td style = "background-color: #2ECC71;color: white"class="uneditable" id="nameNextMonth<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
        if ($balance  < "0.0" && $balance  >= "-100.0" ) {
       ?>
      <td style = "background-color: grey;color: white"class="uneditable" id="nameNextMonth<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
        if ($balance > "0.0" ) {
       ?>
      <td style = "background-color: orange;color: white"class="uneditable" id="nameNextMonth<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
        if ($balance < "-100.0" ) {
       ?>
      <td style = "background-color: red;color: white"class="uneditable" id="nameNextMonth<?php echo $count; ?>"><?php echo $name; ?></td>
      <?php
       }
      ?>
      <td class="uneditable" id="numberNextMonth<?php echo $count; ?>"><?php echo $contact; ?></td>
      <td class="uneditable" id="productNextMonth<?php echo $count; ?>"><?php echo $product; ?></td>
      <td <?php if( $view == 'Software' ){?>class="editable"<?php }else{ ?> class="uneditable"<?php } ?> id="qtyNextMonth<?php echo $count; ?>"><?php echo $qty; ?></td>
      <td class="uneditable" id="costNextMonth<?php echo $id; ?>"><?php echo $cost; ?></td>
      <td class="uneditable" id="discountNextMonth<?php echo $count; ?>"><?php echo $discount; ?></td>
      <td class="uneditable" id="debtNextMonth<?php echo $count; ?>"><?php echo $debt; ?></td>
       <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Data Entry Clerk' || $view == 'Stores Manager' || $view == 'Stores Supervisor') {

        ?>
      <td class="editable" id="mpesaNextMonth<?php echo $count; ?>"><?php echo $mpesa; ?></td>
      <td class="editable" id="cashNextMonth<?php echo $count; ?>"><?php echo $cash; ?></td>
      <td class="uneditable" id="fineNextMonth<?php echo $count; ?>"><?php echo $fine; ?></td>
      <td class="uneditable" id="balanceNextMonth<?php echo $id; ?>"><?php echo $balance; ?></td>
      <td class="editable" id="dateNextMonth<?php echo $count; ?>"><?php echo $delivery_date; ?></td>
      <td class="editable" id="returnedNextMonth<?php echo $count; ?>"><?php echo $returned; ?></td>
      <td class="editable" id="bankedNextMonth<?php echo $count; ?>"><?php echo $banked; ?></td>
      <td class="editable" id="slipNextMonth<?php echo $count; ?>"><?php echo $slip; ?></td>
      <td class="editable" id="bankerNextMonth<?php echo $count; ?>"><?php echo $banked_by; ?></td>
       <td>
          <?php
       if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {

        ?>
          <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteOrderNextMonth" role="button" aria-pressed="true" onclick="deleteOrderNextMonth(this,<?php echo $id; ?>)"><i class="fa fa-trash"></i>&ensp;Delete</button>
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
      <li><a data-toggle="tab" class="nav-link salesTab" href="#menu1" style="color: inherit;">Last 1 Month's Orders</a></li>
    <li><a data-toggle="tab" class="nav-link salesTab" href="#menu2" style="color: inherit;">Yesterday's Orders</a></li>
    <li class="active"><a data-toggle="tab" class="nav-link salesTab active" href="#menu3" style="color: inherit;">Today's Orders</a></li>
    <li><a data-toggle="tab" class="nav-link salesTab" href="#menu4" style="color: inherit;">Tomorrow's Orders</a></li>
    <li><a data-toggle="tab" class="nav-link salesTab" href="#menu5" style="color: inherit;">Next 1 Month's Orders</a></li>
  </ul>


  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?>
