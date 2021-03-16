<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//require user configuration and database connection parameters
//Start PHP session
session_start();
//require user configuration and database connection parameters
require('config.php');
require_once "functions.php";
if (isset($_SESSION['logged_in'])) {
	if ($_SESSION['logged_in'] == TRUE) {
//valid user has logged-in to the website
//Check for unauthorized use of user sessions
    mysqli_query($connection,"UPDATE `users` SET `on` = '1' WHERE `email` = '$email'");
    $iprecreate = $_SERVER['REMOTE_ADDR'];
    $useragentrecreate = $_SERVER["HTTP_USER_AGENT"];
    $signaturerecreate = $_SESSION['signature'];

//Extract original salt from authorized signature

    $saltrecreate = substr($signaturerecreate, 0, $length_salt);

//Extract original hash from authorized signature

    $originalhash = substr($signaturerecreate, $length_salt, 40);

//Re-create the hash based on the user IP and user agent
//then check if it is authorized or not

    $hashrecreate = sha1($saltrecreate . $iprecreate . $useragentrecreate);

    if (!($hashrecreate == $originalhash)) {

//Signature submitted by the user does not matched with the
//authorized signature
//This is unauthorized access
//Block it
        header("Location: $logout_url");
        exit;
    }
    else{
        header("Location: $home_url");
        exit;
    }

//Session Lifetime control for inactivity

    if ((isset($_SESSION['LAST_ACTIVITY'])) && (time() - $_SESSION['LAST_ACTIVITY'] > $sessiontimeout)) {
//redirect the user back to login page for re-authentication
         header("Location: $logout_url");
        exit;
    }
    $_SESSION['LAST_ACTIVITY'] = time();
}
}
require('config.php');
//Pre-define validation
$validationresults = TRUE;
$registered = TRUE;
$recaptchavalidation = TRUE;
$illegalattempts = FALSE;
$activate = TRUE;
$deactivated = FALSE;
$loggedIn = FALSE;
//Trapped brute force attackers and give them more hard work by providing a captcha-protected page

$iptocheck = $_SERVER['REMOTE_ADDR'];
/*$iptocheck = mysqli_real_escape_string($iptocheck);

if ($fetch = mysqli_fetch_array(mysqli_query("SELECT `loggedip` FROM `ipcheck` WHERE `loggedip`='$iptocheck'"))) {

//Already has some IP address records in the database
//Get the total failed login attempts associated with this IP address

    $resultx = mysqli_query("SELECT `failedattempts` FROM `ipcheck` WHERE `loggedip`='$iptocheck'");
    $rowx = mysqli_fetch_array($resultx);
    $loginattempts_total = $rowx['failedattempts'];

    If ($loginattempts_total > $maxfailedattempt) {

//too many failed attempts allowed, redirect and give 403 forbidden.

        header(sprintf("Location: %s", $forbidden_url));
        exit;
    }
}*/

//Check if a user has logged-in

if (!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = FALSE;
}

//Check if the form is submitted

