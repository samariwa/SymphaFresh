<?php
require('../config.php');
require('../functions.php');
$where = $_POST['where'];
if($where == 'email' )
{
    $email = sanitize($_POST['email']);
   $row = mysqli_query($connection,"SELECT email FROM users WHERE email = '".$email."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
    echo "exists";
   }
   else{
       if($email != '')
       {
         echo "missing";
       }
   }
}
elseif($where == 'mobile' )
{
    $mobile = sanitize($_POST['mobile']);
   $row = mysqli_query($connection,"SELECT mobile FROM users WHERE number = '".$mobile."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
    echo "exists";
   }
} 
elseif($where == 'password' )
{
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);
    $result = mysqli_query($connection,"SELECT `password` FROM `users` WHERE `email`='$email'");
    $row = mysqli_fetch_array($result);
    if ( $row == TRUE) {
        $correctpassword = $row['password'];
        if($password != '')
        {
        if(!password_verify($password, $correctpassword))
            {
                echo "invalid";
            }
        }    
    }
}
?>