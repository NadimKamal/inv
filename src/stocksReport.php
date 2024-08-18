<?php
namespace App;

use PDO;

class stocksReport
{
    public $id = null;
    public $stocksReport = null;
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


    public function index()
    {

        //Insert Query
        $query = "SELECT * FROM `stocks_report`";

        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();
        $stocksReport = $stmt->fetchAll();

        return $stocksReport;
    }

    public function getFilteredData($post_data)
    {
        $query = "SELECT * FROM `products` where is_deleted = 0";
        $statement = $this->conn->prepare($query);
        // var_dump($post_data);
        if ($post_data['category'] && $post_data['warehouse'] && $post_data['stock']) { 
                if ($post_data['stock'] == 0) {
                $category_id = $post_data['category'];
                $warehouse = $post_data['warehouse'];
                $query = "SELECT * FROM products WHERE  `category` = :category_id AND `warehouse` = :warehouse AND `quantity` = 0";
                $statement = $this->conn->prepare($query);
                $statement->bindParam(":category_id", $category_id);
                $statement->bindParam(":warehouse", $warehouse);

            } else if ($post_data['stock'] == 1) {
                $category_id = $post_data['category'];
                $warehouse = $post_data['warehouse'];
                $query = "SELECT * FROM products WHERE  `category` = :category_id AND `warehouse` = :warehouse AND `quantity` BETWEEN 1 AND 9";
                $statement = $this->conn->prepare($query);
                $statement->bindParam(":category_id", $category_id);
                $statement->bindParam(":warehouse", $warehouse);
            } else {
                $category_id = $post_data['category'];
                $warehouse = $post_data['warehouse'];
                $query = "SELECT * FROM products WHERE  `category` = :category_id AND `warehouse` = :warehouse AND `quantity` >= 10";
                $statement = $this->conn->prepare($query);
                $statement->bindParam(":category_id", $category_id);
                $statement->bindParam(":warehouse", $warehouse);

            }

        } else if ($post_data['category'] && $post_data['warehouse']) {
            $category_id = $post_data['category'];
            $warehouse = $post_data['warehouse'];
            $query = "SELECT * FROM products WHERE `category` = :category_id AND `warehouse` = :warehouse";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(":category_id", $category_id);
            $statement->bindParam(":warehouse", $warehouse);

        } else if ($post_data['category'] && $post_data['stock']) {
            
            if ($post_data['stock'] == 0) {
                $category_id = $post_data['category'];
                $query = "SELECT * FROM products WHERE `category` = :category_id AND `quantity` = 0";
                $statement = $this->conn->prepare($query);
                $statement->bindParam(":category_id", $category_id);

            } else if ($post_data['stock'] == 1) {
                $category_id = $post_data['category'];
                $query = "SELECT * FROM products WHERE `category` = :category_id AND `quantity` BETWEEN 1 AND 9";
                $statement = $this->conn->prepare($query);
                $statement->bindParam(":category_id", $category_id);

            } else {
                $category_id = $post_data['category'];
                $query = "SELECT * FROM products WHERE `category` = :category_id AND `quantity` >= 10";
                $statement = $this->conn->prepare($query);
                $statement->bindParam(":category_id", $category_id);
            }

        } else if ($post_data['warehouse'] && $post_data['stock']) {
            if ($post_data['stock'] == 0) {
                $warehouse = $post_data['warehouse'];
                $query = "SELECT * FROM products WHERE `warehouse` = :warehouse AND `quantity` = 0";
                $statement = $this->conn->prepare($query);
                $statement->bindParam(":warehouse", $warehouse);

            } else if ($post_data['stock'] == 1) {
                $warehouse = $post_data['warehouse'];
                $query = "SELECT * FROM products WHERE `warehouse` = :warehouse AND `quantity` BETWEEN 1 AND 9";
                $statement = $this->conn->prepare($query);
                $statement->bindParam(":warehouse", $warehouse);

            } else {
                $warehouse = $post_data['warehouse'];
                $query = "SELECT * FROM products WHERE `warehouse` = :warehouse AND `quantity` >= 10";
                $statement = $this->conn->prepare($query);
                $statement->bindParam(":warehouse", $warehouse);
            }
            
        } else if ($post_data['category']) {
            $category_id = $post_data['category'];
            $query = "SELECT * FROM products WHERE `category` = :category_id";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(":category_id", $category_id);

        } else if ($post_data['stock']) {
            if ($post_data['stock'] == 0) {
                $query = "SELECT * FROM products WHERE `quantity` = 0";
                $statement = $this->conn->prepare($query);
            } else if ($post_data['stock'] == 1) {
                $query = "SELECT * FROM products WHERE `quantity` BETWEEN 1 AND 9";
                $statement = $this->conn->prepare($query);
            } else {
                $query = "SELECT * FROM products WHERE `quantity` >= 10";
                $statement = $this->conn->prepare($query);
            }
        } else if ($post_data['warehouse']) {
            $warehouse = $post_data['warehouse'];
            $query = "SELECT * FROM products WHERE `warehouse` = :warehouse";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(":warehouse", $warehouse);


        } else {
            $query = "SELECT * FROM `products` where is_deleted = 0";
            $statement = $this->conn->prepare($query);

        }

        $statement->execute();
        $filteredData = $statement->fetchAll();
        return $filteredData;

    }

}





























// if ($stock == 0) {
//     $query = "SELECT * FROM products WHERE `quantity` = 0";
//     $statement = $this->conn->prepare($query);
// } else if ($stock == 1) {
//     $query = "SELECT * FROM products WHERE `quantity` BETWEEN 1 AND 9";
//     $statement = $this->conn->prepare($query);
// } else {
//     $query = "SELECT * FROM products WHERE `quantity` >= 10";
//     $statement = $this->conn->prepare($query);
// }