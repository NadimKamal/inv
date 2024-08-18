<?php
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}

include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\roles;
$_category= new roles();
$_category->store();

