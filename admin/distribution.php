<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 
 <!-- Begin Page Content -->
        <div class="container-fluid">
  <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Sales</span><span style="font-size: 15px;"> /Goods Distribution</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <?php
           include "dashboard_tabs.php";
          ?>

         <div class="row">
         <div class="col-2">  
      <a href="sales.php" class="btn btn-primary btn-md active float-left ml-3" role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
         </div
    </div><br><br>
     <div class="row">
      <div class="col-md-10 offset-1">
        <h6 class="col-md-10 offset-1">To print tomorrow's distribution list, enter deliverer's name and click the 'Print button'. Otherwise include point in time from which the distribution list should be printed.</h6><br>
        </div>
     </div>
        <div class="row">
          <div class="col-md-7 offset-2">
                 <select type="text" name="deliverer" id="deliverer" class="form-control col-md-12 " style="padding-right:15px;padding-left:15px;" required onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();' required>
                  <option value="" selected="selected" disabled>Deliverer...</option>
                  <?php
                    $count = 0;
                    foreach($deliverersStaffList as $row){
                     $count++;
                    $driver = $row['firstname'];
                  ?>
                   <option value="<?php echo $driver; ?>"><?php echo $driver; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                 </div>
                  </div><br><br>

        <div class="row">
          <div class="col-md-7 offset-2">
           <div class="input-group mb-3">
          <div class="input-group-prepend" >
           <span class="input-group-text" id="inputGroup-sizing-default">Point in Time:</span>
           </div>
         <input type="text" class="form-control col-md-12" aria-label="Default" aria-describedby="inputGroup-sizing-default" style="font-family: FontAwesome, Arial; font-style: normal;"  name="time" id="distributionTime">
       </div>
       </div>
        </div><br>

        <div class="row">
          <div class="col-md-2 offset-5">
           <button class="btn btn-light btn-md active printDistribution" role="button" aria-pressed="true"><i class="fa fa-print"></i>&ensp;Print</button>
         </div>
        </div><br><br>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 