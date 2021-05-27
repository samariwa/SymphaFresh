<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 
 <!-- Begin Page Content -->
        <div class="container-fluid">
  <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Sales</span><span style="font-size: 15px;"> /Print Receipt</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <?php
           include "dashboard_tabs.php";
          ?>

          <div class="row"> 
             <div class="col-2">           
                <a href="sales.php" class="btn btn-primary btn-md active float-left ml-3" role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
             </div>
           </div><br><br>
       <div class="row">
      <div class="col-md-10 offset-1">
        <h6 >To print full receipt for specified date, enter customer's name and click the 'Print button'. Otherwise include point in time from which the gate pass should be printed. The search engine below filters out customers who made orders from one week ago to tomorrow.</h6><br>
     </div>
   </div>
   <div class="row">
          <div class="col-md-7 offset-2">
           <div class="input-group mb-3">
          <div class="input-group-prepend" >
           <span class="input-group-text" id="inputGroup-sizing-default">Customer:</span>
           </div>
         <input type="text" class="form-control col-md-12" aria-label="Default" aria-describedby="inputGroup-sizing-default" style="font-family: FontAwesome, Arial; font-style: normal;"  name="time" id="receiptCustomer">
         <div class="col-12" style="position: relative;z-index: 4;">
            <div class="list-group" id="customerReceiptResult" >

            </div>
            <input type="hidden" class="customerId" id="customerId" name="customerId" value="">
        </div>
       </div>
     </div>
        </div><br>

        <div class="row">
          <div class="col-md-7 offset-2">
           <div class="input-group mb-3">
          <div class="input-group-prepend" >
           <span class="input-group-text" id="inputGroup-sizing-default">Delivery Date:</span>
           </div>
         <input type="date" class="form-control col-md-12" aria-label="Default" aria-describedby="inputGroup-sizing-default" style="font-family: FontAwesome, Arial; font-style: normal;"  name="time" id="receiptDate">
       </div>
     </div>
        </div><br>

        <div class="row">
          <div class="col-md-7 offset-2">
           <div class="input-group mb-3">
          <div class="input-group-prepend" >
           <span class="input-group-text" id="inputGroup-sizing-default">Point in Time:</span>
           </div>
         <input type="text" class="form-control col-md-12" aria-label="Default" aria-describedby="inputGroup-sizing-default" style="font-family: FontAwesome, Arial; font-style: normal;"  name="time" id="receiptTime">
       </div>
     </div>
        </div><br>

        <div class="row">
          <div class="col-md-2 offset-5">
           <button class="btn btn-light btn-md active printReceipt" role="button" aria-pressed="true"><i class="fa fa-print"></i>&ensp;Print</button>
         </div>
        </div><br><br>
       
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 