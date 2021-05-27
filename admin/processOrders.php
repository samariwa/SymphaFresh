<?php
 include "admin_nav.php";
 include('../queries.php');
 $orders = mysqli_query($connection,"SELECT order_status.id as status_id,order_status.status as status,DATE(orders.Delivery_time) as order_date,customers.Name as customer FROM order_status INNER JOIN orders ON orders.Status_id = order_status.id INNER JOIN customers ON orders.Customer_id = customers.id  GROUP BY order_status.id ORDER BY order_status.Created_at DESC")or die($connection->error);
 ?> 
 <!-- Begin Page Content -->
        <div class="container-fluid">
  <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Sales</span><span style="font-size: 15px;"> /Process Orders</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <?php
           include "dashboard_tabs.php";
          ?>

          <div class="row">   
    <div class="col-2">      
      <a href="sales.php" class="btn btn-primary btn-md active float-left ml-3" role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
      </div>
    </div><br><br>
       
    <div class="accordion accordion-flush" id="accordionFlushExample">
    <?php
     foreach($orders as $row){
        $orderDetails = mysqli_query($connection,"SELECT stock.Name as name,stock.Discount as discount,stock.Price as price,inventory_units.Name as unit,orders.Quantity as quantity,order_status.delivery_fee as delivery_fee FROM order_status INNER JOIN orders ON orders.Status_id = order_status.id INNER JOIN stock ON orders.Stock_id = stock.id INNER JOIN inventory_units ON stock.Unit_id = inventory_units.id where order_status.id = '".$row['status_id']."' ORDER BY order_status.Created_at DESC")or die($connection->error);
        $order_details = mysqli_query($connection,"SELECT SUM(orders.Quantity * stock.Price)as gross,SUM(stock.Discount)as discount,SUM(orders.Quantity * (stock.Price - stock.Discount))as net, SUM(Cash + MPesa)as sum2, order_status.delivery_fee as delivery_fee FROM orders INNER JOIN stock on orders.Stock_id = stock.id INNER JOIN order_status ON orders.Status_id = order_status.id where orders.Status_id = '".$row ['status_id']."' ")or die($connection->error);
        $value2 = mysqli_fetch_array($order_details);
    ?> 
    <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $row['status_id']; ?>" aria-expanded="false" aria-controls="flush-collapseOne">
          <?php echo $row['customer']; ?>  |&ensp; <code> Order #<?php echo $row['status_id']; ?></code>  <span class="offset-7"><?php echo date('d.m.Y',strtotime($row ['order_date'])); ?></span>
      </button>
    </h2>
    <div id="flush-collapse<?php echo $row['status_id']; ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
          <ol>  
      <?php
          foreach( $orderDetails as $value){
      ?>
          <li><?php echo $value['name']; ?> - <?php echo $value['quantity']; ?> <?php echo $value['unit']; ?></li>
    <?php
    }
    ?>
          </ol> 
          <div class="row">
              <div class="col-6">
                Gross Cost: Ksh. <?php echo number_format($value2['gross'],2); ?>
                <br>
                Total Discount: Ksh. <?php echo number_format($value2['discount'],2); ?>
                <br>
                Delivery Charge: Ksh. <?php echo number_format($value2['delivery_fee'],2); ?>
                <br>
                Net Cost: Ksh. <?php echo number_format($value2['net'],2); ?>
                <br>
                Amount Paid: Ksh. <?php echo number_format($value2['sum2'],2); ?>
                </div>
                <div class="col-6">
                <ul>
                    <input type="checkbox" id="<?php echo $row['status_id']; ?>" name="processed" <?php if ($row['status'] == 'Processed' || $row['status'] == 'Shipped' || $row['status'] == 'Delivered'){?> checked <?php } ?> value="<?php echo $row['status_id']; ?>" onchange="processOrder(this,'Processed')">
                    <label for="processed">Processing</label><br>
                    <input type="checkbox" id="<?php echo $row['status_id']; ?>" name="shipped" <?php if ( $row['status'] == 'Shipped' || $row['status'] == 'Delivered'){?> checked <?php } ?> value="<?php echo $row['status_id']; ?>" onchange="processOrder(this,'Shipped')">
                    <label for="shipped">Shipment</label><br>
                    <input type="checkbox" id="<?php echo $row['status_id']; ?>" name="delivered" <?php if ( $row['status'] == 'Delivered'){?> checked <?php } ?> value="<?php echo $row['status_id']; ?>" onchange="processOrder(this,'Delivered')">
                    <label for="shipped">Delivered</label><br>
                </ul>
              </div>
          </div>
      </div>
    </div>
  </div>
  <?php
  }
  ?>
</div>
       
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 