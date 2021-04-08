<?php
require '../config.php';
$refresh_page = '';
if($redirect_link != $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/product-list.php')
    {
      $refresh_page = $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/product-list.php';
    }
elseif($redirect_link != $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/index.php') 
    {
        $refresh_page = $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/index.php';
    }   
if(isset($_GET['action']))
{
    if($_GET['action'] == 'add_wishlist')
    {
        $product_id = $_GET['id'];
        $product = mysqli_query($connection,"SELECT s.id AS id,s.Name as Name,image,i_u.Name as unit_name,s.Discount as Discount, sf.Selling_price as Price,c.Category_Name as Category_Name,s.Quantity as Quantity FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id JOIN inventory_units i_u ON s.Unit_id = i_u.id JOIN category c ON s.Category_id=c.id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at WHERE id = '$id';")or die($connection->error);
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

        $item_array = array(
            'item_id' => $product_id,
            'item_name' => $name,
            'item_unit' => $unit_name,
            'item_discount' => $discount,
            'item_price' => $selling_price,
            'item_image' => $image,
            'item_quantity' => $quantity,
            'item_restock' => $restock_level
        );
    $wishlist_data[] = $item_array;
    $item_data = json_encode($wishlist_data);
    setcookie('shopping_wishlist', $item_data, $wishlist_expiry);
    header('location:'.$refresh_page.'?success=1');
    }
}
?>