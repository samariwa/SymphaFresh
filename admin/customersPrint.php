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
    <title>Customers Print</title>
</head><body>
<p align="center"><strong><img src="../assets/images/logo-footer.png" height="100" width="150"></strong></p>
<p align="center">Active Customers</p>
  <?php
        $activecustomersrowcount = mysqli_num_rows($customersPrintList);
      ?>

<p align="center">Total Number: <?php echo $activecustomersrowcount; ?></p>
<?php
$today = date('l, F d, Y h:i A', time());
?>
<hr>
<p> <?php echo $today ?></p>
<hr>
<table  class="table table-striped " style="display:block;overflow-y:scroll;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="14%">Name</th>
      <th scope="col" width="12%">Location</th>
      <th scope="col" width="17%">Contact Number</th>
      <th scope="col" width="10%">Deliverer</th>
      <th scope="col"width="10%">Status</th>
      <th scope="col"width="10%">Note</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($customersPrintList as $row){
         $count++;
         $id = $row['id'];
         $name = $row['Name'];
        $location = $row['Location'];
        $number = $row['Number'];
        $deliverer = $row['Deliverer'];
        $status = $row['Status'];
        $note = $row['Note'];
      ?>
    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td ><?php echo $name; ?></td>
      <td><?php echo $location; ?></td>
      <td><?php echo $number; ?></td>
      <td ><?php echo $deliverer; ?></td>
      <td ><?php echo $status; ?></td>
      <td><?php echo $note; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<br>
<p>Prepared by: <?php echo $_SESSION['user']; ?>
</body></html>