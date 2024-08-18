<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: signin.php");
exit();
