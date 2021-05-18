<?php
require('../config.php');
$message = '';
$refresh_page = '';
$products_page = 'product-list.php';
  
if (strpos($redirect_link, $home_url) == TRUE) {
    $refresh_page = $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/index.php';
}
elseif (strpos($redirect_link, $products_page) == TRUE){
    $refresh_page = $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/product-list.php';
}
    
if(isset($_POST['cart_button'])){
    if (isset($_SESSION['logged_in'])) {
        if ($_SESSION['logged_in'] == TRUE) {
            $customer = mysqli_query($connection,"SELECT customers.id as id FROM `customers` inner join users on customers.User_id = users.id WHERE users.email='".$_SESSION['email']."'");
            $customer_row = mysqli_fetch_array($customer);
            $cart_duplicate = mysqli_query($connection,"SELECT * FROM `cart` WHERE customer_id ='".$customer_row['id']."' AND product_id = '".$_POST['hidden_id']."'");
            $cart_duplicate_result = mysqli_fetch_array($cart_duplicate);
            if ( $cart_duplicate_result == FALSE) {
                mysqli_query($connection,"INSERT INTO `cart` (`customer_id`,`product_id`,`quantity`) VALUES ('".$customer_row['id']."','".$_POST['hidden_id']."','1')");
            } 
            else{
                mysqli_query($connection,"UPDATE `cart` SET `Quantity` = Quantity + '1' WHERE customer_id ='".$customer_row['id']."' AND product_id = '".$_POST['hidden_id']."'")or die($connection->error);
            }
            $item_in_wishlist = mysqli_query($connection,"SELECT * FROM `wishlist` WHERE customer_id ='".$customer_row['id']."' AND product_id = '".$_POST['hidden_id']."'");
            $item_in_wishlist_result = mysqli_fetch_array($item_in_wishlist);
            if ( $item_in_wishlist_result == TRUE) {
                mysqli_query($connection,"DELETE FROM `wishlist` WHERE customer_id ='".$customer_row['id']."' AND product_id = '".$_POST['hidden_id']."'");
            }
        }
        else{
            if(isset($_COOKIE["shopping_cart"]))
            {
                $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                $cart_data = json_decode($cookie_data, true);
            }
            else{
                $cart_data = array();
            }
            $item_id_list = array_column($cart_data, 'item_id');
            if(in_array($_POST['hidden_id'], $item_id_list))
            {
                foreach($cart_data as $keys => $values)
                {
                    if($cart_data[$keys]["item_id"] == $_POST['hidden_id'])
                    {
                        $cart_data[$keys]['item_quantity'] + 1;
                    }
                }
            }
            else{
                $item_array = array(
                    'item_id' => $_POST['hidden_id'],
                    'item_name' => $_POST['hidden_name'],
                    'item_unit' => $_POST['hidden_unit'],
                    'item_discount' => $_POST['hidden_discount'],
                    'item_price' => $_POST['hidden_price'],
                    'item_image' => $_POST['hidden_image'],
                    'item_quantity' => '1'
                );
                $cart_data[] = $item_array;
            } 
            $item_data = json_encode($cart_data);
            setcookie('shopping_cart', $item_data, $cart_expiry);
            if(isset($_COOKIE["shopping_wishlist"]))
            {
                $wishlist_data = stripslashes($_COOKIE['shopping_wishlist']);
                $wishlist_data = json_decode($wishlist_data, true);
                $item_id_wishlist = array_column($wishlist_data, 'item_id');
            if(in_array($_POST['hidden_id'], $item_id_wishlist))
            {
                foreach($wishlist_data as $keys => $values)
                {
                    if($wishlist_data[$keys]["item_id"] == $_POST['hidden_id'])
                    {
                        unset($wishlist_data[$keys]);
                        $wishlist_item_data = json_encode($wishlist_data);
                        setcookie('shopping_wishlist', $wishlist_item_data, $wishlist_expiry);
                    }
                }
            }
            }
        }
    }
    else{
        if(isset($_COOKIE["shopping_cart"]))
        {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $cart_data = json_decode($cookie_data, true);
        }
        else{
            $cart_data = array();
        }
        $item_id_list = array_column($cart_data, 'item_id');
        if(in_array($_POST['hidden_id'], $item_id_list))
        {
            foreach($cart_data as $keys => $values)
            {
                if($cart_data[$keys]["item_id"] == $_POST['hidden_id'])
                {
                    $cart_data[$keys]['item_quantity'] + 1;
                }
            }
        }
        else{
            $item_array = array(
                'item_id' => $_POST['hidden_id'],
                'item_name' => $_POST['hidden_name'],
                'item_unit' => $_POST['hidden_unit'],
                'item_discount' => $_POST['hidden_discount'],
                'item_price' => $_POST['hidden_price'],
                'item_image' => $_POST['hidden_image'],
                'item_quantity' => '1'
            );
            $cart_data[] = $item_array;
        } 
        $item_data = json_encode($cart_data);
        setcookie('shopping_cart', $item_data, $cart_expiry);
        if(isset($_COOKIE["shopping_wishlist"]))
        {
            $wishlist_data = stripslashes($_COOKIE['shopping_wishlist']);
            $wishlist_data = json_decode($wishlist_data, true);
            $item_id_wishlist = array_column($wishlist_data, 'item_id');
        if(in_array($_POST['hidden_id'], $item_id_wishlist))
        {
            foreach($wishlist_data as $keys => $values)
            {
                if($wishlist_data[$keys]["item_id"] == $_POST['hidden_id'])
                {
                    unset($wishlist_data[$keys]);
                    $wishlist_item_data = json_encode($wishlist_data);
                    setcookie('shopping_wishlist', $wishlist_item_data, $wishlist_expiry);
                }
            }
        }
        }
    }
   header('location:'.$refresh_page.'?success=1');
}



