<?php
session_start();
require('../config.php');

function sanitize($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_SESSION['logged_in'])) {
	$email = $_SESSION['email'];
    $session_access = mysqli_query($connection,"SELECT * FROM `users` WHERE `email`='$email'");
    $row = mysqli_fetch_array($session_access);
    $access = $row['access'];
   mysqli_query($connection,"UPDATE `users` SET `online` = '0', `lastActivity` = NOW(), ipAddress = '0' WHERE `email` = '$email'");
    $_SESSION['logged_in'] = False;
    session_destroy();
    session_unset();
    if($access == 'customer'){
        $redirect_page = $_REQUEST['page_url'];
        if(($redirect_link == '') || ($redirect_link == $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/auth/login.php')){
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
}
    ?>