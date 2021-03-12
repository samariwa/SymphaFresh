<?php
//require user configuration and database connection parameters
///////////////////////////////////////
//START OF USER CONFIGURATION/////////
/////////////////////////////////////
//Define MySQL database parameters

$username = "root";
$password = "";
$hostname = "127.0.0.1";
$database = "zolo";
$port = "3306";

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
$login_url = 'login';
$logout_url = 'logout.php';
$dashboard_url = 'dashboard';
?>