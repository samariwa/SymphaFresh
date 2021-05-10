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
    mysqli_query($connection,"UPDATE `users` SET `on` = '1' WHERE `email` = '$email'");
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
        header("Location: ../$logout_url?page_url=<?php echo $redirect_link; ?>");
        exit;
    }
    else{
      $logged_in_email = $_SESSION['email'];
      $session_access = mysqli_query($connection,"SELECT * FROM `users` WHERE `email`='$logged_in_email'");
        $row = mysqli_fetch_array($session_access);
        $access = $row['access'];
      if($access == 'customer'){
        header("Location: ../$home_url"); 
        exit();
      }else{
        header("Location: ../$admin_url"); 
        exit();
      }
    }

//Session Lifetime control for inactivity

    if ((isset($_SESSION['LAST_ACTIVITY'])) && (time() - $_SESSION['LAST_ACTIVITY'] > $sessiontimeout)) {
//redirect the user back to login page for re-authentication
         header("Location: ../$logout_url?page_url=<?php echo $redirect_link; ?>");
        exit;
    }
    $_SESSION['LAST_ACTIVITY'] = time();
}
}
//Pre-define validation
$validationresults = TRUE;
$registered = TRUE;
$botDetect = FALSE;
//Check if a user has logged-in
if (!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = FALSE;
}
if(isset($_REQUEST['login-button'])){
  $url = $token_verification_site;
	$data = [
		'secret' => $private_key,
		'response' => $_POST['token'],
    'remoteip' => $iptocheck
	];
  $options = array(
		'http' => array(
		 'header' => "Content-type: application/x-www-form-urlencoded\r\n",
		     'method' => 'POST',
		     'content' => http_build_query($data)
		 )
	);
  $context = stream_context_create($options);
	$response = file_get_contents($url, false, $context);
	$res = json_decode($response, true);
	if ($res['success'] == true && $res['score'] >= 0.5) {
//Check if the form is submitted
if ((isset($_POST["pass"])) && (isset($_POST["email"])) && ($_SESSION['logged_in'] == FALSE)) {
//Email and password has been submitted by the user
//Receive and sanitize the submitted information


    $email = sanitize($_POST["email"]);
    $pass = sanitize($_POST["pass"]);
    $Name = mysqli_query($connection,"SELECT * FROM `users` WHERE `email`='$email'");
        $row = mysqli_fetch_array($Name);
        $identity = $row['firstname'];
        $user_id = $row['id'];
        $user_email = $row['email'];
        $access = $row['access'];
        $roleSession = mysqli_query($connection,"SELECT jobs.Name as Name FROM `users` inner join jobs on users.Job_id = jobs.id WHERE `email`='$user_email'");
        $row5 = mysqli_fetch_array($roleSession);
        $role = $row5['Name'];      
     $_SESSION['role'] = $role;
    $_SESSION['user'] = $identity;
    $_SESSION['email'] = $user_email;
//validate email
    if (!($fetch = mysqli_fetch_array(mysqli_query($connection,"SELECT `email` FROM `users` WHERE `email`='$email'")))) {
//no records of email in database
//user is not yet registered
        $registered = FALSE;
    }
   
//u is registered in database, now get the hashed password    
    $result = mysqli_query($connection,"SELECT `password` FROM `users` WHERE `email`='$email'");
        $row = mysqli_fetch_array($result);
        $correctpassword = $row['password'];
    if (!password_verify($pass, $correctpassword) || ($registered == FALSE)) {
    
           $validationresults = FALSE;
              $result1 = mysqli_query($connection,"SELECT `loginattempt` FROM `users` WHERE `email`='$email'");
              $row = mysqli_fetch_array($result1);
              $loginattempts_email = $row['loginattempt'];
            $loginattempts_email = $loginattempts_email + 1;
            $loginattempts_email = intval($loginattempts_email);
//update login attempt records
         
            mysqli_query($connection,"UPDATE `users` SET `loginattempt` = '$loginattempts_email' WHERE `email` = '$email'"); 
     
    } 
    else {
    	//remember me functionality
        $rem = sanitize($_POST["remember"]);
        if(isset($rem)){
        setcookie('email', $email, $remember_me_expiry);
        setcookie('pass', $pass, $remember_me_expiry);
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
          mysqli_query($connection,"INSERT INTO `logged_devices` (`user`,`ip_address`,`browser/device`) VALUES ('$user_id','$iptocheck','$useragent')");
        }
        
    }
}
}
else{
  $botDetect = TRUE;
}
}
if (!$_SESSION['logged_in']):
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="shortcut icon" type="image/png" sizes="196x196" href="../assets/images/sympha_fresh_white.png" />
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
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo $public_key; ?>"></script>
    
