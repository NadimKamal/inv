<?php
namespace App;

use PDO;

class items
{
    public $id = null;
    public $item = null;
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

    }



    public function store()
    {
        try {
            // Enable PDO error reporting
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $_item = $_POST['item'];
    
            if (array_key_exists('is_active', $_POST)) {
                $_is_active = $_POST['is_active'];
            } else {
                $_is_active = 0;
            }
    
            $_created_at = date("Y-m-d H:i:s");
    
            // Check if the item already exists
            $checkQuery = "SELECT COUNT(*) FROM `items` WHERE `item` = :item";
            $checkStmt = $this->conn->prepare($checkQuery);
            $checkStmt->bindParam(':item', $_item);
            $checkStmt->execute();
            $itemExists = $checkStmt->fetchColumn();
    
            if ($itemExists > 0) {
                // Item already exists
                $msg = "This item is already there!";
                header('Location: index.php?msg=' . urlencode($msg));
                exit();
            }
    
            // Insert Query
            $query = "INSERT INTO `items`(`item`, `is_active`, `created_at`) VALUES (:item, :is_active, :created_at)";
            $stmt = $this->conn->prepare($query);
    
            $stmt->bindParam(':item', $_item);
            $stmt->bindParam(':is_active', $_is_active);
            $stmt->bindParam(':created_at', $_created_at);
    
            $result = $stmt->execute();
    
            if ($result) {
                $msg = "Successfully Stored!";
                header('Location: index.php?msg=' . urlencode($msg));
                exit();
            }
        } catch (\PDOException $e) {
            // Display error message
            $msg = $e->getMessage();
            header('Location: index.php?msg=' . urlencode($msg));
            exit();
        }
    }
    
    public function index()
    {

        //Insert Query
        $query = "SELECT * FROM `items` where is_deleted = 0";

        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();
        $items = $stmt->fetchAll();

        return $items;
    }
    public function show()
    {
        $_id = $_GET['id'];

        $query = "SELECT * FROM `items` WHERE id= :id";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $item = $stmt->fetch();
        return $item;

        //var_dump($item);
    }
    public function edit()
    {
        $_id = $_GET['id'];

        $query = "SELECT * FROM `items` WHERE id= :id";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $item = $stmt->fetch();
        return $item;

        // var_dump($item);
    }
    public function delete()
    {
        $_id = $_GET['id'];

        $query = "DELETE FROM `items` WHERE `items`. `id` = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();
        // var_dump( $result );

        header('location:trash_index.php');
    }
    public function update()
    {

        $_id = $_POST['id'];
        $_item = $_POST['item'];

        if (array_key_exists('is_active', $_POST)) {
            $_is_active = $_POST['is_active'];
        } else {
            $_is_active = 0;
        }

        $_modified_at = date("Y-m-d H:i:s");


        // Insert Query

        $query = "UPDATE `items` SET `item`= :item, `is_active`= :is_active WHERE `items`.`id`= :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':item', $_item);
        $stmt->bindParam(':is_active', $_is_active);
        $result = $stmt->execute();



        header('location:index.php');
    }
    public function trash()
    {
        $_id = $_GET['id'];
        $_is_deleted = 1;

        $query = "UPDATE `items` SET `is_deleted`= :is_deleted WHERE `items`.`id`= :id";

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
        $query = "SELECT * FROM `items` where is_deleted = 1";

        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();
        $items = $stmt->fetchAll();
        return $items;
    }
    public function restore()
    {

        $_id = $_GET['id'];
        $_is_deleted = 0;

        $query = "UPDATE `items` SET `is_deleted`= :is_deleted WHERE `items`.`id`= :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':is_deleted', $_is_deleted);

        $result = $stmt->execute();
        // var_dump( $result );

        header('location:index.php');

    }

    public function paginate($limit, $offset) {
        // Pagination query to fetch a subset of items
        $query = "SELECT * FROM `items` WHERE is_deleted = 0 LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $items = $stmt->fetchAll();
        return $items;
    }

    public function countTotalItems() {
        // Query to count total items
        $query = "SELECT COUNT(*) as total FROM `items` WHERE is_deleted = 0";
        $stmt = $this->conn->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    // code for search 
    public function searchItems($searchTerm, $itemsPerPage, $offset) {
        $searchTerm = "%{$searchTerm}%";
        $query = "SELECT * FROM `items` WHERE `item` LIKE :searchTerm LIMIT :offset, :itemsPerPage";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':searchTerm', $searchTerm);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
}