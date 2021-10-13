<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 
 <!-- Begin Page Content -->
        <div class="container-fluid">
  <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Site visitors</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <?php
           include "dashboard_tabs.php";
          ?>

         
     <div class="row">
        <h5 class="col-md-6 offset-4">Traffic flow per page</h5><br>
     </div>
     <?php
     $total_website_views = total_views($connection); // Returns total website views
     echo "<strong>Total Website Views:</strong> " . $total_website_views;
     ?>
     <div class="row">
        <h6 class="col-md-6 offset-2" style="text-align:center">For more traffic insight, visit <a href="https://dashboard.tawk.to/#/dashboard/6044ce9b385de407571d74b6">Tawk.to</a></h6><br>
     </div>
       <br>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 