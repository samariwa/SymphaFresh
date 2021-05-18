<?php  
require('config.php');
if(isset($_POST['search'])){
  $result_output = '';
  $query = "SELECT Name FROM stock WHERE Name LIKE '%".$_POST["search"]."%'";
  if($_POST['category'] !== '0'){
    $query .= " AND Category_id = '".$_POST['category']."'";
  }
  $result = mysqli_query($connection,$query);
       if (mysqli_num_rows($result) > 0) { 
        while($row = mysqli_fetch_array($result))
        {
          $result_output = '
          <a href="product-list.php#'.$row["Name"].'" class="list-group-item list-group-item-action border-1">'.$row["Name"].'</a>
          ';
        }                      
       }else{
        $result_output = '
        <a href="#" class="list-group-item border-1">Product Not Found</a>
        ';
       }
       echo $result_output;
}

if(isset($_POST['searchSubmit'])){
  $data = $_POST['search'];
  header('location: template/product-list.php#'.$data);
}
