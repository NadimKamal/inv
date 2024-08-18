<?php
namespace App;

use PDO;

class warehouses
{
    public $id = null;
    public $warehouse = null;
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
        try {
            // Enable PDO error reporting
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $_warehouse = $_POST['warehouse'];
    
            if (array_key_exists('is_active', $_POST)) {
                $_is_active = $_POST['is_active'];
            } else {
                $_is_active = 0;
            }
    
            $_created_at = date("Y-m-d H:i:s");
            $_status = $_POST['status'];
    
            // Check if the warehouse already exists
            $checkQuery = "SELECT COUNT(*) FROM `warehouses` WHERE `warehouse` = :warehouse";
            $checkStmt = $this->conn->prepare($checkQuery);
            $checkStmt->bindParam(':warehouse', $_warehouse);
            $checkStmt->execute();
            $warehouseExists = $checkStmt->fetchColumn();
    
            if ($warehouseExists > 0) {
                // Warehouse already exists
                $msg = "This warehouse is already there!";
                header('Location: index.php?msg=' . urlencode($msg));
                exit();
            }
    
            // Insert Query
            $query = "INSERT INTO `warehouses`(`warehouse`, `is_active`, `created_at`, `status`) VALUES (:warehouse, :is_active, :created_at, :status)";
            $stmt = $this->conn->prepare($query);
    
            $stmt->bindParam(':warehouse', $_warehouse);
            $stmt->bindParam(':is_active', $_is_active);
            $stmt->bindParam(':created_at', $_created_at);
            $stmt->bindParam(':status', $_status);
    
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
        $query = "SELECT * FROM `warehouses` where is_deleted = 0";

        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();
        $warehouses = $stmt->fetchAll();

        return $warehouses;
    }
    public function show()
    {
        $_id = $_GET['id'];

        $query = "SELECT * FROM `warehouses` WHERE id= :id";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $warehouse = $stmt->fetch();
        return $warehouse;

        //var_dump($warehouse);
    }
    public function edit()
    {
        $_id = $_GET['id'];

        $query = "SELECT * FROM `warehouses` WHERE id= :id";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $warehouse = $stmt->fetch();
        return $warehouse;

        // var_dump($warehouse);
    }
    public function update()
    {

        $_id = $_POST['id'];
        $_warehouse = $_POST['warehouse'];

        if (array_key_exists('is_active', $_POST)) {
            $_is_active = $_POST['is_active'];
        } else {
            $_is_active = 0;
        }

        $_modified_at = date("Y-m-d H:i:s");

        // $_status = $_POST['status'];

        // Insert Query

        $query = "UPDATE `warehouses` SET `warehouse`= :warehouse, `is_active`= :is_active, `status`= :status WHERE `warehouses`.`id`= :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':warehouse', $_warehouse);
        $stmt->bindParam(':is_active', $_is_active);
        $stmt->bindParam(':status', $_status);
        $result = $stmt->execute();



        header('location:index.php');
    }
    public function delete()
    {
        $_id = $_GET['id'];

        $query = "DELETE FROM `warehouses` WHERE `warehouses`. `id` = :id";

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

        $query = "UPDATE `warehouses` SET `is_deleted`= :is_deleted WHERE `warehouses`.`id`= :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':is_deleted', $_is_deleted);

        $result = $stmt->execute();
        // var_dump( $result );

        header('location:index.php');
    }
    public function trash_index(){

        //Insert Query
    $query= "SELECT * FROM `warehouses` where is_deleted = 1";

    $stmt= $this->conn->prepare($query);

    $result= $stmt->execute();
    $warehouses= $stmt->fetchAll();
    return $warehouses;
    }
    public function restore(){
        
    $_id = $_GET['id'];
    $_is_deleted = 0;

    $query = "UPDATE `warehouses` SET `is_deleted`= :is_deleted WHERE `warehouses`.`id`= :id";

    $stmt = $this->conn->prepare($query);  

    $stmt->bindParam(':id', $_id);
    $stmt->bindParam(':is_deleted', $_is_deleted);

$result = $stmt->execute();
// var_dump( $result );

header('location:index.php');

    }

    public function paginate($limit, $offset) {
        // Pagination query to fetch a subset of warehouses
        $query = "SELECT * FROM `warehouses` WHERE is_deleted = 0 LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $warehouses = $stmt->fetchAll();
        return $warehouses;
    }

    public function countTotalWarehouses() {
        // Query to count total warehouses
        $query = "SELECT COUNT(*) as total FROM `warehouses` WHERE is_deleted = 0";
        $stmt = $this->conn->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    
    
    public function getWarehouse($warehouse_id)
    {
        $query = "SELECT * FROM warehouses WHERE `id` = :warehouse_id";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":warehouse_id", $warehouse_id);
        $statement->execute();
        $filterData = $statement->fetch();
        
        if ($filterData && is_array($filterData)) {
            return $filterData['warehouse'];
        } else {
            return null; // or any default value you prefer
        }
    }
    
}