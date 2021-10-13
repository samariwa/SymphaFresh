<?php
 session_start();
 require('../config.php');
 require_once "../functions.php";
 $deliverer = $_POST['deliverer'];
 $unformateddate = $_POST['date'];
 $date = '';
 if ($unformateddate != '') {
   $date = date("Y-m-d", strtotime($unformateddate));
 }
else{
  $date = $unformateddate;
}
 $random = generateRandomString();
  $creditNote = mysqli_query($connection,"SELECT stock.Name as 'name',SUM(sales.Quantity) AS 'sum',stock.Price as 'price',sales.discount as 'discount',SUM(sales.returned) as 'returned',sales.Created_at as 'time' FROM sales inner join stock on Stock_id = stock.id  inner join users on users.staffID = sales.Staff_id where DATE(sales.Sales_date) = CURRENT_DATE() and users.firstname LIKE '%".$deliverer."%' GROUP BY stock.ID")or die($connection->error);
 $creditNoteDate = mysqli_query($connection,"SELECT stock.Name as 'name',SUM(sales.Quantity) AS 'sum',stock.Price as 'price',sales.discount as 'discount',SUM(sales.returned) as 'returned',sales.Created_at as 'time' FROM sales inner join stock on Stock_id = stock.id  inner join users on users.staffID = sales.Staff_id where DATE(sales.Sales_date) LIKE '%".$date."%' and users.firstname LIKE '%".$deliverer."%' GROUP BY stock.ID")or die($connection->error);
 
 $creditNumber1 = mysqli_num_rows($creditNote);
 $creditNumber2 = mysqli_num_rows($creditNoteDate);
 $today = date("l, F d, Y h:i A", time());
 $pdf = '';
 if ($date == '') {
    $pdf .= '<!doctype html>
<html><head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Credit Note</title>
</head><body>
<p align="center"><strong><img src="../assets/images/logo-footer.png" height="100" width="150"></strong></p>
<p align="center">Credit Note</p>
<p align="center">Products:'.$creditNumber1.' </p>
<p> Serial #: '.$random.'</p>
<p> For: '.$deliverer.'</p>
<hr>
<p>   '.$today.' </p>
<hr>
<br>
<table class="table table-striped" id="creditNoteTable" style="display:block;text-align:center;"">
  <thead>
    <tr>
      <th scope="col" width="12%""><b>Product Name</b></th>
      <th scope="col" width="12%""><b>Unit Price</b></th>
      <th scope="col" width="12%""><b>Quantity Requested</b></th>
      <th scope="col" width="12%""><b>Quantity Returned</b></th>
      <th scope="col" width="12%""><b>Quantity Sold</b></th>
      <th scope="col" width="12%""><b>Initial Cost</b></th>
      <th scope="col" width="12%""><b>Discount/Unit</b></th>
      <th scope="col" width="12%""><b>Discounted Cost</b></th>
      <th scope="col" width="12%""><b>Requisition Timestamp</b></th>
    </tr>
  </thead>
  <tbody >';
        $totalCost = 0;
        foreach($creditNote as $row){
         $product = $row['name'];
         $quantity = $row['sum']; 
         $price = $row['price'];
         $discount = $row['discount'];
         $returned = $row['returned'];
         $requested = $quantity + $returned;
         $cost = $price * $quantity;
         $total_discount = $discount * $quantity;
         $discounted_cost = $cost - $total_discount;
         $totalCost += $discounted_cost;
         $time = $row['time'];
   $pdf .= '<tr height="40px">
      <th scope="row" style="text-align:center">  '.$product.' </th>
      <td style="text-align:center">  '.number_format($price).' </td>
      <td style="text-align:center">  '.number_format($requested).' </td>
      <td style="text-align:center"> '.number_format($returned).' </td>
      <td style="text-align:center">  '.number_format($quantity).' </td>
       <td style="text-align:center">Ksh. '.number_format($cost).' </td>
      <td style="text-align:center">Ksh. '.number_format($discount).' </td>
      <td style="text-align:center">Ksh. '.number_format($discounted_cost).' </td>
      <td style="text-align:center">  '.$time.' </td>
    </tr>';
    }
    $paid = mysqli_query($connection,"select COALESCE(SUM(MPesa),0) as 'mpesa',COALESCE(SUM(Cash),0) as 'cash',COALESCE(SUM(MPesa + Cash),0) as 'paid'from sales inner join users on users.staffID = sales.Staff_id where DATE(Sales_date) = CURRENT_DATE() and users.firstname LIKE '%".$deliverer."%' ")or die($connection->error);
    $row2 = mysqli_fetch_array($paid);
      $paid_amount = $row2['paid'];
       $mpesa = $row2['mpesa'];
       $cash = $row2['cash'];
      $balance = $totalCost - $paid_amount;
 $pdf .=  '
 <tr >
        <th colspan = "7"><b>Cost of goods sold:</b></th>
      <td ><b>Ksh. '.number_format($totalCost).'</b> </td>
    </tr>
    <tr >
        <th colspan = "7"><b>Paid via M-Pesa:</b></th>
      <td ><b>Ksh. '.number_format($mpesa).'</b> </td>
    </tr>
     <tr >
        <th colspan = "7"><b>Deposited:</b></th>
      <td ><b>Ksh. '.number_format($cash).'</b> </td>
    </tr>
    <tr >
        <th colspan = "7"><b>Total Amount Paid:</b></th>
      <td ><b>Ksh. '.number_format($paid_amount)  .'</b> </td>
    </tr>
    <tr >
        <th colspan = "7"><b>Balance For Today:</b></th>
      <td><b>Ksh. '.number_format($balance).'</b> </td>
    </tr>
 </tbody>
</table>

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
<p align="center">Credit Note</p>
<p align="center">Products:'.$creditNumber2.' </p>
<p> Serial #: '.$random.'</p>
<p> For: '.$deliverer.'</p>
<hr>
<p> '.$today.' </p>
<hr><br>
<table class="table table-striped" id="creditNoteTable" style="display:block;"">
  <thead>
    <tr>
      <th scope="col" width="12%""><b>Product Name</b></th>
      <th scope="col" width="12%""><b>Unit Price</b></th>
      <th scope="col" width="12%""><b>Quantity Requested</b></th>
      <th scope="col" width="12%""<b>Quantity Returned</b></th>
      <th scope="col" width="12%""><b>Quantity Sold</b></th>
      <th scope="col" width="12%""><b>Initial Cost</b></th>
      <th scope="col" width="12%""><b>Discount/Unit</b></th>
      <th scope="col" width="12%""><b>Discounted Cost</b></th>
      <th scope="col" width="12%""><b>Requisition Timestamp</b></th>
    </tr>
  </thead>
  <tbody >';
        $totalCost = 0;
        foreach($creditNoteDate as $row){
         $product = $row['name'];
         $quantity = $row['sum']; 
         $price = $row['price'];
         $discount = $row['discount'];
         $returned = $row['returned'];
         $requested = $quantity + $returned;
         $cost = $price * $quantity;
         $total_discount = $discount * $quantity;
         $discounted_cost = $cost - $total_discount;
         $totalCost += $discounted_cost;
         $time = $row['time'];
      
   $pdf .= ' <tr>
     <th scope="row" style="text-align:center">  '.$product.' </th>
     <td style="text-align:center">  '.number_format($price).' </td>
      <td style="text-align:center">  '.number_format($requested).' </td>
      <td style="text-align:center"> '.number_format($returned).' </td>
      <td style="text-align:center">  '.number_format($quantity).' </td>
       <td style="text-align:center">Ksh. '.number_format($cost).' </td>
      <td style="text-align:center">Ksh. '.number_format($discount).' </td>
      <td style="text-align:center">Ksh. '.number_format($discounted_cost).' </td>
      <td style="text-align:center">  '.$time.' </td>
    </tr>';
    }
     $paid = mysqli_query($connection,"select COALESCE(SUM(MPesa),0) as 'mpesa',COALESCE(SUM(Cash),0) as 'cash',COALESCE(SUM(MPesa + Cash),0) as 'paid'from sales inner join users on users.staffID = sales.Staff_id where DATE(Sales_date) = CURRENT_DATE() and users.firstname LIKE '%".$deliverer."%' ")or die($connection->error);
    $row2 = mysqli_fetch_array($paid);
      $paid_amount = $row2['paid'];
      $mpesa = $row2['mpesa'];
       $cash = $row2['cash'];
      $balance = $totalCost - $paid_amount;
 $pdf .= ' 
 <tr >
        <th colspan = "7"><b>Cost of goods sold:</b></th>
      <td ><b>Ksh. '.number_format($totalCost).'</b> </td>
    </tr>
    <tr >
        <th colspan = "7"><b>Paid via M-Pesa:</b></th>
      <td ><b>Ksh. '.number_format($mpesa) .'</b> </td>
    </tr>
     <tr >
        <th colspan = "7"><b>Deposited:</b></th>
      <td ><b>Ksh. '.number_format($cash).'</b> </td>
    </tr>
     <tr >
        <th colspan = "7"><b>Total Amount Paid:</b></th>
      <td ><b>Ksh. '.number_format($paid_amount) .'</b> </td>
    </tr>
    <tr >
        <th colspan = "7"><b>Balance For Today:</b></th>
      <td><b>Ksh. '.number_format($balance).'</b> </td>
    </tr>
 </tbody>
</table>
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