<?php
 include "admin_nav.php";
  include('../queries.php');
 ?> 
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Sales </span><span style="font-size: 15px;">/Extra Sales </span><span style="font-size: 12px;">/Goods Requisition</span></h1>
         <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
           <?php
           include "dashboard_tabs.php";
          ?>
        <div class="row">
        <div class="col-2">  
          <a href="extra_sales.php" class="btn btn-primary btn-md active float-left ml-3" role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
         </div>
        </div><br>
        <form method="POST">

         <table id="sellerRequisitionSearch" class="table table-striped table-hover" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="5%">Select</th>
      <th scope="col" width="3%">Staff #</th>
      <th scope="col" width="14%">Name</th>
      <th scope="col" width="17%">Contact Number</th>
      <th scope="col" width="12%">Vehicle Type</th>
      <th scope="col" width="17%">Route</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($requisitionSellersList as $row){
         $count++;
         $id = $row['staffID'];
         $firstname = $row['firstname'];
         $lastname = $row['lastname'];
         $number = $row['number'];
        $type = $row['Type'];
        $route = $row['Route'];
      ?>
    <tr>
      <td ><input type="radio" id='selectedCustomer' onclick="selectSeller(this);" name="selectedSeller" value="<?php echo $id; ?>"></td>
      <th scope="row" id="id<?php echo $id; ?>"><?php echo $id; ?></th>
      <td id="sellerName<?php echo $id; ?>"><?php echo $firstname. ' ' .$lastname; ?></td>
      <td id="sellerNumber<?php echo $id; ?>"><?php echo $number; ?></td>
      <td id="sellerVehicle<?php echo $id; ?>"><?php echo $type; ?></td>
      <td id="sellerRoute<?php echo $id; ?>"><?php echo $route; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table><br>


       <table id="productSalesSearch" class="table table-striped table-hover" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr >
      <th scope="col" width="5%">#</th>
      <th scope="col" width="15%">Category</th>
      <th scope="col" width="30%">Stock Name</th>
      <th scope="col"width="15%">Selling Price</th>
      <th scope="col"width="18%">Quantity Available</th>
       <th scope="col"width="18%"></th>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($stockList as $row){
         $count++;
         $id = $row['id'];
        $category = $row['Category_Name'];
        $name = $row['Name'];
        $selling_price = $row['Price'];
        $quantity = $row['Quantity'];
      ?>
    <tr>
      <th scope="row" id="id<?php echo $id; ?>"><?php echo $id; ?></th>
      <td id="category<?php echo $id; ?>"><?php echo $category; ?></td>
      <td id="name<?php echo $id; ?>"><?php echo $name; ?></td>
      <td id="sp<?php echo $id; ?>"><?php echo $selling_price; ?></td>
      <td id="qty<?php echo $id; ?>"><?php echo $quantity; ?></td>
      <?php
       if ($quantity > 0) {
      ?>
      <td><button type="button" class="btn btn-warning addToCart" onclick="cartArray(<?php echo $id; ?>)" id="add_product<?php echo $id; ?>" data_id="<?php echo $id; ?>"><i class="fa fa-plus" ></i>&emsp;Add Product</button></td>
      <?php
       }else{
      ?>
        <td><button type="button" class="btn btn-warning addToCart" disabled onclick="cartArray(<?php echo $id; ?>)" id="add_product<?php echo $id; ?>" data_id="<?php echo $id; ?>"><i class="fa fa-cart-plus" ></i>&emsp;Add Product</button></td>
      <?php
        }
      ?>
   </tr>
    <?php
    }
    ?>
  </tbody>
</table><br>

        
        <h3>Goods Requested</h3>
        <div class="row">
        <table class="table table-bordered" id="cartEditable">
  <thead>
    <tr style="text-align: center;">
      <th scope="col" width="5%">#</th>
      <th scope="col" width="40%">Product Description</th>
      <th scope="col" width="10%">Unit Price</th>
      <th scope="col" width="10%">Quantity</th>
      <th scope="col" width="10%">Discount</th>
      <th scope="col" width="11%"></th>
      <th scope="col" width="15%">Sub-Total</th>
    </tr>
  </thead>
  <tbody id="cartData">

 </tbody>
    <tfoot>
      <th scope="row" colspan="6"><b>Total:</b></th>
      <td id="cartTotal"style="text-align: center;">0</td>
    </tfoot>
</table>
</div><br>
<div class="row" id="sellerDetails">
  
</div><br>
<div class="row">
      <div class="input-group-prepend" style="margin-left: 310px;" >
           <span class="input-group-text" id="inputGroup-sizing-default">Sales Date:</span>
           </div>
       <div class="col-md-5">
       <input type="date"  class="form-control col-md-6" name="deliveryDate" id="deliveryDate" value="" aria-describedby="inputGroup-sizing-default" required autocomplete="date" autofocus style="font-family: FontAwesome, Arial; font-style: normal;">
        </div>
        </div><br><br>

          <div class="row">
          <button type="button" class="btn btn-success col-md-4 completeRequisition" style="margin-left: 320px"><i class="fa fa-check"></i>&emsp;Complete Requisition</button>
        </div><br>
<!--
             <div class="row">
          <div class="input-group mb-5" style="margin-left: 250px;">
          <div class="input-group-prepend" >
           <span class="input-group-text" id="inputGroup-sizing-default">Customer #:</span>
           </div>
         <input type="text" class="form-control col-md-6" required aria-label="Default" aria-describedby="inputGroup-sizing-default" style="font-family: FontAwesome, Arial; font-style: normal;" placeholder='Search...&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&#xf002;' name="customerSearch" id="customerSearch">
       </div>
       <div class="list-group" id="customer_results" style="margin-top: -5px;margin-left: 350px;">

       </div>
        </div><br>

               <div class="row">
          <div class="input-group mb-3" style="margin-left: 160px;">
          <div class="input-group-prepend" >
           <span class="input-group-text" id="inputGroup-sizing-default">Product:</span>
           </div>
         <input type="text" class="form-control col-md-6" required aria-label="Default" aria-describedby="inputGroup-sizing-default" style="font-family: FontAwesome, Arial; font-style: normal;" placeholder='Search...&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&#xf002;' name="productSearch" id="productSearch">
         <div class="input-group-prepend"style="margin-left: 30px;" >
           <span class="input-group-text" id="inputGroup-sizing-default">Quantity:</span>
           </div>
         <input type="number" class="form-control col-md-1" name="orderQty" id="orderQty" min="1" oninput="validity.valid||(value='');">
       </div>
       <div class="list-group" id="product_results" style="margin-top: -5px;margin-left: 350px;">
         
       </div>
        </div><br>

        <div class="row">
          <button type="button" class="btn btn-success col-md-4 " style="margin-left: 320px"><i class="fa fa-cart-plus" id="addToCart"></i>&emsp;Add to Cart</button>
        </div><br>
-->
 
        </form>
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 