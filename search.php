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
        <a href="#" class="list-group-item border-1" style="text-decoration:none;color:inherit;">Product not found</a>
        ';
       }
       echo $result_output;
}

if(isset($_POST['searchSubmit'])){
  $data = $_POST['search'];
  header('location: template/product-list.php#'.$data);
}
if(isset($_POST['receiptSearch'])){
  $result_output = '';
  $result = mysqli_query($connection,"SELECT DISTINCT customers.id as id, customers.Name as Name,orders.Walk_in_name as name FROM orders INNER JOIN customers ON orders.Customer_id = customers.id WHERE DATE(orders.Delivery_time) >= DATE_SUB( CURDATE(), INTERVAL 1 WEEK ) AND DATE(orders.Delivery_time) <= DATE_SUB( CURDATE()+1, INTERVAL 0 DAY) AND customers.Name LIKE '%".$_POST["receiptSearch"]."%' OR orders.Walk_in_name LIKE '%".$_POST["receiptSearch"]."%'");
       if (mysqli_num_rows($result) > 0) { 
        while($row = mysqli_fetch_array($result))
        {
          $id = $row["id"];
          $name = $row["Name"];
          if( $name == 'Unregistered Customer')
          {
            $name = $row["name"];
          }
          $result_output .= '
          <a href="#" style="color: inherit;text-decoration: none;" id='.$id.' class="list-group-item list-group-item-action border-1 customerName">'.$name.'</a>
          ';
        }                      
       }else{
        $result_output = '
        <li class="list-group-item list-group-item-action border-1">Customer not found</li>
        ';
       }
       echo $result_output;
}
?>