<?php
 include "admin_nav.php";
  include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Expenses</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <?php
           include "dashboard_tabs.php";
          ?>

  <div class="row">
    <div class="col-md-4">
             <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-success btn-md active" role="button" aria-pressed="true"><i class="fa fa-plus-circle"></i>&ensp;Add Expense</a>
       <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Add Expense</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form method="POST">
                 <div class="row">
                 <select type="text" name="heading" id="heading" class="form-control col-md-9" style="padding-right:15px;padding-left:15px;margin-left: 60px" required onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();' required>
                  <option value="" selected="selected" disabled>Expense Heading...</option>
                  <?php
                    $count = 0;
                    foreach($expenseHeadingList as $row){
                     $count++;
                    $name = $row['Name'];
                  ?>
                   <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                  </div><br>
                  <div class="row">
                 <input type="text" name="particular" id="particular" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Expense Particular..." required>
                  </div><br>
                  <div class="row">
                 <input type="text" name="party" id="party" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Party Name..." required>
                  </div><br>
                  <div class="row">
                 <input type="number" name="total" id="total" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Total Amount..." required>
                  </div><br>
                  <div class="row">
                 <input type="number" name="paid" id="paid" class="form-control col-md-9" style="padding:15px;margin-left: 60px" placeholder="Paid Amount..." required>
                  </div><br>
                  <div class="row">
                    <label for="date" style="margin-left: 60px;">Payment Date:</label>
                 <input type="date" name="date" id="date" class="form-control col-md-9" style="padding:15px;margin-left: 60px"  required>
                  </div><br>
                  <input type="hidden" name="where" id= "where"  value="expense">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="addExpense">Add Expense</button>
            </form>
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="col-md-4">
           <?php
        $expensesrowcount = mysqli_num_rows($expensesList);
      ?>
      <h6 class="offset-4">Total Number: <?php echo $expensesrowcount; ?></h6>
      </div>
      <div class="col-md-4">
       <a href="expense_heading.php" class="btn btn-primary btn-md active offset-6" role="button" aria-pressed="true" >Expense Heading</a>
       </div>
        </div><br>
        <table id="expensesEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="20%">Expense Heading</th>
      <th scope="col" width="20%">Expense Particular</th>
      <th scope="col" width="20%">Party Name</th>
      <th scope="col" width="6%">Total Amount</th>
      <th scope="col" width="8%">Paid Amount</th>
      <th scope="col" width="11%">Due Amount</th>
      <th scope="col" width="15%">Payment Date</th>
      <th scope="col"width="23%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($expensesList as $row){
         $count++;
         $id = $row['id'];
        $name = $row['Name'];
        $particular = $row['Expense_particular'];
        $party = $row['Party'];
        $total = $row['Total_amount'];
        $paid = $row['Paid_amount'];
        $due = $total - $paid;
        $date = $row['Payment_date'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="uneditable" id="name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="editable" id="particular<?php echo $count; ?>"><?php echo $particular; ?></td>
      <td class="editable" id="party<?php echo $count; ?>"><?php echo $party; ?></td>
      <td class="editable" id="total<?php echo $count; ?>">Ksh. <?php echo $total; ?></td>
      <td class="editable" id="paid<?php echo $count; ?>">Ksh. <?php echo $paid; ?></td>
      <td class="uneditable" id="due<?php echo $count; ?>">Ksh. <?php echo number_format($due); ?></td>
      <td class="editable" id="date<?php echo $count; ?>"><?php echo $date; ?></td>
       <td>
        <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteExpense" role="button" aria-pressed="true" ><i class="fa fa-trash"></i>&ensp;Delete</button>
       </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>       

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 