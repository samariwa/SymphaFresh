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

//Defining length of salt,minimum=10, maximum=35
$length_salt = 15;

//Defining the maximum number of failed attempts to ban brute force attackers
//minimum is 5
$maxfailedattempt = 5;

//Defining session timeout in seconds
//minimum 60 (for one minute)
$sessiontimeout = 60*30;

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
if(strpos($protocol, "HTTPS"))
{
    $protocol="HTTPS://";
}
else
{
    $protocol="HTTP://";
}
$redirect_link = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>