if ((isset($_POST["pass"])) && (isset($_POST["email"])) && ($_SESSION['logged_in'] == FALSE)) {

//Email and password has been submitted by the user
//Receive and sanitize the submitted information


    $email = sanitize($_POST["email"]);
    $pass = sanitize($_POST["pass"]);
    $Name = mysqli_query($connection,"SELECT * FROM `users` WHERE `email`='$email'");
        $row = mysqli_fetch_array($Name);
        $identity = $row['firstname'];
        $user_email = $row['email'];
    $_SESSION['user'] = $identity;
    $_SESSION['email'] = $user_email;
//validate email
    if (!($fetch = mysqli_fetch_array(mysqli_query($connection,"SELECT `email` FROM `users` WHERE `email`='$email'")))) {
//no records of email in database
//user is not yet registered
        $registered = FALSE;
    }

//Grab login attempts from MySQL database for a corresponding username
        $result1 = mysqli_query($connection,"SELECT `loginattempt` FROM `users` WHERE `email`='$email'");
        $row = mysqli_fetch_array($result1);
        $loginattempts_email = $row['loginattempt'];

    if (($loginattempts_email == 5) && ($registered == TRUE)) {
//Require those user with login attempts failed records to
//send an email to inform admin of unusual login attempt.
       require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/Exception.php";
        require_once "PHPMailer/SMTP.php";
         $mail = new PHPMailer(true);
        $mail -> addAddress('kwanzatukuleauthenticator@gmail.com','Kwanza Tukule');
        $mail -> setFrom("kwanzatukuleauthenticator@gmail.com", "Kwanza Tukule");
        $mail->IsSMTP();
        $mail->Host = "smtp.gmail.com";
        // optional
        // used only when SMTP requires authentication  
        $mail->SMTPAuth = true;
        $mail->Username = 'kwanzatukuleauthenticator@gmail.com';
        $mail->Password = 'Kenya.2030';
        $mail -> Subject = "Unusual Login Attempt";
        $mail -> isHTML(true);
        $mail -> Body = "
              Hi,<br><br>
                An unusual login attempt using $email's account has been detected.<br> Please ensure that it is an authorized attempt. If it isn't kindly notify Mariwa for necessary security measures to be taken.<br> Thank you for your co-operation.<br><br>
                Kind Regards,
                ";
        $mail -> send();
        
    }
    //display warning message
if (($loginattempts_email == 5) && ($registered == TRUE)) {
        $illegalattempts = TRUE; 
    }
if (($loginattempts_email > 5) && ($registered == TRUE)) {
      mysqli_query($connection,"UPDATE `users` SET `active` = '2' WHERE `email` = '$email'"); 
      $deactivated = TRUE; 
    }
//Get correct hashed password based on given email address stored in MySQL database

  //check if account is activated
      $result3 = mysqli_query($connection,"SELECT `active` FROM `users` WHERE `email`='$email'");
        $row3 = mysqli_fetch_array($result3);
        $active = $row3['active'];
        if($active == 1){
          $activate = TRUE;
        }
        if($active == 0){
          $activate = FALSE;
        }
        if($active == 2){
          $deactivated = TRUE; 
        }
  //check if the account is logged in using another device
  $result2 = mysqli_query($connection,"SELECT `ipAddress` FROM `users` WHERE `email`='$email'");
  $row2 = mysqli_fetch_array($result2);
  $ipValue = $row2['ipAddress'];
  if ($ipValue == 0) {
        $loggedIn = FALSE;
        }
    elseif ($ipValue == $iptocheck) {
           $loggedIn = FALSE;
          }      
    else{
       $loggedIn = TRUE; 
    }        
//u is registered in database, now get the hashed password    
    $result = mysqli_query($connection,"SELECT `password` FROM `users` WHERE `email`='$email'");
        $row = mysqli_fetch_array($result);
        $correctpassword = $row['password'];
    if (!password_verify($pass, $correctpassword) || ($registered == FALSE) || ($activate == FALSE) || ($deactivated == TRUE) || ($loggedIn == TRUE)) {
    	$result1 = mysqli_query($connection,"SELECT `active` FROM `users` WHERE `email`='$email'");
        $row = mysqli_fetch_array($result1);
        $active = $row['active'];
        if(($active == 0) && ($registered == FALSE) && ($loggedIn = FALSE) || ($active == 0) && !password_verify($pass, $correctpassword) && ($loggedIn = FALSE)){
          $activate = TRUE;
          $validationresults = FALSE; 
          $loggedIn = FALSE;
        }
        else if (($active == 2) && ($registered == FALSE) && ($loggedIn = FALSE) || ($active == 2) && !password_verify($pass, $correctpassword) && ($loggedIn = FALSE)) {
           $deactivated = FALSE;
           $validationresults = FALSE;
           $loggedIn = FALSE;
        }
        elseif (($active == 2) && ($registered == TRUE) && password_verify($pass, $correctpassword) && ($loggedIn = FALSE)) {
           $deactivated = TRUE;
           $validationresults = TRUE;
           $loggedIn = FALSE;
        }
        else if (($active == 2) && ($registered == TRUE) && password_verify($pass, $correctpassword) && ($loggedIn = TRUE)) {
           $deactivated = TRUE;
           $validationresults = TRUE;
           $loggedIn = FALSE;
        }
        else if(($active == 0) && ($registered == TRUE) && password_verify($pass, $correctpassword) && ($loggedIn = FALSE)){
            $activate = FALSE;
          $validationresults = TRUE;
          $loggedIn = FALSE;
        }
        else if(($active == 0) && ($registered == FALSE) && ($loggedIn = FALSE) || ($active == 0) && !password_verify($pass, $correctpassword) && ($loggedIn = FALSE)){
            $activate = TRUE;
          $validationresults = FALSE;
          $loggedIn = FALSE;
        }
        else if(($active == 1) && ($registered == TRUE) && password_verify($pass, $correctpassword) && ($loggedIn = TRUE)){
            $activate = TRUE;
          $validationresults = TRUE;
          $loggedIn = TRUE;
        }
        else if (($active == 1) && ($registered == TRUE) && !password_verify($pass, $correctpassword) && ($loggedIn = FALSE)){
//log login failed attempts to database
        	//user login validation fails
        	 $validationresults = FALSE;
        	 $activate = TRUE;
             $deactivated = FALSE;
             $loggedIn = FALSE;
              $result1 = mysqli_query($connection,"SELECT `loginattempt` FROM `users` WHERE `email`='$email'");
              $row = mysqli_fetch_array($result1);
              $loginattempts_email = $row['loginattempt'];
            $loginattempts_email = $loginattempts_email + 1;
            $loginattempts_email = intval($loginattempts_email);
//update login attempt records
         
            mysqli_query($connection,"UPDATE `users` SET `loginattempt` = '$loginattempts_email' WHERE `email` = '$email'");
//Possible brute force attacker is targeting registered emails
//check if has some IP address records

        /*    if (!($fetch = mysqli_fetch_array(mysqli_query($connection,"SELECT `loggedip` FROM `ipcheck` WHERE `loggedip`='$iptocheck'")))) {

//no records
//insert failed attempts

                $loginattempts_total = 1;
                $loginattempts_total = intval($loginattempts_total);
                mysqli_query($connection,"INSERT INTO `ipcheck` (`loggedip`, `failedattempts`) VALUES ('$iptocheck', '$loginattempts_total')");
            } else {

//has some records, increment attempts

                $loginattempts_total = $loginattempts_total + 1;
                mysqli_query($connection,"UPDATE `ipcheck` SET `failedattempts` = '$loginattempts_total' WHERE `loggedip` = '$iptocheck'");
            }*/
        }
        else{
           $validationresults = FALSE;
             $activate = TRUE;
             $deactivated = FALSE;
             $loggedIn = FALSE;
              $result1 = mysqli_query($connection,"SELECT `loginattempt` FROM `users` WHERE `email`='$email'");
              $row = mysqli_fetch_array($result1);
              $loginattempts_email = $row['loginattempt'];
            $loginattempts_email = $loginattempts_email + 1;
            $loginattempts_email = intval($loginattempts_email);
//update login attempt records
         
            mysqli_query($connection,"UPDATE `users` SET `loginattempt` = '$loginattempts_email' WHERE `email` = '$email'"); 
        }
//Possible brute force attacker is targeting randomly

      /*  if ($registered == FALSE) {
            if (!($fetch = mysqli_fetch_array(mysqli_query($connection,"SELECT `loggedip` FROM `ipcheck` WHERE `loggedip`='$iptocheck'")))) {

//no records
//insert failed attempts

                $loginattempts_total = 1;
                $loginattempts_total = intval($loginattempts_total);
                mysqli_query($connection,"INSERT INTO `ipcheck` (`loggedip`, `failedattempts`) VALUES ('$iptocheck', '$loginattempts_total')");
            } else {

//has some records, increment attempts

                $loginattempts_total = $loginattempts_total + 1;
                mysqli_query($connection,"UPDATE `ipcheck` SET `failedattempts` = '$loginattempts_total' WHERE `loggedip` = '$iptocheck'");
            }
        }*/
    } 
    else {
    	//remember me functionality
        $rem = sanitize($_POST["remember"]);
        if(isset($rem)){
        setcookie('email', $email, time()+60*60*7*24);
        setcookie('pass', $pass, time()+60*60*7*24);
        }
        else{
        	if(isset($_COOKIE['email']))
        	{
        		setcookie('email','');
        	}
        	if(isset($_COOKIE['pass']))
        	{
        		setcookie('pass','');
        	}
        }
//user successfully authenticates with the provided email address and password
//Reset login attempts for a specific email address to 0 as well as the ip address

        $loginattempts_email = 0;
        $loginattempts_total = 0;
        $loginattempts_email = intval($loginattempts_email);
        $loginattempts_total = intval($loginattempts_total);
        mysqli_query($connection,"UPDATE `users` SET `loginattempt` = '$loginattempts_email' WHERE `email` = '$email'");
        //mysqli_query("UPDATE `ipcheck` SET `failedattempts` = '$loginattempts_total' WHERE `loggedip` = '$iptocheck'");

//Generate unique signature of the user based on IP address
//and the browser then append it to session
//This will be used to authenticate the user session
//To make sure it belongs to an authorized user and not to anyone else.
//generate random hash
        

        $random = genRandomSaltString();
        $salt_ip = substr($random, 0, $length_salt);

//hash the ip address, user-agent and the salt
        $useragent = $_SERVER["HTTP_USER_AGENT"];
        $hash_user = sha1($salt_ip . $iptocheck . $useragent);

//concatenate the salt and the hash to form a signature
        $signature = $salt_ip . $hash_user;

//Regenerate session id prior to setting any session variable
//to mitigate session fixation attacks

        session_regenerate_id();

       
//Finally store user unique signature in the session
//and set logged_in to TRUE as well as start activity time

        $_SESSION['signature'] = $signature;
        $_SESSION['logged_in'] = TRUE;
        $_SESSION['LAST_ACTIVITY'] = time();
        if (isset($_SESSION['logged_in'])) {
            mysqli_query($connection,"UPDATE `users` SET `online` = '1', ipAddress = '$iptocheck' WHERE `email` = '$email'");
        }
        
    }
}

