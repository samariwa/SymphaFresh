<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//require user configuration and database connection parameters
//Start PHP session
session_start();
//require user configuration and database connection parameters
require('../config.php');
require_once "../functions.php";
if (isset($_SESSION['logged_in'])) {
	if ($_SESSION['logged_in'] == TRUE) {
//valid user has logged-in to the website
//Check for unauthorized use of user sessions
    mysqli_query($connection,"UPDATE `users` SET `on` = '1' WHERE `username` = '$user'");
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
        header("Location: $dashboard_url");
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

if ((isset($_POST["pass"])) && (isset($_POST["user"])) && ($_SESSION['logged_in'] == FALSE)) {

//Username and password has been submitted by the user
//Receive and sanitize the submitted information


    $user = sanitize($_POST["user"]);
    $pass = sanitize($_POST["pass"]);
    $_SESSION['user'] = $user;
    $roleSession = mysqli_query($connection,"SELECT jobs.Name as Name FROM `users` inner join jobs on users.Job_id = jobs.id WHERE `username`='$user'");
        $row5 = mysqli_fetch_array($roleSession);
        $role = $row5['Name'];      
         $_SESSION['role'] = $role;
//validate username
    if (!($fetch = mysqli_fetch_array(mysqli_query($connection,"SELECT `username` FROM `users` WHERE `username`='$user'")))) {
//no records of username in database
//user is not yet registered
        $registered = FALSE;
    }

//Grab login attempts from MySQL database for a corresponding username
        $result1 = mysqli_query($connection,"SELECT `loginattempt` FROM `users` WHERE `username`='$user'");
        $row = mysqli_fetch_array($result1);
        $loginattempts_username = $row['loginattempt'];

    if (($loginattempts_username == 5) && ($registered == TRUE)) {
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
                An unusual login attempt using $user's account has been detected.<br> Please ensure that it is an authorized attempt. If it isn't kindly notify Mariwa for necessary security measures to be taken.<br> Thank you for your co-operation.<br><br>
                Kind Regards,
                ";
        $mail -> send();
        
    }
    //display warning message
if (($loginattempts_username == 5) && ($registered == TRUE)) {
        $illegalattempts = TRUE; 
    }
if (($loginattempts_username > 5) && ($registered == TRUE)) {
      mysqli_query($connection,"UPDATE `users` SET `active` = '2' WHERE `username` = '$user'"); 
      $deactivated = TRUE; 
    }
//Get correct hashed password based on given username stored in MySQL database

  //check if account is activated
      $result3 = mysqli_query($connection,"SELECT `active` FROM `users` WHERE `username`='$user'");
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
  $result2 = mysqli_query($connection,"SELECT `ipAddress` FROM `users` WHERE `username`='$user'");
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
//username is registered in database, now get the hashed password    
    $result = mysqli_query($connection,"SELECT `password` FROM `users` WHERE `username`='$user'"); 
    $row = mysqli_fetch_array($result);
        $correctpassword = $row['password'];
    if (!password_verify($pass, $correctpassword) || ($registered == FALSE) || ($activate == FALSE) || ($deactivated == TRUE) || ($loggedIn == TRUE)) {
    	$result1 = mysqli_query($connection,"SELECT `active` FROM `users` WHERE `username`='$user'");
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
              $result1 = mysqli_query($connection,"SELECT `loginattempt` FROM `users` WHERE `username`='$user'");
              $row = mysqli_fetch_array($result1);
              $loginattempts_username = $row['loginattempt'];
            $loginattempts_username = $loginattempts_username + 1;
            $loginattempts_username = intval($loginattempts_username);
//update login attempt records
         
            mysqli_query($connection,"UPDATE `users` SET `loginattempt` = '$loginattempts_username' WHERE `username` = '$user'");
//Possible brute force attacker is targeting registered usernames
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
              $result1 = mysqli_query($connection,"SELECT `loginattempt` FROM `users` WHERE `username`='$user'");
              $row = mysqli_fetch_array($result1);
              $loginattempts_username = $row['loginattempt'];
            $loginattempts_username = $loginattempts_username + 1;
            $loginattempts_username = intval($loginattempts_username);
//update login attempt records
         
            mysqli_query($connection,"UPDATE `users` SET `loginattempt` = '$loginattempts_username' WHERE `username` = '$user'"); 
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
        setcookie('user', $user, time()+60*60*7*24);
        setcookie('pass', $pass, time()+60*60*7*24);
        }
        else{
        	if(isset($_COOKIE['user']))
        	{
        		setcookie('user','');
        	}
        	if(isset($_COOKIE['pass']))
        	{
        		setcookie('pass','');
        	}
        }
//user successfully authenticates with the provided username and password
//Reset login attempts for a specific username to 0 as well as the ip address

        $loginattempts_username = 0;
        $loginattempts_total = 0;
        $loginattempts_username = intval($loginattempts_username);
        $loginattempts_total = intval($loginattempts_total);
        mysqli_query($connection,"UPDATE `users` SET `loginattempt` = '$loginattempts_username' WHERE `username` = '$user'");
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
            mysqli_query($connection,"UPDATE `users` SET `on` = '1', ipAddress = '$iptocheck' WHERE `username` = '$user'");
        }
        
    }
}

