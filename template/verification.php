<?php
require('config.php');
$where = $_POST['where'];
if($where == 'email' )
{
    $email = $_POST['email'];
   $row = mysqli_query($connection,"SELECT email FROM subscribers WHERE email = '".$email."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
    echo "exists";
   }
}
elseif($where == 'mobile' )
{
    $mobile = $_POST['mobile'];
   $row = mysqli_query($connection,"SELECT mobile FROM subscribers WHERE mobile = '".$mobile."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
    echo "exists";
   }
}
elseif($where == 'businessname' )
{
    $businessname = $_POST['businessname'];
   $row = mysqli_query($connection,"SELECT name FROM businesses WHERE name = '".$businessname."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
    echo "exists";
   }
}   
elseif($where == 'username' )
{
    $username = $_POST['username'];
   $row = mysqli_query($connection,"SELECT username FROM subscribers WHERE username = '".$username."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
    echo "exists";
   }   
}
?>