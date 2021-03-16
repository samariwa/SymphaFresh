<?php
require 'config.php';
$profile_details = mysqli_query($connection,"SELECT firstname,lastname,email,username,location,mobile FROM users ORDER where id = ''")or die($connection->error);
?>