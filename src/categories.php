<?php
namespace App;

use PDO;

class categories
{
    public $id = null;
    public $category = null;
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
            //  sets the PDO error mode to throw exceptions
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $_category = $_POST['category'];
    
            if (array_key_exists('is_active', $_POST)) {
                $_is_active = $_POST['is_active'];
            } else {
                $_is_active = 0;
            }
    
            $_created_at = date("Y-m-d H:i:s");
    
            // Check if the category already exists
            $checkQuery = "SELECT COUNT(*) FROM `categories` WHERE `category` = :category";
            $checkStmt = $this->conn->prepare($checkQuery);
            $checkStmt->bindParam(':category', $_category);
            $checkStmt->execute();
            $categoryExists = $checkStmt->fetchColumn();
    
            if ($categoryExists > 0) {
                $msg = "This category is already there!";
                header('Location: index.php?msg=' . urlencode($msg));
                exit();
            }
    
            // Insert Query
            $query = "INSERT INTO `categories`(`category`, `is_active`, `created_at`) VALUES (:category, :is_active, :created_at)";
            $stmt = $this->conn->prepare($query);
    
            $stmt->bindParam(':category', $_category);
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
        $query = "SELECT * FROM `categories` where is_deleted = 0";

        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();
        $categories = $stmt->fetchAll();

        return $categories;
    }
    public function show()
    {
        $_id = $_GET['id'];

        $query = "SELECT * FROM `categories` WHERE id= :id";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $category = $stmt->fetch();
        return $category;

        //var_dump($category);
    }
    public function edit()
    {
        $_id = $_GET['id'];

        $query = "SELECT * FROM `categories` WHERE id= :id";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $category = $stmt->fetch();
        return $category;

        // var_dump($category);
    }
    public function update()
    {
        $_id = $_POST['id'];
        $_category = $_POST['category'];

        if (array_key_exists('is_active', $_POST)) {
            $_is_active = $_POST['is_active'];
        } else {
            $_is_active = 0;
        }

        $_modified_at = date("Y-m-d H:i:s");

        $_status = $_POST['status'];

        // Insert Query

        $query = "UPDATE `categories` SET `category`= :category, `is_active`= :is_active, `status`= :status WHERE `categories`.`id`= :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':category', $_category);
        $stmt->bindParam(':is_active', $_is_active);
        $stmt->bindParam(':status', $_status);
        $result = $stmt->execute();



        header('location:index.php');
    }
    public function delete()
    {
        $_id = $_GET['id'];

        $query = "DELETE FROM `categories` WHERE `categories`. `id` = :id";

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

        $query = "UPDATE `categories` SET `is_deleted`= :is_deleted WHERE `categories`.`id`= :id";

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
        $query = "SELECT * FROM `categories` where is_deleted = 1";

        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
    }
    public function restore()
    {

        $_id = $_GET['id'];
        $_is_deleted = 0;

        $query = "UPDATE `categories` SET `is_deleted`= :is_deleted WHERE `categories`.`id`= :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':is_deleted', $_is_deleted);

        $result = $stmt->execute();
        // var_dump( $result );

        header('location:index.php');

    }

    public function paginate($limit, $offset)
    {
        // Pagination query to fetch a subset of categories
        $query = "SELECT * FROM `categories` WHERE is_deleted = 0 LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
    }

    public function countTotalCategories()
    {
        // Query to count total categories
        $query = "SELECT COUNT(*) as total FROM `categories` WHERE is_deleted = 0";
        $stmt = $this->conn->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
    public function searchCategories($searchTerm, $categoriesPerPage, $offset)
    {
        $searchTerm = "%{$searchTerm}%";
        $query = "SELECT * FROM `categories` WHERE `category` LIKE :searchTerm LIMIT :offset, :categoriesPerPage";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':searchTerm', $searchTerm);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':categoriesPerPage', $categoriesPerPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCategory($category_id)
    {
        $query = "SELECT * FROM categories WHERE `id` = :category_id";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":category_id", $category_id);
        $statement->execute();
        $filteredData = $statement->fetch();

        return $filteredData['category'];
    }

}