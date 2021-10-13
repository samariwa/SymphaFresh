<?php  
require('../config.php');
$where =$_POST['where'];
if($where == 'blacklist' )
{  
	$id =$_POST['id'];
	$result = mysqli_query($connection,"SELECT * FROM orders INNER JOIN customers ON orders.Customer_id=customers.id where customers.id='".$id."'");
   if(mysqli_num_rows($result) == 0){
   	echo 0;
   }
   else{
    mysqli_query($connection,"UPDATE `customers` SET `status` = 'blacklisted' where id='".$id."'");
    echo 1;
    exit();
   }
}
else if($where == 'restore' )
{  
	$id =$_POST['id'];
	$result1 = mysqli_query($connection,"SELECT customers.id as id,customers.Name, MAX(orders.created_at),customers.Location,customers.Number,customers.Deliverer,orders.Balance as `balance` FROM orders INNER JOIN customers ON orders.Customer_id=customers.id where customers.Status='blacklisted' GROUP BY customers.id;")or die($connection->error);
        $row = mysqli_fetch_array($result1);
        $balance = $row['balance'];
        if($balance == 0){
        	mysqli_query($connection,"UPDATE `customers` SET `status` = 'clean' where id='".$id."'");
        }
        else if ($balance > 0) {
        	mysqli_query($connection,"UPDATE `customers` SET `status` = 'credit' where id='".$id."'");
        }
        else if ($balance < 0 && $balance >= -500) {
        	mysqli_query($connection,"UPDATE `customers` SET `status` = 'fined' where id='".$id."'");
        }
        else if ($balance < -500) {
        	mysqli_query($connection,"UPDATE `customers` SET `status` = 'no delivery' where id='".$id."'");
        }
       echo 1;
       exit();
}
 ?>