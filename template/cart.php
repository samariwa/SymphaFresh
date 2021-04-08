<?php
require('../config.php');
$message = '';
$refresh_page = '';
if($redirect_link != $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/product-list.php')
    {
      $refresh_page = $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/product-list.php';
    }
elseif($redirect_link != $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/index.php') 
    {
        $refresh_page = $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/index.php';
    }   
if(isset($_POST['cart_button'])){
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
    header('location:'.$refresh_page.'?success=1');
}



if(isset($_POST['where'])){
$where = $_POST['where'];
if($where == 'cart_increase' )
{
    $id = $_POST['id'];
    $qty = $_POST['qty'];
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values)
        {
            if($cart_data[$keys]["item_id"] == $id)
            {
            $result = mysqli_query($connection,"SELECT s.Quantity as quantity FROM stock s WHERE s.id = '$id';")or die($connection->error);
            $row = mysqli_fetch_array($result);
            $Qty = $row['quantity'];
                if($cart_data[$keys]['item_quantity'] == $Qty)
                {
                    $cart_data[$keys]['item_quantity'] = $Qty;
                    echo "max";
                }
                else
                {
                    $cart_data[$keys]['item_quantity'] = $qty;
                }
                $item_data = json_encode($cart_data);
                setcookie('shopping_cart', $item_data, $cart_expiry);
            }
        }
}
elseif($where == 'cart_decrease' )
{
    $id = $_POST['id'];
    $qty = $_POST['qty'];
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values)
        {
            if($cart_data[$keys]["item_id"] == $id)
            {
                if($cart_data[$keys]['item_quantity'] == 1)
                {
                    $cart_data[$keys]['item_quantity'] = 1;
                }
                else
                {
                    $cart_data[$keys]['item_quantity'] = $qty;
                }
                $item_data = json_encode($cart_data);
                setcookie('shopping_cart', $item_data, $cart_expiry);
            }
        }
}
}
if(isset($_GET['action']))
{
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
if(isset($_GET["success"])){
    $message = '
    <div class="alert alert-dismissible" style="background-color: #59b828;color="white;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Item Added into Cart
    </div>    
    ';
}
if(isset($_GET["remove"])){
    $message = '
    <div class="alert alert-dismissible" style="background-color: #59b828;color="white;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Item Successfully Removed
    </div>    
    ';
}
if(isset($_GET["clear"])){
    $message = '
    <div class="alert alert-dismissible" style="background-color: #59b828;color="white;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Your Cart was Successfully Cleared
    </div>    
    ';
}
?>