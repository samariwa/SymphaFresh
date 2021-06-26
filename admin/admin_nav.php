<?php
session_start();
require('../config.php');
require('../functions.php');
$view = $_SESSION['role'];
if (isset($_SESSION['logged_in'])) {
  if ($_SESSION['logged_in'] == TRUE) {
//valid user has logged-in to the website
//Check for unauthorized use of user sessions
   
    $signaturerecreate = $_SESSION['signature'];

//Extract original salt from authorized signature

    $saltrecreate = substr($signaturerecreate, 0, $length_salt);

//Extract original hash from authorized signature

    $originalhash = substr($signaturerecreate, $length_salt, 40);

//Re-create the hash based on the user IP and user agent
//then check if it is authorized or not

    $hashrecreate = sha1($saltrecreate . $iptocheck . $useragent);
    if (!($hashrecreate == $originalhash)) {

//Signature submitted by the user does not matched with the
//authorized signature
//This is unauthorized access
//Block it
        header("Location: ../$admin_url");
        exit();
    }
    $logged_in_user = $_SESSION['user'];
    $logged_in_email = $_SESSION['email'];
        $result1 = mysqli_query($connection,"SELECT `active` FROM `users` WHERE `email`='$logged_in_email'");
        $row = mysqli_fetch_array($result1);
        $active = $row['active'];
//Session Lifetime control for inactivity

    if ((isset($_SESSION['LAST_ACTIVITY'])) && (time() - $_SESSION['LAST_ACTIVITY'] > $sessiontimeout) || (isset($_SESSION['LAST_ACTIVITY'])) && ($active == 2)) {
//redirect the user back to login page for re-authentication
         header("Location: ../$logout_url");
        exit;
    }
    $_SESSION['LAST_ACTIVITY'] = time();
}
else{
  header("Location: ../$logout_url");
  exit;
}
}
else{
  header("Location: ../$logout_url");
        exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
 <link rel = "icon" sizes="196x196" href="../assets/images/sympha_fresh_white.png" type = "image/x-icon">
 <title><?php echo $organization ?> | Admin Dashboard</title>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
  <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="crossorigin="anonymous"></script>
<script type="jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!--Datatables-->
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<!--Calendar-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css" />
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<!-- MDBootstrap Datatables  -->
<link href="css/addons/datatables.min.css" rel="stylesheet">
<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="js/addons/datatables.min.js"></script>
  <!-- Custom styles for this template-->
 <link rel="stylesheet" href="admin.css"/>
 <style type="text/css">
   /*******************
Preloader
********************/
.preloader {
  width: 100%;
  height: 100%;
  top: 0px;
  position: fixed;
  z-index: 99999;
  background: #fff; }
  .preloader .cssload-speeding-wheel {
    position: absolute;
    top: calc(50% - 3.5px);
    left: calc(50% - 3.5px); }

.loader,
.loader__figure {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  -o-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%); }

.loader {
  overflow: visible;
  padding-top: 2em;
  height: 0;
  width: 2em; }

.loader__figure {
  height: 0;
  width: 0;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  border: 0 solid #67BB4C;
  border-radius: 50%;
  -webkit-animation: loader-figure 1.15s infinite cubic-bezier(0.215, 0.61, 0.355, 1);
  -moz-animation: loader-figure 1.15s infinite cubic-bezier(0.215, 0.61, 0.355, 1);
  animation: loader-figure 1.15s infinite cubic-bezier(0.215, 0.61, 0.355, 1); }

.loader__label {
  float: left;
  margin-left: 50%;
  -webkit-transform: translateX(-50%);
  -moz-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  -o-transform: translateX(-50%);
  transform: translateX(-50%);
  margin: 0.5em 0 0 50%;
  font-size: 0.875em;
  letter-spacing: 0.1em;
  line-height: 1.5em;
  color: #67BB4C;
  white-space: nowrap;
  -webkit-animation: loader-label 1.15s infinite cubic-bezier(0.215, 0.61, 0.355, 1);
  -moz-animation: loader-label 1.15s infinite cubic-bezier(0.215, 0.61, 0.355, 1);
  animation: loader-label 1.15s infinite cubic-bezier(0.215, 0.61, 0.355, 1); }

@-webkit-keyframes loader-figure {
  0% {
    height: 0;
    width: 0;
    background-color: #1976d2; }
  29% {
    background-color: #1976d2; }
  30% {
    height: 2em;
    width: 2em;
    background-color: transparent;
    border-width: 1em;
    opacity: 1; }
  100% {
    height: 2em;
    width: 2em;
    border-width: 0;
    opacity: 0;
    background-color: transparent; } }

@-moz-keyframes loader-figure {
  0% {
    height: 0;
    width: 0;
    background-color: #1976d2; }
  29% {
    background-color: #1976d2; }
  30% {
    height: 2em;
    width: 2em;
    background-color: transparent;
    border-width: 1em;
    opacity: 1; }
  100% {
    height: 2em;
    width: 2em;
    border-width: 0;
    opacity: 0;
    background-color: transparent; } }

@keyframes loader-figure {
  0% {
    height: 0;
    width: 0;
    background-color: #1976d2; }
  29% {
    background-color: #1976d2; }
  30% {
    height: 2em;
    width: 2em;
    background-color: transparent;
    border-width: 1em;
    opacity: 1; }
  100% {
    height: 2em;
    width: 2em;
    border-width: 0;
    opacity: 0;
    background-color: transparent; } }

@-webkit-keyframes loader-label {
  0% {
    opacity: 0.25; }
  30% {
    opacity: 1; }
  100% {
    opacity: 0.25; } }

@-moz-keyframes loader-label {
  0% {
    opacity: 0.25; }
  30% {
    opacity: 1; }
  100% {
    opacity: 0.25; } }

@keyframes loader-label {
  0% {
    opacity: 0.25; }
  30% {
    opacity: 1; }
  100% {
    opacity: 0.25; } }

    table.dataTable tr {
      border: 1px solid #CCC;
      color:black;
}

.dataTables_filter input {
  border-radius: 80px;
}
 </style>
</head>    
<body id="page-top">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Sympha Fresh</p>
        </div>
    </div>
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-light sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon ">
        <img src="../assets/images/logo-navbar.png" height="50" width="100">
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" style="border-color: black;">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php" style="color: black;">
           <?php
               if ( $view == 'Stores Manager') {
            ?>          
            <span style="margin-left: 45px">Stores Manager</span></a>
              <?php
               }
               else if ($view == 'Data Entry Clerk'){
               ?> 
            <span style="margin-left: 30px">Data Entry Clerk</span></a>
              <?php
               }
               else if ($view == 'Software'){
               ?> 
            <span style="margin-left: 55px">Super User</span></a>
              <?php
               }
               else if ($view == 'Stores Supervisor'){
               ?> 
            <span style="margin-left: 30px">Stores Supervisor</span></a>
              <?php
               }
               else if ($view == 'Director'){
               ?> 
            <span style="margin-left: 60px">Director</span></a>
              <?php
               }
               else if ($view == 'CEO'){
               ?> 
            <span style="margin-left: 20px">Chief Executive Officer</span></a>
              <?php
               }
               ?>          
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" style="border-color: black;">

      <!-- Heading -->
      <div class="sidebar-heading" style="color: black;">
        Interface
      </div>
      <br>
      <li class="nav-item">&emsp;
        <a style="color: black;" href="dashboard.php">
          <i class="fa fa-home"></i>
          <span>Home</span></a>
      </li>
      <br>
      <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">&emsp;
        <a style="color: black;" href="expenses.php">
        <i class="fa fa-calculator"></i>
          <span>Expenses</span></a>
      </li>
      <br>
       
         
       <li class="nav-item">&emsp;
        <a style="color: black;" href="liabilities.php">
        <i class="bx bxs-coin"></i>
          <span>Liabilities</span></a>
      </li>
      <br>
      
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">&emsp;
        <a style="color: black;" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fa fa-id-card"></i>
          <span>Staff</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Departments:</h6>
            <a class="collapse-item" href="deliverers.php">Deliverers</a>
            <a class="collapse-item" href="office.php">Office</a>
            <a class="collapse-item" href="cooks.php">Cooks</a>
            <a class="collapse-item" href="cleaners.php">Cleaners</a>
          </div>
        </div>
      </li>
       <br>
      <!-- Nav Item - Charts -->
      <li class="nav-item">&emsp;
        <a style="color: black;" href="analytics.php">
         <i class="fa fa-pie-chart" ></i>
          <span>Analytics</span></a>
      </li>
       <br>
<!--       
      <li class="nav-item">&emsp;
        <a style="color: black;" href="#">
          <i class="fa fa-fw fa-table"></i>
          <span>Targets</span></a>
      </li>

       <br>
      
      <li class="nav-item">&emsp;
        <a style="color: black;" href="#">
          <span>Projects</span></a>
      </li>

       <br>
     
      <li class="nav-item">&emsp;
        <a style="color: black;" href="#">
          <i class="fa fa-flag-checkered"></i>
          <span>Milestones</span></a>
      </li>

       <br>
       
-->
        <li class="nav-item">&emsp;
        <a style="color: black;" href="vehicles.php">
          <i class="bx bxs-truck"></i>
          <span>Delivery Trucks</span></a>
      </li>

      <br>

      <li class="nav-item">&emsp;
        <a style="color: black;" href="suppliers.php">
           <i class="bx bx-archive-in"></i>
          <span>Suppliers</span></a>
      </li>

      <br>

      <li class="nav-item">&emsp;
        <a style="color: black;" href="#">
           <i class="fa fa-envelope"></i>
          <span>Site Mailbox</span></a>
      </li>

      <br>

      <li class="nav-item">&emsp;
        <a style="color: black;" href="customer_preferences.php">
           <i class="fa fa-heart"></i>
          <span>Customer Preferences</span></a>
      </li>

      <br>

      <li class="nav-item">&emsp;
        <a style="color: black;" href="blog.php">
        <i class="fa fa-quote-left"></i>
          <span>Blogs</span></a>
      </li>

      <br>

      <li class="nav-item">&emsp;
        <a style="color: black;" href="faqs.php">
        <i class="fa fa-question"></i>
          <span>FAQs</span></a>
      </li>

      <?php
       }
       ?>  
     
      <br>   
 
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ">
             <li><?php
                $Today = date('y:m:d',mktime());
                $new = date('l, F d, Y', strtotime($Today));
                ?><i class="fa fa-calendar"></i>&ensp;<?php
                echo $new;
                ?></li>
          </ul>
          <ul class="navbar-nav ml-auto">  
            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: grey;">
                Notifications<i class="fa fa-bell"></i>
                <!-- Counter - Alerts -->
                <?php
                 include('../queries.php');
                    $restockNumber = mysqli_num_rows($restockExists);
                    $notesNumber = mysqli_num_rows($notesExists);
                    $notificationNumber = $restockNumber + $notesNumber;
                ?>
                <span class="badge badge-danger badge-counter"><?php echo $notificationNumber ?></span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <?php
                foreach($newnotes as $row){
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $title = $row['Title'];
                    $Date = $row['date'];
                    $date = date( 'l, F d, Y', strtotime($Date) );
                  ?>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fa fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500"><?php echo $date ?></div>
                    <?php echo $firstname.' '.$lastname ?>: <?php echo $title ?>
                  </div>
                </a>
                <?php
                }
                foreach($restockNeeded as $row){
                    $Name = $row['Name'];
                    $Quantity = $row['Quantity'];
                    $Date = $row['Updated_at'];
                    $date = date( 'l, F d, Y', strtotime($Date) );
                  ?>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fa fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500"><?php echo $date ?></div>
                    Kindly restock <?php echo $Name ?>. <?php echo $Quantity ?> units left.
                  </div>
                </a>
                <?php
                }
                ?>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>
             <div class="topbar-divider d-none d-sm-block"></div>
             <li class="nav-item dropdown open" >
              <a class="nav-link " style="color: grey;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 

                <i class="fa fa-user"></i>&ensp;
                    <?php
                    if (isset($_SESSION['logged_in'])) 
                    {echo $logged_in_user;}
                    ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="profile.php"><i class="fa fa-user"></i>&ensp;Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../auth/logout.php"><i class="fa fa-sign-out"></i>&ensp;Logout</a>
              </div>
            </li>
              <?php
                 //}
                 ?>
          </ul>

        </nav>  