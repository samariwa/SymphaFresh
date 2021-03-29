<?php
require('../config.php');
$where = $_POST['where'];
if($where == 'email' )
{
    $email = $_POST['email'];
   $row = mysqli_query($connection,"SELECT email FROM users WHERE email = '".$email."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
    echo "exists";
   }
}
elseif($where == 'mobile' )
{
    $mobile = $_POST['mobile'];
   $row = mysqli_query($connection,"SELECT mobile FROM users WHERE number = '".$mobile."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
    echo "exists";
   }
} 
?>