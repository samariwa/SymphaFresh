<?php
 session_start();
 require('../config.php');
 $staffID = $_POST['id'];
 $name = $_POST['name'];
 $grossSalary = $_POST['gross'];
 $tax = $_POST['kra'];
 $nssf = $_POST['nssf'];
 $nhif = $_POST['nhif'];
 $net = $_POST['net'];
  $job = mysqli_query($connection,"SELECT jobs.Name as name FROM users INNER JOIN jobs ON users.Job_id=jobs.id  where users.staffID = '$staffID'")or die($connection->error);
 $row = mysqli_fetch_array($job);
  $role = $row['name'];
 $today = date("l, F d, Y", time());
$start_date = date("l, F d, Y", strtotime($today." -1 month"));
 $pdf = '';   
    $pdf .= '<!doctype html>
<html><head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PAY SLIP</title>
</head><body>
<p align="center"><strong><img src="../assets/images/logo-footer.png" height="100" width="150"></strong></p>
<p align="center">PAY SLIP</p>
<p align="center">Employee Name:'.$name.' </p>
<p align="center">Department:'.$role.' </p>
<p align="center">Staff ID:'.$staffID.' </p>
<p> Payment for Period: '.$start_date.' - '.$today.'</p>
<hr>
<p> Date of Payment:'.$today.'</p>
<hr>
<table class="table table-striped" style="display:block;text-align:center;"">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="60%"">Gross Earnings:</th>
      <th scope="col" width="40%"">'.$grossSalary.'</th>
    </tr>
  </thead>
</table>
<br>
<table class="table table-striped" style="display:block;text-align:center;"">
  <tbody class="thead-dark">
    <tr>
      <td scope="col" width="60%"">KRA Tax Deduction:</td>
      <td scope="col" width="40%"">'.$tax.'</td>
    </tr>
  </tbody>
</table>
<br>
<table class="table table-striped" style="display:block;text-align:center;"">
  <tbody class="thead-dark">
    <tr>
      <td scope="col" width="60%"">NSSF Deduction:</td>
      <td scope="col" width="40%"">'.$nssf.'</td>
    </tr>
  </tbody>
</table>
<br>
<table class="table table-striped" style="display:block;text-align:center;"">
  <tbody class="thead-dark">
    <tr>
      <td scope="col" width="60%"">NHIF Deduction:</td>
      <td scope="col" width="40%"">'.$nhif.'</td>
    </tr>
  </tbody>
</table>
<br>
<table class="table table-striped" style="display:block;text-align:center;"">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="60%"">Net Earnings:</th>
      <th scope="col" width="40%"">'.$net.'</th>
    </tr>
  </thead>
</table>
<p>Prepared by: '.$_SESSION["user"].' 
</body></html>';

echo $pdf;
 ?> 
