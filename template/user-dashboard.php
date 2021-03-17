<?php
 include('header.php');
$profile_details = mysqli_query($connection,"SELECT firstname,lastname,email,location,mobile FROM users where email = '$logged_in_email' ")or die($connection->error);
$result = mysqli_fetch_array($profile_details);
$firstname = $result['firstname'];
$lastname = $result['lastname'];
$mobile = $result['mobile'];
$email = $result['email'];
$location = $result['location'];
?>
             <!-- page-header-section start -->
            <div class="page-header-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between justify-content-md-start">
                            <ul class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li><span>/</span></li>
                                <li>My Orders</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->



           <!-- admin-page start -->
           <section class="admin-page-section d-flex align-items-center" style="background-image: url('../assets/images/admin/profile-bg.jpg'); background-size: cover;">
                <div class="aps-wrapper w-100">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-start">
                            <div class="admin-content-area">
                                <div class="admin-thumb">
                                    <img src="../assets/images/admin/thumbnail-avatar.png" alt="">
                                    <a href="#" class="image-change-option"><i class="fas fa-camera"></i></a>
                                </div>
                                <div class="admin-content">
                                    <h4 class="name"><?php echo $firstname.' '.$lastname; ?></h4>
                                    <p class="desc"><?php echo $email; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- admin-page end -->



            <!-- dashboard-section start -->
            <section id="dashboard-nav" class="dashboard-section">
                <div class="container">
                    <ul class="dashboard-nav d-lg-flex flex-wrap align-items-center justify-content-between">
                        <li><a class="active" href="user-dashboard.php#dashboard-nav"><i class="far fa-list-alt"></i>Your Orders</a></li>
                        <li><a href="track-order.php#dashboard-nav"><i class="fas fa-shipping-fast"></i>Track Orders</a></li>
                        <li><a href="profile.php#dashboard-nav"><i class="far fa-user"></i>Your Profile</a></li>
                        <li><a href="wishlist.php#dashboard-nav"><i class="far fa-heart"></i>Wish List</a></li>
                    </ul>
                </div>

                <div class="container">
                    <div class="dashboard-body bg-color-white p-4 p-md-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="order-head mb-3">
                                    <h5>My Orders</h5>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="orders-container">
                                    <div class="order-item">
                                        <table class="table table-responsive1">
                                            <thead>
                                                <tr>
                                                    <th class="px-3">My Orders</th>
                                                    <th class="text-center">Items</th>
                                                    <th class="text-right pr-5">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="px-3 py-4">
                                                        <div>
                                                            <h6 class="order-number">Order#48376837</h6>
                                                            <p class="date">09/21/2020</p>
                                                            <p class="price">USD 2342</p>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div>
                                                            02items
                                                        </div>
                                                    </td>
                                                    <td class="text-right pr-5">
                                                        <div class="pending">
                                                            pending
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="px-3">
                                                        <div>
                                                            <a href="track-order-single.php">Track Order</a>
                                                        </div>
                                                    </td>
                                                    <td class="text-right px-4" colspan="2">
                                                        <div>
                                                            <a class="view-details" href="order-details.php">View Details</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="order-item">
                                        <table class="table table-responsive1">
                                            <thead>
                                                <tr>
                                                    <th class="px-3">My Orders</th>
                                                    <th class="text-center">Items</th>
                                                    <th class="text-right pr-5">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="px-3 py-4">
                                                        <div>
                                                            <h6 class="order-number">Order#48376837</h6>
                                                            <p class="date">09/21/2020</p>
                                                            <p class="price">USD 2342</p>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div>
                                                            02items
                                                        </div>
                                                    </td>
                                                    <td class="text-right pr-5">
                                                        <div class="done">
                                                            Done
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="px-3">
                                                        <div>
                                                            <a href="track-order-single.php">Track Order</a>
                                                        </div>
                                                    </td>
                                                    <td class="text-right px-4" colspan="2">
                                                        <div>
                                                            <a class="view-details" href="order-details.php">View Details</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="order-item">
                                        <table class="table table-responsive1">
                                            <thead>
                                                <tr>
                                                    <th class="px-3">My Orders</th>
                                                    <th class="text-center">Items</th>
                                                    <th class="text-right pr-5">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="px-3 py-4">
                                                        <div>
                                                            <h6 class="order-number">Order#48376837</h6>
                                                            <p class="date">09/21/2020</p>
                                                            <p class="price">USD 2342</p>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div>
                                                            02items
                                                        </div>
                                                    </td>
                                                    <td class="text-right pr-5">
                                                        <div class="done">
                                                            Done
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="px-3">
                                                        <div>
                                                            <a href="track-order-single.php">Track Order</a>
                                                        </div>
                                                    </td>
                                                    <td class="text-right px-4" colspan="2">
                                                        <div>
                                                            <a class="view-details" href="order-details.php">View Details</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="wallet-item">
                                    <div class="order-item">
                                        <table class="table table-responsive1">
                                            <thead>
                                                <tr>
                                                    <th class="px-3">My Wallet</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="px-3 py-4">
                                                        <div>
                                                            <p class="my-balance">My Balance</p>
                                                            <h6 class="credits">Credits $100</h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right px-4">
                                                        <div>
                                                            <a class="view-details" href="order-details.php">View Details</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="rewards">
                                    <div class="order-item">
                                        <table class="table table-responsive1">
                                            <thead>
                                                <tr>
                                                    <th class="px-3" colspan="3">Rewards</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="px-3 pb-0 pt-4" colspan="3">
                                                        <div class="offer-active">1 Offer Active</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="px-3 py-4">
                                                        <a href="#" class="offre-item active">
                                                            <div class="icon">
                                                                <svg  enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m52 512h-37c-8.284 0-15-6.716-15-15v-180c0-8.284 6.716-15 15-15h37c8.284 0 15 6.716 15 15v180c0 8.284-6.716 15-15 15z"/><path d="m493.252 348.812c-11.564-6.366-25.677-5.932-36.828 1.132l-54.88 34.757c-1.659 14.16-7.893 27.299-18.05 37.7-12.344 12.638-28.855 19.599-46.494 19.599h-74.576c-8.077 0-15.027-6.207-15.407-14.275-.406-8.614 6.458-15.725 14.983-15.725h75c19.579 0 35.456-16.162 34.99-35.845-.452-19.106-16.535-34.155-35.647-34.155h-84.343l-9.784-7.338c-19.485-14.614-43.629-22.662-67.986-22.662-20.532 0-40.691 5.584-58.298 16.147l-18.932 11.36v152.493h252.126c14.579 0 28.842-4.249 41.044-12.227l105.439-68.941c10.263-6.712 16.391-18.04 16.391-30.303 0-13.2-7.184-25.353-18.748-31.717z"/><path d="m212 0c-68.925 0-125 56.075-125 125s56.075 125 125 125 125-56.075 125-125-56.075-125-125-125zm15 187.071v2.929c0 8.284-6.716 15-15 15s-15-6.716-15-15v-2.942c-12.122-4.936-21.476-15.676-24.196-29.073-1.648-8.118 3.596-16.036 11.715-17.686 8.117-1.646 16.037 3.597 17.686 11.715.939 4.627 5.06 7.985 9.796 7.985 5.514 0 10-4.486 10-10s-4.486-10-10-10c-22.056 0-40-17.944-40-40 0-16.752 10.357-31.124 25-37.071v-2.928c0-8.284 6.716-15 15-15s15 6.716 15 15v2.942c12.122 4.936 21.476 15.676 24.196 29.073 1.648 8.118-3.597 16.036-11.715 17.686-8.117 1.648-16.036-3.597-17.686-11.715-.94-4.628-5.06-7.986-9.796-7.986-5.514 0-10 4.486-10 10s4.486 10 10 10c22.056 0 40 17.944 40 40 0 16.752-10.357 31.124-25 37.071z"/><path d="m510.584 201.806c-2.469-5.271-7.764-8.638-13.584-8.638h-21.834c-13.257-52.36-43.146-99.744-85.058-134.453-19.496-16.146-41.216-29.185-64.323-38.846 25.565 27.648 41.215 64.594 41.215 105.131 0 12.468-1.49 24.592-4.282 36.215 6.964 9.982 12.854 20.699 17.485 31.953h-13.203c-5.82 0-11.115 3.367-13.584 8.638s-1.665 11.494 2.061 15.965l65 78c2.85 3.42 7.071 5.397 11.523 5.397s8.674-1.978 11.523-5.397l65-78c3.726-4.471 4.53-10.695 2.061-15.965z"/></svg>
                                                            </div>
                                                            <p class="offer-name">Cash-Back</p>
                                                        </a>
                                                    </td>
                                                    <td class="px-3 py-4">
                                                        <a href="#" class="offre-item">
                                                            <div class="icon">
                                                                <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m301 302c82.703125 0 150-68.296875 150-151s-67.296875-151-150-151-150 68.296875-150 151 67.296875 151 150 151zm60-91h-30v-30h30zm-25.605469-115.605469 21.210938 21.210938-90 90-21.210938-21.210938zm-94.394531-4.394531h30v30h-30zm0 0"/><path d="m441.199219 356.898438-97.601563 65.101562h-117.597656v-30h90c24.902344 0 45-20.101562 45-45v-15h-90c-3-.300781-7.800781 1.199219-13.5-3.601562l-7.199219-6.300782c-39.601562-34.796875-99-34.796875-138.601562 0l-45.300781 39.902344h-66.398438v150h317.5l194.5-130.5-8.402344-12.601562c-13.796875-20.398438-41.996094-25.796876-62.398437-12zm0 0"/></svg>
                                                            </div>
                                                            <p class="offer-name">Cash-Back</p>
                                                        </a>
                                                    </td>
                                                    <td class="px-3 py-4">
                                                        <a href="#" class="offre-item">
                                                            <div class="icon">
                                                                <svg version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><path d="M407,301c-8.276,0-15,6.724-15,15s6.724,15,15,15s15-6.724,15-15S415.276,301,407,301z"/><path d="M497,91H151.245v45c0,8.291-6.709,15-15,15s-15-6.709-15-15V91H15c-8.291,0-15,6.709-15,15v90c0,8.291,6.709,15,15,15
                    c24.814,0,45,20.186,45,45c0,24.814-20.186,45-45,45c-8.291,0-15,6.709-15,15v90c0,8.291,6.709,15,15,15h105v-45
                    c0-8.291,6.709-15,15-15s15,6.709,15,15v45h347c8.291,0,15-6.709,15-15V106C512,97.709,505.291,91,497,91z M150,316
                    c0,8.291-6.709,15-15,15s-15-6.709-15-15v-30c0-8.291,6.709-15,15-15s15,6.709,15,15V316z M150,226c0,8.291-6.709,15-15,15
                    s-15-6.709-15-15v-30c0-8.291,6.709-15,15-15s15,6.709,15,15V226z M242,196c0-24.814,20.186-45,45-45c24.814,0,45,20.186,45,45
                    c0,24.814-20.186,45-45,45C262.186,241,242,220.814,242,196z M278.68,358.48c-6.899-4.6-8.76-13.901-4.16-20.801l120-180
                    c4.585-6.899,13.887-8.745,20.801-4.16c6.899,4.6,8.76,13.901,4.16,20.801l-120,180
                    C294.956,361.117,285.689,363.126,278.68,358.48z M407,361c-24.814,0-45-20.186-45-45c0-24.814,20.186-45,45-45
                    c24.814,0,45,20.186,45,45C452,340.814,431.814,361,407,361z"/><path d="M287,181c-8.276,0-15,6.724-15,15s6.724,15,15,15s15-6.724,15-15S295.276,181,287,181z"/></svg>
                                                            </div>
                                                            <p class="offer-name">Cash-Back</p>
                                                        </a>
                                                    </td>
                                
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- dashboard-section end -->
 <?php
  include('footer.php');
?>