<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Delivery Trucks</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <?php
           include "dashboard_tabs.php";
          ?>

        <div class="row">
          <div class="col-md-4">
             <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-success btn-md active" role="button" aria-pressed="true"><i class="fa fa-plus-circle"></i>&ensp;New Vehicle</a>
       <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">New Vehicle</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                 <div class="row">
                 <input type="text" name="type" id="type" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Vehicle Type..." required>
                  </div><br>
                  <div class="row">
                 <select type="text" name="driver" id="driver" class="form-control col-md-9" style="padding-right:15px;padding-left:15px;margin-left: 60px" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();' required>
                  <option value="" selected="selected" disabled>Vehicle Driver...</option>
                  <?php
                    foreach($deliverersStaffList as $row){           
                    $driver = $row['firstname'];
                  ?>
                   <option value="<?php echo $driver; ?>"><?php echo $driver; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                  </div><br>
                  <div class="row">
                 <input type="text" name="reg" id="reg" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Registration Number..." required>
                  </div><br>
                  <div class="row">
                 <input type="text" name="route" id="route" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Vehicle Route..." required>
                  </div>
                  <input type="hidden" name="where" id= "where"  value="vehicles">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="addVehicle">Add Vehicle</button>
            </form>
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="col-md-8">
           <?php
        $vehiclesrowcount = mysqli_num_rows($vehicleList);
      ?>
      <h6 class="offset-2">Total Number: <?php echo $vehiclesrowcount; ?></h6>
      </div>
        </div><br>

        <table id="vehiclesEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="5%">#</th>
      <th scope="col" width="12%">Vehicle Type</th>
      <th scope="col" width="12%">Reg. No.</th>
      <th scope="col" width="12%">Route</th>
      <th scope="col" width="12%">Mileage</th>
      <th scope="col"width="40%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($vehicleList as $row){
         $count++;
         $id = $row['id'];
        $type = $row['Type'];
        $reg = $row['Reg_Number'];
        $route = $row['Route'];
        $mileage = $row['Mileage'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="uneditable" id="type<?php echo $count; ?>"><?php echo $type; ?></td>
      <td class="uneditable" id="reg<?php echo $count; ?>"><?php echo $reg; ?></td>
      <td class="editable" id="route<?php echo $count; ?>"><?php echo $route; ?></td>
      <td class="editable" id="mileage<?php echo $count; ?>"><?php echo $mileage; ?> Kms.</td>
       <td>
        <button data-toggle="modal" data-target="#exampleModalScrollable<?php echo $id?>" id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-warning btn-sm active viewVehicle" role="button" aria-pressed="true" ><i class="fa fa-eye"></i>&ensp;View Details</button>
        <div class="modal fade" id="exampleModalScrollable<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Vehicle Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php 
              $vehiclesList = mysqli_query($connection,"SELECT users.firstname as driver,vehicles.id as id,Driver_id,Type,Reg_Number,Route,Last_service,notes,Next_service FROM vehicles INNER JOIN vehicle_service ON vehicles.id=vehicle_service.Vehicle_id INNER JOIN users ON vehicles.Driver_id=users.id where vehicles.id = '$id' ")or die($connection->error);
                 $vehicle = mysqli_fetch_array($vehiclesList);
                  $Driver = $vehicle['driver'];
                  $Driver_id = $vehicle['Driver_id'];
                  $Last = $vehicle['Last_service'];
                  $Next = $vehicle['Next_service'];
                  $Notes = $vehicle['notes'];
              ?> 
              <div class="row" style="padding:15px;margin-left: 60px">
                     <h5><b>Driver:</b></h5>
                 </div>
                 <div class="row"  style="padding:15px;margin-left: 60px;margin-top: -30px">
                  <?php echo $Driver ?>
                     <select type="text" name="driver" id="driver<?php echo $id?>" class="form-control col-md-9" style="padding-right:15px;padding-left:15px;margin-left: 10px" required onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();' required>
                  <option value="<?php echo $Driver_id ?>" selected="selected" disabled>Change Vehicle Driver...</option>
                  <?php
                    foreach($deliverersStaffList as $row){
                     $driver_id = $row['id'];
                    $driver = $row['firstname'];
                  ?>
                   <option value="<?php echo $driver_id; ?>"><?php echo $driver; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                 <button type="submit" class="btn btn-primary saveDriver" style="margin-top: 20px;margin-left: 200px" id="<?php echo $id?>">Save</button>
                  </div><br>
                 <div class="row" style="padding:15px;margin-top: -20px;margin-left: 60px">
                     <h5><b>Last Service Date:</b></h5>
                 </div>
                 <div class="row"  style="padding:15px;margin-left: 60px;margin-top: -30px;">
                      <?php echo $Last ?>
                  </div><br>
                   <div class="row" style="padding:15px;margin-left: 60px">
                     <h5><b>Service Notes:</b></h5><br><br>
                  </div>
                 <div class="row"  style="padding:15px;margin-left: 60px;margin-top: -30px;">
                       <?php echo $Notes ?>
                  </div><br>
                   <div class="row" style="padding:15px;margin-left: 60px">
                     <h5><b>Next Service Date:</b></h5><br>
                  </div>
                 <div class="row"  style="padding:15px;margin-left: 60px;margin-top: -30px;">
                        <?php echo $Next ?>
                  </div>
                  <?php 
              $vehiclesList = mysqli_query($connection,"SELECT Last_Inspection,notes,Next_Inspection FROM vehicles INNER JOIN vehicle_inspection ON vehicles.id=vehicle_inspection.Vehicle_id INNER JOIN users ON vehicles.Driver_id=users.id where vehicles.id = '$id' ")or die($connection->error);
                $vehicle = mysqli_fetch_array($vehiclesList);
                  $last = $vehicle['Last_Inspection'];
                  $next = $vehicle['Next_Inspection'];
                  $notes = $vehicle['notes'];
              ?> 
              <div class="row" style="padding:15px;margin-left: 60px">
                     <h5><b>Last Inspection Date:</b></h5>
                 </div>
                 <div class="row"  style="padding:15px;margin-left: 60px;margin-top: -30px;">
                      <?php echo $last ?>
                  </div><br>
                   <div class="row" style="padding:15px;margin-left: 60px">
                     <h5><b>Inspection Notes:</b></h5><br><br>
                  </div>
                 <div class="row"  style="padding:15px;margin-left: 60px;margin-top: -30px;">
                       <?php echo $notes ?>
                  </div><br>
                   <div class="row" style="padding:15px;margin-left: 60px">
                     <h5><b>Next Inspection Date:</b></h5><br>
                  </div>
                 <div class="row"  style="padding:15px;margin-left: 60px;margin-top: -30px;">
                        <?php echo $next ?>
                  </div>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
       <button data-toggle="modal" data-target="#exampleModalScrollable2<?php echo $id?>" class="btn btn-light btn-sm active" role="button" aria-pressed="true"><i class="fa fa-wrench"></i>&ensp;Service</button>
       <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable2<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Add Service Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                 <div class="row">
                  <label for="now" style="margin-left: 60px">Service Date...</label>
                 <input type="date" name="now" id="now<?php echo $id?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px"  required>
                  </div><br>
                  <div class="row">
                 <input type="text" name="note" id="note<?php echo $id?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Service Notes..." >
                  </div><br>
                  <div class="row">
                     <label for="next" style="margin-left: 60px">Next Service Date...</label>
                 <input type="date" name="next" id="next<?php echo $id?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px"  required>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary addService" style="margin-right: 50px" id="<?php echo $id?>">Save Details</button>
            </form>
            </div>
          </div>
        </div>
      </div>
      </div>
      <button data-toggle="modal" data-target="#exampleModalScrollable3<?php echo $id?>" class="btn btn-light btn-sm active" role="button" aria-pressed="true"><i class="fa fa-check-square"></i>&ensp;Inspection</button>
       <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable3<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Add Inspection Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                 <div class="row">
                  <label for="now" style="margin-left: 60px">Inspection Date...</label>
                 <input type="date" name="now" id="Now<?php echo $id?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px"  required>
                  </div><br>
                  <div class="row">
                 <input type="text" name="note" id="Note<?php echo $id?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Inspection Notes..." >
                  </div><br>
                  <div class="row">
                     <label for="next" style="margin-left: 60px">Next Inspection Date...</label>
                 <input type="date" name="next" id="Next<?php echo $id?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px"  required>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary addInspection" style="margin-right: 50px" id="<?php echo $id?>">Save Details</button>
            </form>
            </div>
          </div>
        </div>
      </div>
      </div>
        <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteVehicle" role="button" aria-pressed="true" ><i class="fa fa-trash"></i>&ensp;Delete</button>
       </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 