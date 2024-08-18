<?php
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}
include_once($_SERVER['DOCUMENT_ROOT'] . "/config.php");

use App\items;
$_item= new items();
$_item->restore();


// $_id = $_GET['id'];
// $_is_deleted = 0;

// //Connection to Database

// $servername = "localhost";
// $username = "root";
// $password = "";

// $conn = new PDO("mysql:host=$servername; dbname=inv", $username, $password);
// // set the PDO error mode to exception
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// $query = "UPDATE `items` SET `is_deleted`= :is_deleted WHERE `items`.`id`= :id"; 

// $stmt = $conn->prepare($query);

// $stmt->bindParam(':id', $_id);
// $stmt->bindParam(':is_deleted', $_is_deleted);

// $result = $stmt->execute();
// // var_dump( $result );

// header('location:index.php');