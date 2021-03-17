<?php
 session_start();
 require('config.php');
 require_once "functions.php";
 $deliverer = $_POST['deliverer'];
 $time = $_POST['time'];
 $random = generateRandomString();
  $gatePassFull = mysqli_query($connection,"SELECT stock.Name as 'name',SUM(orders.Quantity) AS 'sum' FROM orders inner join stock on Stock_id = stock.id inner join customers on Customer_id = customers.id where DATE(orders.Late_Order) = CURRENT_DATE()+1 and customers.deliverer LIKE '%".$deliverer."%'GROUP BY stock.ID")or die($connection->error);
  $extraGatePassFull = mysqli_query($connection,"SELECT stock.Name as 'name',SUM(sales.Quantity) AS 'sum' FROM sales inner join stock on Stock_id = stock.id inner join users on users.staffID = sales.Staff_id where DATE(sales.Sales_date) = CURRENT_DATE()+1 and users.firstname LIKE '%".$deliverer."%'GROUP BY stock.ID")or die($connection->error);
 $gatePassPartial = mysqli_query($connection,"SELECT stock.Name as 'name',SUM(orders.Quantity) AS 'sum' FROM orders inner join stock on Stock_id = stock.id inner join customers on Customer_id = customers.id where DATE(orders.Late_Order) =CURRENT_DATE()and orders.Created_at >'%".$time."%' and customers.deliverer LIKE '%".$deliverer."%' and DATE(orders.Late_Order) < DATE_ADD( CURDATE(), INTERVAL 1 DAY) GROUP BY stock.ID")or die($connection->error);
 $extraGatePassPartial = mysqli_query($connection,"SELECT stock.Name as 'name',SUM(sales.Quantity) AS 'sum' FROM sales inner join stock on Stock_id = stock.id inner join users on users.staffID = sales.Staff_id where DATE(sales.Sales_date) =CURRENT_DATE()and sales.Created_at >'%".$time."%' and users.firstname LIKE '%".$deliverer."%' and DATE(sales.Sales_date) < DATE_ADD( CURDATE(), INTERVAL 1 DAY) GROUP BY stock.ID")or die($connection->error);
 $varietyNumber1 = mysqli_num_rows($gatePassFull) + mysqli_num_rows($extraGatePassFull);
 $varietyNumber2 = mysqli_num_rows($gatePassPartial) + mysqli_num_rows($extraGatePassPartial);
 $today = date("l, F d, Y h:i A", time());
 $pdf = '';
 if ($time == '') {
    $pdf .= '<!doctype html>
<html><head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Gate Pass</title>
</head><body>
<p align="center"><strong><img src="assets/img/Kwanza Tukule.png" height="60" width="155"></strong></p>
<p align="center">Gate Pass (For Tomorrow)</p>
<?php
?>
<p align="center">Products:'.$varietyNumber1.' </p>
<?php
?>
<p> Serial #: '.$random.'</p>
<p> For: '.$deliverer.'</p>
<hr>
<p>   '.$today.' </p>
<hr>
<div class="row">
<div class="col-md-6">
<h3 style="text-align:center"><u>Orders</u></h3>
<table class="table table-striped" style="display:block;text-align:center;"">
  <thead>
    <tr>
      <th scope="col" width="70%""><h4><b>Product Name</b></h4></th>
      <th scope="col" width="30%""><h4><b>Quantity</b></h4></th>
    </tr>
  </thead>
  <tbody >';
        $count = 0;
        foreach($gatePassFull as $row){
         $count++;
         $product = $row['name'];
         $quantity = $row['sum']; 
   $pdf .= '<tr height="40px">
      <th scope="row" style="text-align:center">  '.$product.' </th>
      <td style="text-align:center">  '.$quantity.' </td>
    </tr>';
    }
 $pdf .=  '</tbody>
</table>
</div>
<div class="col-md-6">
<h3 style="text-align:center"><u>Sales</u></h3>
<table class="table table-striped" style="display:block;text-align:center;"">
  <thead>
    <tr>
      <th scope="col" width="70%""><h4><b>Product Name</b></h4></th>
      <th scope="col" width="30%""><h4><b>Quantity</b></h4></th>
    </tr>
  </thead>
  <tbody >';
        $count = 0;
        foreach($extraGatePassFull as $row){
         $count++;
         $product = $row['name'];
         $quantity = $row['sum']; 
   $pdf .= '<tr height="20px">
      <th scope="row">  '.$product.' </th>
      <td >  '.$quantity.' </td>
    </tr>';
    }
 $pdf .=  '</tbody>
</table>
</div>
</div>
<br>
<p>Data Clerk Signature: ....................................................</p>
<br>
<p>Store / Dispatch Manager Signature: ....................................................</p>
<br>
<p>Sales Representative Signature: ....................................................</p>
<br>
<p>Operations / Finance Director Signature: ....................................................</p>
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
    <title>Gate Pass</title>
</head><body>
<p align="center"><strong><img src="assets/img/Kwanza Tukule.png" height="60" width="155"></strong></p>
<p align="center">Gate Pass</p>
<p align="center">Products:'.$varietyNumber2.' </p>
<p> Serial #: '.$random.'</p>
<p> For: '.$deliverer.'</p>
<hr>
<p> '.$today.' </p>
<hr>
<div class="row">
<div class="col-md-6">
<h3 style="text-align:center"><u>Orders</u></h3>
<table class="table table-striped" style="display:block;"">
  <thead>
    <tr>
      <th scope="col" width="70%""><h4><b>Product Name</b></h4></th>
      <th scope="col" width="30%""><h4><b>Quantity</b></h4></th>
    </tr>
  </thead>
  <tbody >';
        $count = 0;
        foreach($gatePassPartial as $row){
         $count++;
         $product = $row['name'];
         $quantity = $row['sum'];
      
   $pdf .= ' <tr>
      <th scope="row" style="text-align:center">  '.$product.' </th>
      <td style="text-align:center">  '.$quantity.' </td>
    </tr>';
    }
 $pdf .= ' </tbody>
</table>
</div>
<div class="col-md-6">
<h3 style="text-align:center"><u>Sales</u></h3>
<table class="table table-striped;text-align:center;" style="display:block;"">
  <thead>
    <tr>
      <th scope="col" width="70%""><h4><b>Product Name</b></h4></th>
      <th scope="col" width="30%""><h4><b>Quantity</b></h4></th>
    </tr>
  </thead>
  <tbody >';
        $count = 0;
        foreach($extraGatePassPartial as $row){
         $count++;
         $product = $row['name'];
         $quantity = $row['sum']; 
   $pdf .= '<tr>
      <th scope="row">  '.$product.' </th>
      <td >  '.$quantity.' </td>
    </tr>';
    }
 $pdf .=  '</tbody>
</table>
</div>
</div>
<br>
<p>Data Clerk Signature: ....................................................</p>
<br>
<p>Store / Dispatch Manager Signature: ....................................................</p>
<br>
<p>Sales Representative Signature: ....................................................</p>
<br>
<p>Operations / Finance Director Signature: ....................................................</p>
<p>Prepared by: '.$_SESSION["user"].' 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body></html>';

echo $pdf;

 }

 ?> 
