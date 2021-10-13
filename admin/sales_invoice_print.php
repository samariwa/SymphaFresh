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
  $salesInvoice = mysqli_query($connection,"SELECT stock.Name as 'name',SUM(sales.Quantity) AS 'sum',stock.Price as 'price',sales.Created_at as 'time' FROM sales inner join stock on Stock_id = stock.id  inner join users on users.staffID = sales.Staff_id where DATE(sales.Sales_date) = CURRENT_DATE() and users.firstname LIKE '%".$deliverer."%' GROUP BY stock.ID")or die($connection->error);
 $salesInvoiceDate = mysqli_query($connection,"SELECT stock.Name as 'name',SUM(sales.Quantity) AS 'sum',stock.Price as 'price',sales.Created_at as 'time' FROM sales inner join stock on Stock_id = stock.id inner join users on users.staffID = sales.Staff_id  where DATE(sales.Sales_date) ='".$date."' and users.firstname LIKE '%".$deliverer."%' GROUP BY stock.ID")or die($connection->error);
 $invoiceNumber1 = mysqli_num_rows($salesInvoice);
 $invoiceNumber2 = mysqli_num_rows($salesInvoiceDate);
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
    <title>Sales Invoice</title>
</head><body>
<p align="center"><strong><img src="../assets/images/logo-footer.png" height="100" width="150"></strong></p>
<p align="center">Sales Invoice</p>
<?php
?>
<p align="center">Products:'.$invoiceNumber1.' </p>
<?php
?>
<p> Serial #: '.$random.'</p>
<p> For: '.$deliverer.'</p>
<hr>
<p>   '.$today.' </p>
<hr>
<br>
<table class="table" style="display:block;text-align:center;"">
  <thead>
    <tr>
      <th scope="col" width="20%""><h4><b>Product Name</b></h4></th>
      <th scope="col" width="20%""><h4><b>Unit Price</b></h4></th>
      <th scope="col" width="20%""><h4><b>Quantity(Units)</b></h4></th>
      <th scope="col" width="20%""><h4><b>Cost</b></h4></th>
      <th scope="col" width="20%""><h4><b>Requisition Timestamp</b></h4></th>
    </tr>
  </thead>
  <tbody >';
        $totalCost = 0;
        foreach($salesInvoice as $row){
         $product = $row['name'];
         $quantity = $row['sum']; 
         $price = $row['price'];
         $cost = $price * $quantity;
         $totalCost += $cost;
         $time = $row['time'];
   $pdf .= '<tr height="40px">
      <th scope="row" style="text-align:center">  '.$product.' </th>
      <td style="text-align:center"> Ksh. '.number_format($price).' </td>
      <td style="text-align:center">  '.$quantity.' </td>
      <td style="text-align:center"> Ksh. '.number_format($cost).' </td>
      <td style="text-align:center">  '.$time.' </td>
    </tr>';
    }
 $pdf .=  '
  <tr >
        <th colspan = "3"><b>Cost of goods requested:</b></th>
      <td id = "invoiceTotal"><b>Ksh. '.number_format($totalCost).'</b> </td>
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
    <title>Sales Invoice</title>
</head><body>
<p align="center"><strong><img src="assets/img/Kwanza Tukule.png" height="60" width="155"></strong></p>
<p align="center">Sales Invoice</p>
<p align="center">Products:'.$invoiceNumber2.' </p>
<p> Serial #: '.$random.'</p>
<p> For: '.$deliverer.'</p>
<hr>
<p> '.$today.' </p>
<hr>
<br>
<table class="table " style="display:block;text-align:center;"">
  <thead>
    <tr>
      <th scope="col" width="20%""><h4><b>Product Name</b></h4></th>
      <th scope="col" width="20%""><h4><b>Unit Price</b></h4></th>
      <th scope="col" width="20%""><h4><b>Quantity(Units)</b></h4></th>
      <th scope="col" width="20%""><h4><b>Cost</b></h4></th>
      <th scope="col" width="20%""><h4><b>Requisition Timestamp</b></h4></th>
    </tr>
  </thead>
  <tbody >';
        $totalCost = 0;
        foreach($salesInvoiceDate as $row){
         $product = $row['name'];
         $quantity = $row['sum']; 
         $price = $row['price'];
         $cost = $price * $quantity;
          $totalCost += $cost;
         $time = $row['time'];
   $pdf .= ' <tr>
      <th scope="row" style="text-align:center">  '.$product.' </th>
      <td style="text-align:center"> Ksh. '.number_format($price).' </td>
      <td style="text-align:center">  '.$quantity.' </td>
      <td style="text-align:center"> Ksh. '.number_format($cost).' </td>
      <td style="text-align:center">  '.$time.' </td>
    </tr>';
    }
 $pdf .=
 ' 
  <tr >
  <th colspan = "3"><b>Cost of goods requested</b></th>
  <td id = "invoiceTotal"><b>Ksh. '.number_format($totalCost).'</b> </td>
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