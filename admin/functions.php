<?php
   function generateRandomString(){
   	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = 11;
            $string = '';
            for ($p = 0; $p < $charactersLength; $p++) {
                $string .= $characters[rand(0, $charactersLength - 1)];
            }
            return $string;
   }
   function redirectToLoginPage(){
   require('../config.php');
 	header('Location:$login_url');
   	exit();
 }
 function genRandomSaltString() {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $string = '';
            for ($p = 0; $p < $charactersLength; $p++) {
                $string .= $characters[rand(0, $charactersLength - 1)];
            }

            return $string;
        }
  function sanitize($data) {
   require('../config.php');
   $connection = mysqli_connect($hostname,$username, $password, $database)
     or die("Unable to connect to Server");
     $data = trim($data);
     $data = htmlspecialchars($data);
     $data = mysqli_real_escape_string($connection,$data);
     return $data;
}
 ?>