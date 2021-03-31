<?php
require_once "../functions.php";
require('../config.php');
$passwordnotempty = TRUE;
$passwordvalidate = TRUE;
$passwordmatch  = TRUE;
   if (isset($_GET['email']) && isset($_GET['token'])){
      $email = $connection->real_escape_string($_GET['email']);
      $token = $connection->real_escape_string($_GET['token']);
      $sql = "SELECT number FROM users WHERE email='$email' AND token='$token' AND tokenExpire > NOW()";
      $check=mysqli_query($connection,$sql);
      $exists=mysqli_num_rows($check);
      if($exists > 0){
         if ((isset($_POST["pass"])) &&  (isset($_POST["pass2"]))) {
         $desired_password = sanitize($_POST["pass"]);
         $desired_password1 = sanitize($_POST["pass2"]);
         if (empty($desired_password)) {
        $passwordnotempty = FALSE;
    } else {
        $passwordnotempty = TRUE;
    }
    if (empty($desired_password1)) {
        $passwordnotempty1 = FALSE;
    } else {
        $passwordnotempty1 = TRUE;
    }
     if ($desired_password == $desired_password1) {
        $passwordmatch = TRUE;
    } else {
        $passwordmatch = FALSE;
    }
       
    if ( ((strlen($desired_password)) < 8)) {
        $passwordvalidate = FALSE;
    } else {
        $passwordvalidate = TRUE;
    }
        
             if(($passwordnotempty == TRUE) && ($passwordnotempty1 == TRUE) && ($passwordmatch == TRUE)){
                 $hash = password_hash($desired_password, PASSWORD_DEFAULT);
                 mysqli_query($connection, "UPDATE users SET password= '$hash' WHERE email='$email'");
                 //redirect to login page
                 echo '<script type="text/javascript">
                alert("Your password reset was successfull!");
                window.location.href="login.php?page_url=../template/index.php";
                </script>';
             }
         }
      }else
         redirectToLoginPage();
   }else{
   	redirectToLoginPage();
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reset Password</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="shortcut icon" type="image/png" href="../assets/images/favicon.png" />
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../assets/css/util.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
<!--===============================================================================================-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <!--===============================================================================================-->
    <link href='https://unpkg.com/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <!--===============================================================================================-->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!--===============================================================================================-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!--===============================================================================================-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    
</head>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-form-title" style="background-image:url('../assets/images/auth-bg.jpg')">
          <span class="login100-form-title-1">
            Reset Password
          </span>
        </div>

        <form class="login100-form" method="POST">

        <div class="wrap-input100 m-b-20">
            <span class="label-input100">New Password</span>
            <input class="input100" type="password" name="pass" required placeholder="Enter password">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 m-b-20">
            <span class="label-input100">Confirm Password</span>
            <input class="input100" type="password" name="pass2" required placeholder="Re-enter password">
            <span class="focus-input100"></span>
          </div>
           <div class="flex-sb-m w-full m-b-30">
           
          </div>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit">
             Reset
            </button>
          </div>
          <div>
          </div>
          
          <div style="margin-top: 20px">
          <!-- Display validation errors -->
          <?php if ($passwordmatch == FALSE)
            echo '<br><font color="red"><i class="bx bxs-lock bx-flashing"></i>&ensp;<font color="red"><i class="bx bxs-error bx-flashing"></i>&ensp;Your passwords do not match.</font>'; ?>
            <?php if ($passwordvalidate = FALSE)
                echo '<br><br><font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Your password should be greater than 8 characters.</font>'; ?>
            <br>
        </div>                 
        </form>
      </div>
    </div>
  </div>
</body>
</html>