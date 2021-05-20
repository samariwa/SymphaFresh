<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">
           <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Home</span></h1>
            <h6 style="margin-left: 500px;">Time: <span id="time"></span></h6>
            <form method="post">
            <a  name="create_pdf" href="reportPDF.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mr-2"><i class="fa fa-download fa-sm text-white-50"></i> Export Report</a>
           </form>
          </div>
          <?php
       }
       else{
        ?>
         <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <h6 style="margin-right: 20px;">Time: <span id="time"></span></h6>
          </div>
        <?php
         }
         include "dashboard_tabs.php";
        ?>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-success">Sales Done Monthly Overview</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">View:</div>
                      <a class="dropdown-item" href="#">Last Week</a>
                      <a class="dropdown-item" href="#">Last Week but one</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <div id="curve_chart" style="width: 640px; height: 320px;"></div>
                  
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-success">Product Sales Weekly Overview</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">View:</div>
                      <a class="dropdown-item" href="#">Last Week</a>
                      <a class="dropdown-item" href="#">Last Week but one</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->

    <div id="piechart2" style="width: 310px; height: 310px;"></div>
                  </div>
                  <div class="mt-4 text-center small">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-tasks"></i> Today's Tasks</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Processing orders <span class="float-right">20%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Inspecting work area <span class="float-right">60%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Debriefing staff <span class="float-right">80%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Order Inventory <span class="float-right">Complete!</span></h4>
                  <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>  
            </div>
            <div class="col-lg-3 mb-4" style="margin-left: -7px;margin-top: 50px">   
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-success">Registered Customers</h6>    
                </div>
                <!-- Card Body -->
    <div class="card-body" style=" height: 200px;">
      <br>
      <i class="fa fa-address-book fa-4x" style="margin-left: 70px;"></i>
      <br><br>
      <?php 
        $customersrowcount = mysqli_num_rows($customersList);
      ?>
      <p style="text-align: center;font-size: 35px"><?php echo $customersrowcount; ?></p>
    </div>
 </div>
            </div>
            <div class="col-lg-3 mb-5" style="margin-left: -10px;margin-top: 50px">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">Newsletter Subscribers</h6>
                </div>
                <div class="card-body" style=" height: 200px;">  
                  <br>
                  <i class="fa fa-envelope fa-4x" style="margin-left: 70px"></i>
                  <br><br>
                  <?php 
                  $subscribersrowcount = mysqli_num_rows($subscribersList);
                  ?>
                  <p style="text-align: center;font-size: 35px"><?php echo $subscribersrowcount ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 