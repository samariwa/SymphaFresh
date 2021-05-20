<?php
 session_start();
 require('../config.php');
 require_once "../functions.php";
 $deliverer = $_POST['deliverer'];
 $time = $_POST['time'];
 $random = generateRandomString();
  $distributionFull = mysqli_query($connection,"SELECT customers.Name as name,customers.Number as number,customers.Location as location,stock.Name as stock,orders.Quantity as quantity FROM orders INNER JOIN customers ON orders.Customer_id=customers.id INNER JOIN stock ON orders.Stock_id=stock.id where customers.Deliverer LIKE '%".$deliverer."%' AND DATE(orders.Delivery_time) = CURRENT_DATE()+1 order by orders.id")or die($connection->error);
 $distributionPartial = mysqli_query($connection,"SELECT customers.Name as name,customers.Number as number,customers.Location as location,stock.Name as stock,orders.Quantity as quantity FROM orders INNER JOIN customers ON orders.Customer_id=customers.id INNER JOIN stock ON orders.Stock_id=stock.id where customers.Deliverer LIKE '%".$deliverer."%' AND DATE(orders.Delivery_time) =CURRENT_DATE()and orders.Created_at >'%".$time."%'  and DATE(orders.Delivery_time) < DATE_ADD( CURDATE(), INTERVAL 1 DAY) order by orders.id")or die($connection->error);
 $today = date("l, F d, Y h:i A", time());
 $varietyNumber1 = mysqli_num_rows($distributionFull);
 $varietyNumber2 = mysqli_num_rows($distributionPartial);
 $pdf = '';   
 if ($time == '') {
    $pdf .= '<!doctype html>
<html><head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products Distribution</title>
</head><body>
<p align="center"><strong><img src="../assets/images/logo-footer.png" height="100" width="150"></strong></p>
<p align="center">Products Distribution (For Tomorrow)</p>
<p align="center">No. of products ordered:'.$varietyNumber1.' </p>
<p> Serial #: '.$random.'</p>
<p> For: '.$deliverer.'</p>
<hr>
<p> '.$today.'</p>
<hr>
<table class="table table-striped" style="display:block;text-align:center;"">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="20%"">Customer Name</th>
      <th scope="col" width="20%"">Customer Number</th>
      <th scope="col" width="20%"">Customer Location</th>
      <th scope="col" width="20%"">Product Name</th>
      <th scope="col" width="20%"">Quantity</th>
    </tr>
  </thead>
  <tbody >';
        $count = 0;
        foreach($distributionFull as $row){
         $count++;
         $name = $row['name'];
         if($name == 'Unregistered Customer')
         {
           $name = $row['new_name'];
         }
         $number = $row['number'];
         $location = $row['location'];
         $stock = $row['stock'];
         $quantity = $row['quantity'];    
    $pdf .= '<tr>
      <th scope="row" style="text-align:center">  '.$name.' </th>
      <td style="text-align:center">  '.$number.' </td>
      <td style="text-align:center">  '.$location.' </td>
      <td style="text-align:center">  '.$stock.' </td>
      <td style="text-align:center">  '.$quantity.' </td>
    </tr>';
    }
  $pdf .= '</tbody>
</table>
<br>
<p>Prepared by: '.$_SESSION["user"].' 
</body></html>';

echo $pdf;
 }
 else{
      $pdf .= '<!doctype html>
<html><head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products Distribution</title>
</head><body>
<p align="center"><strong><img src="assets/img/Kwanza Tukule.png" height="60" width="155"></strong></p>
<p align="center">Products Distribution</p>
<?php
?>
<p align="center">No. of Customers who ordered:'.$varietyNumber2.' </p>
<p> Serial #: '.$random.'</p>
<p> For: '.$deliverer.'</p>
<hr>
<p> '.$today.' </p>
<hr>
<table class="table table-striped;text-align:center;" style="display:block;text-align:center;"">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="20%"">Customer Name</th>
      <th scope="col" width="20%"">Customer Number</th>
      <th scope="col" width="20%"">Customer Location</th>
      <th scope="col" width="20%"">Product Name</th>
      <th scope="col" width="20%"">Quantity</th>
    </tr>
  </thead>
  <tbody >';
        $count = 0;
        foreach($distributionPartial as $row){
         $count++;
         $name = $row['name'];
         if($name == 'Unregistered Customer')
         {
           $name = $row['new_name'];
         }
    $number = $row['number'];
    $location = $row['location'];
    $stock = $row['stock'];
    $quantity = $row['quantity']; 
   $pdf .= ' <tr>
      <th scope="row" style="text-align:center">  '.$name.' </th>
      <td style="text-align:center">  '.$number.' </td>
      <td style="text-align:center">  '.$location.' </td>
      <td style="text-align:center">  '.$stock.' </td>
      <td style="text-align:center">  '.$quantity.' </td>
    </tr>';
    }
  $pdf .= '</tbody>
</table>
<br>
<p>Prepared by: '.$_SESSION["user"].' 
</body></html>';

echo $pdf;

 }

 ?> 
