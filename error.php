<?php
  include('header.php');
  $error = $_SERVER["REDIRECT_STATUS"];
  $error_code = '';
  $error_title = '';
  $error_message = '';

  if($error == 404)
  {
      $error_code = '404';
      $error_title = 'Page Not Found';
      $error_message = 'It looks like nothing was found at this location.';
  }
  if($error == 408)
  {
      $error_code = '408';
      $error_title = 'Request Timeout';
      $error_message = 'Your request took too long to respond.';
  }
?> 
            <!-- page-header-section start -->
            <div class="page-header-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between justify-content-md-end">
                            <ul class="breadcrumb">
                                <li><a href="index.html">Home</a></li>
                                <li><span>/</span></li>
                                <li><?php  echo $error_code; ?> Page</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->



            <!-- about section start -->
            <section class="error-page text-center">
                <div class="container">
                    <h1><?php  echo $error_code; ?></h1>
                    <h3><?php echo $error_title; ?></h3>
                    <p><?php echo $error_message; ?></p>
                    <a href="index.php" class="backhome">Back Home</a>
                </div>
            </section>
            <!-- about section end -->
<?php
    include('footer.php');
?>