if (!$_SESSION['logged_in']):
    ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sympha Fresh | Login</title>
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
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card" style="opacity: 0.8">
                  <br>  
                <h4 style="text-align: center;"><i class="fa fa-user"></i>&ensp;Login</h4>
                <div class="card-body">         
                    <form method="POST" >
                         <br>
                         <p style="text-align: center;"><i><b>Restricted Access</b></i></p>
                         <p style="text-align: center;font-size: 15px;"><i>(This site is restricted to public access. Please enter username and password to proceed.)</i></p>
                         <br>
                        <div class="form-group row" >
                            <label for="user"  class="offset-md-2 col-form-label text-md-right">Username:</label>

                            <div class="col-md-6 ">
                                <input id="user" type="text"  name="user" value="<?php if(isset($_COOKIE['user'])){echo $_COOKIE['user'];}?>" required autocomplete="text" autofocus class="<?php if ($validationresults == FALSE)
                                echo "invalid"; ?>">
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group row" >
                            <label for="pass" class="  offset-md-2 col-form-label text-md-right">Password:</label>

                            <div class="col-md-6 ">
                                <input id="pass" type="password"  name="pass" required autocomplete="current-password" class=" <?php if ($validationresults == FALSE)
                            echo "invalid"; ?>" value="<?php if(isset($_COOKIE['pass'])){echo $_COOKIE['pass'];}?>">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE['user'])){ ?> checked <?php }?> >
                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <?php if ($validationresults == FALSE || $registered == FALSE)
                        echo '&emsp;&emsp;<font color="red"><i class="bx bxs-lock bx-flashing"></i>&ensp;Please enter valid username, password (if required).</font>'; ?>
                        <?php if ($activate == FALSE) { $_SESSION['activation'] = $user;
                        echo '&emsp;&emsp;<font color="red"><i class="bx bxs-lock bx-flashing"></i>&ensp;Your account is still inactive. Kindly <a href = "activation.php" style="color: inherit;">(click here)</a> to<br> &emsp;&emsp;&emsp;&emsp;activate the account and try again.</font>';} ?>
                        <?php if ($deactivated == TRUE) 
                        echo '&emsp;&emsp;<font color="red"><i class="bx bxs-lock bx-flashing"></i>&ensp;Your account has been deactivated. Kindly contact <br>&emsp;&emsp;your administrator to reactivate the account and try again.</font>'; ?>
                        <?php if ($loggedIn == TRUE) 
                        echo '&emsp;&emsp;&ensp;<font color="red"><i class="bx bxs-error-alt bx-flashing"></i>&ensp;Your account is logged in using another device.<br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Kindly log out first and try again.</font>'; ?>
                        <?php if ($illegalattempts == TRUE)
                        echo '&emsp;&emsp;<font color="red"><i class="bx bxs-error-alt bx-flashing"></i>&ensp;<b><i>Warning!</i></b> Approaching attempt limit and this account will be &emsp;&emsp;deactivated. Kindly reset your password using the link below &emsp;&ensp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(if required).</font>'; ?>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-5"><br>
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-8 offset-md-4">
                         <a href="forgotPassword.php">Forgot Password</a>
                       </div>
                    </form>
                </div>
                
            </div>
           <br>
        </div>
    </div>
</div>
  </body>
</html>
<?php
else:
	//redirect to dashboard
    header("Location: $dashboard_url"); 
    exit();
endif;
?>