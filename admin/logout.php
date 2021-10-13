<?php
session_start();
require('../config.php');

function sanitize($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_SESSION['logged_in'])) {
	$user = $_SESSION['user'];
   mysqli_query($connection,"UPDATE `users` SET `on` = '0', `lastActivity` = NOW(), ipAddress = '0' WHERE `username` = '$user'");
    $_SESSION['logged_in'] = False;
    session_destroy();
    session_unset();
   header("Location: $login_url"); 
    exit();
}
    ?>