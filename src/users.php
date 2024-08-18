<?php
namespace App;

use PDO;

class users
{
    public $id = null;
    public $role = null;
    public $role_id = null;
    public $fname = null;
    public $lname = null;
    public $phone = null;
    public $gender = null;
    public $user = null;
    public $email = null;
    public $password = null;
    public $conn = null;
    public function __construct()
    {
        // Connection to database

        $servername = "localhost";
        $username = "root";
        $password = "";

        $this->conn = new PDO("mysql:host=$servername; dbname=inv", $username, $password);
        // set the PDO error mode to exception

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";

    }

    public function store()
    {
        print_r($_POST);
        $_role_id = $_POST['role_id'];
        $_fname = $_POST['fname'];
        $_lname = $_POST['fname'];
        $_phone = $_POST['phone'];
        $_gender = $_POST['gender'];
        $_user_name = $_POST['user_name'];
        $_role_name = $this->getRole($_POST['role_id']);
        $_email = $_POST['email'];
        $_user_password = $_POST['user_password'];

        if (strlen($_user_password) < 8) {
            $error_msg = "Password length must be at least 8 characters.";
            header('location: create.php?error=' . urlencode($error_msg));
            return;
        }
      
        $_hash_password = password_hash($_user_password, PASSWORD_DEFAULT); 
      

        if (array_key_exists('is_active', $_POST)) {
            $_is_active = $_POST['is_active'];
        } else {
            $_is_active = 0;
        }

        $_created_at = date("Y-m-d H:i:s");

        // $_status = $_POST['status'];

        // Insert Query

        $query = "INSERT INTO `users`(`role`, `role_id`,`fname`, `lname`, `phone`, `gender`, `name`, `email`, `password`, `is_active`, `created_at`) VALUES ( :role_name, :role_id, :fname, :lname, :phone, :gender, :user_name, :email, :user_password, :is_active, :created_at)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':role_id', $_role_id);
        $stmt->bindParam(':fname', $_fname);
        $stmt->bindParam(':lname', $_lname);
        $stmt->bindParam(':phone', $_phone);
        $stmt->bindParam(':gender', $_gender);
        $stmt->bindParam(':user_name', $_user_name);
        $stmt->bindParam(':user_password', $_hash_password);
        $stmt->bindParam(':role_name', $_role_name);
        $stmt->bindParam(':email', $_email);
        $stmt->bindParam(':is_active', $_is_active);
        $stmt->bindParam(':created_at', $_created_at);

        // $stmt->bindParam(':status', $_status);

        $result = $stmt->execute();

        // var_dump($result);

        // PHP link
        if ($result) {
            $msg = "Successfully Stored!";
            header('Location: index.php?msg=' . urlencode($msg));
            exit();
        } 
    }

    function getRole($id)
    {
        $query = "SELECT * FROM `roles` where `id` = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $role = $stmt->fetch();

        return $role['role_name'];
    }
    
    public function index()
    {

        //Insert Query
        $query = "SELECT * FROM `users` where is_deleted = 0";

        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();
        $users = $stmt->fetchAll();

        return $users;
    }
    public function show()
    {
        $_id = $_GET['id'];

        $query = "SELECT * FROM `users` WHERE id= :id";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $user = $stmt->fetch();
        return $user;

        //var_dump($user);
    }
    public function edit()
    {
        $_id = $_GET['id'];

        $query = "SELECT * FROM `users` WHERE id= :id";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $user = $stmt->fetch();
        return $user;

        // var_dump($user);
    }
    public function update()
    {

        $_id = $_POST['id'];
        $_fname = $_POST['fname'];
        $_lname = $_POST['lname'];
        $_phone = $_POST['phone'];
        $_gender = $_POST['gender'];
        $_user_name = $_POST['user_name'];
        $_role_name = $_POST['role_name'];
        $_email = $_POST['email'];
        $_user_password = $_POST['user_password'];

        if (array_key_exists('is_active', $_POST)) {
            $_is_active = $_POST['is_active'];
        } else {
            $_is_active = 0;
        }

        $_modified_at = date("Y-m-d H:i:s");


        // Insert Query

        $query = "UPDATE `users` SET `fname`= :fname, `lname`= :lname, `phone`= :phone, `gender`= :gender, `name`= :user_name, `role`= :role_name, `email`= :email, `password`= :user_password, `is_active`= :is_active WHERE `users`.`id`= :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':fname', $_fname);
        $stmt->bindParam(':lname', $_lname);
        $stmt->bindParam(':phone', $_phone);
        $stmt->bindParam(':gender', $_gender);
        $stmt->bindParam(':user_name', $_user_name);
        $stmt->bindParam(':user_password', $_user_password);
        $stmt->bindParam(':role_name', $_role_name);
        $stmt->bindParam(':email', $_email);
        $stmt->bindParam(':is_active', $_is_active);
        // $stmt->bindParam(':created_at', $_created_at);

        $result = $stmt->execute();


        header('location:index.php');
    }
    public function delete()
    {
        $_id = $_GET['id'];

        $query = "DELETE FROM `users` WHERE `users`. `id` = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();
        // var_dump( $result );

        header('location:trash_index.php');
    }
    public function trash()
    {
        $_id = $_GET['id'];
        $_is_deleted = 1;

        $query = "UPDATE `users` SET `is_deleted`= :is_deleted WHERE `users`.`id`= :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':is_deleted', $_is_deleted);

        $result = $stmt->execute();
        // var_dump( $result );

        header('location:index.php');
    }

    public function restore()
    {

        $_id = $_GET['id'];
        $_is_deleted = 0;

        $query = "UPDATE `users` SET `is_deleted`= :is_deleted WHERE `users`.`id`= :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':is_deleted', $_is_deleted);

        $result = $stmt->execute();
        // var_dump( $result );

        header('location:index.php');

    }
    public function trash_index()
    {

        //Insert Query
        $query = "SELECT * FROM `users` where is_deleted = 1";

        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
    }
    public function paginateUsers($limit, $offset)
    {
        $query = "SELECT * FROM `users` WHERE is_deleted = 0 LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countTotalUsers()
    {
        $query = "SELECT COUNT(*) FROM `users` WHERE is_deleted = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }


    public function getRoles()
    {
        $query = "SELECT * FROM `roles` where is_deleted = 0";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $roles = $stmt->fetchAll();

        return $roles;
    }

}
