<?php
require('config.php');
session_start();
$activation = $_SESSION['activation'];
mysqli_query($connection,"UPDATE `users` SET `active` = '1' WHERE `username` = '$activation'");
session_destroy();
session_unset();
header('Location: login.php');
exit();
?>