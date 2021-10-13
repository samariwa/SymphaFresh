<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require_once "../functions.php";
require('../config.php');
$verified = FALSE;
$no_Error = TRUE;
$exists = TRUE;
   if (isset($_POST['email'])){
      $email = $connection->real_escape_string($_POST['email']);
      $sql= "SELECT firstname FROM users WHERE email='$email'";
       $check=mysqli_query($connection,$sql);
       $row = mysqli_fetch_array($check);
      $exists=mysqli_num_rows($check);
      
        $name = $row['firstname'];
      if ($exists > 0){
        $random = generateRandomString();
        mysqli_query($connection, "UPDATE users SET token= '$random',tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE )WHERE email='$email'");
        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/Exception.php";
        require_once "PHPMailer/SMTP.php";
         $mail = new PHPMailer(true);
        $mail -> addAddress($email,'Recepient');
        $mail -> setFrom("kwanzatukuleauthenticator@gmail.com", "Kwanza Tukule");
        $mail->IsSMTP();
        $mail->Host = "smtp.gmail.com";
        // optional
        // used only when SMTP requires authentication  
        $mail->SMTPAuth = true;
        $mail->Username = 'kwanzatukuleauthenticator@gmail.com';
        $mail->Password = 'Kenya.2030';
        $mail -> Subject = "Reset Password";
        $mail -> isHTML(true);
        $mail -> Body = "
              Hi $name;<br><br>
                In order to reset your password, please click on the link below:<br>
                <a href='
                http://kwanzatukule.ddns.net/resetPassword?email=$email&token=$random'>Password Reset Link</a><br><br>
                Kindly reset your password in the given time limit of 5 minutes.<br><br>
                Kind Regards,
                ";
          if($mail -> send()){
            $verified = TRUE;
        }
          else{
            $no_Error = FALSE;
        }
      }else{
        $exists = FALSE;
      }
   }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sympha Fresh | Forgot Password</title>
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
<br><br>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card" style="opacity: 0.8">
                  <br>  
                <h4 style="text-align: center;"><i class="fa fa-key"></i>&ensp;Forgot Password</h4>
                <div class="card-body">         
                    <form method="POST" >
                         <br>
                         <p style="text-align: center;"><i><b>Restricted Access</b></i></p>
                         <p style="text-align: center;font-size: 15px;"><i>(This site is restricted to public access.)</i></p>
                         <p style="text-align: center;">Please verify that it is you.</p>
                         <br>
                         <div class="form-group row" >
                            <label for="email"  class="offset-md-2 col-form-label text-md-right"style="margin-left: 105px">Email-address:</label>

                            <div class="col-md-6 ">
                                <input id="email" type="email"  name="email" value="" required autocomplete="email" autofocus >
                            </div>
                        </div>
                          <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4"><br>
                                <button id="send" type="submit" class="btn btn-primary" style="margin-left: 35px">
                                    Verify
                                </button>
                            </div>
                        </div>
                        <?php if ($verified == TRUE)
                        echo '<br><br>&emsp;&emsp;&emsp;<font color="green"><i class="bx bx-check-circle bx-flashing"></i>&ensp;Please check your email for verification code.<br> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<i class="bx bxs-hourglass-bottom bx-flashing"></i>&ensp;The code expires in 5 minutes.</font>'; ?>
                        <?php if ($no_Error == FALSE)
                        echo '<br><br>&emsp;&emsp;<font color="red"><i class="bx bx-error-alt bx-flashing"></i>&ensp;Oops! Something went wrong. Please try again.</font>'; ?>
                        <?php if ($exists == FALSE)
                        echo '<br><br>&emsp;&emsp;<font color="red"><i class="bx bx-error-alt bx-flashing"></i>&ensp;Please ensure that the email address entered was <br>&emsp;&emsp;&emsp;&ensp;used in registration.</font>'; ?>
                        <br><br>
                        <div class="col-md-8 offset-md-4">
                         <a href="login.php" style="margin-left: 10px">Back to Login</a>
                       </div>
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