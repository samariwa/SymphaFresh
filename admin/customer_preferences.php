<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Customer Preferences</span></h1>
            <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
         <?php
           include "dashboard_tabs.php";
          ?>
          <br><br>
         <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
      <table class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10%" style="text-align: left;">#&emsp;&emsp;&emsp;&emsp;</th>
      <th scope="col" width="45%">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Product Name&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
      <th scope="col" width="45%">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Preference(%)&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $row2 = mysqli_fetch_array($totalPreferences);
        $total = $row2['count'];
        $count = 0;
        foreach($customer_preferences as $row){
         $count++;
         $id = $row['id'];
         $name = $row['name'];
        $count = $row['count'];
        $percentage = number_format((float)($count / $total) * 100, 2, '.', '');
      ?>
    <tr>
      <th scope="row"  style="text-align: left;"><?php echo $id; ?></th>
      <td><?php echo $name; ?></td>
      <td><?php echo $percentage; ?>%</td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<?php
        }
        else{
        ?>

         <table id="categoriesEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;width: 100%">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="40%">#&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
      <th scope="col" width="60%">Category Name&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($categoriesList as $row){
         $count++;
         $id = $row['id'];
        $category = $row['Category_Name'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="uneditable" id="category<?php echo $count; ?>"><?php echo $category; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<?php
    }
    ?>
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 