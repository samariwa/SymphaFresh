<?php
require_once "../functions.php";
require('../config.php');
$passwordnotempty = TRUE;
$passwordvalidate = TRUE;
$passwordmatch  = TRUE;
$botDetect = FALSE;
if (isset($_REQUEST['reset_button'])) {
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
  }
  else{
    $botDetect = TRUE;
  }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reset Password</title>
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
            Reset Password
          </span>
        </div>

        <form class="login100-form" method="POST" id="rest-form">

        <div class="wrap-input100 m-b-20">
        <span style="color: red;" id="pass-error"></span>
            <span class="label-input100">New Password</span>
            <input class="input100" type="password" name="pass" id="pass" required placeholder="Enter password">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 m-b-20">
          <span style="color: red;" id="pass2-error"></span>
            <span class="label-input100">Confirm Password</span>
            <input class="input100" type="password" name="pass2" id="pass2" required placeholder="Re-enter password">
            <span class="focus-input100"></span>
          </div>
           <div class="flex-sb-m w-full m-b-30">
           
          </div>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit" name="reset_button">
             Reset
            </button>
          </div>
          <div>
          </div>
          
          <div style="margin-top: 20px">
          <!-- Display validation errors -->
          <?php if ($botDetect == TRUE)
              echo '<font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Access Denied!</font>';
          ?>
          <?php if ($passwordmatch == FALSE)
            echo '<br><font color="red"><i class="bx bxs-lock bx-flashing"></i>&ensp;<font color="red"><i class="bx bxs-error bx-flashing"></i>&ensp;Your passwords do not match.</font>'; ?>
            <?php if ($passwordvalidate = FALSE)
                echo '<br><br><font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Your password should be greater than 8 characters.</font>'; ?>
            <br>
        </div>  
        <input type="hidden" id="token" name="token">                
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript">
		$(function(){
  $(`#pass-error`).hide();
	$(`#pass2-error`).hide();

  var passError = false;
  var pass2Error = false;

  $(`#pass`).focusout(function(){
      check_pass();
  });
  $(`#pass2`).focusout(function(){
      check_pass2();
  });

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

  $(`#reset-form`).submit(function(){
          check_pass(); 
          check_pass2();          

          if (passError == false && pass2Error == false) {
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