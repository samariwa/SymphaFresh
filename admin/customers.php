<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Customers</span></h1>
            <h6 class="text-gray-600" style="margin-left: 500px;">Time: <span id="time"></span></h6>
             <button class="btn btn-light btn-md active printCustomers mr-3" role="button" aria-pressed="true" ><i class="fa fa-print"></i>&ensp;Print</button>
          </div>
        <?php
           include "dashboard_tabs.php";
          ?>
    <div class="row">
      <div class="col-md-3">
      <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-success btn-md active" role="button" aria-pressed="true"><i class="fa fa-plus-circle"></i>&ensp;New Customer</a>
      <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">New Customer</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                <div class="row">
                 <input type="text" name="name" id= "name" class="form-control col-md-9" style="padding:15px;margin-left: 60px" required  placeholder="Customer Name...">
                  </div><br>
                 <div class="row">
                 <input type="text" name="location" id= "location" class="form-control col-md-9" required style="padding:15px;margin-left: 60px" placeholder="Customer Location...">
                  </div><br>
                 <div class="row">
                 <input type="text" name="number" id= "number"class="form-control col-md-9" required style="padding:15px;margin-left: 60px" placeholder="Contact Number...">
                  </div><br>
                <!-- <div class="row">
                 <select type="text" name="deliverer" id="deliverer" class="form-control col-md-9" style="padding-right:15px;padding-left:15px;margin-left: 60px" required onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();' required>
                  <option value="" selected="selected" disabled>Deliverer...</option>
                  <?php
                    $count = 0;
                    foreach($deliverersStaffList as $row){
                     $count++;
                    $driver = $row['firstname'];
                  ?>
                   <option value="<?php #echo $driver; ?>"><?php #echo $driver; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                  </div>-->
                  <input type="hidden" name="where" id= "where"  value="customer">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="addCustomer">Add Customer</button>
            </form>
            </div>
          </div>
        </div>
      </div>
       </div>
       <div class="col-md-5">
      <?php
        $customersrowcount = mysqli_num_rows($customersList);
      ?>
      <h6 class="offset-5">Total Number: <?php echo $customersrowcount; ?></h6>
      </div>
      <div class="col-md-4">
      <a href="blacklisted.php" class="btn btn-dark btn-md active offset-5" role="button" aria-pressed="true" >Blacklisted Customers</a>
      </div>
    </div><br>
    <table id="customersEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="14%">Name</th>
      <th scope="col" width="10%">Location</th>
      <th scope="col" width="17%">Contact Number</th>
      <th scope="col" width="8%">Deliverer</th>
      <th scope="col"width="10%">Status</th>
      <th scope="col"width="10%">Note</th>
       <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
      <th scope="col"width="22%"></th>
      <?php
        }
        ?>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($customersList as $row){
         $count++;
         $id = $row['id'];
         $name = $row['Name'];
        $location = $row['Location'];
        $number = $row['Number'];
        $deliverer = $row['Deliverer'];
        $status = $row['Status'];
        $note = $row['Note'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td  class="editable" id="name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="editable" id="location<?php echo $count; ?>"><?php echo $location; ?></td>
      <td class="editable" id="number<?php echo $count; ?>"><?php echo $number; ?></td>
      <td class="editable" id="deliverer<?php echo $count; ?>"><?php echo $deliverer; ?></td>
      <td class="uneditable"id="status<?php echo $count; ?>"><?php echo $status; ?></td>
      <td class="editable"id="note<?php echo $count; ?>"><?php echo $note; ?></td>
        <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
       <td>&emsp;&emsp;
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-dark btn-sm active blacklistCustomer" role="button" aria-pressed="true" >Blacklist</button>
       <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteCustomer" role="button" aria-pressed="true" ><i class="fa fa-user-times"></i>Delete</button></td>
        <?php
        }
        ?>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 