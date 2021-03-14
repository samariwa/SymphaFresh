<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require('config.php');
require('functions.php');
session_start();
$botDetect = FALSE;
if (isset($_REQUEST['submit_button'])) {
	$iptocheck = $_SERVER['REMOTE_ADDR'];
	$url = "https://www.google.com/recaptcha/api/siteverify";
	$data = [
		'secret' => "6LcD5ggaAAAAAKBfRn4dI-qMbsY0yUEERC-dZ7jy",
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
	if ($res['success'] == true) {
		//sanitize user inputs
    $first_name = sanitize($_POST["firstname"]);
    $last_name = sanitize($_POST["lastname"]);
	$location = sanitize($_POST["location"]);
    $email = sanitize($_POST["email"]);
    $mobile = sanitize($_POST["mobile"]);
    $desired_password = sanitize($_POST["pass"]);
    $desired_password1 = sanitize($_POST["pass2"]);
    $random = generateRandomString();
    $hash = password_hash($desired_password, PASSWORD_DEFAULT);
	//Insert details to database
    mysqli_query($connection,"INSERT INTO `users` (`firstname`,`lastname`,`mobile`,`email`,`location`,`password`) VALUES ('$first_name','$last_name','$mobile','$email','$location','$hash')") or die(mysqli_error($connection));
    $result = mysqli_query($connection,"SELECT `id` FROM `users` WHERE `email`='$email'");
          $row = mysqli_fetch_array($result);
          $owner_id = $row['id'];
        $_SESSION['user'] = $first_name;
        $random = genRandomSaltString();
        $salt_ip = substr($random, 0, $length_salt);
        //hash the ip address, user-agent and the salt
        $useragent = $_SERVER["HTTP_USER_AGENT"];
        $hash_user = sha1($salt_ip . $iptocheck . $useragent);
        //concatenate the salt and the hash to form a signature
        $signature = $salt_ip . $hash_user;
        $_SESSION['signature'] = $signature;
        $_SESSION['logged_in'] = TRUE;
        $_SESSION['LAST_ACTIVITY'] = time();
        if (isset($_SESSION['logged_in'])) {
            mysqli_query($connection,"UPDATE `users` SET `online` = '1', ipAddress = '$iptocheck' WHERE `email` = '$email'");
        }
    //Send notification to email
    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/Exception.php";
    require_once "PHPMailer/SMTP.php";
    $mail = new PHPMailer(true);
    $mail -> addAddress("kwanzatukuleauthenticator@gmail.com", "Kwanza Tukule");
    $mail -> setFrom("kwanzatukuleauthenticator@gmail.com", "Kwanza Tukule");
    $mail->IsSMTP();
    $mail->Host = "smtp.gmail.com";
    // optional
    // used only when SMTP requires authentication  
    $mail->SMTPAuth = true;
    $mail->Username = 'kwanzatukuleauthenticator@gmail.com';
    $mail->Password = 'Kenya.2030';
    $mail -> Subject = "New User";
    $mail -> isHTML(true);
    $mail -> Body = "
          Hey there,<br><br>
            A new user has just been registered. Kindly verify user details.<br><br>
            User details:<br> 
            Name: $first_name&ensp;$last_name<br> 
            Email Address:$email<br> <br> <br> 
            <form action='http://192.168.64.2/QRCode/index'>
		       <input type='submit' value='Verify' />
            </form>
            Kind Regards,
            ";
    $mail -> send();
     header("Location: $dashboard_url");
     exit;
	}
	else{
		$botDetect = TRUE;
	}
 }
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
    <script src="https://www.google.com/recaptcha/api.js?render=6LcD5ggaAAAAAPkNgg9MMdNk7Wn6qr6lbyY9s4fi"></script>
</head>
<body>	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image:url('assets/images/auth-bg.jpg')">
					<span class="login100-form-title-1">
						Sign Up
					</span>
				</div>  
				<form class="login100-form" id="registration-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

					<div class="wrap-input100 m-b-20">
						<span class="label-input100">First Name</span>
						<input class="input100" type="text" name="firstname" id="firstname" required placeholder="Christine">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span class="label-input100">Last Name</span>
						<input class="input100" type="text" name="lastname" id="lastname" required placeholder="Washiali">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span class="label-input100">Physical Address</span>
						<input class="input100" type="text" name="location" id="location" required placeholder="&#xf041; Lang'ata, Nairobi, Kenya" style="font-family:Arial, FontAwesome">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span style="color: red;" id="email-error"></span>
						<span class="label-input100">Email Address</span>
						<input class="input100" type="email" name="email" id="email" required placeholder="&#xf0e0; christine*****@gmail.com" style="font-family:Arial, FontAwesome">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span style="color: red;" id="mobile-error"></span>
						<span class="label-input100">Mobile Number</span>
						<input class="input100" type="text" name="mobile" id="mobile" required placeholder="&#xf095; +254 7## ### ###" style="font-family:Arial, FontAwesome">
						<span class="focus-input100" ></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span style="color: red;" id="pass-error"></span>
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" id="pass" required placeholder="Enter password">
						<span class="focus-input100" ></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span style="color: red;" id="pass2-error"></span>
						<span class="label-input100">Confirm Password</span>
						<input class="input100" type="password" name="pass2" id="pass2" required placeholder="Re-enter password">
						<span class="focus-input100" ></span>
					</div>

					<div class="flex-sb-m w-full m-b-30" style="margin-top: 30px">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" required name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								I agree to the <a href="#" style="color: inherit;text-decoration: underline;">Terms and Conditions</a>
							</label>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="submit_button">
							Register
						</button>
					</div>	
					<div style="margin-top: 20px">
		                  <!-- Display error -->
		                  <?php if ($botDetect == TRUE)
		                        echo '<font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Access Denied!</font>';
		                   ?>
                  </div>
					<input type="hidden" id="token" name="token">       		        
				</form>
			</div>
		</div>
	</div>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(function(){
		  $(`#email-error`).hide();
		  $(`#mobile-error`).hide();
		  $(`#pass-error`).hide();
		  $(`#pass2-error`).hide();

		  var emailError = false;
          var mobileError = false;
          var passError = false;
          var pass2Error = false;

           $(`#email`).focusout(function(){
              check_email();
          });
          $(`#mobile`).focusout(function(){
              check_mobile();
          });
          $(`#pass`).focusout(function(){
              check_pass();
          });
          $(`#pass2`).focusout(function(){
              check_pass2();
          });

          
          function check_email(){
          	var email = $(`#email`).val();
          	var where = 'email';
            $.post("verification.php",{email:email,where:where},
              function(result){
              	if (result == 'exists') {
              		$(`#email-error`).show();
              		$(`#email-error`).html('<i class="bx bxs-data bx-flashing"></i>&ensp;This email address already exists.');
              		emailError = true;

              	}
              	else{
              		$(`#email-error`).hide();
              		$(`#email-error`).html('');
              		emailError = false;
              	}
            });
        }


 
        function check_mobile(){
          	var mobile = $(`#mobile`).val();
          	var where = 'mobile';
              $.post("verification.php",{mobile:mobile,where:where},
              function(result){
              	if (result == 'exists') {
              		$(`#mobile-error`).show();
              		$(`#mobile-error`).html('<i class="bx bxs-data bx-flashing"></i>&ensp;This mobile number already exists.');
              		mobileError = true;
              	}
              	else{
              		$(`#mobile-error`).hide();
              		$(`#mobile-error`).html('');
              		emailError = false;
              	}
          });
        }

        function check_pass(){
          	var pass = $(`#pass`).val().length;
          	if (pass > 0 && pass < 8) {
              $(`#pass-error`).show();
              $(`#pass-error`).html('<i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Password should be greater than 8 characters.');
              passError = true;
          	}
          	else{
               $(`#pass-error`).hide();
              	$(`#pass-error`).html('');
              	passError = false;
          	}
          	
        }
        function check_pass2(){
          	var pass2 = $(`#pass2`).val();
          	var pass = $(`#pass`).val();
          	if( pass2 !== pass && pass2 != ''){
          		$(`#pass2-error`).show();
              $(`#pass2-error`).html('<i class="bx bxs-error bx-flashing"></i>&ensp;Your passwords do not match.');
              pass2Error = true;
          	}
          	else{
          		$(`#pass2-error`).hide();
              	$(`#pass2-error`).html('');
              	pass2Error = false;
          	}
          	
        } 

        $(`#registration-form`).submit(function(){
          emailError = false;
          mobileError = false;
          passError = false;
          pass2Error = false;

          check_email();
          check_mobile();
          check_pass(); 
          check_pass2();          

          if (emailError == false && mobileError == false && passError == false && pass2Error == false) {
          	return true;
          }else{
          	return false;
          }
        });
     });

     grecaptcha.ready(function() {
    // do request for recaptcha token
    // response is promise with passed token
        grecaptcha.execute('6LcD5ggaAAAAAPkNgg9MMdNk7Wn6qr6lbyY9s4fi', {action:'validate_captcha'})
                  .then(function(token) {
            // add token value to form
            console.log(token);
            document.getElementById('token').value = token;
        });
    });
	</script>
  </body>
</html>