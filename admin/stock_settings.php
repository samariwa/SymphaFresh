<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

 <!-- Begin Page Content -->
        <div class="container-fluid"> 

  <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Stock Flow Automation Settings</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

         <?php
           include "dashboard_tabs.php";
          ?>
         <div class="row">
       <div class="col-md-5">   
      <a href="stock.php" class="btn btn-primary btn-md active " role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
      </div>
       <div class="col-md-7">
       <a href="inventory_units.php" class="btn btn-secondary btn-md active offset-9" role="button" aria-pressed="true" >Inventory Units</a>
       </div>
    </div>
    <br>
    <table id="stockSettings" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="4%">#</th>
      <th scope="col" width="23%">Stock Name</th>
      <th scope="col" width="12%">Unit</th>
      <th scope="col"width="12%">Contains</th>
      <th scope="col"width="12%">Subunits</th>
      <th scope="col" width="15%">Subunit Replenish Quantity</th>
      <th scope="col"width="12%">Restock/Replenish Level</th>
      <th scope="col"width="10%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($stockFlowSettingsList as $row){
         $count++;
         $id = $row['stock_id'];
        $name = $row['stock_name'];
        $unit = $row['unit_name'];
        $unit_ID = $row['unit_id'];
        $contains = $row['contains'];
        $subunit_ID = $row['subunit_id'];
        $subunit = mysqli_query($connection,"SELECT u.Name as subunit FROM stock s INNER JOIN inventory_units u ON s.Unit_id = u.id WHERE s.Unit_id = '$subunit_ID'")or die($connection->error);
        $row2 = mysqli_fetch_array($subunit);
        $subunit_name = $row2['subunit'];
        $replenish_qty = $row['replenish_qty'];
        $restock_level = $row['restock_level'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="uneditable" id="name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="uneditable" id="unit<?php echo $count; ?>"><?php echo $unit; ?></td> 
      <td class="uneditable" id="contains<?php echo $count; ?>"><?php echo $contains; ?></td>
      <td class="uneditable" id="subunit<?php echo $count; ?>"><?php echo $subunit_name; ?></td>
      <td class="uneditable" id="replenish<?php echo $count; ?>"><?php echo $replenish_qty; ?></td>
      <td class="uneditable" id="restock<?php echo $count; ?>"><?php echo $restock_level; ?></td>
        <td>  
        <button data-toggle="modal" data-target="#exampleModalScrollable<?php echo $id; ?>" id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-success btn-sm active restock" role="button" aria-pressed="true" ><i class="fa fa-edit"></i>&ensp;Edit</button>
        <div class="modal fade" id="exampleModalScrollable<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Automation Settings</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                <div class="row">
                  <label for="stock" style="margin-left: 60px;">Stock Name:</label>
                 <input type="text" name="stock" id="stock<?php echo $id?>" class="form-control col-md-9 " style="padding:15px;margin-left: 60px" value="<?php echo $name ?>" disabled required min="0" step="1" oninput="validity.valid||(value='');">
                  </div><br>
                 <div class="row">
                  <label for="unit" style="margin-left: 60px;">Unit:</label>
                 <select type="text" name="unit" id="unit<?php echo $id?>" class="form-control col-md-9" style="padding-right:15px;padding-left:15px;margin-left: 60px" required onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                  <?php
                    $count = 0;
                    foreach($unitsList as $row){
                     $count++;
                     $unit_id = $row['id'];
                    $unit = $row['Name'];
                    if ($unit_id == $unit_ID) {
                      ?>
                      <option value="<?php echo $unit_ID ?>" selected="selected"><?php echo $unit; ?></option>
                      <?php
                    }
                    else{
                  ?>
                   <option value="<?php echo $unit_id; ?>"><?php echo $unit; ?></option>
                  <?php
                      }
                    }
                  ?>
                 </select>
                 </div><br>
                  <div class="row">
                  <label for="contains" style="margin-left: 60px;">Contains:</label>
                 <input type="number" name="contains" id="contains<?php echo $id?>" class="form-control col-md-9 " style="padding:15px;margin-left: 60px" value="<?php echo $contains ?>" required min="0" step="1" oninput="validity.valid||(value='');">
                  </div><br>
                  <div class="row">
                    <label for="subunit" style="margin-left: 60px;">Sub-Units:</label>
                 <select type="text" name="subunit" id="subunit<?php echo $id?>" class="form-control col-md-9 " style="padding-right:15px;padding-left:15px;margin-left: 60px" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                  <?php
                    $count = 0;
                    foreach($unitsList as $row){
                     $count++;
                    $subunit_id = $row['id'];
                    $unit = $row['Name'];
                    if ($subunit_id == $subunit_ID) {
                      ?>
                     <option value="<?php echo $subunit_ID ?>" selected="selected"><?php echo $subunit_name; ?></option>
                      <?php
                    }
                    else{
                  ?>
                   <option value="<?php echo $subunit_id; ?>"><?php echo $unit; ?></option>
                  <?php
                    }
                   } 
                  ?>
                 </select>
                  </div><br>
                  <div class="row">
                    <label for="replenish" style="margin-left: 60px;">Sub-Unit Replenish Quantity:</label>
                 <input type="number" name="replenish" id="replenish<?php echo $id?>" class="form-control col-md-9"  style="padding:15px;margin-left: 60px" placeholder="Sub-Unit Replenish Quantity..." required min="0" step="1" oninput="validity.valid||(value='');" value="<?php echo $replenish_qty ?>">
                  </div><br>
                  <div class="row">
                    <label for="restock" style="margin-left: 60px;">Restock/Replenish Level:</label>
                 <input type="number" name="restock" id="restock<?php echo $id?>" class="form-control col-md-9" required style="padding:15px;margin-left: 60px" required min="1" step="1" oninput="validity.valid||(value='');"value="<?php echo $restock_level; ?>">
                  </div>
            </div>
             <div class="modal-footer">
              <button type="submit" class="btn btn-primary editAutomation" style="margin-right: 50px" id="<?php echo $id; ?>">Edit Automation</button>
            </form>
            </div>
          </div>
        </div>
      </div>
     </div>
      </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>  
        

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 
         