</head>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-form-title" style="background-image:url('../assets/images/auth-bg.jpg')">
          <span class="login100-form-title-1">
            Sign In
          </span>
        </div>

        <form class="login100-form" method="POST" id="login-form">

          <div class="wrap-input100 m-b-20">
						<span style="color: red;" id="email-error"></span>
            <span class="label-input100">Email Address</span>
            <input class="input100" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];}?>"  type="email" name="email" id="email" required placeholder="Enter email address">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 m-b-20">
						<span style="color: red;" id="password-error"></span>
            <span class="label-input100">Password</span>
            <input class="input100" value="<?php if(isset($_COOKIE['pass'])){echo $_COOKIE['pass'];}?>" type="password" name="pass" id="pass" required placeholder="Enter password">
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
              <a href="forgot.php" class="txt1" style="text-decoration: none;">
                Forgot Password?
              </a>
            </div>
          </div>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn" name="login-button">
              Login
            </button>
          </div>
          <div>
            <br>
             <p>Don't have an account?&ensp;<a href="registration.php" style="color: inherit;text-decoration: underline;">Register</a></p>
          </div>
          <?php 
          if (($validationresults == FALSE) || ($registered == FALSE)){
          ?>
          <div style="margin-top: 20px">
          <!-- Display validation errors -->
                     <?php if ($botDetect == TRUE)
		                        echo '<font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Access Denied!</font>';
		                   ?>
                  <?php if ($validationresults == FALSE || $registered == FALSE)
                        echo '<font color="red"><i class="bx bxs-lock bx-flashing"></i>&ensp;Please enter valid email address, password <br> &ensp;&emsp;(if required).</font>';
                   ?>
                  </div>
            <?php
                 }
           ?>
           <input type="hidden" id="token" name="token">                   
        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript">
  $(function(){
    $(`#email-error`).hide();
    $(`#password-error`).hide();

    var emailError = false;
    var passError = false;
 
    $(`#email`).focusout(function(){
        check_email();
      });
    $(`#pass`).focusout(function(){
        check_pass();
      });

      function check_email(){
          	var email = $(`#email`).val();
          	var where = 'email';
            $.post("verification.php",{email:email,where:where},
              function(result){
              	if (result == 'missing') {
              		$(`#email-error`).show();
              		$(`#email-error`).html('<i class="bx bxs-data bx-flashing"></i>&ensp;This email address does not exists.');
              		emailError = true;
              	}
              	else{
              		$(`#email-error`).hide();
              		$(`#email-error`).html('');
              		emailError = false;
              	}
            });
        }

        function check_pass(){
          var email = $(`#email`).val();
          	var password = $(`#pass`).val();
          	var where = 'password';
              $.post("verification.php",{email:email,password:password,where:where},
              function(result){
              	if (result == 'invalid') {
              		$(`#password-error`).show();
              		$(`#password-error`).html('<i class="bx bxs-data bx-flashing"></i>&ensp;Invalid Password.');
              		passError = true;
              	}
              	else{
              		$(`#password-error`).hide();
              		$(`#password-error`).html('');
              		passError = false;
              	}
          });
        }

        $(`#login-form`).submit(function(){

          check_email();
          check_pass();   

          if (emailError == false &&  passError == false) {
          	return true;
          }else{
          	return false;
          }
        });

  });

  grecaptcha.ready(function() {
    // do request for recaptcha token
    // response is promise with passed token
        grecaptcha.execute('<?php echo $public_key; ?>', {action:'validate_captcha'})
                  .then(function(token) {
            // add token value to form
            document.getElementById('token').value = token;
        });
    });
  </script>
</body>
</html>
<?php
else:
	//redirect to dashboard
  if($access == 'customer'){
    $redirect_page = $_REQUEST['page_url'];
    if($redirect_link == ''){
      header("Location: ../$home_url"); 
      exit();
    }
    else{
      header("Location: $redirect_page"); 
    exit();
    }
  }else{
    header("Location: ../$admin_url"); 
    exit();
  }
endif;
?>