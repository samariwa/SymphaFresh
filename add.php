<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require('config.php');
require_once "functions.php";
$where =$_POST['where'];
session_start();
if($where == 'customer' )
{
   $name = $_POST['name'];
   $location = $_POST['location'];
   $number = $_POST['number'];
   #$deliverer = $_POST['deliverer'];
   $row = mysqli_query($connection,"SELECT id,Name,Location,Number,Status,Note FROM customers WHERE Name = '".$name."' OR Number = '".$number."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
    echo "exists";
   }
   else{
     echo "success";
    mysqli_query($connection,"INSERT INTO `customers` (`Name`,`Location`,`Number`) VALUES ('$name','$location','$number')") or die(mysqli_error($connection));
   }
}
elseif($where == 'stock'){
       $unit = $_POST['unit'];
       $result2 = mysqli_query($connection,"SELECT Name FROM inventory_units WHERE id = '".$unit."';")or die($connection->error);
       $row2 = mysqli_fetch_array($result2);
       $unit_name = $row2['Name'];
       $raw_name = $_POST['name'];
       $raw_name2 = str_replace('  ',' ',$raw_name);
       $raw_name3 = ltrim($raw_name2,' ');
       $raw_name4 = rtrim($raw_name3,' ');
       $name = $raw_name4.' '.$unit_name;
       $category = $_POST['category'];
       $supplier = $_POST['supplier'];
       $received = $_POST['received'];
       $expiry = $_POST['expiry'];
       $fileName = $_FILES['upload']['name'];
       $path = time().'.png';
       move_uploaded_file($_FILES['upload']['tmp_name'], 'assets/images/products/'.$path);
       $bp = $_POST['bp'];
       $sp = $_POST['sp'];
       $qty = $_POST['qty'];
       $contains = $_POST['contains'];
       $subunit = $_POST['subunit'];
       $replenish = '';
       if(isset($_POST['replenish']))
       {
       $replenish = $_POST['replenish'];
       }
       else{
         $replenish = '0';
       }
       $restock = $_POST['restock'];
       $row = mysqli_query($connection,"SELECT `Name` FROM stock WHERE Name = '".$name."'")or die($connection->error);
       $result = mysqli_fetch_array($row);
       if ( $result == TRUE) {
         echo "exists";
       }
       else{
         echo "success";
          mysqli_query($connection,"INSERT INTO `stock` (`Category_id`,`Supplier_id`,`Name`,`Unit_id`,`Subunit_id`,`Contains`,`subunit_replenish_qty`,`Restock_Level`,`Buying_price`,`Price`,`Quantity`,`Opening_stock`,`image`) VALUES ('$category','$supplier','$name','$unit','$subunit','$contains','$replenish','$restock','$bp','$sp','$qty','$qty','$path');") or die(mysqli_error($connection));
        $result1 = mysqli_query($connection,"SELECT * FROM stock WHERE Name = '".$name."';")or die($connection->error);
       $row1 = mysqli_fetch_array($result1);
       $Stock_id = $row1['id'];
        mysqli_query($connection,"INSERT INTO `stock_flow` (`Stock_id`,`Expiry_date`,`Buying_price`,`Selling_Price`,`Received_date`,`Purchased`) VALUES ('$Stock_id','$expiry','$bp','$sp','$received','$qty')") or die(mysqli_error($connection));
       }

}
else if ($where == 'categories') {
   $category = $_POST['category'];
   $row = mysqli_query($connection,"SELECT * FROM category WHERE Category_Name = '".$category."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
     echo "exists";
   }
   else{
    echo "success";
    mysqli_query($connection,"INSERT INTO `category` (`Category_Name`) VALUES ('$category')") or die(mysqli_error($connection));
   }
}
else if ($where == 'faq') {
  $question = $_POST['question'];
  $answer = $_POST['answer'];
  $row = mysqli_query($connection,"SELECT * FROM faqs WHERE question = '".$question."'")or die($connection->error);
  $result = mysqli_fetch_array($row);
  if ( $result == TRUE) {
    echo "exists";
  }
  else{
   echo "success";
   mysqli_query($connection,"INSERT INTO `faqs` (`question`,`answer`) VALUES ('$question','$answer')") or die(mysqli_error($connection));
  }
}
else if ($where == 'blog') {
  $title = $_POST['title'];
  $blog = $_POST['blog_text'];
  $fileName = $_FILES['upload']['tmp_name'];
  $sourceProperties = getimagesize($fileName);
  $resizeFileName = time();
  $uploadPath = 'assets/images/blog/'; 
  $fileExt = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
  $path = $resizeFileName.'.'.$fileExt;
  $fullPath = $uploadPath.$path;
  $imageProcess = '';
  $uploadImageType = $sourceProperties[2];
  $sourceImageWidth = $sourceProperties[0];
  $sourceImageHeight = $sourceProperties[1];
  switch ($uploadImageType){
    case IMAGETYPE_JPEG:
      $resourceType = imagecreatefromjpeg($fileName);
      $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
      imagejpeg($imageLayer,$fullPath);
      $imageProcess = 1;
      break;
    case IMAGETYPE_GIF:
      $resourceType = imagecreatefromgif($fileName);
      $imageLayer =  resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight);
      imagegif($imageLayer,$fullPath);
      $imageProcess = 1;
      break;
    case IMAGETYPE_PNG:
      $resourceType = imagecreatefrompng($fileName);
      $imageLayer =  resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight);
      imagepng($imageLayer,$fullPath);
      $imageProcess = 1;
      break;

    default:
    $imageProcess = 0;
    break;  
  }
  
  if($imageProcess == 1)
  {
    move_uploaded_file($file, $fullPath);
  $row = mysqli_query($connection,"SELECT * FROM blogs WHERE blog = '".$blog."'")or die($connection->error);
  $result = mysqli_fetch_array($row);
  if ( $result == TRUE) {
    echo "exists";
  }
  else{
   echo "success";
   mysqli_query($connection,"INSERT INTO `blogs` (`title`,`blog`,`image`) VALUES ('$title','$blog','$path')") or die(mysqli_error($connection));
  }
  } 
}
else if ($where == 'units') {
   $unit = $_POST['unit'];
   $row = mysqli_query($connection,"SELECT * FROM inventory_units WHERE Name = '".$unit."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
     echo "exists";
   }
   else{
    echo "success";
    mysqli_query($connection,"INSERT INTO `inventory_units` (`Name`) VALUES ('$unit')") or die(mysqli_error($connection));
   }
} 

