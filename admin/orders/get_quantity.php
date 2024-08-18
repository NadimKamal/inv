<?php
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}

include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\orders;

if(isset($_POST['productId'])){

  $productId = $_POST['productId'];
    
    include_once($_SERVER['DOCUMENT_ROOT']."/config.php");
    $_order= new orders();
    
    // Call getProductDetails method to retrieve product details
    $productDetails = $_order->getProductDetails($productId);
    
    // Convert product details array to JSON and echo it
    echo json_encode($productDetails);
}
