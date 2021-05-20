<?php
 include('../queries.php');
 session_start();
 ?> 
<!doctype html>
<html><head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Made</title>
</head><body>
<p align="center"><strong><img src="../assets/images/logo-footer.png" height="100" width="150"></strong></p>
<p align="center">Tomorrow's Orders</p>
  <?php
        $newsalesrowcount = mysqli_num_rows($extraSalesPrintList);
      ?>

<p align="center">Total Number: <?php echo $newsalesrowcount; ?></p>
<?php
$today = date('l, F d, Y h:i A', time());
?>
<hr>
<p> <?php echo $today ?></p>
<hr>
<table class="table table-striped" style="display:block;overflow-y:scroll;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="14%">Seller Name</th>
      <th scope="col" width="12%">Number</th>
      <th scope="col" width="17%">Stock Name</th>
      <th scope="col" width="10%">Quantity Sold</th>
      <th scope="col" width="10%">Quantity Returned</th>
      <th scope="col"width="10%">Cost</th>
      <th scope="col"width="10%">C/F/Debt</th>
      <th scope="col" width="10%">MPesa</th>
      <th scope="col"width="10%">Cash</th>
      <th scope="col"width="10%">Balance</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($extraSalesPrintList as $row){
         $count++;
         $id = $row['id'];
        $firstname = $row['firstame'];
        $lastname = $row['lastame'];
        $contact = $row['Number'];
        $product = $row['name'];
        $qty = $row['Quantity'];
        $price = $row['Price'];
        $cost = $qty * $price;
        $debt = $row['Debt'];
        $mpesa = $row['MPesa'];
        $cash = $row['Cash'];
        $returned = $row['Returned'];
        $balance = ($mpesa + $cash) + $debt - $cost;
      ?>
    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td ><?php echo $firstname.' '.$lastname; ?></td>
      <td><?php echo $contact; ?></td>
      <td><?php echo $product; ?></td>
      <td ><?php echo $qty; ?></td>
      <td ><?php echo $returned; ?></td>
      <td ><?php echo $cost; ?></td>
      <td><?php echo $debt; ?></td>
      <td ><?php echo $mpesa; ?></td>
      <td ><?php echo $cash; ?></td>
      <td><?php echo $balance; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<br>
<p>Prepared by: <?php echo $_SESSION['user']; ?>
</body></html>