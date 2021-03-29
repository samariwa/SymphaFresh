<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Users</span></h1>
            <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
             <?php
           include "dashboard_tabs.php";
          ?>
        <br>
         <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
         <div class="row" id="status_change" style="margin-left: 50px">
           <h2>Users</h2>
           <?php
                function deactivate($user){
                  $username = $user;
                mysqli_query($connection,"UPDATE `users` SET `active` = '2' WHERE `username` = '".$username."'")or die($connection->error);
                 }
                 function reactivate($user){
                  $username = $user;
                mysqli_query($connection,"UPDATE `users` SET `active` = '1',`loginattempts` = '0' WHERE `username` = '".$username."'")or die($connection->error); 
                 }
             $usersrowcount = mysqli_num_rows($usersList);
           ?>
      <h6 style="margin-left: 300px;">Total Number: <?php echo $usersrowcount; ?></h6>
         </div>
          <div class="row" style="margin-left: 50px">
           <h5><u>Online</u></h5>
         </div><br>
         <div  style="margin-left: 50px;margin-top: -30px;">
           <?php 
           $count = 0;
           foreach($usersList as $row){
            $count++;
             $name = $row['firstname'];
            $activity = $row['online'];
            $lastActivity = $row['lastActivity'];
            $active = $row['active'];
            $login = $row['loginattempt'];
               if ($activity == 1) {
                echo "<div class='row'>
                <div class='col-md-7'>
                <img src='assets/img/online.png' height='10' width='10' style='margin-top:0px;'>&emsp;" . $name . 
                "</div>
                <div class='col-md-5'>
                <form method='post'>
                <button id='deactivate' name='$name' class='btn btn-danger btn-sm active ' role='button' aria-pressed='true'><i class='fa fa-toggle-off'></i>&ensp;Deactivate</button>
                </form>
                 </div>
                </div><br/>";  
                if (isset($_POST[$name])){
                  mysqli_query($connection,"UPDATE `users` SET `active` = '2' WHERE `username` = '".$name."'")or die($connection->error);
                }    
               }
               else if (($activity == 1) && ($active == 2)) {
                echo "<div class='row'>
                <div class='col-md-7'>
                <img src='assets/img/online.png' height='10' width='10' style='margin-top:0px;'>&emsp;" . $name . 
                "</div>
                <div class='col-md-5'>
                <form method='post'>
                <button id='reactivate' name='$name' class='btn btn-success btn-sm active ' role='button' aria-pressed='true'><i class='fa fa-toggle-on'></i>&ensp;Reactivate</button>
                </form>
                 </div>
                </div><br/>"; 
                if (isset($_POST[$name])){
                  mysqli_query($connection,"UPDATE `users` SET `active` = '1',`loginattempt` = '0' WHERE `username` = '".$name."'")or die($connection->error); 
                }   
               }
             }
            ?>
         </div>
         <div class="row" style="margin-left: 50px">
           <h5><u>Offline</u></h5>
         </div>
         <div  style="margin-left: 50px;margin-top: 0px;">
           <?php 
           $count2 = 0;
           foreach($usersList as $row){
            $count2++;
             $name = $row['firstname'];
            $activity = $row['online'];
            $active = $row['active'];
            $login = $row['loginattempt'];
            $lastActivity = $row['lastActivity'];
            $date = date( 'l, F d, Y h:i A', strtotime($lastActivity) );
            $day = date('d.m.Y',strtotime($date));
            $yesterday = date('d.m.Y',strtotime("yesterday"));  
            $time = date("h:i A",strtotime($lastActivity));  
            $today = date('d.m.Y', time());
               if (($activity == 0) && ($day == $yesterday) && ($active == 1)) {
                echo "<div class='row'>
                <div class='col-md-7'>
                <img src='assets/img/offline.png' height='10' width='10' style='margin-top:0px;'>&emsp;" . $name . "&emsp;Last Seen: Yesterday $time 
                </div>
                <div class='col-md-5'>
                <form method='post'>
                <button  class='btn btn-danger btn-sm active ' role='button' aria-pressed='true' id='deactivate' name='$name'><i class='fa fa-toggle-off'></i>&ensp;Deactivate</button>
                </form>
                </div>
                </div><br/>"; 
                if (isset($_POST[$name])){
                   mysqli_query($connection,"UPDATE `users` SET `active` = '2' WHERE `username` = '".$name."'")or die($connection->error);  
                } 
               }
                else if (($activity == 0) && ($day == $yesterday) && ($active == 2)) {
                echo "<div class='row'>
                <div class='col-md-7'>
                <img src='assets/img/offline.png' height='10' width='10' style='margin-top:0px;'>&emsp;" . $name . "&emsp;Last Seen: Yesterday $time 
                </div>
                <div class='col-md-5'>
                <form method='post'>
                <button class='btn btn-success btn-sm active ' role='button' aria-pressed='true' id='reactivate' name='$name'><i class='fa fa-toggle-on'></i>&ensp;Reactivate</button>
                </form>
                </div>
                </div><br/>"; 
                if (isset($_POST[$name])){
                mysqli_query($connection,"UPDATE `users` SET `active` = '1',`loginattempt` = '0' WHERE `username` = '".$name."'")or die($connection->error); 
                }     
               }
               else if(($activity == 0) && ($day == $today) && ($active == 1)){
                echo "<div class='row'>
                <div class='col-md-7'>
                <img src='assets/img/offline.png' height='10' width='10' style='margin-top:0px;'>&emsp;" . $name . "&emsp;Last Seen: $time
                 </div>
                <div class='col-md-5'>
                <form method='post'>
                <button class='btn btn-danger btn-sm active ' role='button' aria-pressed='true' id='deactivate' name='$name'><i class='fa fa-toggle-off'></i>&ensp;Deactivate</button>
                </form>
                </div>
                 </div><br/>"; 
                 if (isset($_POST[$name])){
                   mysqli_query($connection,"UPDATE `users` SET `active` = '2' WHERE `username` = '".$name."'")or die($connection->error);
                } 
               }
                else if (($activity == 0) && ($day == $yesterday) && ($active == 2)) {
                echo "<div class='row'>
                <div class='col-md-7'>
                <img src='assets/img/offline.png' height='10' width='10' style='margin-top:0px;'>&emsp;" . $name . "&emsp;Last Seen: $time
                 </div>
                <div class='col-md-5'>
                <form method='post'>
                <button class='btn btn-success btn-sm active ' role='button' aria-pressed='true' id='reactivate' name='$name'><i class='fa fa-toggle-on'></i>&ensp;Reactivate</button>
                </form>
                </div>
                 </div><br/>";  
                 if (isset($_POST[$name])){
                 mysqli_query($connection,"UPDATE `users` SET `active` = '1',`loginattempt` = '0' WHERE `username` = '".$name."'")or die($connection->error); 
                }   
               }
               else if(($activity == 0) && ($day != $yesterday) && ($day != $today) && ($active == 1)){
                echo "<div class='row'>
                <div class='col-md-7'>
                <img src='assets/img/offline.png' height='10' width='10' style='margin-top:0px;'>&emsp;" . $name . "&emsp;Last Seen: $date
                </div>
                <div class='col-md-5'>
                <form method='post'>
                <button class='btn btn-danger btn-sm active' role='button' aria-pressed='true' id='deactivate' name='$name'><i class='fa fa-toggle-off'></i>&ensp;Deactivate</button>
                </form>
                </div>
                </div><br/>"; 
                if (isset($_POST[$name])){
                   mysqli_query($connection,"UPDATE `users` SET `active` = '2' WHERE `username` = '".$name."'")or die($connection->error);
                } 
               }
               else if(($activity == 0) && ($day != $yesterday) && ($day != $today) && ($active == 2)){
                echo "<div class='row'>
                <div class='col-md-7'>
                <img src='assets/img/offline.png' height='10' width='10' style='margin-top:0px;'>&emsp;" . $name . "&emsp;Last Seen: $date
                </div>
                <div class='col-md-5'>
                <form method='post'>
                <button class='btn btn-success btn-sm active' role='button' aria-pressed='true' id='reactivate' name='$name'><i class='fa fa-toggle-on'></i>&ensp;Reactivate</button>
                </form>
                </div>
                </div><br/>"; 
                if (isset($_POST[$name])){
                  mysqli_query($connection,"UPDATE `users` SET `active` = '1',`loginattempt` = '0' WHERE `username` = '".$name."'")or die($connection->error); 
                }   
               }
               else if($active == 0){
                echo "<div class='row'>
                <div class='col-md-7'>
                <img src='assets/img/offline.png' height='10' width='10' style='margin-top:0px;'>&emsp;" . $name . "
                </div>
                <div class='col-md-5'>
                <button class='btn btn-danger btn-sm active' role='button' aria-pressed='true' disabled ><i class='fa fa-ban'></i>&ensp;Inactive Account</button>
                </div>
                </div><br/>"; 
               }
             }
            ?>
         </div>
         <br>
         <div style="font-size:14px;margin-left: 100px;">
             <p>For purposes of accountability and additional security, kindly deactivate accounts of employees who are off work or on leave.</p>
         </div>
         <?php
          }else{
        ?>
        <div class="row" style="margin-left: 50px">
           <h2>Users</h2>
           <?php
             $usersrowcount = mysqli_num_rows($usersList);
           ?>
      <h6 style="margin-left: 300px;">Total Number: <?php echo $usersrowcount; ?></h6>
         </div>
          <div class="row" style="margin-left: 50px">
           <h5><u>Online</u></h5>
         </div><br>
         <div  style="margin-left: 50px;margin-top: -30px;">
           <?php 
           $count = 0;
           foreach($usersList as $row){
            $count++;
             $name = $row['username'];
            $activity = $row['on'];
            $lastActivity = $row['lastActivity'];
               if ($activity == 1) {
                echo "<div class='row'>
                <div class='col-md-7'>
                <img src='assets/img/online.png' height='13' width='13' style='margin-top:0px;'>&emsp;" . $name . 
                "</div>
                </div><br/>";
                 
               }
             }
            ?>
         </div>
         <div class="row" style="margin-left: 50px">
           <h5><u>Offline</u></h5>
         </div>
         <div  style="margin-left: 50px;margin-top: 0px;">
           <?php 
           $count2 = 0;
           foreach($usersList as $row){
            $count2++;
             $name = $row['username'];
            $activity = $row['on'];
            $lastActivity = $row['lastActivity'];
            $date = date( 'l, F d, Y h:i A', strtotime($lastActivity) );
            $day = date('d.m.Y',strtotime($date));
            $yesterday = date('d.m.Y',strtotime("yesterday"));  
            $time = date("h:i A",strtotime($lastActivity));  
            $today = date('d.m.Y', time());
               if (($activity == 0) && ($day == $yesterday)) {
                echo "<div class='row'>
                <div class='col-md-7'>
                <img src='assets/img/offline.png' height='13' width='13' style='margin-top:0px;'>&emsp;" . $name . "&emsp;Last Seen: Yesterday $time 
                </div>
                </div><br/>";    
               }else if(($activity == 0) && ($day == $today)){
                echo "<div class='row'>
                <div class='col-md-7'>
                <img src='assets/img/offline.png' height='13' width='13' style='margin-top:0px;'>&emsp;" . $name . "&emsp;Last Seen: $time
                 </div>
                 </div><br/>"; 
               }else if(($activity == 0) && ($day != $yesterday) && ($day != $today)){
                echo "<div class='row'>
                <div class='col-md-7'>
                <img src='assets/img/offline.png' height='13' width='13' style='margin-top:0px;'>&emsp;" . $name . "&emsp;Last Seen: $date
                </div>
                </div><br/>"; 
               }
             }
            ?>
         </div>
         <br>
        <?php
          }
        ?>
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 