else if ($where == 'supplier') {
   $name = $_POST['name'];
   $contact = $_POST['contact'];
   $row = mysqli_query($connection,"SELECT * FROM suppliers WHERE Name = '".$name."' OR Supplier_contact = '".$contact."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
     echo "exists";
   }
   else{
    echo "success";
    mysqli_query($connection,"INSERT INTO `suppliers` (`Name`,`Supplier_contact`) VALUES ('$name','$contact')") or die(mysqli_error($connection));
   }
}
else if ($where == 'vehicles') {
   $type = $_POST['type'];
   $driver = $_POST['driver'];
   $reg = $_POST['reg'];
   $route = $_POST['route'];
   $row0 = mysqli_query($connection,"SELECT `id` FROM users WHERE firstname = '".$driver."'")or die($connection->error);
   $result0 = mysqli_fetch_array($row0);
   $id = $result0['id'];
   $row = mysqli_query($connection,"SELECT * FROM vehicles WHERE Reg_Number = '".$reg."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
     echo "exists";
   }
   else{
     echo "success";
    mysqli_query($connection,"INSERT INTO `vehicles` (`Driver_id`,`Type`,`Reg_Number`,`Route`) VALUES ('$id','$type','$reg','$route')") or die(mysqli_error($connection));
   }
}
else if ($where == 'deliverer') {
     $fname = $_POST['fname'];
     $lname = $_POST['lname'];
     $contact = $_POST['contact'];
     $staffId = $_POST['staffId'];
     $nationalId = $_POST['nationalId'];
     $yob = $_POST['yob'];
     $gender = $_POST['gender'];
     $salary = $_POST['salary'];
     $role = '5';
     $row = mysqli_query($connection,"SELECT * FROM users WHERE nationalID = '".$nationalId."' or staffID = '".$staffId."'")or die($connection->error);
     $result = mysqli_fetch_array($row);
     if ( $result == TRUE) {
       echo "exists";
     }
     else{
      echo "success";
      mysqli_query($connection,"INSERT INTO `users` (`firstname`,`lastname`,`number`,`Job_Id`,`staffID`,`nationalID`,`yob`,`gender`,`salary`) VALUES ('$fname','$lname','$contact','$role','$staffId','$nationalId','$yob','$gender','$salary')") or die(mysqli_error($connection));
     }
}
else if ($where == 'cook') {
     $fname = $_POST['fname'];
     $lname = $_POST['lname'];
     $contact = $_POST['contact'];
     $staffId = $_POST['staffId'];
     $nationalId = $_POST['nationalId'];
     $yob = $_POST['yob'];
     $gender = $_POST['gender'];
     $salary = $_POST['salary'];
     $role = '6';
     $row = mysqli_query($connection,"SELECT * FROM users WHERE nationalID = '".$nationalId."' or staffID = '".$staffId."'")or die($connection->error);
     $result = mysqli_fetch_array($row);
     if ( $result == TRUE) {
       echo "exists";
     }
     else{
      echo "success";
      mysqli_query($connection,"INSERT INTO `users` (`firstname`,`lastname`,`number`,`Job_Id`,`staffID`,`nationalID`,`yob`,`gender`,`salary`) VALUES ('$fname','$lname','$contact','$role','$staffId','$nationalId','$yob','$gender','$salary')") or die(mysqli_error($connection));
     }
}
else if ($where == 'cleaner') {
     $fname = $_POST['fname'];
     $lname = $_POST['lname'];
     $contact = $_POST['contact'];
     $staffId = $_POST['staffId'];
     $nationalId = $_POST['nationalId'];
     $yob = $_POST['yob'];
     $gender = $_POST['gender'];
     $salary = $_POST['salary'];
     $role = '8';
     $row = mysqli_query($connection,"SELECT * FROM users WHERE nationalID = '".$nationalId."' or staffID = '".$staffId."'")or die($connection->error);
     $result = mysqli_fetch_array($row);
     if ( $result == TRUE) {
       echo "exists";
     }
     else{
      echo "success";
      mysqli_query($connection,"INSERT INTO `users` (`firstname`,`lastname`,`number`,`Job_Id`,`staffID`,`nationalID`,`yob`,`gender`,`salary`) VALUES ('$fname','$lname','$contact','$role','$staffId','$nationalId','$yob','$gender','$salary')") or die(mysqli_error($connection));
     }
}
else if ($where == 'office') {
     $fname = $_POST['fname'];
     $lname = $_POST['lname'];
     $contact = $_POST['contact'];
     $staffId = $_POST['staffId'];
     $nationalId = $_POST['nationalId'];
     $yob = $_POST['yob'];
     $gender = $_POST['gender'];
     $salary = $_POST['salary'];
     $roleNo = $_POST['role'];
     $row = mysqli_query($connection,"SELECT * FROM users WHERE nationalID = '".$nationalId."' or staffID = '".$staffId."'")or die($connection->error);
     $result = mysqli_fetch_array($row);
     if ( $result == TRUE) {
       echo "exists";
     }
     else{
      echo "success";
      $row0 = mysqli_query($connection,"SELECT `id` FROM jobs WHERE Name = '".$roleNo."'")or die($connection->error);
     $result0 = mysqli_fetch_array($row0);
     $id = $result0['id'];
      mysqli_query($connection,"INSERT INTO `users` (`firstname`,`lastname`,`number`,`Job_Id`,`staffID`,`nationalID`,`yob`,`gender`,`salary`) VALUES ('$fname','$lname','$contact','$id','$staffId','$nationalId','$yob','$gender','$salary')") or die(mysqli_error($connection));
     }
}
else if ($where == 'note') {
     $title = $_POST['title'];
     $message = $_POST['message'];
     $access = $_POST['access'];
     $user = $_SESSION['user'];
      echo "success";
     $row = mysqli_query($connection,"SELECT id FROM users WHERE username = '".$user."'")or die($connection->error);
     $result = mysqli_fetch_array($row);
     $id = $result['id'];
      mysqli_query($connection,"INSERT INTO `notes` (`User_id`,`Title`,`Note`,`Public`) VALUES ('$id','$title','$message','$access')") or die(mysqli_error($connection));
}
elseif ($where == 'purchase') {
  $id = $_POST['id'];
    $received = $_POST['received'];
     $qty = $_POST['qty'];
     $bp = $_POST['bp'];
     $sp = $_POST['sp'];
     $expiry = $_POST['expiry'];
     mysqli_query($connection,"INSERT INTO `stock_flow` (`Stock_id`,`Buying_price`,`Selling_Price`,`Received_date`,`Purchased`,`Expiry_date`) VALUES ('$id','$bp','$sp','$received','$qty','$expiry')") or die(mysqli_error($connection));
mysqli_query($connection,"UPDATE `stock` SET `Quantity` = Quantity + '".$qty."',Buying_price = '".$bp."',Price = '".$sp."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif ($where == 'calendar') {
  if(isset($_POST["title"]))
{
  $title = $_POST["title"];
  $start_event = $_POST["start"];
  $end_event = $_POST["end"];
  $user = $_SESSION['user'];
   $userId = mysqli_query($connection,"SELECT id  FROM `users` WHERE username = '$user'")or die($connection->error);
   $value = mysqli_fetch_array($userId);
   $userID = $value['id'];
  mysqli_query($connection,"INSERT INTO event (title,User_id, start_event, end_event) VALUES ('$title','$userID', '$start_event', '$end_event')") or die(mysqli_error($connection));
}
}
elseif ($where == 'expense') {
  $name = $_POST['heading'];
    $party = $_POST['party'];
    $particular = $_POST['particular'];
     $total = $_POST['total'];
     $paid = $_POST['paid'];
     $due = $total - $paid;
     $date = $_POST['date'];
     $expenseId = mysqli_query($connection,"SELECT id  FROM `expenses` WHERE Name = '$name'")or die($connection->error);
   $value = mysqli_fetch_array($expenseId);
   $id = $value['id'];
   echo "success";
     mysqli_query($connection,"INSERT INTO `expense_details` (`Expense_id`,`Expense_particular`,`Party`,`Total_amount`,`Paid_amount`,`Due_amount`,`Payment_date`) VALUES ('$id','$particular','$party','$total','$paid','$due','$date')") or die(mysqli_error($connection));
}
elseif ($where == 'expenseHeading') {
  $name = $_POST['heading'];
  echo "success";
     mysqli_query($connection,"INSERT INTO `expenses` (`Name`) VALUES ('$name')") or die(mysqli_error($connection));
}
elseif ($where=='order') {
  $balance = "";
  $category="";
  $price = $_POST['price'];
  $discount = $_POST['discount'];
  $quantity = $_POST['quantity'];
  $customer = '1';
  $customerType = 'walk_in';
  $newCustomer = $_POST['newCustomer'];
  if($_POST['customer'] != 'N/A')
  {
    $customer = $_POST['customer'];
    $newCustomer = 'N/A';
    $customerType = 'online';
  }
  $stockIDx = $_POST['stockid'];
  $lateOrder = $_POST['lateOrder'];
  $cost = $price - $discount;
  $resx = mysqli_query($connection, "SELECT Category_id,Quantity FROM `stock` WHERE id='$stockIDx'");
  while ($rowx = mysqli_fetch_array($resx)) {
    $category = $rowx['Category_id'];
    $qty = $rowx['Quantity'];
  }
  if($qty < $quantity){
     echo 'unavailable';
     exit();
  }
  $result  = mysqli_query($connection, "SELECT Balance FROM `orders` WHERE Customer_id='$customer' ORDER BY id DESC");
  $count = 0;
  while($row = mysqli_fetch_array($result)) {
    if ($count==0) {
      $balance = $row['Balance'];
    }
      $count++;
  }
  $newDebt = $balance;
  $newBalance = (int)$newDebt - ((int)$cost*(int)$quantity);
  $sql = "INSERT INTO `orders`(`Customer_id`,`Category_id`,`Quantity`,`Debt`,`Discount`,`Balance`,`Stock_id`,`Delivery_time`,`Walk_in_name`,`Customer_type`) VALUES('$customer','$category','$quantity','$newDebt','$discount','$newBalance','$stockIDx','$lateOrder','$newCustomer','$customerType')";
  echo "success";
  $product = mysqli_query($connection,"SELECT Name,Category_Name  FROM `stock` inner join category on stock.Category_id = category.id WHERE stock.id = '".$stockIDx."'")or die($connection->error);
   $Product = mysqli_fetch_array($product);
  $Category_Name = $Product['Category_Name'];
  $Stock_Name = $Product['Name'];
  mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity - '".$quantity."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
  $Category = mysqli_query($connection,"SELECT Quantity,Unit_id,subunit_replenish_qty,Restock_Level,inventory_units.Name as Unit_name  FROM `stock` inner join inventory_units on stock.Unit_id = inventory_units.id WHERE stock.id = '".$stockIDx."'")or die($connection->error);
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
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '12' WHERE `id` = '".$stockIDx."'")or die($connection->error);
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
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '50' WHERE `id` = '".$stockIDx."'")or die($connection->error);
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
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '18' WHERE `id` = '".$stockIDx."'")or die($connection->error);
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
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '12' WHERE `id` = '".$stockIDx."'")or die($connection->error);
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
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '6' WHERE `id` = '".$stockIDx."'")or die($connection->error);
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
   if ($newBalance == 0 ) {
     mysqli_query($connection,"UPDATE `customers`  SET `Status` = 'clean' WHERE `id` = '".$customer."'")or die($connection->error);
   }
   else if ($newBalance < -100) {
     mysqli_query($connection,"UPDATE `customers`  SET `Status` = 'no delivery' WHERE `id` = '".$customer."'")or die($connection->error);
   }
   else if ($newBalance >= -100 && $newBalance < 0) {
     mysqli_query($connection,"UPDATE `customers`  SET `Status` = 'fined' WHERE `id` = '".$customer."'")or die($connection->error);
   }
   else if ($newBalance > 0) {
     mysqli_query($connection,"UPDATE `customers`  SET `Status` = 'credit' WHERE `id` = '".$customer."'")or die($connection->error);
   }
  if (mysqli_query($connection, $sql) === TRUE) {
    echo 'success';
  }
  
}
elseif ($where=='sales') {
  $balance = "";
  $category="";
  $price = $_POST['price'];
  $discount = $_POST['discount'];
  $quantity = $_POST['quantity'];
   $date = $_POST['salesDate'];
  $staffID = $_POST['seller'];
  $stockIDx = $_POST['stockid'];
  $cost = $price - $discount;
  $resx = mysqli_query($connection, "SELECT Category_id,Quantity FROM `stock` WHERE id='$stockIDx'");
  while ($rowx = mysqli_fetch_array($resx)) {
    $category = $rowx['Category_id'];
    $qty = $rowx['Quantity'];
  }
  if($qty < $quantity){
     echo 'unavailable';
     exit();
  }
  $result  = mysqli_query($connection, "SELECT Balance FROM `sales` WHERE Staff_id='$staffID' ORDER BY id DESC");
  $count = 0;
  while($row = mysqli_fetch_array($result)) {
    if ($count==0) {
      $balance = $row['Balance'];
    }
      $count++;
  }
  $newDebt = $balance;
  $newBalance = (int)$newDebt - ((int)$cost*(int)$quantity);
  $sql="INSERT INTO `sales`(`Staff_id`,`Category_id`,`Quantity`,`Debt`,`Discount`,`Sales_date`,`Balance`,`Stock_id`)VALUES('$staffID','$category','$quantity','$newDebt','$discount','$date','$newBalance','$stockIDx')";
  $product = mysqli_query($connection,"SELECT Name,Category_Name  FROM `stock` inner join category on stock.Category_id = category.id WHERE stock.id = '".$stockIDx."'")or die($connection->error);
   $Product = mysqli_fetch_array($product);
  $Category_Name = $Product['Category_Name'];
  $Stock_Name = $Product['Name'];
  mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity - '".$quantity."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
  $Category = mysqli_query($connection,"SELECT Quantity,Unit_id,subunit_replenish_qty,Restock_Level,inventory_units.Name as Unit_name  FROM `stock` inner join inventory_units on stock.Unit_id = inventory_units.id WHERE stock.id = '".$stockIDx."'")or die($connection->error);
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
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '12' WHERE `id` = '".$stockIDx."'")or die($connection->error);
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
   if ($bagQuantity <= 1) {
     $newBagQty = 0;
     $newPacketsIncreament = 50;
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '0' WHERE `Name` = '".$Bag_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$newPacketsIncreament."' WHERE `id` = '".$stockIDx."'")or die($connection->error);
   }else{
      $newBagQty = $bagQuantity - 1;
      mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = '$newBagQty' WHERE `Name` = '".$Bag_Name."'")or die($connection->error);
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '50' WHERE `id` = '".$stockIDx."'")or die($connection->error);
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
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '18' WHERE `id` = '".$stockIDx."'")or die($connection->error);
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
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '12' WHERE `id` = '".$stockIDx."'")or die($connection->error);
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
     mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '6' WHERE `id` = '".$stockIDx."'")or die($connection->error);
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
    }
   */ 
  if (mysqli_query($connection, $sql) === TRUE) {
    echo 'success';
  }
  
}
else if ($where == 'sickoff') {
   $employee = $_POST['employee'];
   $reason = $_POST['reason'];
   $start = $_POST['start'];
   $number = $_POST['number'];
    mysqli_query($connection,"INSERT INTO `employee_sickoff_data` (`Staff_id`,`Reason`,`Start_day`,`sickoff_days_no`,`End_day`) VALUES ('$employee','$reason','$start','$number',DATE_ADD( '".$start."', INTERVAL ".$number." DAY ))") or die(mysqli_error($connection));
     echo "success";
}
else if ($where == 'leave') {
   $employee = $_POST['employee'];
   $standIn = $_POST['standIn'];
   $start = $_POST['start'];
   $number = $_POST['number'];
   $exists = mysqli_query($connection,"SELECT * FROM employee_leave_data WHERE Staff_id = '".$employee."'")or die($connection->error);
   $result = mysqli_fetch_array($exists);
   if ( $result == FALSE) {
    $rem_days = 21 - $number;
     if($rem_days >= 0){
      if( $employee != $standIn)
      {
    mysqli_query($connection,"INSERT INTO `employee_leave_data` (`Staff_id`,`Stand_in_employee`,`Start_day`,`rem_leave_days`,`leave_days_no`,`End_day`) VALUES ('$employee','$standIn','$start','$rem_days','$number',DATE_ADD( '".$start."', INTERVAL ".$number." DAY ))") or die(mysqli_error($connection));
     echo "success";
     }
     else{
      echo "failed";
     }
     }
     else{
      echo "exceeded";
     }
   }
   else{
    $days_left= mysqli_query($connection,"SELECT rem_leave_days FROM employee_leave_data WHERE Staff_id = '".$employee."' ORDER BY Start_day DESC LIMIT 1")or die($connection->error);
    $days = mysqli_fetch_array($days_left);
     $rem = $days['rem_leave_days'];
     $new_rem = $rem - $number;
     if($new_rem >= 0){
      if( $employee != $standIn)
      {
    mysqli_query($connection,"INSERT INTO `employee_leave_data` (`Staff_id`,`Stand_in_employee`,`Start_day`,`rem_leave_days`,`leave_days_no`,`End_day`) VALUES ('$employee','$standIn','$start','$new_rem','$number',DATE_ADD( '".$start."', INTERVAL ".$number." DAY ))") or die(mysqli_error($connection));
       echo "success";
     }
     else{
      echo "failed";
     }
     }
     else{
      echo "exceeded";
     }
   }
}

elseif ($where == 'files') {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $upload = $_POST['upload'];
  $location = $_POST['location'];
  $owner = $_SESSION['user'];
  $owner_id= mysqli_query($connection,"SELECT staffID FROM users WHERE username = '".$owner."'")or die($connection->error);
    $uploader_id = mysqli_fetch_array($owner_id);
     $uploader = $uploader_id['staffID'];
      $exists= mysqli_query($connection,"SELECT *  FROM files WHERE file_name = '".$name."'")or die($connection->error);
      $exists_result = mysqli_fetch_array($exists);
       if ($exists_result == TRUE) {
       $exists_number = mysqli_query($connection,"SELECT COUNT(id) AS NumberOfFiles FROM files WHERE file_name = '".$name."'")or die($connection->error);
      $exists_value = mysqli_fetch_array($exists_number);
      $exists_count = $exists_value['NumberOfFiles'];
     $total_count = $exists_count + 1;
     $name = $name."(".$total_count.")";
     }
    $random = generateRandomString();
    $save = mysqli_query($connection,"INSERT INTO `files` (`folder_serial`,`file_serial`,`file_name`,`description`,`file_owner_id`) VALUES ('$location','$random','$name','$description','$uploader')") or die(mysqli_error($connection));
        $save = $this->db->query("INSERT INTO folders set ".$data);
        if($save){
         echo "success";
      }
}

elseif ($where == 'newsletter') {
  if (isset($_POST['email'])) {
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
	if ($res['success'] == 'true' && $res['score'] >= 0.5) {
  $row = mysqli_query($connection,"SELECT * FROM newsletter_subscribers WHERE email = '".$_POST['email']."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
     echo "exists";
   }
   else{
    echo "success";
    $registered = "";
    $row = mysqli_query($connection,"SELECT * FROM users WHERE email = '".$_POST['email']."'")or die($connection->error);
    $result = mysqli_fetch_array($row);
    if ( $result == TRUE) {
      $registered = "1";
    }
    else{
      $registered = "0";
    }
    mysqli_query($connection,"INSERT INTO `newsletter_subscribers` (`email`, `registered_user`) VALUES ('".$_POST['email']."','$registered')") or die(mysqli_error($connection));
   }
  }
}
else{
  echo "error";
} 
}
elseif ($where == 'site_contact') {
  $full_name = "";
  $number = "";
  $registered = "";
  if (isset($_POST['email']) && isset($_POST['message']) && isset($_POST['subject'])) {
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
	if ($res['success'] == 'true' && $res['score'] >= 0.5) {
  $row = mysqli_query($connection,"SELECT * FROM users WHERE email = '".$_POST['email']."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
     $registered = "1";
     $full_name = $result['firstname'].' '.$result['lastname'];
     $number = $result['number'];
   }
   else{ 
    $registered = "0";
    $full_name = $_POST['name'];
    $number = $_POST['number'];
   }
    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/Exception.php";
    require_once "PHPMailer/SMTP.php";
    $mail = new PHPMailer(true);
    $mail -> addAddress($authenticator_email,$organization);
    $mail -> setFrom($authenticator_email,$organization);
    $mail->IsSMTP();
    $mail->Host = $mail_host;
    // optional
    // used only when SMTP requires authentication  
    $mail->SMTPAuth = true;
    $mail->Username = $authenticator_email;
    $mail->Password = $authenticator_password;
    $mail -> Subject = $_POST['subject'];
    $mail -> isHTML(true);
    $mail -> Body = $_POST['message'].'<br><br>Customer Name: '.$full_name.'<br><br>Customer Number: '.$number.'<br><br>Customer Email: '.$_POST['email'];
    $mail -> send();
   mysqli_query($connection,"INSERT INTO `site_communication` (`name`, `email`, `number`,`subject`, `message`,`registered_user`) VALUES ('$full_name','".$_POST['email']."','$number','".$_POST["subject"]."','".$_POST["message"]."','$registered')") or die(mysqli_error($connection));
    echo "success";
  }
  else{
    echo "error";
  } 
}
}
elseif ($where == 'site_comment') {
  $name = "";
  $registered = "";
  if (isset($_POST['email']) && isset($_POST['comment'])) {
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
	if ($res['success'] == 'true' && $res['score'] >= 0.5) {
  $row = mysqli_query($connection,"SELECT * FROM users WHERE email = '".$_POST['email']."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
     $registered = "1";
     $name = $result['firstname'].' '.$result['lastname'];
   }
   else{ 
    $registered = "0";
    $name = $_POST['name'];
   }
   mysqli_query($connection,"INSERT INTO `comments` (`blog_id`,`commenter`, `registered`, `belongs_to`,`comment`) VALUES ('".$_POST['id']."','$name','$registered','blog','".$_POST['comment']."')") or die(mysqli_error($connection));
    echo "success";
  }
  else{
    echo "error";
  } 
}
}
elseif ($where == 'site_subcomment') {
  $name = "";
  $registered = "";
  if (isset($_POST['email']) && isset($_POST['subcomment'])) {
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
  $row = mysqli_query($connection,"SELECT * FROM users WHERE email = '".$_POST['email']."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
     $registered = "1";
     $name = $result['firstname'].' '.$result['lastname'];
   }
   else{ 
    $registered = "0";
    $name = $_POST['name'];
   }
   mysqli_query($connection,"INSERT INTO `comments` (`comment_id`,`commenter`, `registered`, `belongs_to`,`comment`) VALUES ('".$_POST['id']."','$name','$registered','comment','".$_POST['subcomment']."')") or die(mysqli_error($connection));
    echo "success";
  }
  else{
    echo "error";
  } 
}
}
elseif ($where == 'onlineOrder') {
  $location = $_POST['mode'];
  $payment = $_POST['payment'];
  $date = $_POST['date'];
  $customerType = 'online';
  $newCustomer = 'N/A';
  $status_id = generateRandomString();
  mysqli_query($connection,"INSERT INTO `order_status` (`id`,`status`) VALUES ('$status_id','Pending')")or die($connection->error);
  $cust_id = mysqli_query($connection,"SELECT id FROM customers WHERE User_id = '".$_POST['id']."'")or die($connection->error);
  $result = mysqli_fetch_array($cust_id);
  $customer_id = $result['id'];
  $cart_items = mysqli_query($connection,"SELECT * FROM cart WHERE Customer_id = '".$customer_id."'")or die($connection->error);
  foreach($cart_items as $row)
  {
    $product_id = $row['product_id'];
    $Quantity = $row['quantity'];
    $stockDetails = mysqli_query($connection,"SELECT s.Discount as Discount, sf.Selling_price as Price,c.id as Category,c.Category_Name as category_name,s.Name as stock_name,s.Quantity as Quantity FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id JOIN inventory_units i_u ON s.Unit_id = i_u.id JOIN category c ON s.Category_id=c.id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at WHERE s.id = '$product_id' ;")or die($connection->error);
    $result2 = mysqli_fetch_array($stockDetails);
    $discount = $result2['Discount'];
    $price = $result2['Price'];
    $discount = $result2['Discount'];
    $category = $result2['Category'];
    $stock_name = $result2['stock_name'];
    $category_name = $result2['category_name'];
    $quantity = $result2['Quantity'];
    $cost = $price - $discount;
    if($quantity < $Quantity){
      echo 'unavailable';
   }
   else{
   $result  = mysqli_query($connection, "SELECT Balance FROM `orders` WHERE Customer_id='$customer_id' ORDER BY id DESC");
   $count = 0;
   while($row = mysqli_fetch_array($result)) {
     if ($count==0) {
       $balance = $row['Balance'];
     }
       $count++;
   }
   $newDebt = $balance;
   $newBalance = (int)$newDebt - ((int)$cost*(int)$Quantity);
   $sql = "INSERT INTO `orders`(`Customer_id`,`Location`,`Category_id`,`Quantity`,`Debt`,`Discount`,`Balance`,`Stock_id`,`Delivery_time`,`Walk_in_name`,`Customer_type`,`Status_id`) VALUES('$customer_id','$location','$category','$Quantity','$newDebt','$discount','$newBalance','$product_id','$date','$newCustomer','$customerType','$status_id')";
   mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity - '".$Quantity."' WHERE `id` = '".$product_id."'")or die($connection->error);
   $Category = mysqli_query($connection,"SELECT Quantity,Unit_id,subunit_replenish_qty,Restock_Level,inventory_units.Name as Unit_name  FROM `stock` inner join inventory_units on stock.Unit_id = inventory_units.id WHERE stock.id = '".$product_id."'")or die($connection->error);
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
      mysqli_query($connection,"UPDATE `stock`  SET `Quantity` = Quantity + '".$subunit_replenish_qty."' WHERE `id` = '".$product_id."'")or die($connection->error);
   }
 }
 mysqli_query($connection,"Delete from `cart` where customer_id='".$customer_id."' AND product_id = '".$product_id."'")or die($connection->error);
 if ($newBalance == 0 ) {
  mysqli_query($connection,"UPDATE `customers`  SET `Status` = 'clean' WHERE `id` = '".$customer_id."'")or die($connection->error);
}
else if ($newBalance < -100) {
  mysqli_query($connection,"UPDATE `customers`  SET `Status` = 'no delivery' WHERE `id` = '".$customer_id."'")or die($connection->error);
}
else if ($newBalance >= -100 && $newBalance < 0) {
  mysqli_query($connection,"UPDATE `customers`  SET `Status` = 'fined' WHERE `id` = '".$customer_id."'")or die($connection->error);
}
else if ($newBalance > 0) {
  mysqli_query($connection,"UPDATE `customers`  SET `Status` = 'credit' WHERE `id` = '".$customer_id."'")or die($connection->error);
}
if (mysqli_query($connection, $sql) === TRUE) {
 echo 'success';
}
  }
  }
}
 ?>
