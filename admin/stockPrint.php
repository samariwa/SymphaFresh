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
    <title>Stock Print</title>
</head><body>
<p align="center"><strong><img src="../assets/images/logo-footer.png" height="100" width="150"></strong></p>
<p align="center">Stock Data</p>
  <?php
        $stockrowcount = mysqli_num_rows($stockList);
      ?>

<p align="center">Total Number: <?php echo $stockrowcount; ?></p>
<?php
$today = date('l, F d, Y h:i A', time());
?>
<hr>
<p> <?php echo $today ?></p>
<hr>
<table  class="table table-striped " style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="4%">#</th>
      <th scope="col" width="15%">Category</th>
      <th scope="col" width="17%">Stock Name</th>
      <th scope="col" width="11%">Buying Price</th>
      <th scope="col"width="11%">Selling Price</th>
      <th scope="col"width="12%">Quantity Available</th>
      <th scope="col" width="10%">Restock Level</th>
    </tr>
  </thead>
  <tbody >
    <?php
         $count = 0;
        foreach($stockList as $row){
         $count++;
         $id = $row['id'];
        $category = $row['Category_Name'];
        $name = $row['Name'];
        $buying_price = $row['Buying_price'];
        $selling_price = $row['Price'];
        $quantity = $row['Quantity'];
        $restock_Level = $row['Restock_Level'];
      ?>
    <tr>
      <th ><?php echo $id; ?></th>
      <td ><?php echo $category; ?></td>
      <td ><?php echo $name; ?></td>
      <td ><?php echo $buying_price; ?></td> 
      <td ><?php echo $selling_price; ?></td>
      <td ><?php echo $quantity; ?></td>
       <td><?php echo $restock_Level; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<br>
<p>Prepared by: <?php echo $_SESSION['user']; ?>
</body></html>