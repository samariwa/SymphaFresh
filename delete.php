<?php
require('config.php');
$where =$_POST['where'];
if($where == 'customer' )
{  
	$id =$_POST['id'];
mysqli_query($connection,"Delete from `customers` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
}
else if($where == 'stock' )
{  
	$id =$_POST['id'];
    $row = mysqli_query($connection,"SELECT image FROM stock WHERE id = '".$id."'")or die($connection->error);
     $result = mysqli_fetch_array($row);
     $path = $result['image'];
     mysqli_query($connection,"Delete from `stock` where id='".$id."'")or die($connection->error);
     unlink('assets/images/products/'.$path);
    echo 1;
    exit();
}
else if($where == 'blacklist' )
{  
	$id =$_POST['id'];
mysqli_query($connection,"Delete from `customers` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
}
else if($where == 'category' )
{  
	$id =$_POST['id'];
mysqli_query($connection,"Delete from `category` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
}
else if($where == 'unit' )
{  
  $id =$_POST['id'];
mysqli_query($connection,"Delete from `inventory_units` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
}
else if($where == 'order' )
{  
    $id =$_POST['id'];
    $cost = $_POST['cost'];
$result = mysqli_query($connection,"select stock.id as stock,orders.Quantity as orderQty,orders.Customer_id as customer,stock.Quantity as stockQty from orders INNER JOIN stock ON orders.Stock_id=stock.id where orders.id='".$id."'")or die($connection->error);
$row = mysqli_fetch_array($result);
    $stock = $row['stock'];
    $orderQty = $row['orderQty'];
    $customer = $row['customer'];
    $stockQty = $row['stockQty'];
    $qty = $orderQty + $stockQty;
    mysqli_query($connection,"Delete from `orders` where id='".$id."'")or die($connection->error);
    mysqli_query($connection,"update stock set Quantity='".$qty."'  where id ='".$stock."'")or die($connection->error);
    $result2 = mysqli_query($connection,"SELECT Category_Name FROM category join stock on category.id = stock.Category_id where stock.id = '".$stock."'")or die($connection->error);
      $row2 = mysqli_fetch_array($result2);
      $Cat_Name = $row2['Category_Name'];
      if($Cat_Name == 'Cereals'){
       mysqli_query($connection,"update cooked_cereals set Returned= Returned +".$orderQty." WHERE `Stock_id` = '".$stock."' AND date(Delivery_date) = CURRENT_DATE()")or die($connection->error);
      }
    mysqli_query($connection,"update orders set Debt= Debt+'".$cost."', Balance=Balance+'".$cost."'  where Customer_id ='".$customer."' AND id > '".$id."'")or die($connection->error);
    echo 1;
    exit();
}
else if($where == 'sales' )
{  
    $id =$_POST['id'];
    $cost = $_POST['cost'];
$result = mysqli_query($connection,"select stock.id as stock,sales.Quantity as saleQty,sales.Staff_id as staff,stock.Quantity as stockQty from sales INNER JOIN stock ON sales.Stock_id=stock.id where sales.id='".$id."'")or die($connection->error);
$row = mysqli_fetch_array($result);
    $stock = $row['stock'];
    $saleQty = $row['saleQty'];
    $staff = $row['staff'];
    $stockQty = $row['stockQty'];
    $qty = $saleQty + $stockQty;
    mysqli_query($connection,"Delete from `sales` where id='".$id."'")or die($connection->error);
    mysqli_query($connection,"update stock set Quantity='".$qty."'  where id ='".$stock."'")or die($connection->error);
    $result2 = mysqli_query($connection,"SELECT Category_Name FROM category join stock on category.id = stock.Category_id where stock.id = '".$stock."'")or die($connection->error);
      $row2 = mysqli_fetch_array($result2);
      $Cat_Name = $row2['Category_Name'];
      if($Cat_Name == 'Cereals'){
       mysqli_query($connection,"update cooked_cereals set Returned= Returned +".$saleQty." WHERE `Stock_id` = '".$stock."' AND date(Delivery_date) = CURRENT_DATE()")or die($connection->error);
      }
    mysqli_query($connection,"update sales set Debt= Debt+'".$cost."', Balance=Balance+'".$cost."'  where Staff_id ='".$staff."' AND id > '".$id."'")or die($connection->error);
    echo 1;
    exit();
}
else if($where == 'supplier' )
{  
	$id =$_POST['id'];
mysqli_query($connection,"Delete from `suppliers` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
}
else if($where == 'vehicle' )
{  
	$id =$_POST['id'];
mysqli_query($connection,"Delete from `vehicles` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }
 else if($where == 'deliverer' )
{  
    $id =$_POST['id'];
mysqli_query($connection,"Delete from `users` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }
 else if($where == 'cook' )
{  
    $id =$_POST['id'];
mysqli_query($connection,"Delete from `users` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }
  else if($where == 'office' )
{  
    $id =$_POST['id'];
   mysqli_query($connection,"Delete from `users` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }
 else if($where == 'publicNote' )
{  
    $id =$_POST['id'];
   mysqli_query($connection,"Delete from `notes` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }
 else if($where == 'privateNote' )
{  
    $id =$_POST['id'];
   mysqli_query($connection,"Delete from `notes` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }
 else if($where == 'faq' )
{  
    $id =$_POST['id'];
   mysqli_query($connection,"Delete from `faqs` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }
 else if($where == 'blog' )
 {  
     $id =$_POST['id'];
     $row = mysqli_query($connection,"SELECT image FROM blogs WHERE id = '".$id."'")or die($connection->error);
     $result = mysqli_fetch_array($row);
     $path = $result['image'];
    mysqli_query($connection,"Delete from `blogs` where id='".$id."'")or die($connection->error);
    unlink('assets/images/blog/'.$path);
     echo 1;
     exit();
  }
 else if($where == 'expenseHeading' )
{  
    $id =$_POST['id'];
   mysqli_query($connection,"Delete from `expenses` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }
  else if($where == 'expense' )
{  
    $id =$_POST['id'];
   mysqli_query($connection,"Delete from `expense_details` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }
 else if($where == 'calendar' )
{  
   if(isset($_POST["id"]))
{
     $id =$_POST['id'];
   mysqli_query($connection,"DELETE from event WHERE id='$id'")or die($connection->error);
}

 }
?>