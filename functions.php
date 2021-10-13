<?php
   function generateRandomString(){
   	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = 7;
            $string = '';
            for ($p = 0; $p < $charactersLength; $p++) {
                $string .= $characters[rand(0, $charactersLength - 1)];
            }
            return $string;
   }
   function redirectToLoginPage(){
   require('config.php');
 	header("Location:../$login_url?page_url=../$home_url");
   	exit();
 }
 function genRandomSaltString() {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $string = '';
            for ($p = 0; $p < $charactersLength; $p++) {
                $string .= $characters[rand(0, $charactersLength - 1)];
            }

            return $string;
        }
    function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
      $numbers = range($min, $max);
      shuffle($numbers);
      return array_slice($numbers, 0, $quantity);
  }      
  function sanitize($data) {
   require('config.php');
     $data = trim($data);
     $data = htmlspecialchars($data);
     $data = mysqli_real_escape_string($connection,$data);
     return $data;
}

function total_views($connection, $page_id = null)
{
  if($page_id === null)
  {
    // count total website views
    $query = "SELECT sum(total_views) as total_views FROM pages";
    $result = mysqli_query($connection, $query); 
    if(mysqli_num_rows($result) > 0)
    {
      while($row = $result->fetch_assoc())
      {
        if($row['total_views'] === null)
        {
          return 0;
        }
        else
        {
          return $row['total_views'];
        }
      }
    }
    else
    {
      return "No records found!";
    }
  }
  else
  {
    // count specific page views
    $query = "SELECT total_views FROM pages WHERE id='$page_id'";
    $result = mysqli_query($connection, $query);  
    if(mysqli_num_rows($result) > 0)
    {
      while($row = $result->fetch_assoc())
      {
        if($row['total_views'] === null)
        {
          return 0;
        }
        else
        {
          return $row['total_views'];
        }
      }
    }
    else
    {
      return "No records found!";
    }
  }
}
function is_unique_view($connection, $visitor_ip, $page_id)
{
  $query = "SELECT * FROM page_views WHERE visitor_ip='$visitor_ip' AND page_id='$page_id'";
  $result = mysqli_query($connection, $query);
  
  if(mysqli_num_rows($result) > 0)
  {
    return false;
  }
  else
  {
    return true;
  }
}
function add_view($connection, $visitor_ip, $page_id)
{
  if(is_unique_view($connection, $visitor_ip, $page_id) === true)
  {
    // insert unique visitor record for checking whether the visit is unique or not in future.
    $query = "INSERT INTO page_views (visitor_ip, page_id) VALUES ('$visitor_ip', '$page_id')";
    if(mysqli_query($connection, $query))
    {
      // At this point unique visitor record is created successfully. Now update total_views of specific page.
      $query = "UPDATE pages SET total_views = total_views + 1 WHERE id='$page_id'";
      if(!mysqli_query($connection, $query))
      {
        echo "Error updating record: " . mysqli_error($connection);
      }
    }
    else
    {
      echo "Error inserting record: " . mysqli_error($connection);
    }
  }
}

function page_views($page_id){
    require('config.php');
    $visitor_ip = $_SERVER['REMOTE_ADDR']; 
   // stores IP address of visitor in variable
   add_view($connection, $visitor_ip, $page_id);
   $total_page_views = total_views($connection, $page_id); 
   return $total_page_views;
}

function getStringBetween($str,$from,$to)
{
    $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
    return substr($sub,0,strpos($sub,$to));
}

function text_limit($x, $length)
{
  if(strlen($x)<=$length)
  {
    echo $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    $tag = '';
    if (strpos($y, '<') !== false) {
      $tag = getStringBetween($y,'<','>');
      if (strpos($y, '<'.$tag.'>') !== false && strpos($y, '</'.$tag.'>') == false) {
        $y .= '</'.$tag.'>';
      }
    }
    echo $y;
  }
}

function resizeImage($resourceType,$image_width,$image_height){

  /*$max_resolution = 500;
  $ratio = $max_resolution / $image_width;
  $resizeWidth = $max_resolution;
  $resizeHeight = $image_height * $ratio;
  if($resizeHeight > $max_resolution){
    $ratio = $max_resolution / $image_height;
    $resizeHeight = $max_resolution;
    $resizeWidth = $image_width * $ratio;
  } */

  $resizeWidth = 350;
  $resizeHeight = 350;

  $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
  imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight,$image_width,$image_height);
  return $imageLayer;
}
 ?>