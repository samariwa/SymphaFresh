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
    $user_id = $row['id'];
   mysqli_query($connection,"UPDATE `users` SET `online` = '0', `lastActivity` = NOW(), ipAddress = '0' WHERE `email` = '$email'");
   mysqli_query($connection,"DELETE FROM `logged_devices` WHERE `user` = '$user_id' AND ip_address = '$iptocheck'");
    $_SESSION['logged_in'] = False;
    session_destroy();
    session_unset();
    if($access == 'customer'){
        $redirect_page = $_REQUEST['page_url'];
        $profile_link = FALSE;
        if (strpos($redirect_link, 'profile.php') == TRUE) {
          $profile_link = TRUE;
      }
      elseif (strpos($redirect_link, 'checkout.php') == TRUE){
        $profile_link = TRUE;
      }
      elseif (strpos($redirect_link, 'order-details.php') == TRUE){
        $profile_link = TRUE;
      }
      elseif (strpos($redirect_link, 'track-order-single.php') == TRUE){
        $profile_link = TRUE;
      }
      elseif (strpos($redirect_link, 'track-order.php') == TRUE){
        $profile_link = TRUE;
      }
      elseif (strpos($redirect_link, 'user-dashboard.php') == TRUE){
        $profile_link = TRUE;
      }
      elseif (strpos($redirect_link, 'wishlist.php') == TRUE){
        $profile_link = TRUE;
      }
      elseif (strpos($redirect_link, 'login.php') == TRUE){
        $profile_link = TRUE;
      }
        if(($redirect_link == '') || ($profile_link == TRUE)){
          header("Location: ../$home_url"); 
          exit();
        }
        else{
          header("Location: $redirect_page"); 
        exit();
        }
      }else{
        header("Location: ../$home_url"); 
        exit();
      }
}
    ?>