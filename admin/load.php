<?php
require('../config.php');
session_start();
$user = $_SESSION['user'];
$userId = mysqli_query($connection,"SELECT id  FROM `users` WHERE username = '$user'")or die($connection->error);
$value = mysqli_fetch_array($userId);
$userID = $value['id'];
$calendarQuery = mysqli_query($connection,"SELECT * FROM event where User_id = '$userID' ORDER BY id")or die($connection->error);
foreach($calendarQuery as $row){
 	$data[] = array(
       'id' => $row['id'],
       'title' => $row['title'],
       'start' => $row['start_event'],
       'end' => $row['end_event'],
       'textColor'=> 'white',
       'backgroundColor'=>'green',
       'borderColor'=>'yellow'
 	);	   
    }
    echo json_encode($data);
    ?> 