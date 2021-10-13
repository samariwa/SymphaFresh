<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Stock</span></h1>
            <h6 class="h6 mb-0 text-gray-600 " style="margin-left: 450px;">Time: <span id="time"></span></h6>
            <a <?php if ($view == 'Software' || $view == 'Director' || $view == 'CEO' ) { ?> href="stock_settings.php" <?php }else{ ?> href = "#" <?php } ?> class="btn btn-light btn-md mr-1 active" role="button" aria-pressed="true"><i class="fa fa-cogs"></i>&ensp;Settings</a>
            <button class="btn btn-light btn-md active printStock mr-1" role="button" aria-pressed="true" ><i class="fa fa-print"></i>&ensp;Print</button>
          </div>
           <?php
           include "dashboard_tabs.php";
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Stores Manager' || $view == 'Stores Supervisor') {

        ?>
         <div class="row">
          <div class="col-md-2">
      <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-success btn-md active" role="button" aria-pressed="true" ><i class="fa fa-plus-circle"></i>&ensp;New Stock</a>
      <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">New Stock</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                <div class="row">
                 <select type="text" name="category" id="category" class="form-control col-md-9" style="padding-right:15px;padding-left:15px;margin-left: 60px" required onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                  <option value="" selected="selected" disabled>Category...</option>
                  <?php
                    $count = 0;
                    foreach($categoriesList as $row){
                     $count++;
                     $category_id = $row['id'];
                    $category = $row['Category_Name'];
                  ?>
                   <option value="<?php echo $category_id; ?>"><?php echo $category; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                  </div><br>
                 <div class="row">
                 <input type="text" name="name" id="name" class="form-control col-md-9" style="padding:15px;margin-left: 60px" required  placeholder="Stock Name...">
                  </div><br>
                  <div class="row">
                 <select type="text" name="unit" id="unit" class="form-control col-md-9" style="padding-right:15px;padding-left:15px;margin-left: 60px" required onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                  <option value="" selected="selected" disabled>Unit...</option>
                  <?php
                    $count = 0;
                    foreach($unitsList as $row){
                     $count++;
                     $unit_id = $row['id'];
                    $unit = $row['Name'];
                  ?>
                   <option value="<?php echo $unit_id; ?>"><?php echo $unit; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                 </div><br>
                 <div class="row">
                 <input type="number" name="contains" id="contains" class="form-control col-md-4 " style="padding:15px;margin-left: 60px" placeholder="Contains..." oninput="replenishDisable()">
                 <select type="text" name="subunit" id="subunit" class="form-control col-md-4 " style="padding-right:15px;padding-left:15px;margin-left: 40px" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur(); replenishDisable();'>
                  <option value="" selected="selected" disabled>Sub-Units...</option>
                  <?php
                    $count = 0;
                    foreach($unitsList as $row){
                     $count++;
                    $subunit_id = $row['id'];
                    $unit = $row['Name'];
                  ?>
                   <option value="<?php echo $subunit_id; ?>"><?php echo $unit; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                  </div><br>
                  <div class="row">
                 <input type="number" name="replenish" id="replenish" class="form-control col-md-9"  style="padding:15px;margin-left: 60px" placeholder="Sub-Unit Replenish Quantity..." oninput="subunitsDisable()">
                  </div><br>
                  <div class="row">
                 <select type="text" name="supplier" id="supplier" class="form-control col-md-9" style="padding-right:15px;padding-left:15px;margin-left: 60px" required onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                   <option value="" selected="selected" disabled>Supplier...</option>
                  <?php
                    $count = 0;
                    foreach($suppliersList as $row){
                     $count++;
                    $supplier_id = $row['id'];
                    $supplier = $row['Name'];
                  ?>
                   <option value="<?php echo $supplier_id; ?>"><?php echo $supplier; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                  </div><br>
                  <div class="row">
                 <label for="upload" style="margin-left: 60px">Upload product image:</label>
                 <input type="file" id="upload" name="upload" style="padding:15px;margin-left: 50px" onchange="displayname(this,$(this))" required>
                  </div><br>
                  <div class="row">
                    <label for="received" style="margin-left: 60px;">Date Received:</label>
                 <input type="date" name="received" id="received" class="form-control col-md-9" required  style="padding:15px;margin-left: 60px" >
                  </div><br>
                  <div class="row">
                    <label for="expiry" style="margin-left: 60px;">Expiration Date:</label>
                 <input type="date" name="expiry" id="expiry" class="form-control col-md-9" required style="padding:15px;margin-left: 60px" >
                  </div><br>
                 <div class="row">
                 <input type="number" name="bp" id="bp" class="form-control col-md-9" required style="padding:15px;margin-left: 60px" placeholder="Buying Price...">
                  </div><br>
                  <div class="row">
                 <input type="number" name="sp" id="sp" class="form-control col-md-9" required style="padding:15px;margin-left: 60px" placeholder="Selling Price...">
                  </div><br>
                 <div class="row">
                 <input type="number" name="qty" id="qty" class="form-control col-md-9" required style="padding:15px;margin-left: 60px" placeholder="Quantity...">
                  </div><br>
                  <div class="row">
                 <input type="number" name="restock" id="restock" class="form-control col-md-9" required style="padding:15px;margin-left: 60px" placeholder="Restock Level...">
                  </div>
                  <input type="hidden" name="where" id="where"  value="stock">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="addStock" style="margin-right: 50px" id="addStock">Add Stock</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <a href="shelf_life.php" class="btn btn-info btn-md active" role="button" aria-pressed="true">Stock Shelf Life</a>
      </div>
      <div class="col-md-3">
      <a href="damaged.php" class="btn btn-secondary btn-md active" role="button" aria-pressed="true" >Damaged Stock</a>
      </div>
      <div class="col-md-2">
      <a href="valuation.php" class="btn btn-warning btn-md active" role="button" aria-pressed="true" >Stock Valuation</a>
      </div>
      <div class="col-md-2">
      <a href="categories.php" class="btn btn-primary btn-md active" role="button" aria-pressed="true">Stock Categories</a>
    </div>
    </div><br>  
     <?php
          }else{
            ?>
<div class="row">
  <div class="col-md-6">
      <a href="shelf_life.php" class="btn btn-info btn-md active  ml-2" role="button" aria-pressed="true">Stock Shelf Life</a>
    </div>
    <div class="col-md-6">
      <a href="categories.php" class="btn btn-primary btn-md active offset-8" role="button" aria-pressed="true">Stock Categories</a>
    </div>
    </div><br> 
            <?php
          }
        $stockrowcount = mysqli_num_rows($stockList);
      ?>
      <div class="offset-2"><h6 class="offset-4">Total Number: <?php echo $stockrowcount; ?></h6></div>
      <table id="stockEditable" class="table table-striped table-hover paginate " style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
  <tr>
      <th scope="col" width="4%">#</th>
      <th scope="col" width="16%">Category</th>
      <th scope="col" width="16%">Stock Name</th>
       <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
      <th scope="col" width="9%">Buying Price</th>
      <th scope="col" width="5%">Discount</th>
       <?php
        }
        ?>
      <th scope="col"width="9%">Selling Price</th>
      <th scope="col"width="9%">Quantity Available</th>
      <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Stores Manager' || $view == 'Stores Supervisor') {

        ?>
        <th scope="col" width="9%">Restock Level</th>
        <?php
       }
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' ) {
        ?>
      <th scope="col"width="30%"></th>
    </tr>
    <?php
        }
        ?>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($stockList as $row){
         $count++;
         $id = $row['id'];
        $category = $row['Category_Name'];
        $name = $row['Name'];
        $buying_price = $row['Buying_price'];
        $discount = $row['Discount'];
        $selling_price = $row['Price'];
        $quantity = $row['Quantity'];
        $restock_Level = $row['Restock_Level'];
      ?>
    <tr>
      <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="editable" id="category<?php echo $count; ?>"><?php echo $category; ?></td>
      <td class="editable" id="name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="editable" id="bprice<?php echo $count; ?>"><?php echo $buying_price; ?></td> 
      <td class="editable" id="discount<?php echo $count; ?>"><?php echo $discount; ?></td> 
      <td class="editable" id="sprice<?php echo $count; ?>"><?php echo $selling_price; ?></td>
      <td class="uneditable" id="qty<?php echo $count; ?>"><?php echo $quantity; ?></td>
      <?php
        }else{
        ?>
        <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="uneditable" id="category<?php echo $count; ?>"><?php echo $category; ?></td>
      <td class="uneditable" id="name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="uneditable" id="sprice<?php echo $count; ?>"><?php echo $selling_price; ?></td>
      <td class="uneditable" id="qty<?php echo $count; ?>"><?php echo $quantity; ?></td>
      <?php
       }
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Stores Manager' || $view == 'Stores Supervisor') {
        ?>
        <td class="editable" id="restock_Level<?php echo $count; ?>"><?php echo $restock_Level; ?></td>
        <?php
        }
        if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {
        ?>
        <td>  
        <button data-toggle="modal" data-target="#exampleModalScrollable<?php echo $id; ?>" id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-light btn-sm active restock" role="button" aria-pressed="true" ><i class="fa fa-plus"></i>&ensp;Restock</button>
        <div class="modal fade" id="exampleModalScrollable<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $name; ?> restock</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                 <div class="row">
                  <label for="expiry" style="margin-left: 60px;">Date Received:</label>
                 <input type="date" name="received" id="received<?php echo $id; ?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Date Received..." required>
                  </div><br>
                  <div class="row">
                 <input type="number" name="qty" id="quantity<?php echo $id; ?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Quantity Purchased..." required min="1" oninput="validity.valid||(value='');">
                  </div><br>
                  <div class="row">
                 <input type="number" name="bp" id="bp<?php echo $id; ?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Buying Price..." required min="0.01" step="0.01" oninput="validity.valid||(value='');">
                  </div><br>
                  <div class="row">
                 <input type="number" name="sp" id="sp<?php echo $id; ?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Selling Price..." required min="0.01" step="0.01" oninput="validity.valid||(value='');">
                  </div><br>
                  <div class="row">
                    <label for="expiry" style="margin-left: 60px;">Expiration Date:</label>
                 <input type="date" name="expiry" id="expiry<?php echo $id; ?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Expiry Date..." required>
                  </div>
            </div>
             <div class="modal-footer">
              <button type="submit" class="btn btn-primary addPurchase" style="margin-right: 50px" id="<?php echo $id; ?>">Add Purchase</button>
            </form>
            </div>
          </div>
        </div>
      </div>
     </div>
        <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteStock" role="button" aria-pressed="true" ><i class="fa fa-trash"></i>&ensp;Delete</button></td>
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