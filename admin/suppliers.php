<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Suppliers</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <?php
           include "dashboard_tabs.php";
          ?>
 

        <div class="row">
          <div class="col-md-4">
             <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-success btn-md active" role="button" aria-pressed="true" ><i class="fa fa-plus-circle"></i>&ensp;New Supplier</a>
       <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">New Supplier</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                 <div class="row">
                 <input type="text" name="name" id="name" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Supplier Name..." required>
                  </div><br>
                  <div class="row">
                 <input type="text" name="contact" id="contact" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Supplier Contact..."required>
                  </div>
                  <input type="hidden" name="where" id="where"  value="supplier">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary float-left ml-3" id="addSupplier">Add Supplier</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
           <?php
        $suppliersrowcount = mysqli_num_rows($suppliersList);
      ?>
      <h6 class="offset-2">Total Number: <?php echo $suppliersrowcount; ?></h6>
      </div>
        </div><br>

        <table id="suppliersEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10%">#</th>
      <th scope="col" width="45%">Supplier Name</th>
      <th scope="col" width="45%">Supplier Contact</th>
      <th scope="col"width="70%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($suppliersList as $row){
         $count++;
         $id = $row['id'];
        $supplier = $row['Name'];
        $contact = $row['Supplier_contact'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="uneditable" id="supplier<?php echo $count; ?>"><?php echo $supplier; ?></td>
      <td class="editable" id="contact<?php echo $count; ?>"><?php echo $contact; ?></td>
       <td>
        <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteSupplier" role="button" aria-pressed="true" ><i class="fa fa-trash"></i>&ensp;Delete</button>
       </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 