<?php

session_start();
include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connection to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $role = "";

    $conn = new PDO("mysql:host=$servername; dbname=inv", $username, $password);
    // set the PDO error mode to exception

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";


    $email = $_POST['email'];
    $password = $_POST['pass'];

    
    $sql = "SELECT `id`, `name`, `email`, `password`, `role_id`, `is_active` FROM users WHERE email=:email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch();
    // print_r($result);
    $result_id = $result['id'] ?? null;
    $result_user_name = $result['name'] ?? null;
    $result_email = $result['email'] ?? null;
    $result_password = $result['password'] ?? null;
    $result_role_id = $result['role_id'] ?? null;
    $result_is_active = $result['is_active'] ?? null;
    
    $verify = password_verify($password, $result_password); 

    if ($verify) {
        // Check if the account is active
        if ($result_is_active == 1) {
            // Store user information in session
            $_SESSION['user_id'] = $result_id;
            $_SESSION['username'] = $result_user_name;
            $_SESSION['email'] = $result_email;
            $_SESSION['role_id'] = $result_role_id;

            // Redirect to the protected page
            header('location: ./index.php');
            exit();
        } else {
            $error_msg = 'Your account is not active. Please contact support.';
            header('location: signin.php?error=' . urlencode($error_msg));
            exit();
        }
    } else {
        $error_msg = 'Email and Password is not matched';
        header('location: signin.php?error=' . urlencode($error_msg));
        exit();
    }

}

