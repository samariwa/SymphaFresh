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
                 $message = "Your password reset was successfull!";
                  echo "<script type='text/javascript'>alert('$message');</script>";
                 //redirect to login page
		         header("Location: $login_url"); 
		         exit;
             }
         }
      }else
         redirectToLoginPage();
   }else{
   	redirectToLoginPage();
   }
   ?>
   <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sympha Fresh | Reset Password</title>
    <link rel="stylesheet" href="auth.css"/>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link href='https://unpkg.com/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="response.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel = "icon" href ="../assets/img/logo.png" type = "image/x-icon">
  </head>
  <body>
            <nav style="background-color: white;opacity: 0.9">
               <div class="logo">&emsp;&emsp;
                  <a class="navbar-brand" href="#"><img src="assets/img/Kwanza Tukule.png" height="55" width="140"></a>
               </div>
            </nav>
          <div  style="background: radial-gradient(ellipse at bottom, #1b2735 0%, #090a0f 100%);margin-right: 0px;margin-left: 0px;width: 100% ">
    <div id="stars"></div>
<div id="stars2"></div>
<div id="stars3"></div>
<br><br><br>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card" style="opacity: 0.8">
                  <br>  
                <h4 style="text-align: center;"><i class="fa fa-fingerprint"></i>&ensp;Reset Password</h4>
                <div class="card-body">         
                    <form method="POST" >
                         <br>
                        <div class="form-group row" >
                            <label for="pass"  class="offset-md-2 col-form-label text-md-right">New Password:</label>

                            <div class="col-md-6 ">
                                <input id="pass" type="password"  name="pass" value="" required autocomplete="current-password"  class="<?php if ($validationresults == FALSE)
                                echo "invalid"; ?>">
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group row" >
                            <label for="pass2" class="  offset-md-2 col-form-label text-md-right" style="margin-left: 60px;">Confirm Password:</label>

                            <div class="col-md-6 ">
                                <input id="pass2" type="password"  name="pass2" required autocomplete="current-password" class=" <?php if ($validationresults == FALSE)
                            echo "invalid"; ?>">
                            </div>
                        </div>
                        <br>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-5"><br>
                                <button type="submit" class="btn btn-primary">
                                    Reset
                                </button>
                            </div>
                        </div>
                         <?php if ($passwordmatch == FALSE)
                        echo '<br><br>&emsp;&emsp;<font color="red"><i class="bx bxs-lock bx-flashing"></i>&ensp;<font color="red"><i class="bx bxs-error bx-flashing"></i>&ensp;Your passwords do not match.</font>'; ?>
                        <?php if ($passwordvalidate = FALSE)
                         echo '<br><br>&emsp;&emsp;<font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Your password should be greater than 8 characters.</font>'; ?>
                        <br>
                    </form>
                </div>
                
            </div>
           <br>
        </div>
    </div>
</div>
  </body>
</html>