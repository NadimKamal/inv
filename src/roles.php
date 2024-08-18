<?php
namespace App;

use PDO;

class roles
{
    public $id = null;
    public $role_name = null;
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

        $_role_name = $_POST['role_name'];

        // var_dump($_role);

        if (array_key_exists('is_active', $_POST)) {
            $_is_active = $_POST['is_active'];
        } else {
            $_is_active = 0;
        }

        $_created_at = date("Y-m-d H:i:s");
        $_updated_at = date("Y-m-d H:i:s");



        // Insert Query

        $query = "INSERT INTO `roles`(`role_name`, `is_active`, `created_at`) VALUES (:role_name, :is_active, :created_at)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':role_name', $_role_name);
        $stmt->bindParam(':is_active', $_is_active);
        $stmt->bindParam(':created_at', $_created_at);


        $result = $stmt->execute();

        var_dump($result);

        // PHP link
        if ($result) {
            $msg = "Successfully Stored!";
            header('Location: index.php?msg=' . urlencode($msg));
            exit();
        } 
    }
    public function index()
    {

        //Insert Query
        $query = "SELECT * FROM `roles` where is_deleted = 0";

        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();
        $roles = $stmt->fetchAll();

        return $roles;
    }
    public function show()
    {
        $_id = $_GET['id'];

        $query = "SELECT * FROM `roles` WHERE id= :id";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $role = $stmt->fetch();
        return $role;

        //var_dump($role);
    }
    public function edit()
    {
        $_id = $_GET['id'];

        $query = "SELECT * FROM `roles` WHERE id= :id";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $role = $stmt->fetch();
        return $role;

        // var_dump($role);
    }
    public function update()
    {
        // print_r($_POST);
        $_id = $_POST['id'];
        $_role = $_POST['role'];

        if (array_key_exists('is_active', $_POST)) {
            $_is_active = $_POST['is_active'];
        } else {
            $_is_active = 0;
        }

        $_modified_at = date("Y-m-d H:i:s");

        $_status = $_POST['status'];

        // Insert Query

        $query = "UPDATE `roles` SET `role`= :role, `is_active`= :is_active, `status`= :status WHERE `roles`.`id`= :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':role', $_role);
        $stmt->bindParam(':is_active', $_is_active);
        $stmt->bindParam(':status', $_status);
        $result = $stmt->execute();



        header('location:index.php');
    }
    public function delete()
    {
        $_id = $_GET['id'];

        $query = "DELETE FROM `roles` WHERE `roles`. `id` = :id";

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

        $query = "UPDATE `roles` SET `is_deleted`= :is_deleted WHERE `roles`.`id`= :id";

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
        $query = "SELECT * FROM `roles` where is_deleted = 1";

        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();
        $roles = $stmt->fetchAll();
        return $roles;
    }
    public function restore()
    {

        $_id = $_GET['id'];
        $_is_deleted = 0;

        $query = "UPDATE `roles` SET `is_deleted`= :is_deleted WHERE `roles`.`id`= :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':is_deleted', $_is_deleted);

        $result = $stmt->execute();
        // var_dump( $result );

        header('location:index.php');

    }

    public function paginate($limit, $offset) {
        // Pagination query to fetch a subset of roles
        $query = "SELECT * FROM `roles` WHERE is_deleted = 0 LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $roles = $stmt->fetchAll();
        return $roles;
    }

    public function countTotalCategories() {
        // Query to count total roles
        $query = "SELECT COUNT(*) as total FROM `roles` WHERE is_deleted = 0";
        $stmt = $this->conn->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
    public function searchCategories($searchTerm, $categoriesPerPage, $offset) {
        $searchTerm = "%{$searchTerm}%";
        $query = "SELECT * FROM `roles` WHERE `role` LIKE :searchTerm LIMIT :offset, :categoriesPerPage";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':searchTerm', $searchTerm);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':categoriesPerPage', $categoriesPerPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
}