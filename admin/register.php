<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require_once "../functions.php";
require('../config.php');
session_start();
 //Pre-define validation
$usernamenotempty = TRUE;
$usernamevalidate = TRUE;
$usernotduplicate = TRUE;
$passwordnotempty = TRUE;
$passwordvalidate = TRUE;
$passwordmatch  = TRUE;
$active = TRUE;
if ((isset($_POST["pass"])) && (isset($_POST["user"])) && (isset($_POST["pass2"]))) {
//Username and Password has been submitted by the user
//Receive and validate the submitted information
//sanitize user inputs
    $first_name = sanitize($_POST["first"]);
    $last_name = sanitize($_POST["last"]);
    $phone_no = sanitize($_POST["number"]);
    $email = sanitize($_POST["email"]);
    $national_id = sanitize($_POST["national"]);
    $staff_id = sanitize($_POST["staff"]);
    $dob = sanitize($_POST["dob"]);
    $gender = sanitize($_POST["gender"]);
    $role = sanitize($_POST["role"]);
    $desired_username = sanitize($_POST["user"]);
    $desired_password = sanitize($_POST["pass"]);
    $desired_password1 = sanitize($_POST["pass2"]);


//validate username

    if (empty($desired_username)) {
        $usernamenotempty = FALSE;
    } else {
        $usernamenotempty = TRUE;
    }

    if ( ((strlen($desired_username)) > 11)) {
        $usernamevalidate = FALSE;
    } else {
        $usernamevalidate = TRUE;
    }

    if (!($fetch = mysqli_fetch_array(mysqli_query($connection,"SELECT `username` FROM `users` WHERE `username`='$desired_username'")))) {
//no records for this user in the MySQL database
        $usernotduplicate = TRUE;
    } else {
       $usernotduplicate = FALSE;
    }

    if (!($fetch = mysqli_fetch_array(mysqli_query($connection,"SELECT `nationalID` FROM `users` WHERE `nationalID`='$national_id'")))) {
//no records for this user in the MySQL database
        $usernotduplicate = TRUE;
    } else {
        $usernotduplicate = FALSE;
    }

    if (!($fetch = mysqli_fetch_array(mysqli_query($connection,"SELECT `staffID` FROM `users` WHERE `staffID`='$staff_id'")))) {
//no records for this user in the MySQL database
        $usernotduplicate = TRUE;
    } else {
        $usernotduplicate = FALSE;
    }

    if (!($fetch = mysqli_fetch_array(mysqli_query($connection,"SELECT `email` FROM `users` WHERE `email`='$email'")))) {
//no records for this user in the MySQL database
        $usernotduplicate = TRUE;
    } else {
        $usernotduplicate = FALSE;
    }
//validate password

    if (empty($desired_password)) {
        $passwordnotempty = FALSE;
    } else {
        $passwordnotempty = TRUE;
    }
//php function ctype_alnum for checking the characters used in registration
    if ( ((strlen($desired_password)) < 8)) {
        $passwordvalidate = FALSE;
    } else {
        $passwordvalidate = TRUE;
    }

    if ($desired_password == $desired_password1) {
        $passwordmatch = TRUE;
    } else {
        $passwordmatch = FALSE;
    }

    if (($usernamenotempty == TRUE)
        && ($usernamevalidate == TRUE)
        && ($usernotduplicate == TRUE)
        && ($passwordnotempty == TRUE)
        && ($passwordmatch == TRUE)
        && ($passwordvalidate == TRUE)
        ) {
    $active = FALSE;
//The username, password and recaptcha validation succeeds.
//Hash the password
//This is very important for security reasons because once the password has been compromised,
//The attacker cannot still get the plain text password equivalent without brute force.

  $hash = password_hash($desired_password, PASSWORD_DEFAULT);

  //check the id number of the job      
    $role_query = mysqli_query($connection,"SELECT id FROM `jobs` WHERE `Name`='$role'");
    $role1 = mysqli_fetch_array($role_query);
    $job = $role1['id'];
//Insert details password to MySQL database

        mysqli_query($connection,"INSERT INTO `users` (`Job_id`,`firstname`,`lastname`,`number`,`email`,`nationalID`,`staffID`,`yob`,`gender`,`username`, `password`) VALUES ('$job','$first_name','$last_name','$phone_no','$email','$national_id','$staff_id','$dob','$gender','$desired_username', '$hash')") or die(mysqli_error($connection));
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
              Hi Sam,<br><br>
                A new user has been just been registered. Kindly ensure that the registration has done by a rightful user.<br><br>
                User details:<br> 
                Name: $first_name&ensp;$last_name<br> 
                Phone Number:$phone_no<br> 
                Email Address:$email<br> 
                Role:$role<br><br> <br> 
                Kind Regards,
                ";
        $mail -> send();

    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sympha Fresh | Register</title>
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
        <div class="col-md-8">
            <div class="card" style="opacity: 0.8">
                  <br>  
                <h4 style="text-align: center;"><i class="fa fa-user-plus"></i>&ensp;Register</h4>
                <div class="card-body">         
                    <form method="POST" >
                        <div class="form-group row" >
                            <label for="first"  class="offset-md-1 col-form-label text-md-right" style="margin-left: 110px">First Name:</label>

                            <div class="col-md-3 ">
                                <input id="first" type="text"  name="first" value="" required autocomplete="text" autofocus>
                            </div>
                            <label for="last"  class="offset-md-0 col-form-label text-md-right" style="margin-left: 60px">Last Name:</label>

                            <div class="col-md-3 ">
                                <input id="last" type="text"  name="last" value="" required autocomplete="text" autofocus>
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label for="number"  class="offset-md-1 col-form-label text-md-right" style="margin-left: 50px">Telephone Number:</label>

                            <div class="col-md-3 ">
                                <input id="number" type="text"  name="number" value="" required autocomplete="text" autofocus>
                            </div>
                            <label for="email"  class="offset-md-0 col-form-label text-md-right" style="margin-left: 35px">Email Address:</label>

                            <div class="col-md-3 ">
                                <input id="email" type="email"  name="email" value="" required autocomplete="email" autofocus>
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label for="national"  class="offset-md-1 col-form-label text-md-right" style="margin-left: 80px">National ID No.:</label>

                            <div class="col-md-2 ">
                                <input id="national" type="number"  name="national" value="" required autocomplete="number" autofocus>
                            </div>
                            <label for="staff"  class="offset-md-1 col-form-label text-md-right" style="margin-left: 125px">Staff ID No.:</label>

                            <div class="col-md-3 ">
                                <input id="staff" type="number"  name="staff" value="" required autocomplete="number" autofocus>
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label for="dob"  class="offset-md-1 col-form-label text-md-right"style="margin-left: 95px">Date of Birth:</label>

                            <div class="col-md-3 ">
                                <input id="dob" type="date"  name="dob" value="" required autocomplete="date" autofocus>
                            </div>
                            <label for="gender"  class="offset-md-1 col-form-label text-md-right" style="margin-left: 85px">Gender:</label>

                            <div class="col-md-3 ">
                               <select id="gender" name="gender" class="form-control">
                                    <option value="">Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                    </select>
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label for="role"  class="offset-md-1 col-form-label text-md-right" style="margin-left: 155px">Role:</label>

                            <div class="col-md-3 ">
                                <select id="role" name="role" class="form-control">
                                    <option value="">Role</option>
                                    <option value="CEO">CEO</option>
                                    <option value="Director">Director</option>
                                    <option value="Data Entry Clerk">Data Entry Clerk</option>
                                    <option value="Admin2">Admin 2</option>
                                    <option value="Stores Supervisor">Stores Supervisor</option>
                                    </select>
                            </div>
                            <label for="user"  class="offset-md-2 col-form-label text-md-right" style="margin-left: 65px">Username:</label>

                            <div class="col-md-3 ">
                                <input id="user" type="text"  name="user" value="" required autocomplete="text" autofocus class="<?php if (($usernamenotempty == FALSE) || ($usernamevalidate == FALSE) || ($usernamenotduplicate == FALSE)) echo "invalid"; ?>" id="desired_username" name="desired_username">
                            </div>
                        </div>
                        <div class="form-group row" >
                           <label for="pass"  class="offset-md-1 col-form-label text-md-right" style="margin-left: 115px">Password:</label>

                            <div class="col-md-3 ">
                                <input id="pass" type="password"  name="pass" value="" required  autofocus class="<?php if (($passwordnotempty == FALSE) || ($passwordmatch == FALSE) || ($passwordvalidate == FALSE)) echo "invalid"; ?>" id="desired_password">
                            </div>
                            <label for="pass2"  class="offset-md-1 col-form-label text-md-right" style="margin-left: 10px">Confirm Password:</label>

                            <div class="col-md-3 ">
                                <input id="pass2" type="password"  name="pass2" value="" required  autofocus class="<?php if (($passwordnotempty == FALSE) || ($passwordmatch == FALSE) || ($passwordvalidate == FALSE)) echo "invalid"; ?>" id="desired_password1">
                            </div>
                        </div>
                        <p style="color: grey ;margin-left:100px;font-size: 14px;"><i>Hint: For a secure account, password should have more than 8 alphanumeric characters.</i></p>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-2 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                            <div class="col-md-2 offset-md-0">
                                <button type="reset" class="btn btn-primary">
                                    Reset
                                </button>
                            </div>
                        </div>
                        <!-- Display validation errors -->
                         <?php 
					         if ($active == FALSE) {  $_SESSION['activation'] = $desired_username;
					        echo '<br><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;<font color="green"><i class="bx bx-check-circle bx-flashing"></i>&ensp;Registration Complete. Kindly <a href="activation.php" style="color: inherit;">(click here)</a> to activate your account.</font>'; } ?>
					        <?php 
					         if ($passwordmatch == FALSE)
					        echo '<br><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;<font color="red"><i class="bx bxs-error bx-flashing"></i>&ensp;Your passwords do not match.</font>'; ?>
					<?php  if ($passwordvalidate == FALSE)
					        echo '<br><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Your password should be greater than 8 characters.</font>'; ?>
					   <?php if ($usernamevalidate == FALSE)
					        echo '<br><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Your username should be less than 11 characters.</font>'; ?>
					     <?php if ($usernotduplicate == FALSE)
					        echo '<br><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<font color="red"><i class="bx bxs-data bx-flashing"></i>&ensp;User already exists.</font>'; ?>
                    </form>
                </div>
                <br><br>
            </div>
           <br><br><br>
        </div>
    </div>
</div>
  </body>
</html>