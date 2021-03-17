<?php
 include "admin_nav.php";
 include('queries.php');
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Help Center</span></h1>
            <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
            <?php
           include "dashboard_tabs.php";
          ?>
        <br>
        <h3>Contact Us</h3>
        <p>Have queries or/and recommendations?</p>
        <h6><i class="fa fa-comment"></i>&ensp;<i><b>Engage with a support specialist</b></i></h6>
        <p>Get quick help with your queries / recommendations via messaging support that operates 24/7.</p>
        <div class="row">
        <button data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-light btn-md active ml-3" role="button" aria-pressed="true" ><i class="fa fa-comment"></i>&ensp;Message Now</button>
         <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Message Support</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                  <div class="row">
                 <textarea  name="query" id="query" class="form-control col-md-9" required  placeholder="Enter your query / recommendation here..." style="padding:15px;margin-left: 60px" ></textarea>
                  </div><br> 
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" name="sendQuery">Send</button>
            </form>
              <?php
                if (isset($_POST['sendQuery'])){
                   $query = $_POST['query'];
                  $result1 = mysqli_query($connection,"SELECT * FROM `users` WHERE `username`='$logged_in_user'");
                  $row = mysqli_fetch_array($result1);
                  $number = $row['number'];
                  $email = $row['email'];
                  $firstname = $row['firstname'];
                  $lastname = $row['lastname'];
                  require_once "PHPMailer/PHPMailer.php";
                  require_once "PHPMailer/Exception.php";
                  require_once "PHPMailer/SMTP.php";
                   $mail = new PHPMailer(true);
                  $mail -> addAddress('symphaenterprises@gmail.com','Kwanza Tukule');
                  $mail -> setFrom("symphaenterprises@gmail.com", "Kwanza Tukule");
                  $mail->IsSMTP();
                  $mail->Host = "smtp.gmail.com";
                  // optional
                  // used only when SMTP requires authentication  
                  $mail->SMTPAuth = true;
                  $mail->Username = 'kwanzatukuleauthenticator@gmail.com';
                  $mail->Password = 'Kenya.2030';
                  $mail -> Subject = "Help & Support";
                  $mail -> isHTML(true);
                  $mail -> Body = "
                        Hi Sam,<br><br>
                          One of the software users has a query / recommedation for you. Please help them out ASAP.<br><br> 
                          Message: $query
                          <br>
                          Contact User:<br>
                          Name: $firstname $lastname <br>
                          Phone Number: $number <br>
                          Email: $email
                          <br><br>
                          Kind Regards,
                          ";
                  $mail -> send();
                  echo '<script language="javascript">';
                  echo 'alert("Message Successfully Sent. Thank you for messaging us. You will receive response as soon as possible.")';
                  echo '</script>';
                }  
              ?>   
            </div>
          </div>
        </div>
      </div>
        </div><br>
        <p>You could also engage with use via the live chat by clicking on the icon on the right of your screen.</p>
        <h6><i class="fa fa-phone "></i>&ensp;<i><b>Call Us</b></i></h6>
        <p>Get in touch with us for real time support during our business hours.</p>
        <p>Just Call: <b>(+254) 713 932 911</b></p>
        <h5><b>Business Hours: </b></h5>
        <p>Weekdays -> 8 am - 5 pm</p>
        <p>Saturdays -> 8 am - 12.30 pm</p>
        <br>
        <h6><i class="bx bxs-smile"></i>&ensp;<b>We're happy to help</b></h6>
  <?php
   if (fsockopen('mariwa.ddns.net', 10080)){
    ?>
  <h6 style="text-align: right;">Backup Server Status:&ensp;<img src='assets/img/online.png' height='10' width='10' style='margin-top:0px;'>&ensp; Up</h6>
   <?php
} else{
?>
<h6 style="text-align: right;">Backup Server Status:&ensp;<img src='assets/img/offline.png' height='10' width='10' style='margin-top:0px;'>&ensp; Down</h6>
   <?php
     }
    ?>
        <h6></h6>
   <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='chat.js';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->     
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 