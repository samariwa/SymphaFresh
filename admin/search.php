<?php  
require('config.php');
$where =$_POST['where'];
if($where == 'customer' )
{
   $customer_output = '';
       $result = mysqli_query($connection,"SELECT id,Name,Location,Number,Deliverer FROM customers WHERE Status != 'blacklisted' AND Name LIKE '%".$_POST["search"]."%' OR Location LIKE  '%".$_POST["search"]."%' OR Number LIKE  '%".$_POST["search"]."%' OR Deliverer LIKE  '%".$_POST["search"]."%'");
       if (mysqli_num_rows($result) > 0) {

       	       
             $customer_output .= '<h6 style="margin-left:100px;" ><b>Search Result(s)</b></h6>';
        while($row = mysqli_fetch_array($result))
        {
          $customer_output .= '
          <div class="row">
          <a href="#" class=" list-group-item-action list-group-flush" ><span class="idX" >'.$row["id"].'</span>&emsp;&emsp;<span id="selected">'.$row["Name"].'</span>&emsp;&emsp;('.$row["Location"].')&emsp;&emsp;'.$row["Number"].'&emsp;&emsp;'.$row["Deliverer"].'</a><br>
          </div>';
        }   
        echo $customer_output;                  
       }else{
          echo "<p>Customer Not Found</p>";
       }
}
else if ($where == 'product') {
	$product_output = '';
       $result = mysqli_query($connection,"SELECT stock.id,category.Category_Name,stock.Name,stock.Price,stock.Quantity FROM stock INNER JOIN category ON stock.Category_id=category.id WHERE Name LIKE '%".$_POST["search2"]."%' OR Category_Name LIKE  '%".$_POST["search2"]."%'")or die($connection->error);
       if (mysqli_num_rows($result) > 0) {

       	       
             $product_output .= '<h6 style="margin-left:100px;" ><b>Search Result(s)</b></h6>';
        while($row = mysqli_fetch_array($result))
        {
          $product_output .= '
          <div class="row">
          <a href="#" class=" list-group-item-action list-group-flush" ><span id="selected2">'.$row["Name"].'</span>&emsp;&emsp;('.$row["Category_Name"].')&emsp;&emsp;Price('.$row["Price"].')&emsp;&emsp;Quantity Available('.$row["Quantity"].')</a><br>
          </div>';
        }   
        echo $product_output;                  
       }else{
          echo "<p>Product Not Found</p>";
       }       
}
else if ($where == 'customerDetails') {
	$result = mysqli_query($connection,"SELECT id,Name,Location,Number,Deliverer FROM customers WHERE Status != 'blacklisted' AND id = '".$_POST["customerId"]."'");
	 $customerResult = array();
    $customer = mysqli_fetch_array($result);
        $customerArray = array('Name' => $customer['Name'], 'Location'  => $customer['Location'], 'Deliverer' => $customer['Deliverer']);
        array_push($customerResult, $customerArray);
    $customer = json_encode($customerResult);
    echo $customer;
}
else if ($where == 'cart') {
	 $result = mysqli_query($connection,"SELECT stock.id,category.Category_Name,stock.Name,stock.Price,stock.Quantity FROM stock INNER JOIN category ON stock.Category_id=category.id WHERE Name = '".$_POST["productName"]."'")or die($connection->error);
	 $productResult = array();
    $product = mysqli_fetch_array($result);
        $productArray = array('id' => $product['id'], 'Price'  => $product['Price'], 'Quantity' => $product['Quantity']);
        array_push($productResult, $productArray);
    $product = json_encode($productResult);
    echo $product;
}