if (!$_SESSION['logged_in']):
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png" />
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/css/util.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
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
        <div class="login100-form-title" style="background-image:url('assets/images/auth-bg.jpg')">
          <span class="login100-form-title-1">
            Sign In
          </span>
        </div>

        <form class="login100-form" method="POST">

          <div class="wrap-input100 m-b-20">
            <span class="label-input100">Email Address</span>
            <input class="input100" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];}?>"  type="email" name="email" required placeholder="Enter email address">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 m-b-20">
            <span class="label-input100">Password</span>
            <input class="input100" value="<?php if(isset($_COOKIE['pass'])){echo $_COOKIE['pass'];}?>" type="password" name="pass" required placeholder="Enter password">
            <span class="focus-input100"></span>
          </div>
           <div class="flex-sb-m w-full m-b-30">
            <div class="contact100-form-checkbox">
              <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" <?php if(isset($_COOKIE['email'])){ ?> checked <?php }?>>
              <label class="label-checkbox100" for="ckb1">
                Remember Me
              </label>
            </div>
            <div>
              <a href="#" class="txt1" style="text-decoration: none;">
                Forgot Password?
              </a>
            </div>
          </div>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn">
              Login
            </button>
          </div>
          <?php 
          if (($validationresults == FALSE) || ($registered == FALSE) || ($activate == FALSE) || ($deactivated == TRUE) || ($loggedIn == FALSE) || ($illegalattempts == TRUE)){
          ?>
          <div style="margin-top: 20px">
          <!-- Display validation errors -->
                  <?php if ($validationresults == FALSE || $registered == FALSE)
                        echo '<font color="red"><i class="bx bxs-lock bx-flashing"></i>&ensp;Please enter valid email address, password <br> &ensp;&emsp;(if required).</font>';
                        if ($activate == FALSE) { $_SESSION['activation'] = $email;
                        echo '<br><br><font color="red"><i class="bx bxs-lock bx-flashing"></i>&ensp;Your account is still inactive. Kindly <a href = "activation.php" style="color: inherit;">(click here)</a> to<br> &ensp;&emsp;activate the account and try again.</font>'; }
                        if ($deactivated == TRUE) 
                        echo '<br><br><font color="red"><i class="bx bxs-lock bx-flashing"></i>&ensp;Your account has been deactivated. Kindly <br>&ensp;&emsp;contact your administrator to reactivate the <br>&ensp;&emsp;account and try again.</font>';
                       if ($loggedIn == TRUE) 
                        echo '<br><br><font color="red"><i class="bx bxs-error-alt bx-flashing"></i>&ensp;Your account is logged in using another device. <br>&ensp;&emsp;Kindly log out first and try again.</font>';
                        if ($illegalattempts == TRUE)
                        echo '<br><br><font color="red"><i class="bx bxs-error-alt bx-flashing"></i>&ensp;<b><i>Warning!</i></b> Approaching attempt limit and this <br>&ensp;&emsp;account will be deactivated. Kindly reset your <br>&ensp;&emsp;password using the link below (if required).</font>';
                   ?>
                  </div>
            <?php
                 }
           ?>                   
        </form>
      </div>
    </div>
  </div>
</body>
</html>
<?php
else:
	//redirect to dashboard
    header("Location: $home_url"); 
    exit();
endif;
?>