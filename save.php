<?php
require('config.php');
session_start();
$view = $_SESSION['role'];
$where =$_POST['where'];
if ($where == 'customer' ) {
	$id = $_POST['id'];
   $name = $_POST['name'];
   $location = $_POST['location'];
   $number = $_POST['number'];
   $deliverer = $_POST['deliverer'];
   $note = $_POST['note'];
	mysqli_query($connection,"UPDATE `customers` SET `Name` = '".$name."',`Location` = '".$location."',`Number` = '".$number."',`Deliverer` = '".$deliverer."',`Note` = '".$note."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif( $where == 'stock'){
   $id = $_POST['id'];
   $category = $_POST['category'];
   $name = $_POST['name'];
   $bp = $_POST['bp'];
   $discount = $_POST['discount'];
   $sp = $_POST['sp'];
   $qty = $_POST['qty'];
   $restock = $_POST['restock_Level'];
   //MariaDB
   //$result1 = mysqli_query($connection,"SELECT sfid as batchId FROM (SELECT s.id as sid, sf.id as sfid ,sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id JOIN category c ON s.Category_id=c.id ) q WHERE rn = 1 AND sid='$id'")or die($connection->error);
   //MySQL
   $result1 = mysqli_query($connection,"SELECT sfid as batchId FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN category c ON s.Category_id=c.id INNER JOIN (SELECT s.id as sid, sf.id as sfid, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.sid = s.id AND subQuery.max_created_at = sf.Created_at AND s.id = '$id';")or die($connection->error);
        $row = mysqli_fetch_array($result1);
        $flowId = $row['batchId'];
   $result2 = mysqli_query($connection,"SELECT id FROM category where Category_Name='$category';")or die($connection->error);
        $row2 = mysqli_fetch_array($result2);
        $categoryId = $row2['id'];
mysqli_query($connection,"UPDATE `stock` JOIN stock_flow ON stock.id = stock_flow.Stock_id SET `Name` = '".$name."',Category_id = '".$categoryId."',Restock_Level = '".$restock."',`Discount` = '".$discount."',stock_flow.Buying_price= '".$bp."',stock_flow.Selling_price = '".$sp."',stock.Price = '".$sp."',stock.Buying_price = '".$bp."'  WHERE  stock_flow.id = '".$flowId."'")or die($connection->error);
}
elseif ($where == 'blacklist') {
	$id = $_POST['id'];
    $location = $_POST['location'];
    $number = $_POST['number'];
    $balance = $_POST['balance'];
mysqli_query($connection,"UPDATE `customers` INNER JOIN `orders` ON customers.id = orders.Customer_id SET `Location` = '".$location."',`Number` = '".$number."',`Balance` = '".$balance."' WHERE customers.id = '".$id."'")or die($connection->error);
}
elseif ($where == 'categories') {
	$id = $_POST['id'];
    $name = $_POST['name'];
mysqli_query($connection,"UPDATE `category` SET `Category_Name` = '".$name."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif ($where == 'orders') {
	$id = $_POST['id'];
$qty = $_POST['qty'];
$mpesa = $_POST['mpesa'];
$cash = $_POST['cash'];
$date = $_POST['date'];
$banked = $_POST['banked'];
$slip = $_POST['slip'];
$banker = $_POST['banker'];
$returned = $_POST['returned'];
$result2 = mysqli_query($connection,"select Stock_id, Debt, Fine,Quantity as Qty,Returned from  orders where id='".$id."';")or die($connection->error);
   $row2 = mysqli_fetch_array($result2);
    $old_Qty =  $row2['Qty'];
    $Fine = $row2['Fine'];
    $Debt =  $row2['Debt'];
    $stock_id = $row2['Stock_id'];
    $returns = $row2['Returned'];
    if ($returned > $old_Qty) {
      echo "excess returned";
      exit();
    }
    //MariaDB
    //$result4 = mysqli_query($connection,"SELECT Price,quantity FROM (SELECT s.id as id,s.Quantity as quantity,sf.Selling_price as Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id ) q WHERE rn = 1 AND id = '$stock_id'")or die($connection->error);
    //MySQL
    $result4 = mysqli_query($connection,"SELECT sf.Selling_price as Price, s.Quantity as quantity FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at AND s.id = '$stock_id';")or die($connection->error);
    $row4 = mysqli_fetch_array($result4);
    $Price = $row4['Price'];
    $storeQty = $row4['quantity'];
    if ($view == 'Software') {
       $cost = $Price * $qty;
    }
    else{
     $cost = $Price * $old_Qty;
    }
     $newBalance = $Debt-$cost+$mpesa+$cash+$Fine;
$result1 = mysqli_query($connection,"SELECT Customer_id,Quantity,Balance FROM orders where `id` = '".$id."'")or die($connection->error);
    $row = mysqli_fetch_array($result1);
    $Quantity = $row['Quantity'];
    $oldBalance = $row['Balance'];
    $customer = $row['Customer_id'];
    $Returned = '';
    if ($returns == $returned) {
      if ($view == 'Software') {
      $Returned = $Quantity - $qty;
       }
    else{ 
      $Returned = $Quantity - $old_Qty;
      }
    }
        else if ($returned < $returns && $returned >= 0) {
      $Returned = $returned;
      $initialAmt = $Quantity + $returns;
       if ($view == 'Software') {
      $qty = $initialAmt - $returned;
         }
    else{ 
      $old_Qty = $initialAmt - $returned;
      }
    }
    else if ($returned < 0) {
      $Returned = 0;
      $initialAmt = $Quantity + $returns;
      if ($view == 'Software') {
      $qty = $initialAmt - 0;
          }
    else{ 
      $old_Qty = $initialAmt - 0;
    }
    }
    else{
      $Returned = $returned;
      $initialAmt = $Quantity + $returns;
      if ($view == 'Software') {
      $qty = $initialAmt - $returned;
          }
    else{ 
      $old_Qty = $initialAmt - $returned;
    }
    }
    if ($view == 'Software') {
    $qtyAdded = $qty - $Quantity;
         }
    else{ 
    $qtyAdded = $old_Qty - $Quantity;
     }
    if ($storeQty < $qtyAdded) {
      echo "Unavailable";
      exit();
    }
     if ($view == 'Software') {
      mysqli_query($connection,"UPDATE `orders`  SET `Quantity` = '".$qty."',`Balance` = '".$newBalance."',`MPesa` = '".$mpesa."',`Cash` = '".$cash."',`Delivery_time` = '".$date."',`Returned` = '".$Returned."',`Banked` = '".$banked."',`Slip_Number` = '".$slip."',`Banked_By` = '".$banker."' WHERE `id` = '".$id."'")or die($connection->error);
       }
    else{ 
      mysqli_query($connection,"UPDATE `orders`  SET `Quantity` = '".$old_Qty."',`Balance` = '".$newBalance."',`MPesa` = '".$mpesa."',`Cash` = '".$cash."',`Delivery_time` = '".$date."',`Returned` = '".$Returned."',`Banked` = '".$banked."',`Slip_Number` = '".$slip."',`Banked_By` = '".$banker."' WHERE `id` = '".$id."'")or die($connection->error);
     }
      mysqli_query($connection,"update stock set Quantity= Quantity +".$Returned." WHERE `id` = '".$stock_id."'")or die($connection->error);
      $product = mysqli_query($connection,"SELECT Name,Category_Name  FROM `stock` inner join category on stock.Category_id = category.id WHERE stock.id = '".$stock_id."'")or die($connection->error);
   $Product = mysqli_fetch_array($product);
  $Category_Name = $Product['Category_Name'];
  $Stock_Name = $Product['Name'];
  $Category = mysqli_query($connection,"SELECT Quantity,Unit_id,subunit_replenish_qty,Restock_Level,inventory_units.Name as Unit_name  FROM `stock` inner join inventory_units on stock.Unit_id = inventory_units.id WHERE stock.id = '".$stock_id."'")or die($connection->error);
   $Name = mysqli_fetch_array($Category);
   $Restock_Level = $Name['Restock_Level'];
   $Qty = $Name['Quantity'];
   if ($Qty < $Restock_Level) {
      $Unit_id = $Name['Unit_id'];
      $Unit_name = $Name['Unit_name'];
      $trunctated_name = str_replace($Unit_name,'',$Stock_Name);
      $parent_exists = mysqli_query($connection,"SELECT Name,Contains,Quantity FROM stock WHERE Name LIKE '".$trunctated_name."%' AND Subunit_id = '".$Unit_id."'")or die($connection->error);
     $result_existence = mysqli_fetch_array($parent_exists);
     if ( $result_existence == TRUE) {
      $parent_name = $result_existence['Name'];
      $parent_contains = $result_existence['Contains'];
      $parent_quantity = $result_existence['Quantity'];
      $subunit_replenish_qty = $Name['subunit_replenish_qty'];
      $parent_reduction = $subunit_replenish_qty / $parent_contains;
      if ($parent_quantity <= $parent_reduction) {
        $new_parent_quantity = 0;
        $subunit_replenish_qty = $parent_quantity * $parent_contains;
        }
        else{
          $new_parent_quantity = $parent_quantity - $parent_reduction;
        }
        mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '$new_parent_quantity' WHERE `Name` = '".$parent_name."'")or die($connection->error);
        mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$subunit_replenish_qty."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
     }
   }
   /*
   if($Category_Name == 'Maize Flour' && strpos($Stock_Name, 'Pieces') !== false || $Category_Name == 'All Purpose Flour' && strpos($Stock_Name, 'Pieces') !== false){
   $Qty = $Name['Quantity'];
   if ($Qty < $Restock_Level) {
     $Bundle_Name = str_replace("Pieces","Bundles",$Stock_Name);
     $Bundle_Qty = mysqli_query($connection,"SELECT Quantity  FROM `stock` WHERE stock.Name = '".$Bundle_Name."'")or die($connection->error);
   $bundle_qty = mysqli_fetch_array($Bundle_Qty);
   $bundleQuantity = $bundle_qty['Quantity'];
   if ($bundleQuantity <= 1) {
     $newBundleQty = 0;
     $newPiecesIncreament = $bundleQuantity * 12;
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '0' WHERE `Name` = '".$Bundle_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$newPiecesIncreament."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
   }else{
      $newBundleQty = $bundleQuantity - 1;
      mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '$newBundleQty' WHERE `Name` = '".$Bundle_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '12' WHERE `id` = '".$stock_id."'")or die($connection->error);
   }
   }
   }
    if($Category_Name == 'Sugar' && strpos($Stock_Name, 'Packets') !== false){
       $Qty = $Name['Quantity'];
   if ($Qty < $Restock_Level) {
     $Bag_Name = str_replace("Packets","Bag",$Stock_Name);
     $Bag_Qty = mysqli_query($connection,"SELECT Quantity  FROM `stock` WHERE stock.Name = '".$Bag_Name."'")or die($connection->error);
   $bag_qty = mysqli_fetch_array($Bag_Qty);
   $bagQuantity = $bag_qty['Quantity'];
   if ($bagQuantity = 1) {
     $newBagQty = 0;
     $newPacketsIncreament = 50;
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '0' WHERE `Name` = '".$Bag_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$newPacketsIncreament."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
   }else{
      $newBagQty = $bagQuantity - 1;
      mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '$newBagQty' WHERE `Name` = '".$Bag_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '50' WHERE `id` = '".$stock_id."'")or die($connection->error);
   }
   }
    }
    if($Category_Name == 'Serviettes' && strpos($Stock_Name, 'Pieces') !== false){
       $Qty = $Name['Quantity'];
   if ($Qty < $Restock_Level) {
     $Bundle_Name = str_replace("Pieces","Bundles",$Stock_Name);
     $Bundle_Qty = mysqli_query($connection,"SELECT Quantity  FROM `stock` WHERE stock.Name = '".$Bundle_Name."'")or die($connection->error);
   $bundle_qty = mysqli_fetch_array($Bundle_Qty);
   $bundleQuantity = $bag_qty['Quantity'];
   if ($bundleQuantity = 1) {
     $newBundleQty = 0;
     $newPiecesIncreament = 18;
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '0' WHERE `Name` = '".$Bundle_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$newPiecesIncreament."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
   }else{
      $newBundleQty = $bundleQuantity - 1;
      mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '$newBundleQty' WHERE `Name` = '".$Bundle_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '18' WHERE `id` = '".$stock_id."'")or die($connection->error);
   }
   }
    }
    if($Category_Name == 'Baking Powder' && strpos($Stock_Name, 'Pieces') !== false){
       $Qty = $Name['Quantity'];
   if ($Qty < $Restock_Level) {
     $Dozen_Name = str_replace("Pieces","Dozen",$Stock_Name);
     $Dozen_Qty = mysqli_query($connection,"SELECT Quantity  FROM `stock` WHERE stock.Name = '".$Dozen_Name."'")or die($connection->error);
   $dozen_qty = mysqli_fetch_array($Dozen_Qty);
   $dozenQuantity = $dozen_qty['Quantity'];
   if ($dozenQuantity = 1) {
     $newDozenQty = 0;
     $newPiecesIncreament = 12;
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '0' WHERE `Name` = '".$Dozen_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$newPiecesIncreament."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
   }else{
      $newDozenQty = $dozenQuantity - 1;
      mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '$newDozenQty' WHERE `Name` = '".$Dozen_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '12' WHERE `id` = '".$stock_id."'")or die($connection->error);
   }
   }
    }
    if($Category_Name == 'Baking Powder' && strpos($Stock_Name, 'Dozen') !== false){
       $Qty = $Name['Quantity'];
   if ($Qty < $Restock_Level) {
     $Box_Name = str_replace("Dozen","Boxes",$Stock_Name);
     $Box_Qty = mysqli_query($connection,"SELECT Quantity  FROM `stock` WHERE stock.Name = '".$Box_Name."'")or die($connection->error);
   $box_qty = mysqli_fetch_array($Box_Qty);
   $boxQuantity = $box_qty['Quantity'];
   if ($dozenQuantity = 1) {
     $newBoxQty = 0;
     $newDozenIncreament = 6;
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '0' WHERE `Name` = '".$Box_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$newDozenIncreament."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
   }else{
      $newBoxQty = $boxQuantity - 1;
      mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '$newBoxQty' WHERE `Name` = '".$Box_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '6' WHERE `id` = '".$stock_id."'")or die($connection->error);
   }
   }
    }
    if($Category_Name == 'Milk' && strpos($Stock_Name, 'Packets') !== false){
       $Qty = $Name['Quantity'];
   if ($Qty < $Restock_Level) {
     $Box_Name = str_replace("Packets","Boxes",$Stock_Name);
     $Box_Qty = mysqli_query($connection,"SELECT Quantity  FROM `stock` WHERE stock.Name = '".$Box_Name."'")or die($connection->error);
   $box_qty = mysqli_fetch_array($Box_Qty);
   $boxQuantity = $box_qty['Quantity'];
   if ($boxQuantity = 1) {
     $newBoxQty = 0;
     $newPiecesIncreament = 12;
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '0' WHERE `Name` = '".$Box_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$newPiecesIncreament."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
   }else{
      $newBoxQty = $boxQuantity - 1;
      mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '$newBoxQty' WHERE `Name` = '".$Box_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '12' WHERE `id` = '".$stock_id."'")or die($connection->error);
   }
   }
    }
    if($Category_Name == 'Rice' && strpos($Stock_Name, 'Packets') !== false){
       $Qty = $Name['Quantity'];
   if ($Qty < $Restock_Level) {
     $Bag_Name = str_replace("Packets","Bag",$Stock_Name);
     $Bag_Qty = mysqli_query($connection,"SELECT Quantity  FROM `stock` WHERE stock.Name = '".$Bag_Name."'")or die($connection->error);
   $bag_qty = mysqli_fetch_array($Bag_Qty);
   $bagQuantity = $bag_qty['Quantity'];
   if ($bagQuantity = 1) {
     $newBagQty = 0;
     $newPacketsIncreament = 25;
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '0' WHERE `Name` = '".$Bag_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$newPacketsIncreament."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
   }else{
      $newBagQty = $bagQuantity - 1;
      mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '$newBagQty' WHERE `Name` = '".$Bag_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '25' WHERE `id` = '".$stock_id."'")or die($connection->error);
   }
   }
    }
    if($Category_Name == 'Soap' && strpos($Stock_Name, 'Pieces') !== false){
       $Qty = $Name['Quantity'];
   if ($Qty < $Restock_Level) {
     $Box_Name = str_replace("Pieces","Boxes",$Stock_Name);
     $Box_Qty = mysqli_query($connection,"SELECT Quantity  FROM `stock` WHERE stock.Name = '".$Box_Name."'")or die($connection->error);
   $box_qty = mysqli_fetch_array($Box_Qty);
   $boxQuantity = $box_qty['Quantity'];
   if ($boxQuantity = 1) {
     $newBoxQty = 0;
     $newPiecesIncreament = 50;
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '0' WHERE `Name` = '".$Box_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$newPiecesIncreament."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
   }else{
      $newBoxQty = $boxQuantity - 1;
      mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '$newBoxQty' WHERE `Name` = '".$Box_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '50' WHERE `id` = '".$stock_id."'")or die($connection->error);
   }
   }
    }
    */

     /* $result5 = mysqli_query($connection,"SELECT Category_Name FROM category join stock on category.id = stock.Category_id where stock.id = '".$stock_id."'")or die($connection->error);
      $row5 = mysqli_fetch_array($result5);
      $Cat_Name = $row5['Category_Name'];
      if($Cat_Name == 'Cereals'){
       mysqli_query($connection,"update cooked_cereals set Returned= Returned +".$Returned." WHERE `Stock_id` = '".$stock_id."' AND date(Delivery_date) = CURRENT_DATE()")or die($connection->error);
      }*/
      $difference = $oldBalance - $newBalance;
		mysqli_query($connection,"UPDATE orders set Debt= Debt-'".$difference."', `Balance` = Balance -".$difference." WHERE Customer_id='".$customer."' and id >'".$id."' ;")or die($connection->error);
			//newBalance calculate credit score
     $result3 = mysqli_query($connection,"select orders.Balance as newBalance from orders INNER JOIN customers ON orders.Customer_id=customers.id  WHERE orders.id IN (SELECT MAX(orders.id)FROM orders INNER JOIN customers ON orders.Customer_id=customers.id where customers.id='".$customer."' )")or die($connection->error);
    $row3 = mysqli_fetch_array($result3);
    $lastBalance = $row3['newBalance'];
    if ($lastBalance == 0) {
      mysqli_query($connection,"UPDATE `customers`  SET `Status` = 'clean' WHERE `id` = '".$customer."'")or die($connection->error);
    }else if ($lastBalance > 0) {
      mysqli_query($connection,"UPDATE `customers`  SET `Status` = 'credit' WHERE `id` = '".$customer."'")or die($connection->error);
    }else if ($lastBalance < 0 && $newBalance >= -100) {
      mysqli_query($connection,"UPDATE `customers`  SET `Status` = 'fined' WHERE `id` = '".$customer."'")or die($connection->error);
    }else if ($lastBalance < -100) {
     mysqli_query($connection,"UPDATE `customers`  SET `Status` = 'no delivery' WHERE `id` = '".$customer."'")or die($connection->error);
 }
    }
    elseif ($where == 'sales') {
  $id = $_POST['id'];
$qty = $_POST['qty'];
$mpesa = $_POST['mpesa'];
$cash = $_POST['cash'];
$discount = $_POST['discount'];
$banked = $_POST['banked'];
$slip = $_POST['slip'];
$banker = $_POST['banker'];
$returned = $_POST['returned'];
$result2 = mysqli_query($connection,"select Stock_id, Debt, Quantity as Qty,Returned from  sales where id='".$id."';")or die($connection->error);
   $row2 = mysqli_fetch_array($result2);
    $old_Qty =  $row2['Qty'];
    $Debt =  $row2['Debt'];
    $stock_id = $row2['Stock_id'];
    $returns = $row2['Returned'];
    if ($returned > $old_Qty) {
      echo "excess returned";
      exit();
    }
    $result4 = mysqli_query($connection,"SELECT Price,quantity FROM (SELECT s.id as id,s.Quantity as quantity,sf.Selling_price as Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id ) q WHERE rn = 1 AND id = '$stock_id'")or die($connection->error);
    $row4 = mysqli_fetch_array($result4);
    $Price = $row4['Price'];
    $storeQty = $row4['quantity'];
    $Discounted_Price = $Price - $discount;
    if ($view == 'Software') {
     $cost = $Discounted_Price * $qty;
      }
    else{ 
     $cost = $Discounted_Price * $old_Qty;
     }
     $newBalance = $Debt-$cost+$mpesa+$cash;
$result1 = mysqli_query($connection,"SELECT Staff_id,Quantity,Balance FROM sales where `id` = '".$id."'")or die($connection->error);
    $row = mysqli_fetch_array($result1);
    $Quantity = $row['Quantity'];
    $oldBalance = $row['Balance'];
    $staff = $row['Staff_id'];
    
    /*
     $Returned = $returned;
   #Quantity cell manipulation
    //xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx//
   //user should no input quantity less than 0
    if ($qty < 0){
      echo "false qty";
      exit();
    }
    //quantity has been set correctly
    else{
      //if the quantity hasn't been changed (We do this rather than put 0 since there could be returns for that product already)
      if ($view == 'Software') {
       if($qty == $Quantity){
         $Returned = $returns;
       }
       //if the new quantity is greater than old quantity it means there is a surplus
       else if ($qty > $Quantity) {
        //check if additional qty will exceed what is availablw
        $qtyAdded = $qty - $Quantity;
        if ($storeQty < $qtyAdded) {
          echo "Unavailable";
          exit();
           }
          else{
        //surplus but then there was no returns so no cancellation with returns
        if ($returns = 0) {
          $Returned = 0;
        }
        //surplus but with returns, we shall cancel out the additional qty with anything that was returned
         else if ($returns > 0) {
           $surplus_qty = $qty - $Quantity;
           //if returns is greater than surplus thats computed in previous line
           if ($returns > $surplus_qty) {
             $Returned = $returns - $surplus_qty;
             $qty = $Quantity;
           }
           //if returns and surplus are equal
           else if ($returns == $surplus_qty) {
             $Returned = 0;
             $qty = $Quantity;
           }
           //this means that surplus is greater than returns
           else{
             $new_surplus = $surplus_qty - $returns;
             $qty = $Quantity + $new_surplus;
             $Returned = 0;
           }
         }
        } 
       }
       //if the new quantity from user is less than the current quantity it means there is a return
       else if ($qty < $Quantity) {
        //if the returns was initially 0
         if ($returns = 0) {
           $Returned = $Quantity - $qty;
         }
         //if the returns were already there do:
         else if ($returns > 0) {
           $new_returned = $Quantity - $qty;
           $Returned = $returns + $new_returned;
         }
       }
    }
       else{
       if($old_Qty == $Quantity){
         $Returned = $returns;
       }
        //if the new quantity is greater than old quantity it means there is a surplus
       else if ($old_Qty > $Quantity) {
        //check if additional qty will exceed what is availablw
        $qtyAdded = $old_Qty - $Quantity;
        if ($storeQty < $qtyAdded) {
          echo "Unavailable";
          exit();
           }
          else{
        //surplus but then there was no returns so no cancellation with returns
        if ($returns = 0) {
          $Returned = 0;
        }
        //surplus but with returns, we shall cancel out the additional qty with anything that was returned
         else if ($returns > 0) {
           $surplus_qty = $old_Qty - $Quantity;
           //if returns is greater than surplus thats computed in previous line
           if ($returns > $surplus_qty) {
             $Returned = $returns - $surplus_qty;
             $old_Qty = $Quantity;
           }
           //if returns and surplus are equal
           else if ($returns == $surplus_qty) {
             $Returned = 0;
             $old_Qty = $Quantity;
           }
           //this means that surplus is greater than returns
           else{
             $new_surplus = $surplus_qty - $returns;
             $old_Qty = $Quantity + $new_surplus;
             $Returned = 0;
           }
         }
        } 
       }
        //if the new quantity from user is less than the current quantity it means there is a return
       else if ($old_Qty < $Quantity) {
        //if the returns was initially 0
         if ($returns = 0) {
           $Returned = $Quantity - $old_Qty;
         }
         //if the returns were already there do:
         else if ($returns > 0) {
           $new_returned = $Quantity - $old_Qty;
           $Returned = $returns + $new_returned;
         }
       }
      }   
  }
    //xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx//
    #Returned cell manupulation
    //xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx//
    //returned cant be negative
    if ($returned < 0) {
      echo "false returned";
      exit();
    }
    //retuned can't exceed quantity requested/ordered
    else if ($returned > $Quantity) {
      echo "excess returned";
      exit();
    }
    else {
      //if the quantity is 0 then returned shouldnt change
      if($Quantity = 0){
        $Returned = $returns;
      }
      //if the returns quantity was initially 0
      if ($returns = 0) {
        $Returned = $returned;
        if ($view == 'Software') {
        $qty = $Quantity - $returned;
        }
        else{
          $old_Qty = $Quantity - $returned;
        }
      }
      //if the returns quantity was initially there
      else if ($returns > 0) {
        //get the difference in old returns and new returns. a positive result inicates new returns while a negative one means reduced returns thus more sold
        $surplus_returns = $returned - $returns;
           $Returned = $returned;
            if ($view == 'Software') {
           $qty = $Quantity - $surplus_returns;
           }
           else{
            $old_Qty = $Quantity - $surplus_returns;
           }
      }
    }
    //xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx//
  */

    
      $Returned = '';
      $initialAmt = $Quantity + $returns;
      //if the returns dont change
    if ($returns == $returned) {
      if ($view == 'Software') {
      $Returned = $initialAmt - $qty;
        }
    else{ 
      $Returned = $initialAmt - $old_Qty;
      }
    }
    //returned less that the initial returned
        else if ($returned < $returns && $returned >= 0) {
      $Returned = $returned;
      //get the total initial amount .Take it this way that product has been fully requested with no returns. Now remove the current returns to get the new qty sold.
      if ($view == 'Software') {
      $qty = $initialAmt - $returned;
         }
    else{ 
      $old_Qty = $initialAmt - $returned;
      }
    }
    //if negative is input. The full requisition qty will be in the qty cell and no returns.
    else if ($returned < 0) {
      $Returned = 0;
      if ($view == 'Software') {
      $qty = $initialAmt - 0;
         }
    else{ 
      $old_Qty = $initialAmt - 0;
      }
    }
    //if the amount returned is greater than the initial returned, initial amount minus new returned for new qty and returnsed enters is new returned
    else{
      $Returned = $returned;
      if ($view == 'Software') {
      $qty = $initialAmt - $returned;
          }
    else{ 
      $old_Qty = $initialAmt - $returned;
     }
    }
    //here we want to check if the new increament in qty is available in store in the case where the qty was increased
    if ($view == 'Software') {
      if ($qty > $Quantity) {
        $qtyAdded = $qty - $Quantity;
        //if it is available
        //if the qty is added and there was a return or not
        if ($storeQty > $qtyAdded) {
          //if there was no return just add the new qty increament to initial qty
          if ($returns = 0) {
             $qty = $Quantity + $qtyAdded;
          } 
          //if there was a return we to remove the return 
          else{
            //if increament is greater than returns
           if ($qtyAdded > $returns) {
             $qty = $qty - $returns;
            // $Returned = 0;
           }
            //if increament is less than returns
           else if ($qtyAdded < $returns) {
             $qty = $Quantity;
             $Returned = $returns - $qtyAdded;
           }
            //if increament is equal to returns
           else{
              $qty = $Quantity;
             // $Returned = 0;
           }
          }
        }
      }
      else{
        $Returned = $initialAmt - $qty;
      }
      }

    //if not available in store
    if ($storeQty < $qtyAdded) {
      echo "Unavailable";
      exit();
    }

    
    if ($view == 'Software') {
      mysqli_query($connection,"UPDATE `sales`  SET `Quantity` = '".$qty."',`Balance` = '".$newBalance."',`MPesa` = '".$mpesa."',`Cash` = '".$cash."',`Discount` = '".$discount."',`Returned` = '".$Returned."',`Banked` = '".$banked."',`Slip_Number` = '".$slip."',`Banked_By` = '".$banker."' WHERE `id` = '".$id."'")or die($connection->error);
        }
    else{ 
      mysqli_query($connection,"UPDATE `sales`  SET `Quantity` = '".$old_Qty."',`Balance` = '".$newBalance."',`MPesa` = '".$mpesa."',`Cash` = '".$cash."',`Discount` = '".$discount."',`Returned` = '".$Returned."',`Banked` = '".$banked."',`Slip_Number` = '".$slip."',`Banked_By` = '".$banker."' WHERE `id` = '".$id."'")or die($connection->error);
     }
      mysqli_query($connection,"update stock set Quantity= Quantity +".$Returned." WHERE `id` = '".$stock_id."'")or die($connection->error);
      $product = mysqli_query($connection,"SELECT Name,Category_Name  FROM `stock` inner join category on stock.Category_id = category.id WHERE stock.id = '".$stock_id."'")or die($connection->error);
   $Product = mysqli_fetch_array($product);
  $Category_Name = $Product['Category_Name'];
  $Stock_Name = $Product['Name'];
  $Category = mysqli_query($connection,"SELECT Quantity,Unit_id,subunit_replenish_qty,Restock_Level,inventory_units.Name as Unit_name  FROM `stock` inner join inventory_units on stock.Unit_id = inventory_units.id WHERE stock.id = '".$stock_id."'")or die($connection->error);
   $Name = mysqli_fetch_array($Category);
   $Restock_Level = $Name['Restock_Level'];
   $Qty = $Name['Quantity'];
   if ($Qty < $Restock_Level) {
      $Unit_id = $Name['Unit_id'];
      $Unit_name = $Name['Unit_name'];
      $trunctated_name = str_replace($Unit_name,'',$Stock_Name);
      $parent_exists = mysqli_query($connection,"SELECT Name,Contains,Quantity FROM stock WHERE Name LIKE '".$trunctated_name."%' AND Subunit_id = '".$Unit_id."'")or die($connection->error);
     $result_existence = mysqli_fetch_array($parent_exists);
     if ( $result_existence == TRUE) {
      $parent_name = $result_existence['Name'];
      $parent_contains = $result_existence['Contains'];
      $parent_quantity = $result_existence['Quantity'];
      $subunit_replenish_qty = $Name['subunit_replenish_qty'];
      $parent_reduction = $subunit_replenish_qty / $parent_contains;
      if ($parent_quantity <= $parent_reduction) {
        $new_parent_quantity = 0;
        $subunit_replenish_qty = $parent_quantity * $parent_contains;
        }
        else{
          $new_parent_quantity = $parent_quantity - $parent_reduction;
        }
        mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '$new_parent_quantity' WHERE `Name` = '".$parent_name."'")or die($connection->error);
        mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$subunit_replenish_qty."' WHERE `id` = '".$stock_id."'")or die($connection->error);
     }
   }
   /*
   if($Category_Name == 'Maize Flour' && strpos($Stock_Name, 'Pieces') !== false || $Category_Name == 'All Purpose Flour' && strpos($Stock_Name, 'Pieces') !== false){
   $Qty = $Name['Quantity'];
   if ($Qty < $Restock_Level) {
     $Bundle_Name = str_replace("Pieces","Bundles",$Stock_Name);
     $Bundle_Qty = mysqli_query($connection,"SELECT Quantity  FROM `stock` WHERE stock.Name = '".$Bundle_Name."'")or die($connection->error);
   $bundle_qty = mysqli_fetch_array($Bundle_Qty);
   $bundleQuantity = $bundle_qty['Quantity'];
   if ($bundleQuantity <= 1) {
     $newBundleQty = 0;
     $newPiecesIncreament = $bundleQuantity * 12;
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '0' WHERE `Name` = '".$Bundle_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$newPiecesIncreament."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
   }else{
      $newBundleQty = $bundleQuantity - 1;
      mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '$newBundleQty' WHERE `Name` = '".$Bundle_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '12' WHERE `id` = '".$stock_id."'")or die($connection->error);
   }
   }
   }
    if($Category_Name == 'Sugar' && strpos($Stock_Name, 'Packets') !== false){
       $Qty = $Name['Quantity'];
   if ($Qty < $Restock_Level) {
     $Bag_Name = str_replace("Packets","Bag",$Stock_Name);
     $Bag_Qty = mysqli_query($connection,"SELECT Quantity  FROM `stock` WHERE stock.Name = '".$Bag_Name."'")or die($connection->error);
   $bag_qty = mysqli_fetch_array($Bag_Qty);
   $bagQuantity = $bag_qty['Quantity'];
   if ($bagQuantity = 1) {
     $newBagQty = 0;
     $newPacketsIncreament = 50;
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '0' WHERE `Name` = '".$Bag_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$newPacketsIncreament."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
   }else{
      $newBagQty = $bagQuantity - 1;
      mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '$newBagQty' WHERE `Name` = '".$Bag_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '50' WHERE `id` = '".$stock_id."'")or die($connection->error);
   }
   }
    }
    if($Category_Name == 'Serviettes' && strpos($Stock_Name, 'Pieces') !== false){
       $Qty = $Name['Quantity'];
   if ($Qty < $Restock_Level) {
     $Bundle_Name = str_replace("Pieces","Bundles",$Stock_Name);
     $Bundle_Qty = mysqli_query($connection,"SELECT Quantity  FROM `stock` WHERE stock.Name = '".$Bundle_Name."'")or die($connection->error);
   $bundle_qty = mysqli_fetch_array($Bundle_Qty);
   $bundleQuantity = $bag_qty['Quantity'];
   if ($bundleQuantity = 1) {
     $newBundleQty = 0;
     $newPiecesIncreament = 18;
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '0' WHERE `Name` = '".$Bundle_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$newPiecesIncreament."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
   }else{
      $newBundleQty = $bundleQuantity - 1;
      mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '$newBundleQty' WHERE `Name` = '".$Bundle_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '18' WHERE `id` = '".$stock_id."'")or die($connection->error);
   }
   }
    }
    if($Category_Name == 'Baking Powder' && strpos($Stock_Name, 'Pieces') !== false){
       $Qty = $Name['Quantity'];
   if ($Qty < $Restock_Level) {
     $Dozen_Name = str_replace("Pieces","Dozen",$Stock_Name);
     $Dozen_Qty = mysqli_query($connection,"SELECT Quantity  FROM `stock` WHERE stock.Name = '".$Dozen_Name."'")or die($connection->error);
   $dozen_qty = mysqli_fetch_array($Dozen_Qty);
   $dozenQuantity = $dozen_qty['Quantity'];
   if ($dozenQuantity = 1) {
     $newDozenQty = 0;
     $newPiecesIncreament = 12;
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '0' WHERE `Name` = '".$Dozen_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$newPiecesIncreament."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
   }else{
      $newDozenQty = $dozenQuantity - 1;
      mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '$newDozenQty' WHERE `Name` = '".$Dozen_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '12' WHERE `id` = '".$stock_id."'")or die($connection->error);
   }
   }
    }
    if($Category_Name == 'Baking Powder' && strpos($Stock_Name, 'Dozen') !== false){
       $Qty = $Name['Quantity'];
   if ($Qty < $Restock_Level) {
     $Box_Name = str_replace("Dozen","Boxes",$Stock_Name);
     $Box_Qty = mysqli_query($connection,"SELECT Quantity  FROM `stock` WHERE stock.Name = '".$Box_Name."'")or die($connection->error);
   $box_qty = mysqli_fetch_array($Dozen_Qty);
   $boxQuantity = $box_qty['Quantity'];
   if ($dozenQuantity = 1) {
     $newBoxQty = 0;
     $newDozenIncreament = 6;
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '0' WHERE `Name` = '".$Box_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$newDozenIncreament."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
   }else{
      $newBoxQty = $boxQuantity - 1;
      mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '$newBoxQty' WHERE `Name` = '".$Box_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '6' WHERE `id` = '".$stock_id."'")or die($connection->error);
   }
   }
    }
    */
    
     /* $result5 = mysqli_query($connection,"SELECT Category_Name FROM category join stock on category.id = stock.Category_id where stock.id = '".$stock_id."'")or die($connection->error);
      $row5 = mysqli_fetch_array($result5);
      $Cat_Name = $row5['Category_Name'];
      if($Cat_Name == 'Cereals'){
       mysqli_query($connection,"update cooked_cereals set Returned= Returned +".$Returned." WHERE `Stock_id` = '".$stock_id."' AND date(Delivery_date) = CURRENT_DATE()")or die($connection->error);
      }*/
      $difference = $oldBalance - $newBalance;
    mysqli_query($connection,"UPDATE sales set Debt= Debt-'".$difference."', `Balance` = Balance -".$difference." WHERE Staff_id='".$staff."' and id >'".$id."' ;")or die($connection->error);
    }
elseif ($where == 'fine') {
	$id = $_POST['id'];
	$balance = $_POST['balance'];
	$customerID = "";
	$x = new stdClass();
	$res1 = mysqli_query($connection, "SELECT * FROM orders WHERE id ='$id'");

	$rowS = mysqli_fetch_array($res1);
	$customerID = $rowS['Customer_id'];

	$res2 = mysqli_query($connection,"SELECT EXISTS(SELECT * FROM orders WHERE Customer_id='$customerID' AND id >= '$id' AND Fine < 0)");
	$rx = mysqli_fetch_array($res2);
	if ($rx[0]==0) {
		$x->msg="Positive";
		$re = mysqli_query($connection, "SELECT * FROM orders WHERE id='$id'");
		$rowy = mysqli_fetch_array($re);
		$fine = 0;
		$balance = $rowy['Balance'];
		if ($balance <= -500) {
			$fine = -100;
		}elseif ($balance>-500 && $balance<0) {
			$fine = $balance * 0.1;
		}
		if ($fine!=0) {
			$newB = $balance + $fine;
			$x->newBalance = $newB;
			$x->Fine=$fine;
			if (mysqli_query($connection,"UPDATE orders SET Fine = '$fine', Balance = '$newB' WHERE id='$id'")===TRUE) {
					mysqli_query($connection,"UPDATE orders set Debt= Debt+'".$fine."', `Balance` = Balance +".$fine." WHERE Customer_id='".$customerID."' and id >'".$id."' ;")or die($connection->error);
			}
			#update status
			$result2 = mysqli_query($connection,"SELECT orders.Balance as newBalance from orders INNER JOIN customers ON orders.Customer_id=customers.id  WHERE orders.id IN (SELECT MAX(orders.id)FROM orders INNER JOIN customers ON orders.Customer_id=customers.id where customers.id='".$customerID."' ); ")or die($connection->error);
			$row2 = mysqli_fetch_array($result2);
			$newBalance = $row2['newBalance'];
			if ($newBalance == 0) {
				mysqli_query($connection,"UPDATE `customers`  SET `Status` = 'clean' WHERE `id` = '".$customerID."'")or die($connection->error);
			}else if ($newBalance > 0) {
				mysqli_query($connection,"UPDATE `customers`  SET `Status` = 'credit' WHERE `id` = '".$customerID."'")or die($connection->error);
			}else if ($newBalance < 0 && $newBalance >= -100) {
				mysqli_query($connection,"UPDATE `customers`  SET `Status` = 'fined' WHERE `id` = '".$customerID."'")or die($connection->error);
			}else if ($newBalance < -100) {
			 mysqli_query($connection,"UPDATE `customers`  SET `Status` = 'no delivery' WHERE `id` = '".$customerID."'")or die($connection->error);
		}
		#sam's weebshit
	}else {
		$x->msg="Negativex";
	}
	}else {
		$res3 = mysqli_query($connection,"SELECT * FROM orders WHERE Customer_id='$customerID' AND id >= '$id' AND Fine < 0");
		while($rowx = mysqli_fetch_assoc($res3)){
			if ($rowx['Fine']<0) {
				$x->fineAmt = $rowx['Fine'];
				$x->fineOrder = $rowx['id'];
			}
		}
		$x->msg="Negative";
	}
	echo json_encode($x);
}

elseif ($where == 'suppliers') {
  $id = $_POST['id'];
    $contact = $_POST['contact'];
mysqli_query($connection,"UPDATE `suppliers` SET `Supplier_contact` = '".$contact."' WHERE `id` = '".$id."'")or die($connection->error);
}elseif ($where == 'vehicles') {
  $id = $_POST['id'];
    $route = $_POST['route'];
    $mileage = $_POST['mileage'];
    $miles = str_replace(" Kms.", "", $mileage);
mysqli_query($connection,"UPDATE `vehicles` SET `Route` = '".$route."',`Mileage` = '".$miles."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif ($where == 'deliverer') {
  $id = $_POST['id'];
    $contact = $_POST['contact'];
    $staffId = $_POST['staffId'];
    $nationalId = $_POST['nationalId'];
    $salary = $_POST['salary'];
    $kra = $_POST['kra'];
    $nssf = $_POST['nssf'];
    $nhif = $_POST['nhif'];
    $figure = str_replace("Ksh. ","",$salary);
mysqli_query($connection,"UPDATE `users` SET `number` = '".$contact."',`staffID` = '".$staffId."',`nationalID` = '".$nationalId."',`KRA` = '".$kra."',`NSSF` = '".$nssf."',`NHIF` = '".$nhif."',`salary` = '".$figure."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif ($where == 'cook') {
  $id = $_POST['id'];
    $contact = $_POST['contact'];
    $staffId = $_POST['staffId'];
    $nationalId = $_POST['nationalId'];
    $salary = $_POST['salary'];
    $kra = $_POST['kra'];
    $nssf = $_POST['nssf'];
    $nhif = $_POST['nhif'];
    $figure = str_replace("Ksh. ","",$salary);
mysqli_query($connection,"UPDATE `users` SET `number` = '".$contact."',`staffID` = '".$staffId."',`nationalID` = '".$nationalId."',`KRA` = '".$kra."',`NSSF` = '".$nssf."',`NHIF` = '".$nhif."',`salary` = '".$figure."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif ($where == 'cleaner') {
  $id = $_POST['id'];
    $contact = $_POST['contact'];
    $staffId = $_POST['staffId'];
    $nationalId = $_POST['nationalId'];
    $salary = $_POST['salary'];
    $kra = $_POST['kra'];
    $nssf = $_POST['nssf'];
    $nhif = $_POST['nhif'];
    $figure = str_replace("Ksh. ","",$salary);
mysqli_query($connection,"UPDATE `users` SET `number` = '".$contact."',`staffID` = '".$staffId."',`nationalID` = '".$nationalId."',`KRA` = '".$kra."',`NSSF` = '".$nssf."',`NHIF` = '".$nhif."',`salary` = '".$figure."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif ($where == 'office') {
  $id = $_POST['id'];
    $contact = $_POST['contact'];
    $staffId = $_POST['staffId'];
    $nationalId = $_POST['nationalId'];
    $salary = $_POST['salary'];
    $kra = $_POST['kra'];
    $nssf = $_POST['nssf'];
    $nhif = $_POST['nhif'];
    $role = $_POST['role'];
    $result1 = mysqli_query($connection,"SELECT id FROM jobs where Name like '%$role%';")or die($connection->error);
    $row = mysqli_fetch_array($result1);
    $position = $row['id'];
    $figure = str_replace("Ksh. ","",$salary);
mysqli_query($connection,"UPDATE `users` SET `number` = '".$contact."',`staffID` = '".$staffId."',`nationalID` = '".$nationalId."',`KRA` = '".$kra."',`NSSF` = '".$nssf."',`NHIF` = '".$nhif."',`salary` = '".$figure."' ,`Job_id` = '".$position."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif ($where == 'faq') {
  $id = $_POST['id'];
    $question = $_POST['question'];
     $answer = $_POST['answer'];
mysqli_query($connection,"UPDATE `faqs` SET `question` = '".$question."',`answer` = '".$answer."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif ($where == 'blog') {
  $id = $_POST['id'];
    $title = $_POST['title'];
     $blog = $_POST['blog'];
mysqli_query($connection,"UPDATE `blogs` SET `title` = '".$title."',`blog` = '".$blog."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif ($where == 'publicNote') {
  $id = $_POST['id'];
    $title = $_POST['title'];
     $body = $_POST['body'];
mysqli_query($connection,"UPDATE `notes` SET `Title` = '".$title."',`Note` = '".$body."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif ($where == 'privateNote') {
  $id = $_POST['id'];
    $title = $_POST['title'];
     $body = $_POST['body'];
mysqli_query($connection,"UPDATE `notes` SET `Title` = '".$title."',`Note` = '".$body."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif ($where == 'expenseHeading') {
  $id = $_POST['id'];
    $name = $_POST['name'];
mysqli_query($connection,"UPDATE `expenses` SET `Name` = '".$name."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif ($where == 'expense') {
  $id = $_POST['id'];
    $party = $_POST['party'];
    $particular = $_POST['particular'];
     $total = $_POST['total'];
     $paid = $_POST['paid'];
     $due = $_POST['due'];
     $date = $_POST['date'];
mysqli_query($connection,"UPDATE `expense_details` SET `Party` = '".$party."',`Expense_particular` = '".$particular."',`Total_amount` = '".$total."',`Paid_amount` = '".$paid."',`Due_amount` = '".$due."',`Payment_date` = '".$date."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif ($where == 'calendar') {
   if(isset($_POST["id"]))
{
  $id =$_POST["id"];
   $title = $_POST["title"];
  $start_event = $_POST["start"];
  $end_event = $_POST["end"];
  mysqli_query($connection,"UPDATE event SET title='$title', start_event='$start_event', end_event='$end_event' WHERE id='$id'")or die($connection->error);
}
}
elseif ($where == 'profile') {
  $staffid = $_POST['staffid'];
    $username = $_POST['username'];
     $email = $_POST['email'];
     $number = $_POST['number'];
     $nationalid = $_POST['nationalid'];
mysqli_query($connection,"UPDATE `users` SET `username` = '".$username."',`email` = '".$email."',`number` = '".$number."',`nationalID` = '".$nationalid."' WHERE `staffID` = '".$staffid."'")or die($connection->error);
unset($_SESSION['user']);
$_SESSION['user'] = $username;
echo "saved";
}
elseif ($where == 'service') {
  $id = $_POST['id'];
    $now = $_POST['now'];
     $note = $_POST['note'];
     $next = $_POST['next'];
     $row = mysqli_query($connection,"SELECT * FROM vehicle_service WHERE Vehicle_id = '".$id."'")or die($connection->error);
      $result = mysqli_fetch_array($row);
         if ( $result == TRUE) {
mysqli_query($connection,"UPDATE `vehicle_service` SET Last_service = '".$now."', `notes` = '".$note."',Next_service = '".$next."' WHERE `Vehicle_id` = '".$id."'")or die($connection->error);
         }
         else{
      mysqli_query($connection,"INSERT INTO `vehicle_service` (`Vehicle_id`,`Last_service`,`notes`,`Next_service`) VALUES ('$id','$now','$note','$next')") or die(mysqli_error($connection));
         }
}
elseif ($where == 'inspection') {
  $id = $_POST['id'];
    $now = $_POST['now'];
     $note = $_POST['note'];
     $next = $_POST['next'];
     $row = mysqli_query($connection,"SELECT * FROM vehicle_inspection WHERE Vehicle_id = '".$id."'")or die($connection->error);
      $result = mysqli_fetch_array($row);
         if ( $result == TRUE) {
mysqli_query($connection,"UPDATE `vehicle_inspection` SET Last_Inspection = '".$now."', `notes` = '".$note."',Next_Inspection = '".$next."' WHERE `Vehicle_id` = '".$id."'")or die($connection->error);
          }
          else{
    mysqli_query($connection,"INSERT INTO `vehicle_inspection` (`Vehicle_id`,`Last_Inspection`,`notes`,`Next_Inspection`) VALUES ('$id','$now','$note','$next')") or die(mysqli_error($connection));
          }
}
elseif ($where == 'driver') {
  $id = $_POST['id'];
    $driver = $_POST['driver'];
mysqli_query($connection,"UPDATE `vehicles` SET Driver_id = '".$driver."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif ($where == 'damaged') {
  $id = $_POST['id'];
    $qty = $_POST['qty'];
mysqli_query($connection,"UPDATE `stock_flow` JOIN stock ON stock_flow.Stock_id = stock.id SET Damaged = Damaged + '".$qty."',Quantity = Quantity - '".$qty."' WHERE stock_flow.id = '".$id."'")or die($connection->error);
}
elseif ($where == 'leftovers') {
  $id = $_POST['id'];
    $difference = $_POST['difference'];
mysqli_query($connection,"UPDATE `cooked_cereals`  SET `Quantity_Difference` =  '".$difference."',`Quantity_Prepared` = Quantity_Prepared + '$difference' WHERE `id` = '".$id."'") or die(mysqli_error($connection));
}
elseif ($where == 'sickoff') {
  $id = $_POST['id'];
  $reason = $_POST['reason'];
  $start = $_POST['start'];
  $days = $_POST['days'];
$result2 = mysqli_query($connection,"SELECT id from employee_sickoff_data  WHERE Staff_id = '$id' AND Start_day='$start'")or die($connection->error);
$row2 = mysqli_fetch_array($result2);
$ID = $row2['id'];
mysqli_query($connection,"UPDATE `employee_sickoff_data`  SET `Reason` =  '".$reason."',`Start_day` = '$start', `sickoff_days_no` = '$days',`End_day` = DATE_ADD( '".$start."', INTERVAL ".$days." DAY ) WHERE `id` = '".$ID."'") or die(mysqli_error($connection));
}
elseif ($where == 'leave') {
  $id = $_POST['id'];
  $standIn = $_POST['standIn'];
  $start = $_POST['start'];
  $days = $_POST['days'];
$result2 = mysqli_query($connection,"SELECT id from employee_leave_data  WHERE Staff_id = '$id' AND Start_day='$start'")or die($connection->error);
$row2 = mysqli_fetch_array($result2);
$ID = $row2['id'];
$arr = explode(' ',trim($standIn));
$firstname = $arr[0];
$lastname = $arr[1];
$result3 = mysqli_query($connection,"SELECT staffID from users  WHERE firstname = '$firstname' AND lastname = '$lastname'")or die($connection->error);
$row3 = mysqli_fetch_array($result3);
$standID = $row3['staffID'];
if ($id == $standID) {
  echo "Kindly choose another stand in employee. Action Failed";
  exit();
}
mysqli_query($connection,"UPDATE `employee_leave_data`  SET `Stand_in_employee` = '".$standID."',`Start_day` = '$start', `leave_days_no` = '$days',`End_day` = DATE_ADD( '".$start."', INTERVAL ".$days." DAY ) WHERE `id` = '".$ID."'") or die(mysqli_error($connection));
}
elseif ($where == 'stock_automation') {
  $stock = $_POST['stock'];
  $unit = $_POST['unit'];
  $contains = $_POST['contains'];
  $subunit = $_POST['subunit'];
   $replenish = $_POST['replenish'];
  $restock = $_POST['restock'];
$result2 = mysqli_query($connection,"SELECT stock.id as id,inventory_units.name as current_unit from stock  inner join inventory_units ON stock.Unit_id = inventory_units.id WHERE stock.Name = '$stock' ")or die($connection->error);
$row2 = mysqli_fetch_array($result2);
$ID = $row2['id'];
$current_unit = $row2['current_unit'];
$result = mysqli_query($connection,"SELECT Name FROM inventory_units WHERE inventory_units.id = '$unit' ")or die($connection->error);
$row = mysqli_fetch_array($result);
$new_unit = $row['Name'];
$new_name = str_replace($current_unit,$new_unit,$stock);
mysqli_query($connection,"UPDATE `stock`  SET `Name` = '$new_name',`Unit_id` =  '".$unit."',`Contains` = '$contains', `Subunit_id` = '$subunit',`subunit_replenish_qty` = '$replenish',`Restock_Level` = '$restock' WHERE `id` = '".$ID."'") or die(mysqli_error($connection));
echo "success";
}
elseif ($where == 'inventory_units') {
  $id = $_POST['id'];
    $unit = $_POST['name'];
     $stock_names = mysqli_query($connection,"SELECT s.id as stock_id,s.Name as initial_name, u.Name as initial_unit FROM stock s INNER JOIN inventory_units u ON s.Unit_id = u.id WHERE u.id = '$id'")or die($connection->error);
     foreach($stock_names as $row){
       $initial_name = $row['initial_name'];
        $initial_unit = $row['initial_unit'];
        $stock_id = $row['stock_id'];
        $new_name = str_replace($initial_unit,$unit,$initial_name);
        mysqli_query($connection,"UPDATE `stock` SET `Name` = '".$new_name."' WHERE `id` = '".$stock_id."'")or die($connection->error);
     }
mysqli_query($connection,"UPDATE `inventory_units` SET `Name` = '".$unit."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif ($where == 'customerProfile') {
  if (isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['location'])) {
    $data = [
      'secret' => $private_key,
      'response' => $_POST['token'],
          'remoteip' => $iptocheck
    ];
    $options = array(
      'http' => array(
       'header' => "Content-type: application/x-www-form-urlencoded\r\n",
           'method' => 'POST',
           'content' => http_build_query($data)
       )
    );
    $context = stream_context_create($options);
    $response = file_get_contents($token_verification_site, false, $context);
    $res = json_decode($response, true);
    if ($res['success'] == true && $res['score'] >= 0.5) {
  $fullname = $_POST['firstname'].' '.$_POST['lastname'];
$result2 = mysqli_query($connection,"SELECT email,number FROM users where email = '".$_POST['old_email']."'")or die($connection->error);
$row2 = mysqli_fetch_array($result2);
$result3 = mysqli_query($connection,"SELECT EXISTS(SELECT email,number from users  WHERE email = '".$_POST['email']."' OR number = '".$_POST['mobile']."')")or die($connection->error);
$row3 = mysqli_fetch_array($result3);
if ($row3[0] == 1 && $_POST['mobile'] !== $row2['number'] && $_POST['email'] !== $row2['email']) {
    echo "exists";
}
else{
mysqli_query($connection,"UPDATE `customers`  SET `Name` = '".$fullname."',`Number` = '".$_POST['mobile']."', `Location` = '".$_POST['location']."' WHERE `Number` = '".$row2['number']."'") or die(mysqli_error($connection));
mysqli_query($connection,"UPDATE `users`  SET `firstname` = '".$_POST['firstname']."',`lastname` = '".$_POST['lastname']."', `email` = '".$_POST['email']."',`number` = '".$_POST['mobile']."' WHERE `number` = '".$row2['number']."'") or die(mysqli_error($connection));
echo "success";
unset($_SESSION['user']);
unset($_SESSION['email']);
$_SESSION['user'] = $_POST['firstname'];
$_SESSION['email'] = $_POST['email'];
}
}
else{
  echo "error";
} 
}
}
elseif ($where == 'process_order') {
  $id = $_POST['id'];
  $value = $_POST['value'];
  $action = $_POST['action'];
  $status = '';
  if($action == 'Processed' && $value == '1')
  {
     $status = 'Processed';
  }
  elseif($action == 'Processed' && $value == '0')
  {
     $status = 'Pending';
  }
  elseif($action == 'Shipped' && $value == '1')
  {
    $status = 'Shipped';
 }
 elseif($action == 'Shipped' && $value == '0')
  {
    $status = 'Processed';
 }
 elseif($action == 'Delivered' && $value == '1')
 {
    $status = 'Delivered';
 }
 elseif($action == 'Delivered' && $value == '0')
 {
     $status = 'Shipped';
 }
mysqli_query($connection,"UPDATE `order_status` SET status = '".$status."' WHERE id = '".$id."'")or die($connection->error);
}
 ?>
