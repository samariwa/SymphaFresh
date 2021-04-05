<?php
 include "admin_nav.php";
  include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Profile</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
          <?php
           include "dashboard_tabs.php";
          ?>
         <br>
        <?php
         $user = $_SESSION['user'];
         $profileQuery = mysqli_query($connection,"SELECT firstname,lastname,number,email,jobs.Name as job,nationalID,staffID,yob,gender FROM users INNER JOIN jobs WHERE firstname = '$user'")or die($connection->error);
          $result = mysqli_fetch_array($profileQuery);
          $firstname = $result['firstname'];
          $lastname = $result['lastname'];
          $number = $result['number'];
          $email = $result['email'];
          $job = $result['job'];
          $nationalid = $result['nationalID'];
          $staffid = $result['staffID'];
          $yob = $result['yob'];
          $gender = $result['gender'];
          $currentYear = date("Y");
          $age = $currentYear - $yob;
        ?>
                        <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="assets/img/avatar.jpg" class="rounded-circle" width="150" />
                                    <h4 class="card-title m-t-10"><?php echo $firstname." ".$lastname; ?></h4>
                                    <h6 class="card-subtitle"><?php echo $view; ?></h6><br>
                                    <h6 class="card-subtitle" >Staff ID: <span id="staffid"><?php echo $staffid; ?></span></h6><br>
                                    <h6 class="card-subtitle">Age: <?php echo $age; ?></h6><br>
                                    <h6 class="card-subtitle">Gender: <?php echo $gender; ?></h6>
                                </center>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tab panes -->
                            <div class="card-body">
                                <form class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12">Username</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?php echo $user; ?>" class="form-control form-control-line" name="username" id="username" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" value="<?php echo $email; ?>" class="form-control form-control-line" name="email" id="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?php echo $number; ?>" class="form-control form-control-line" name="number" id="number" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">National Id</label>
                                        <div class="col-md-12">
                                           <input type="text" value="<?php echo $nationalid; ?>" class="form-control form-control-line" name="nationalid" id="nationalid" required>
                                         </div>
                                    </div><br>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" onclick="updateProfile()">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 