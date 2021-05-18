<?php
require('config.php');
require_once "queries.php";
session_start();
if (isset($_SESSION['logged_in'])) {
    if ($_SESSION['logged_in'] == TRUE) {
        $customer = mysqli_query($connection,"SELECT customers.id as id FROM `customers` inner join users on customers.User_id = users.id WHERE users.email='".$_SESSION['email']."'");
        $customer_row = mysqli_fetch_array($customer);
    }
}
if( $_POST['where'] == 'filter' )
{
    $filterList = "SELECT s.id AS id,s.Name as Name,image,s.Category_id as cat_id,i_u.Name as unit_name,s.Discount as Discount, sf.Buying_price as Buying_price,sf.Selling_price as Price,c.Category_Name as Category_Name,s.Restock_Level as Restock_Level,s.Quantity as Quantity FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id JOIN inventory_units i_u ON s.Unit_id = i_u.id JOIN category c ON s.Category_id=c.id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at WHERE s.id > '0'";
    if(isset($_POST['minimum_price'],$_POST['minimum_price']))
    {
        $filterList .= "AND Price BETWEEN '".$_POST['minimum_price']."' AND '".$_POST['maximum_price']."'";
    }
    if(isset($_POST['category']))
    {
        $category_filter = implode("','", $_POST['category']);
        $filterList .= "AND s.Name IN ('".$category_filter."')";
    }
    $filterResult = mysqli_query($connection, $filterList)or die($connection->error);
    $filterrowcount = mysqli_num_rows($filterResult);
    $output = '';
    if($filterrowcount > 0)
    {
        foreach($filterResult as $row)
        {
            $output .= '
            <div class="col-sm-6 col-xl-4" id="'.$row['Name'].'">
            <div class="product-item ';
            if($row['Quantity'] < $row['Restock_Level'] ){ 
                $output .= ' stock-out  ';
             }
             $output .= '" id="'.$row['Name'].'">
                <div class="product-thumb">
                    <!--you can add this onclick to anchor tag below when necessary-->
                        <!--onclick="openModal()"-->
                    <a  class="modalOpen" id="'.$row['id'].'"><img src="../assets/images/products/'.$row['image'].'" alt="product"></a>
                    ';
                    if($row['Discount'] > 0){ 
                        $output .= '<span class="batch sale">Sale</span> ';
                    }  
                        $item_in_wishlist = '';
                        $item_in_wishlist_id = '';
                        if (isset($_SESSION["logged_in"])) {
                            //session set to true
                            if ($_SESSION["logged_in"] == TRUE) {
                        $product_in_wishlist = mysqli_query($connection,"SELECT * FROM `wishlist` WHERE customer_id ='".$customer_row['id']."' AND product_id = '".$row['id']."'");
                        $product_wishlist_result = mysqli_fetch_array($product_in_wishlist);
                        if ( $product_wishlist_result == true) {
                            $item_in_wishlist = true;
                            $item_in_wishlist_id = $product_wishlist_result["product_id"];
                        }
                        else{
                            $item_in_wishlist = false;
                        }
                        }
                        //session set to false
                        else{
                            //wishlist cookie set
                            if(isset($_COOKIE["shopping_wishlist"]))
                            {
                                $wishlist_data = stripslashes($_COOKIE["shopping_wishlist"]);
                                $wishlist_data = json_decode($wishlist_data, true);
                                $item_id = array_column($wishlist_data, "item_id");
                            if(in_array( $row['id'], $item_id))
                            {
                                foreach($wishlist_data as $keys => $values)
                                {
                                    if($wishlist_data[$keys]["item_id"] == $row['id'])
                                    {
                                        $item_in_wishlist = true;
                                        $item_in_wishlist_id = $values["item_id"];
                                    }
                                }
                            }
                            else{
                                $item_in_wishlist = false;
                            }
                        }
                        //wishlist cookie not set
                        else{
                            $item_in_wishlist = false; 
                        }
                        }
                    }
                    //session not set
                    else{
                        //wishlist cookie set
                        if(isset($_COOKIE["shopping_wishlist"]))
                            {
                                $wishlist_data = stripslashes($_COOKIE["shopping_wishlist"]);
                                $wishlist_data = json_decode($wishlist_data, true);
                                $item_id = array_column($wishlist_data, "item_id");
                            if(in_array( $row['id'], $item_id))
                            {
                                foreach($wishlist_data as $keys => $values)
                                {
                                    if($wishlist_data[$keys]["item_id"] == $row['id'])
                                    {
                                        $item_in_wishlist = true;
                                        $item_in_wishlist_id = $values["item_id"];
                                    }
                                }
                            }
                            else{
                                $item_in_wishlist = false;
                            }
                        }
                        //wishlist cookie not set
                        else{
                            $item_in_wishlist = false; 
                        }
                    } 
                               if($item_in_wishlist == true){
                                $output .= '<a class="wish-link"
                                href="'.$protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/product-list.php?action=add_wishlist&id='.$row['id']. '">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path style="fill:red;" d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>';
                            
                               }
                               if($item_in_wishlist == false){
                                $output .= '<a class="wish-link"
                                href="'.$protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/product-list.php?action=add_wishlist&id='.$row['id']. '">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>';
                               }
                               $output .= '
                    </a>
                </div>
                <div class="product-content">
                    <a href="#" class="cata" id="itemCategory'.$row['id'].'">'.$row['Category_Name'].'</a>
                    <h6><a href="product-detail.php" class="product-title">'.$row['Name'].'</a></h6>
                    <p class="quantity">'.$row['unit_name'].'</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="price">Ksh.'.number_format($row['Price'] - $row['Discount'],2);
                         if($row['Discount'] > 0){ 
                            $output .= '<br><del>Ksh.'.number_format($row['Price'],2).'</del>';
                         }
                         $output .= '</div>';
                            $item_in_cart = '';
                            $item_in_cart_qty = '';
                            $item_in_cart_id = '';
                            if (isset($_SESSION["logged_in"])) {
                                //session set to true
                                if ($_SESSION["logged_in"] == TRUE) {
                            $product_in_cart = mysqli_query($connection,"SELECT * FROM `cart` WHERE customer_id ='".$customer_row['id']."' AND product_id = '".$row['id']."'");
                            $product_cart_result = mysqli_fetch_array($product_in_cart);
                            if ( $product_cart_result == true) {
                                $item_in_cart = true;
                                $item_in_cart_id = $product_cart_result["product_id"];
                                $item_in_cart_qty = $product_cart_result["quantity"];
                            }
                            else{
                                $item_in_cart = false;
                            }
                            }
                            //session set to false
                            else{
                                //cart cookie set
                                if(isset($_COOKIE["shopping_cart"]))
                                {
                                    $cart_data = stripslashes($_COOKIE["shopping_cart"]);
                                    $cart_data = json_decode($cart_data, true);
                                    $item_id = array_column($cart_data, "item_id");
                                if(in_array( $row['id'], $item_id))
                                {
                                    foreach($cart_data as $keys => $values)
                                    {
                                        if($cart_data[$keys]["item_id"] == $row['id'])
                                        {
                                            $item_in_cart = true;
                                            $item_in_cart_id = $values["item_id"];
                                            $item_in_cart_qty = $values["item_quantity"];
                                        }
                                    }
                                }
                                else{
                                    $item_in_cart = false;
                                }
                            }
                            //cart cookie not set
                            else{
                                $item_in_cart = false; 
                            }
                            }
                        }
                        //session not set
                        else{
                            //cart cookie set
                            if(isset($_COOKIE["shopping_cart"]))
                                {
                                    $cart_data = stripslashes($_COOKIE["shopping_cart"]);
                                    $cart_data = json_decode($cart_data, true);
                                    $item_id = array_column($cart_data, "item_id");
                                if(in_array( $row['id'], $item_id))
                                {
                                    foreach($cart_data as $keys => $values)
                                    {
                                        if($cart_data[$keys]["item_id"] == $row['id'])
                                        {
                                            $item_in_cart = true;
                                            $item_in_cart_id = $values["item_id"];
                                            $item_in_cart_qty = $values["item_quantity"];
                                        }
                                    }
                                }
                                else{
                                    $item_in_cart = false;
                                }
                            }
                            //cart cookie not set
                            else{
                                $item_in_cart = false; 
                            }
                        } 
                        $output .= '<div class="cart-btn-toggle">';
                            if($item_in_cart == true)
                                {        
                                $output .= '<div class="price-button">
                                <input type="hidden" name="hidden_id" id="hidden_id'.$row['id'].'" value="'.$row['id'].'">
                                <input type="hidden" name="hidden_name" id="hidden_name'.$row['id'].'" value="'.$row['Name'].'">
                                <input type="hidden" name="hidden_unit" id="hidden_unit'.$row['id'].'" value="'.$row['unit_name'].'">
                                <input type="hidden" name="hidden_discount" id="hidden_discount'.$row['id'].'" value="'.$row['Discount'].'">
                                <input type="hidden" name="hidden_price" id="hidden_price'.$row['id'].'" value="'.$row['Price'].'">
                                <input type="hidden" name="hidden_image" id="hidden_image'.$row['id'].'" value="'.$row['image'].'">
                                        <div class="price-increase-decrese-group d-flex">
                                            <span class="decrease-btn">
                                                <button type="button"
                                                    class="btn quantity-left-minus productlist_decrease" data-type="minus" id="'.$item_in_cart_id.'" data-field="">-
                                                </button> 
                                            </span>
                                            <input type="text" name="quantity" id="productlist_qty'.$item_in_cart_id.'" disabled class="form-controls input-number" value="'.$item_in_cart_qty.'">
                                            <span class="increase">
                                                <button type="button"
                                                    class="btn quantity-right-plus productlist_increase" data-type="plus" id="'.$item_in_cart_id.'" data-field="">+
                                                </button>
                                            </span>
                                        </div>
                                    </div> 
                                '; 
                                }
                                else{
                                $output .= '<form method="POST">
                                <input type="hidden" name="hidden_id" id="hidden_id'.$row['id'].'" value="'.$row['id'].'">
                                <input type="hidden" name="hidden_name" id="hidden_name'.$row['id'].'" value="'.$row['Name'].'">
                                <input type="hidden" name="hidden_unit" id="hidden_unit'.$row['id'].'" value="'.$row['unit_name'].'">
                                <input type="hidden" name="hidden_discount" id="hidden_discount'.$row['id'].'" value="'.$row['Discount'].'">
                                <input type="hidden" name="hidden_price" id="hidden_price'.$row['id'].'" value="'.$row['Price'].'">
                                <input type="hidden" name="hidden_image" id="hidden_image'.$row['id'].'" value="'.$row['image'].'">
                                <button type="submit" class="cart-btn" name="cart_button">
                                    <span ><i class="fas fa-shopping-cart"></i> Cart</span>
                                </button>
                                </form>';
                                }              
                                $output .= '</div>    
                    </div>
                </div>
            </div>
        </div>';
        }
    }
    else{
        $output = '
                <h3 class="mt-5 ml-5" style="color:#59b828;">Product not found</h3>
        ';
    }
    echo $output;
}
elseif( $_POST['where'] == 'pagination' )
{
    $records_per_page = 9;
    $page = '';
    $output = '<div class="row align-items-center">';
    if(isset($_POST['page']))
    {
        $page = $_POST['page'];
    }
    else
    {
      $page = 1;
    }
    $start_from = ((int)$page - 1) * $records_per_page;
    $query = "SELECT * FROM blogs ORDER BY id ASC LIMIT $start_from,$records_per_page";
    $pageResult = mysqli_query($connection, $query)or die($connection->error);
    foreach($pageResult as $row){
        $id = $row['id'];
        $title = $row['title'];
        $blog = $row['blog'];
        $image = $row['image'];
        $Date = $row['Created_at'];
        $date = date( 'F d, Y', strtotime($Date));
        $Blog='';
        if(strlen($blog)<=100)
        {
          $Blog = $blog;
        }
        else
        {
          $Blog=substr($blog,0,100) . '...';
        }
        $comments = mysqli_query($connection,"SELECT * FROM comments WHERE blog_id = '$id' AND belongs_to = 'blog'")or die($connection->error);
        $comments_count = mysqli_num_rows($comments); 
        $output .= '<div class="col-md-6 col-lg-4 mb--30">
            <div class="post-item">
                <div class="post-thumb">
                    <a href="blog-single.php?id='.$id.'"><img src="../assets/images/blog/'.$image.'" alt="thumb"></a>
                </div>
                <div class="post-content border-effect">
                    <ul class="meta-post list-unstyled pl-0 d-flex justify-content-between">
                        <li>
                            <span class="icon"><i class="far fa-clock"></i></span>
                            <span class="meta-content">'.$date.'</span>
                        </li>
                        <li>
                            <span class="icon"><i class="far fa-comment-alt"></i></span>
                            
                            <a href="blog-single.php?id='.$id.'#comments-section" class="meta-link">'.$comments_count.' Comment';
                            if($comments_count != 1){ 
                            $output .= 's';  
                            }
                            $output .= '</a>
                        </li>
                    </ul>
                    <h4 class="title mb-3">'.$title.'</h4>
                    <h5 class="title mb-3"><a href="blog-single.php?id='.$id.'">'.$Blog.'</a></h5>
                    <a href="blog-single.php" class="blog-btn">Read More</a>
                </div>
            </div>
        </div>';
            }
        $blogsrowcount = mysqli_num_rows($blogsList);
        $total_pages = ceil($blogsrowcount / $records_per_page);
        $prev = (int)$page - 1;
        $next = (int)$page + 1;
        $output .= '<div class="col-12 pt--30">
            <ul class="pagination justify-content-center justify-content-lg-start">
                <li><a class="d-flex pagination_link" href="#" id="'.$prev.'><i class="icon fas fa-angle-left"></i><span class="text">';
                if($page != 1){
                $output .= 'Prev';
                }
                $output .= '</span></a></li>';
               for($i=1; $i<=$total_pages; $i++){
                $output .= '<li class="d-none d-md-block"><a class="pagination_link';
                if( $page == $i ){
                    $output .= ' active'; 
                }
                $output .= '" href="#" id="'.$i.'">'.$i.'</a></li>
                ';
               }
                $output .= '<li><a class="d-flex pagination_link" href="#" id="'.$next.'"><span class="text">';
                 if($page != $total_pages){
                $output .= 'Next</span><i class="icon fas fa-angle-right"></i>';
                 }

                $output .= '
                </a></li>
            </ul>
        </div>
        </div>
        ';
        echo $output;
}
 ?>
