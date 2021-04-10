<?php
require '../config.php';
$refresh_page = '';
$products_page = 'product-list.php';
$wishlist_page = 'wishlist.php'; 
if (strpos($redirect_link, $home_url) == TRUE) {
    $refresh_page = $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/index.php';
}
elseif (strpos($redirect_link, $products_page) == TRUE){
    $refresh_page = $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/product-list.php';
} 
elseif (strpos($redirect_link, $wishlist_page) == TRUE){
    $refresh_page = $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/wishlist.php';
} 
if(isset($_GET['action']))
{
    if($_GET['action'] == 'add_wishlist')
    {
        $product_id = $_GET['id'];
        $product = mysqli_query($connection,"SELECT s.id AS id,s.Name as Name,image,i_u.Name as unit_name,s.Discount as Discount, sf.Selling_price as Price,c.Category_Name as Category_Name,s.Quantity as Quantity FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id JOIN inventory_units i_u ON s.Unit_id = i_u.id JOIN category c ON s.Category_id=c.id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at WHERE s.id = '$product_id';")or die($connection->error);
        $row = mysqli_fetch_array($product);
        $category = $row['Category_Name'];
        $name = $row['Name'];
        $image = $row['image'];
        $selling_price = $row['Price'];
        $discount = $row['Discount'];
        $discounted_price = $selling_price - $discount;
        $quantity = $row['Quantity'];
        $unit_name = $row['unit_name'];
        $restock_level = $row['Restock_Level'];
        if(isset($_COOKIE["shopping_wishlist"]))
        {
            $cookie_data = stripslashes($_COOKIE['shopping_wishlist']);
            $wishlist_data = json_decode($cookie_data, true);
        }
        else{
            $wishlist_data = array();
        }
    $item_id_list = array_column($wishlist_data, 'item_id');
    if(in_array($product_id, $item_id_list))
    {
  
    }
    else{
        $item_array = array(
            'item_id' => $product_id,
            'item_name' => $name,
            'item_unit' => $unit_name,
            'item_discount' => $discount,
            'item_category' => $category,
            'item_price' => $selling_price,
            'item_image' => $image,
            'item_quantity' => $quantity,
            'item_restock' => $restock_level
        );
        $wishlist_data[] = $item_array;
    } 
    $item_data = json_encode($wishlist_data);
    setcookie('shopping_wishlist', $item_data, $wishlist_expiry);
    header('location:'.$refresh_page.'?wishlist-success=1');
    }

    if($_GET['action'] == 'wishlist_delete')
    {
        $wishlist_data = stripslashes($_COOKIE['shopping_wishlist']);
        $wishlist_data = json_decode($wishlist_data, true);
        foreach($wishlist_data as $keys => $values)
        {
            if($wishlist_data[$keys]['item_id'] == $_GET['id'])
            {
                unset($wishlist_data[$keys]);
                $item_data = json_encode($wishlist_data);
                setcookie('shopping_wishlist', $item_data, $wishlist_expiry);
                header('location:'.$refresh_page.'?wishlist-remove=1');
            }
        }
    }
    if($_GET['action'] == 'wishlist-clear')
    {
        setcookie('shopping_wishlist', '', $wishlist_expiry);
        header('location:'.$refresh_page.'?wishlist-clear=1');
    }
    if($_GET['action'] == 'wishlist-cart-all')
    {
        $wishlist_data = stripslashes($_COOKIE['shopping_wishlist']);
        $wishlist_data = json_decode($wishlist_data, true);
        if(isset($_COOKIE["shopping_cart"]))
        {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $cart_data = json_decode($cookie_data, true);
        }
        else{
            $cart_data = array();
        }
        $wishlist_data = stripslashes($_COOKIE['shopping_wishlist']);
        $wishlist_data = json_decode($wishlist_data, true);
        foreach($wishlist_data as $keys => $values)
        {
            $item_id_list = array_column($cart_data, 'item_id');
            if(in_array($values["item_id"], $item_id_list))
            {
                

            }
            else{
                $item_array = array(
                    'item_id' => $values["item_id"],
                    'item_name' => $values["item_name"],
                    'item_unit' => $values["item_unit"],
                    'item_discount' => $values["item_discount"],
                    'item_price' => $values["item_price"],
                    'item_image' => $values["item_image"],
                    'item_quantity' => '1'
                );
                $cart_data[] = $item_array;
            } 
        }
        $item_data = json_encode($cart_data);
        setcookie('shopping_cart', $item_data, $cart_expiry);
        setcookie('shopping_wishlist', '', $wishlist_expiry);
        header('location:'.$refresh_page.'?wishlist-to-cart=1');
    }
    if($_GET['action'] == 'wishlist_cart')
    {
        $wishlist_data = stripslashes($_COOKIE['shopping_wishlist']);
        $wishlist_data = json_decode($wishlist_data, true);
        foreach($wishlist_data as $keys => $values)
        {
            if($wishlist_data[$keys]['item_id'] == $_GET['id'])
            {
                unset($wishlist_data[$keys]);
                $item_data = json_encode($wishlist_data);
                setcookie('shopping_wishlist', $item_data, $wishlist_expiry);
                header('location:'.$refresh_page.'?wishlist-remove=1');
            }
        }
    }
}
if(isset($_GET["wishlist-success"])){
    $message = '
    <div class="alert alert-dismissible" style="background-color: #59b828; color:white;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Item Added into Wishlist
    </div>    
    ';
}
if(isset($_GET["wishlist-remove"])){
    $message = '
    <div class="alert alert-dismissible" style="background-color: #59b828; color:white;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Item Removed from Wishlist
    </div>    
    ';
}
if(isset($_GET["wishlist-clear"])){
    $message = '
    <div class="alert alert-dismissible" style="background-color: #59b828; color:white;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       Your Wishlist was Successfully Cleared
    </div>    
    ';
}
if(isset($_GET["wishlist-to-cart"])){
    $message = '
    <div class="alert alert-dismissible" style="background-color: #59b828;color:white;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       Your Wishlist was Successfully transferred to your Cart
    </div>    
    ';
}
?>