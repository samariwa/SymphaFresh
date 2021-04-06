<?php
//require user configuration and database connection parameters
///////////////////////////////////////
//START OF USER CONFIGURATION/////////
/////////////////////////////////////
//Define MySQL database parameters

$username = "root";
$password = "";
$hostname = "192.168.100.150";
$database = "sympha_fresh";
$port = "3307";

//Defining authenticator credentials
$authenticator_email = 'symphauthenticator@gmail.com';
$authenticator_password = 'Kenya.2030';

//mail host
$mail_host = "smtp.gmail.com";

//site primary contact number
$contact_number = "+254 713 932 911";

//business physical address
$physical_address = "This address";

//Defining organization details
$organization = 'Sympha Fresh';

//Defining Recaptcha parameters
$privatekey = "Recaptcha private key";
$publickey = "Recaptcha public key";

//Defining length of salt,minimum=10, maximum=35
$length_salt = 15;

//User browser
$useragent = $_SERVER["HTTP_USER_AGENT"];

//Defining the maximum number of failed attempts to ban brute force attackers
//minimum is 5
$maxfailedattempts = 5;

//Defining session timeout in seconds
//minimum 60 (for one minute)
$sessiontimeout = 60*30;

//client ip address
$iptocheck = $_SERVER['REMOTE_ADDR'];

//Defining cookies timeout in seconds
//remember me cookies
$remember_me_expiry = time()+60*60*7*24;
//cart cookies
$cart_expiry = time() +60*60*7*24;

////////////////////////////////////
//END OF USER CONFIGURATION/////////
////////////////////////////////////
//DO NOT EDIT ANYTHING BELOW!

$connection = mysqli_connect($hostname,$username, $password, $database, $port)
or die("Unable to connect to Server");
$login_url = 'auth/login.php';
$logout_url = 'auth/logout.php';
$home_url = 'template/index.php';
$admin_url = 'admin/dashboard.php';
$protocol = $_SERVER['SERVER_PROTOCOL'];
if(strpos($protocol, "https"))
{
    $protocol="https://";
}
else
{
    $protocol="http://";
}
$redirect_link = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>