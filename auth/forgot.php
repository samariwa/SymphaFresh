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
                http://192.168.64.2/SymphaFresh/auth/reset.php?email=$email&token=$random'>Password Reset Link</a><br><br>
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
<html lang="en">
<head>
  <title>Forgot Password</title>
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
            Forgot Password
          </span>
        </div>

        <form class="login100-form" method="POST">

          <div class="wrap-input100 m-b-20">
            <span class="label-input100">Email Address</span>
            <input class="input100"  type="email" name="email" required placeholder="Enter email address">
            <span class="focus-input100"></span>
          </div>

           <div class="flex-sb-m w-full m-b-30">
   
          </div>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn" id="send" type="submit">
              Verify
            </button>
          </div>
            <?php if ($verified == TRUE)
            echo '&emsp;&emsp;&emsp;<font color="green"><i class="bx bx-check-circle bx-flashing"></i>&ensp;Please check your email for verification code.<br><i class="bx bxs-hourglass-bottom bx-flashing"></i>&ensp;The code expires in 5 minutes.</font>'; ?>
            <?php if ($no_Error == FALSE)
            echo '<br><br>&emsp;&emsp;<font color="red"><i class="bx bx-error-alt bx-flashing"></i>&ensp;Oops! Something went wrong. Please try again.</font>'; ?>
            <?php if ($exists == FALSE)
            echo '<br>&emsp;&emsp;<font color="red"><i class="bx bx-error-alt bx-flashing"></i>&ensp;Please ensure that the email address entered was <br>&emsp;&ensp;used in registration.</font>'; ?>
            <br><br>
          <div>
            <br>
             <p><a href="login.php" style="color: inherit;text-decoration: none;">Back to Login</a></p>
          </div>                 
        </form>
      </div>
    </div>
  </div>
</body>
</html>