<?php
 include "admin_nav.php";
  include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Expense Headings</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <?php
           include "dashboard_tabs.php";
          ?>

  <div class="row">
    <div class="col-md-4">
        <a href="expenses.php" class="btn btn-primary btn-md active" role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
        </div>   
        <div class="col-md-4"> 
           <?php
        $expenseheadingrowcount = mysqli_num_rows($expenseHeadingList);
      ?>
      <h6 class="offset-3">Total Number: <?php echo $expenseheadingrowcount ?></h6>
    </div>
    <div class="col-md-4">
        <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-secondary btn-md active offset-4" role="button" aria-pressed="true"><i class="fa fa-plus-circle"></i>&ensp;New Expense Heading</a>
       <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">New Expense Heading</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form method="POST">
                 <div class="row">
                 <input type="text" name="heading" id="heading" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder=" Expense Heading..." required>
                  </div><br>
                  <input type="hidden" name="where" id= "where"  value="expenseHeading">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="addExpenseHeading">Add Expense Heading</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
        </div><br>
        <table id="expenseHeadingEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="85%">Expense Heading</th>
      <th scope="col"width="15%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($expenseHeadingList as $row){
         $count++;
         $id = $row['id'];
        $name = $row['Name'];
        
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="editable" id="name<?php echo $count; ?>"><?php echo $name; ?></td>
       <td>
        <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteExpenseHeading" role="button" aria-pressed="true" ><i class="fa fa-trash"></i>&ensp;Delete</button>
       </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>       

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 