if(isset($_POST['where'])){
    if (isset($_SESSION['logged_in'])) {
        if ($_SESSION['logged_in'] == TRUE) {
            $customer = mysqli_query($connection,"SELECT customers.id as id FROM `customers` inner join users on customers.User_id = users.id WHERE users.email='".$_SESSION['email']."'");
            $customer_row = mysqli_fetch_array($customer);
            if($_POST['where'] == 'cart_increase')
            {
                $total = $_POST['total'];
                $result = mysqli_query($connection,"SELECT s.Discount as Discount,sf.Selling_price as Price,s.Quantity as Quantity FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at WHERE s.id = '".$_POST['id']."';")or die($connection->error);
                $row = mysqli_fetch_array($result);
                $Discount = $row['Discount'];
                $Price = $row['Price'];
                    if($_POST['qty'] == $row['Quantity'])
                    {
                        mysqli_query($connection,"UPDATE `cart` SET `Quantity` = '".$row['Quantity']."' WHERE customer_id ='".$customer_row['id']."' AND product_id = '".$_POST['id']."'")or die($connection->error);
                        echo "max";
                    }
                    else
                    {
                        mysqli_query($connection,"UPDATE `cart` SET `Quantity` = '".$_POST['qty']."' WHERE customer_id ='".$customer_row['id']."' AND product_id = '".$_POST['id']."'")or die($connection->error);
                        $net_subtotal = ($Price - $Discount) * $_POST['qty'];
                        $total += ($Price - $Discount);
                        $data = array(number_format($net_subtotal,2),number_format($total,2),$total,$_POST['qty']);
                        $array = json_encode($data);
                        echo $array;
                    }   
            }
            elseif($_POST['where'] == 'cart_decrease' )
            {
                $total = $_POST['total'];
                $result = mysqli_query($connection,"SELECT s.Discount as Discount,sf.Selling_price as Price FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at WHERE s.id = '".$_POST['id']."';")or die($connection->error);
                $row = mysqli_fetch_array($result);
                $Discount = $row['Discount'];
                $Price = $row['Price'];
                    if($row['qty'] == 1)
                    {
                        mysqli_query($connection,"UPDATE `cart` SET `Quantity` = '1' WHERE customer_id ='".$customer_row['id']."' AND product_id = '".$_POST['id']."'")or die($connection->error);
                    }
                    else
                    {
                        mysqli_query($connection,"UPDATE `cart` SET `Quantity` = '".$_POST['qty']."' WHERE customer_id ='".$customer_row['id']."' AND product_id = '".$_POST['id']."'")or die($connection->error);
                        $net_subtotal = ($Price - $Discount) * $_POST['qty'];
                        $total -= ($Price - $Discount);
                        $data = array(number_format($net_subtotal,2),number_format($total,2),$total,$_POST['qty']);
                        $array = json_encode($data);
                        echo $array;
                    }   
            }
        }
        else{
            if($_POST['where'] == 'cart_increase' )
            {
                $total = $_POST['total'];
                $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                $cart_data = json_decode($cookie_data, true);
                foreach($cart_data as $keys => $values)
                    {
                        if($cart_data[$keys]["item_id"] == $_POST['id'])
                        {
                        $result = mysqli_query($connection,"SELECT s.Quantity as quantity FROM stock s WHERE s.id = '".$_POST['id']."';")or die($connection->error);
                        $row = mysqli_fetch_array($result);
                            if($cart_data[$keys]['item_quantity'] == $row['quantity'])
                            {
                                $cart_data[$keys]['item_quantity'] = $row['quantity'];
                                echo "max";
                            }
                            else
                            {
                                $cart_data[$keys]['item_quantity'] = $_POST['qty'];
                                $net_subtotal = ($cart_data[$keys]['item_price'] - $cart_data[$keys]['item_discount']) * $cart_data[$keys]['item_quantity'];
                                $total += ($cart_data[$keys]['item_price'] - $cart_data[$keys]['item_discount']);
                                $data = array(number_format($net_subtotal,2),number_format($total,2),$total,$cart_data[$keys]['item_quantity']);
                                $array = json_encode($data);
                                echo $array;
                            }
                            $item_data = json_encode($cart_data);
                            setcookie('shopping_cart', $item_data, $cart_expiry);
                        }
                    }
            }
            elseif($_POST['where'] == 'cart_decrease' )
            {
                $total = $_POST['total'];
                $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                $cart_data = json_decode($cookie_data, true);
                foreach($cart_data as $keys => $values)
                    {
                        if($cart_data[$keys]["item_id"] == $_POST['id'])
                        {
                            if($cart_data[$keys]['item_quantity'] == 1)
                            {
                                $cart_data[$keys]['item_quantity'] = 1;
                            }
                            else
                            {
                                $cart_data[$keys]['item_quantity'] = $_POST['qty'];
                                $net_subtotal = ($cart_data[$keys]['item_price'] - $cart_data[$keys]['item_discount']) * $cart_data[$keys]['item_quantity'];
                                $total -= ($cart_data[$keys]['item_price'] - $cart_data[$keys]['item_discount']);
                                $data = array(number_format($net_subtotal,2),number_format($total,2),$total,$cart_data[$keys]['item_quantity']);
                                $array = json_encode($data);
                                echo $array;
                            }
                            $item_data = json_encode($cart_data);
                            setcookie('shopping_cart', $item_data, $cart_expiry);
                        }
                    }
            }
            
        
        }
    }
    else{
        if($_POST['where'] == 'cart_increase')
        {
            $total = $_POST['total'];
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $cart_data = json_decode($cookie_data, true);
            foreach($cart_data as $keys => $values)
                {
                    if($cart_data[$keys]["item_id"] == $_POST['id'])
                    {
                    $result = mysqli_query($connection,"SELECT s.Quantity as quantity FROM stock s WHERE s.id = '".$_POST['id']."';")or die($connection->error);
                    $row = mysqli_fetch_array($result);
                        if($cart_data[$keys]['item_quantity'] == $row['quantity'])
                        {
                            $cart_data[$keys]['item_quantity'] = $row['quantity'];
                            echo "max";
                        }
                        else
                        {
                            $cart_data[$keys]['item_quantity'] = $_POST['qty'];
                            $net_subtotal = ($cart_data[$keys]['item_price'] - $cart_data[$keys]['item_discount']) * $cart_data[$keys]['item_quantity'];
                            $total += ($cart_data[$keys]['item_price'] - $cart_data[$keys]['item_discount']);
                            $data = array(number_format($net_subtotal,2),number_format($total,2),$total,$cart_data[$keys]['item_quantity']);
                            $array = json_encode($data);
                            echo $array;
                        }
                        $item_data = json_encode($cart_data);
                        setcookie('shopping_cart', $item_data, $cart_expiry);
                    }
                }
        }
        elseif($_POST['where'] == 'cart_decrease' )
        {
            $total = $_POST['total'];
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $cart_data = json_decode($cookie_data, true);
            foreach($cart_data as $keys => $values)
                {
                    if($cart_data[$keys]["item_id"] == $_POST['id'])
                    {
                        if($cart_data[$keys]['item_quantity'] == 1)
                        {
                            $cart_data[$keys]['item_quantity'] = 1;
                        }
                        else
                        {
                            $cart_data[$keys]['item_quantity'] = $_POST['qty'];
                            $net_subtotal = ($cart_data[$keys]['item_price'] - $cart_data[$keys]['item_discount']) * $cart_data[$keys]['item_quantity'];
                            $total -= ($cart_data[$keys]['item_price'] - $cart_data[$keys]['item_discount']);
                            $data = array(number_format($net_subtotal,2),number_format($total,2),$total,$cart_data[$keys]['item_quantity']);
                            $array = json_encode($data);
                            echo $array;
                        }
                        $item_data = json_encode($cart_data);
                        setcookie('shopping_cart', $item_data, $cart_expiry);
                    }
                }
        }
        
    }

}



