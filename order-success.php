<?php
  include('header.php');
  $my_orders = mysqli_query($connection,"SELECT order_status.id as status_id,order_status.status as status,DATE(orders.Delivery_time) as order_date FROM order_status INNER JOIN orders ON orders.Status_id = order_status.id INNER JOIN customers ON orders.Customer_id = customers.id where orders.Customer_id = '$customer_id' GROUP BY order_status.id ORDER BY order_status.Created_at DESC LIMIT 1")or die($connection->error);
  $value = mysqli_fetch_array($my_orders);
  $order_details = mysqli_query($connection,"SELECT SUM(orders.Quantity * (stock.Price - stock.Discount))as sum FROM orders INNER JOIN stock on orders.Stock_id = stock.id where orders.Status_id = '".$value['status_id']."' ")or die($connection->error);
  $row = mysqli_fetch_array($order_details);
?> 
           <!-- page-header-section start -->
           <div class="page-header-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between justify-content-md-end">
                            <ul class="breadcrumb">
                                <li><a href="index.html">Home</a></li>
                                <li><span>/</span></li>
                                <li>Order Success</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->



            <!-- Product order success section start -->
            <section class="product-order-success-section section-ptb">
                <div class="container">
                    <div class="product-order-success-container">
                        <div class="product-order-success">
                            <div class="iconimage">
                                <img src="assets/images/checkicon.png" alt="icon">
                            </div>
                            <h2>Your order has been received.</h2>
                            <p>Thank you for shopping with Sympha Fresh</p>
                            <a href="order-details.php?id=<?php echo $value['status_id']?>" class="order-btn">View Order Details</a>
                        </div>
                        <div class="order-description">
                            <ul class="order-info">
                                <li>
                                    <h6>Your Order Number</h6>
                                    <span>:</span>
                                    <p>Order#<?php echo $value['status_id']; ?></p>
                                </li>
                                <li>
                                    <h6>Your Order Date </h6>
                                    <span>:</span>
                                    <p><?php echo date('d.m.Y',strtotime($value['order_date'])); ?></p>
                                </li>
                                <li>
                                    <h6>Total</h6>
                                    <span>:</span>
                                    <p>Ksh. <?php echo number_format($row['sum'],2); ?></p>
                                </li>
                            </ul>
                            <!--<a href="#" class="view-summery">View a summary of your order</a>-->
                        </div>
                    </div>
                </div>
            </section>
            <!-- Product order success section end -->
<?php
    include('footer.php');
?>