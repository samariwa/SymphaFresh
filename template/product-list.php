<?php
  include('header.php');
?> 
            <!-- page-header-section start -->
            <div class="page-header-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between justify-content-md-end">
                            <ul class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li><span>/</span></li>
                                <li>Product List</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->
            <?php echo $message; ?>
            <!-- page-content -->
            <section class="page-content section-ptb-90">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 sidebar order-lg-last">
                            <div class="widget widget-head">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Filter</h6>
                                    <a href="product-list.php">Clear All</a>
                                </div>
                            </div>
                            <div class="widget">
                                <h4 class="widget-title d-none d-lg-block">Categories</h4>
                                <a class="widget-title d-lg-none" data-toggle="collapse" href="#scatagory-widget01" role="button" aria-expanded="false" aria-controls="scatagory-widget01">Catagories<i class="fas fa-angle-down"></i></a>

                                <div class="widget-wrapper" id="scatagory-widget01">
                                    <ul class="catagory-menu collapse show" id="catagory-main">
                                    <?php 
                                    $count = 0;
                                    foreach($categoriesList as $row){
                                        $count++;
                                        $id = $row['id'];
                                        $category = $row['Category_Name'];
                                    ?>    
                                        <li><a class="collapsed"  data-toggle="collapse" href="#catagory-widget-s<?php echo $count; ?>" role="button" aria-expanded="false" aria-controls="catagory-widget-s<?php echo $count; ?>"><?php echo $category; ?> <span class="plus-minus"></span></a>
                                            <ul class="catagory-submenu collapse" id="catagory-widget-s<?php echo $count; ?>">
                                            <?php
                                            $stockSubmenu = mysqli_query($connection,"SELECT id, Name from stock where Category_id = '$id';")or die($connection->error);                              
                                                foreach($stockSubmenu as $row){
                                                $stock_id = $row['id'];    
                                                $name = $row['Name'];
                                            ?>
                                                <li class="checkbox-item">
                                                    <input type="checkbox">
                                                    <span class="checkbox"></span>
                                                    <span class="label"><?php echo $name; ?></span>
                                                </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="widget">
                                <h4 class="widget-title d-none d-lg-block">Filter by Price</h4>
                                <a class="widget-title d-lg-none" data-toggle="collapse" href="#scatagory-widget02" role="button" aria-expanded="false" aria-controls="scatagory-widget02">Filter by Price<i class="fas fa-angle-down"></i></a>

                                <div class="widget-wrapper" id="scatagory-widget02">
                                    <div class="range-slider">
                                        <input type="text" class="js-range-slider" value="" />
                                        <input type="submit" class="submit" value="filter">
                                    </div>
                                </div>
                            </div>

                           <!-- <div class="widget">
                                <h4 class="widget-title d-none d-lg-block">Filter by Brand Name</h4>
                                <a class="widget-title d-lg-none" data-toggle="collapse" href="#scatagory-widget03" role="button" aria-expanded="false" aria-controls="scatagory-widget03">Filte by Brand Name<i class="fas fa-angle-down"></i></a>

                                <div class="widget-wrapper" id="scatagory-widget03">
                                
                                <div class="flux-custom-select">
                                        <select>
                                            <option value="0">Select Brand</option>
                                            <option value="1">Nesle</option>
                                            <option value="2">Dano</option>
                                            <option value="3">Fresh</option>
                                            <option value="3">Uniliver</option>
                                            <option value="3">Pepsi</option>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-lg-9 order-lg-first">
                            <div class="row product-list">
                            <?php
                                foreach($stockList as $row){
                                $count++;
                                $id = $row['id'];
                                $category = $row['Category_Name'];
                                $name = $row['Name'];
                                $image = $row['image'];
                                $selling_price = $row['Price'];
                                $discount = $row['Discount'];
                                $discounted_price = $selling_price - $discount;
                                $quantity = $row['Quantity'];
                                $unit_name = $row['unit_name'];
                                $restock_level = $row['Restock_Level'];
                            ?>
                                <div class="col-sm-6 col-xl-4" id="<?php echo $name; ?>">
                                    <div class="product-item <?php if($quantity < $restock_level ){ ?>stock-out<?php }?>">
                                        <div class="product-thumb">
                                            <a onclick="openModal()"><img src="../assets/images/products/<?php echo $image; ?>" alt="product"></a>
                                            <?php if($discount > 0){?><span class="batch sale">Sale</span><?php } ?>
                                            <a class="wish-link"
                                            href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/template/product-list.php?action=add_wishlist&id='.$id ?>">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path  
                                                <?php
                                            if(isset($_COOKIE["shopping_wishlist"]))
                                            {
                                                $wishlist_data = stripslashes($_COOKIE['shopping_wishlist']);
                                                $wishlist_data = json_decode($wishlist_data, true);
                                                $item_id_wishlist = array_column($wishlist_data, 'item_id');
                                            if(in_array( $id, $item_id_wishlist))
                                            {
                                                foreach($wishlist_data as $keys => $values)
                                                {
                                                    if($wishlist_data[$keys]["item_id"] == $id)
                                                    {
                                                    ?>
                                                    style="fill:red;"
                                                     <?php   
                                                    }
                                                }
                                            }
                                            }
                                             ?>
                                                d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                               
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="#" class="cata"><?php echo $category; ?></a>
                                            <h6><a href="product-detail.php" class="product-title"><?php echo $name; ?></a></h6>
                                            <p class="quantity"><?php echo $unit_name; ?></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">Ksh.<?php echo number_format($discounted_price,2); if($discount > 0){?> <del>Ksh.<?php echo number_format($selling_price,2); ?></del><?php } ?></div>
            
                                                <div class="cart-btn-toggle">
                                                <form method="POST">
                                                <input type="hidden" name="hidden_id" value="<?php echo $id; ?>">
                                                <input type="hidden" name="hidden_name" value="<?php echo $name; ?>">
                                                <input type="hidden" name="hidden_unit" value="<?php echo $unit_name; ?>">
                                                <input type="hidden" name="hidden_discount" value="<?php echo $discount; ?>">
                                                <input type="hidden" name="hidden_price" value="<?php echo $selling_price; ?>">
                                                <input type="hidden" name="hidden_image" value="<?php echo $image; ?>">
                                                <button type="submit" class="cart-btn" name="cart_button">
                                                    <span ><i class="fas fa-shopping-cart"></i> Cart</span>
                                                </button>
                                                </form>
                                                  <!--  <div class="price-btn">
                                                        <div class="price-increase-decrese-group d-flex">
                                                            <span class="decrease-btn">
                                                                <button type="button"
                                                                    class="btn quantity-left-minus" data-type="minus" data-field="">-
                                                                </button> 
                                                            </span>
                                                            <input type="text" name="quantity" class="form-controls input-number" value="1">
                                                            <span class="increase">
                                                                <button type="button"
                                                                    class="btn quantity-right-plus" data-type="plus" data-field="">+
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <?php
                                }  
                                ?>
                                
                                <div class="col-12 text-center mt-4">
                                    <button class="loadMore">Load More</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- page-content -->
<?php
    include('footer.php');
?>