if(isset($_GET['action']))
{
    if (isset($_SESSION['logged_in'])) {
        if ($_SESSION['logged_in'] == TRUE) {
            $customer = mysqli_query($connection,"SELECT customers.id as id FROM `customers` inner join users on customers.User_id = users.id WHERE users.email='".$_SESSION['email']."'");
            $customer_row = mysqli_fetch_array($customer);
            if($_GET['action'] == 'delete')
            {
                $product_id = $_GET['id'];
                mysqli_query($connection,"DELETE FROM `cart` WHERE customer_id ='".$customer_row['id']."' AND product_id ='$product_id'");
                header('location:'.$refresh_page.'?remove=1');
            }
            if($_GET['action'] == 'clear')
            {
                mysqli_query($connection,"DELETE FROM `cart` WHERE customer_id ='".$customer_row['id']."'");
                header('location:'.$refresh_page.'?clear=1');
            }
        }
        else{
            if($_GET['action'] == 'delete')
            {
                $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                $cart_data = json_decode($cookie_data, true);
                foreach($cart_data as $keys => $values)
                {
                    if($cart_data[$keys]['item_id'] == $_GET['id'])
                    {
                        unset($cart_data[$keys]);
                        $item_data = json_encode($cart_data);
                        setcookie('shopping_cart', $item_data, $cart_expiry);
                        header('location:'.$refresh_page.'?remove=1');
                    }
                }
            }
            if($_GET['action'] == 'clear')
            {
                setcookie('shopping_cart', '', $cart_expiry);
                header('location:'.$refresh_page.'?clear=1');
            }
        }
    }
    else{
        if($_GET['action'] == 'delete')
        {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $cart_data = json_decode($cookie_data, true);
            foreach($cart_data as $keys => $values)
            {
                if($cart_data[$keys]['item_id'] == $_GET['id'])
                {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    setcookie('shopping_cart', $item_data, $cart_expiry);
                    header('location:'.$refresh_page.'?remove=1');
                }
            }
        }
        if($_GET['action'] == 'clear')
        {
            setcookie('shopping_cart', '', $cart_expiry);
            header('location:'.$refresh_page.'?clear=1');
        }
    }
    
}




if(isset($_GET["success"])){
    $message = '
    <div class="alert alert-dismissible" style="background-color: #59b828;color:white;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Item Added into Cart
    </div>    
    ';
}
if(isset($_GET["remove"])){
    $message = '
    <div class="alert alert-dismissible" style="background-color: #59b828;color:white;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Item Removed from Cart
    </div>    
    ';
}
if(isset($_GET["clear"])){
    $message = '
    <div class="alert alert-dismissible" style="background-color: #59b828;color:white;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Your Cart was Successfully Cleared
    </div>    
    ';
}
?>