<?php
namespace App;

use PDO;

class products
{
    public $id = null;
    public $picture = null;
    public $product = null;
    public $purchase_price = null;
    public $price = null;
    public $quantity = null;
    public $color = null;
    public $size = null;
    public $unit = null;
    public $item = null;
    public $category = null;
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
    }


    public function store()
    {

        $approot = $_SERVER['DOCUMENT_ROOT'];

        // working with image
        $file_name = "IMG" . time() . "_" . $_FILES['picture']['name'];

        $target = $_FILES['picture']['tmp_name'];

        $destination = $approot . '/public/uploads/' . $file_name;

        $is_file_move = move_uploaded_file($target, $destination);

        if ($is_file_move) {
            $_picture = $file_name;
        } else {
            $_picture = null;
        }

        // $_picture= $_FILES['picture']['name'];
        $_product = $_POST['product'];
        $_purchase_price = $_POST['purchase_price'];
        $_price = $_POST['price'];
        $_quantity = $_POST['quantity'];
        $_color = $_POST['color'];
        $_size = $_POST['size'];
        $_unit = $_POST['unit'];
        $_item = $_POST['item'];
        $_category = $_POST['category'];
        $_warehouse = $_POST['warehouse'];

        if (array_key_exists('is_active', $_POST)) {
            $_is_active = $_POST['is_active'];
        } else {
            $_is_active = 0;
        }

        $_created_at = date("Y-m-d H:i:s");
        $challan_no = '123';


        // Insert Query

        $query = "INSERT INTO `products`( `picture`, `product`, `purchase_price`, `price`, `quantity`, `color`, `size`, `unit`, `item`, `category`, `warehouse`, `is_active`, `created_at`, `challan_no`) VALUES ( :picture, :product, :purchase_price, :price, :quantity, :color, :size, :unit, :item, :category, :warehouse, :is_active, :created_at, :challan_no )";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':picture', $_picture);
        $stmt->bindParam(':product', $_product);
        $stmt->bindParam(':purchase_price', $_purchase_price);
        $stmt->bindParam(':price', $_price);
        $stmt->bindParam(':quantity', $_quantity);
        $stmt->bindParam(':color', $_color);
        $stmt->bindParam(':size', $_size);
        $stmt->bindParam(':unit', $_unit);
        $stmt->bindParam(':item', $_item);
        $stmt->bindParam(':category', $_category);
        $stmt->bindParam(':warehouse', $_warehouse);
        $stmt->bindParam(':is_active', $_is_active);
        $stmt->bindParam(':challan_no', $challan_no);
        $stmt->bindParam(':created_at', $_created_at);

        $result = $stmt->execute();

        // var_dump($result);

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
        $query = "SELECT * FROM `products` where is_deleted = 0";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }
    public function show()
    {

        $_id = $_GET['id'];

        // $query = "SELECT * FROM `products` WHERE id= :id";

        $query = "SELECT p.*, c.color, c.id AS color_id , s.size, s.id AS size_id, u.unit, u.id AS unit_id, i.item, i.id AS item_id,
        cat.category, cat.id AS category_id, war.warehouse, war.id AS warehouse_id
        FROM `products` AS p
        
        LEFT JOIN `colors` AS c
        ON p.color = c.id
        LEFT JOIN `sizes` AS s
        ON p.size = s.id
        LEFT JOIN `units` AS u
        ON p.unit = u.id
        LEFT JOIN `items` AS i
        ON p.item = i.id
        LEFT JOIN `categories` AS cat
        ON p.category = cat.id
        LEFT JOIN `warehouses` AS war
        ON p.warehouse = war.id
        WHERE p.id = :id;";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $product = $stmt->fetch();
        return $product;

        //var_dump($product);
    }
    public function edit()
    {

        $_id = $_GET['id'];

        $query = "SELECT p.*, c.color, c.id AS color_id , s.size, s.id AS size_id, u.unit, u.id AS unit_id, i.item, i.id AS item_id,
        cat.category, cat.id AS category_id, war.warehouse, war.id AS warehouse_id
        FROM `products` AS p
        LEFT JOIN `colors` AS c
        ON p.color = c.id
        LEFT JOIN `sizes` AS s
        ON p.size = s.id
        LEFT JOIN `units` AS u
        ON p.unit = u.id
        LEFT JOIN `items` AS i
        ON p.item = i.id
        LEFT JOIN `categories` AS cat
        ON p.category = cat.id
        LEFT JOIN `warehouses` AS war
        ON p.warehouse = war.id

        WHERE p.id = :id;";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $product = $stmt->fetch();
        return $product;
    }
    public function restore()
    {
        $_id = $_GET['id'];
        $_is_deleted = 0;

        $query = "UPDATE `products` SET `is_deleted`= :is_deleted WHERE `products`.`id`= :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':is_deleted', $_is_deleted);

        $result = $stmt->execute();
        // var_dump( $result );

        header('location:index.php');
    }
    public function delete()
    {
        $_id = $_GET['id'];

        $query = "DELETE FROM `products` WHERE `products`. `id` = :id";

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


        $query = "UPDATE `products` SET `is_deleted`= :is_deleted WHERE `products`.`id`= :id";

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
        $query = "SELECT * FROM `products` where is_deleted = 1";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }
    public function update()
    {

        $approot = $_SERVER['DOCUMENT_ROOT'];
        // working with image

        if ($_FILES['picture']['name'] != "") {
            $file_name = "IMG" . time() . "_" . $_FILES['picture']['name'];

            $target = $_FILES['picture']['tmp_name'];

            $destination = $approot . '/public/uploads/' . $file_name;

            $is_file_move = move_uploaded_file($target, $destination);

            if ($is_file_move) {
                $_picture = $file_name;
            } else {
                $_picture = null;
            }
        } else {
            $_picture = $_POST['old_picture'];
        }

        $_id = $_POST['id'];
        $_product = $_POST['product'];
        $_purchase_price = $_POST['purchase_price'];
        $_price = $_POST['price'];
        $_quantity = $_POST['quantity'];
        $_color = $_POST['color'];
        $_size = $_POST['size'];
        $_unit = $_POST['unit'];
        $_item = $_POST['item'];
        $_category = $_POST['category'];
        $_warehouse = $_POST['warehouse'];

        if (array_key_exists('is_active', $_POST)) {
            $_is_active = $_POST['is_active'];
        } else {
            $_is_active = 0;
        }

        $_modified_at = date("Y-m-d H:i:s");


        // Insert Query

        $query = "UPDATE `products` SET `picture`= :picture, `product`= :product,  `purchase_price`= :purchase_price, `price`= :price, `quantity`= :quantity, `color`= :color, `size`= :size, `unit`= :unit, `item`= :item, `category`= :category , `warehouse`= :warehouse, `is_active`= :is_active WHERE `products`.`id`= :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':picture', $_picture);
        $stmt->bindParam(':product', $_product);
        $stmt->bindParam(':purchase_price', $_purchase_price);
        $stmt->bindParam(':price', $_price);
        $stmt->bindParam(':quantity', $_quantity);
        $stmt->bindParam(':color', $_color);
        $stmt->bindParam(':size', $_size);
        $stmt->bindParam(':unit', $_unit);
        $stmt->bindParam(':item', $_item);
        $stmt->bindParam(':category', $_category);
        $stmt->bindParam(':warehouse', $_warehouse);
        $stmt->bindParam(':is_active', $_is_active);

        $result = $stmt->execute();

        header('location:index.php');
    }

    public function paginate($limit, $offset)
    {
        // Pagination query to fetch a subset of products
        $query = "SELECT * FROM `products` where is_deleted = 0 LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }

    public function countTotalProducts()
    {
        // Query to count total products
        $query = "SELECT COUNT(*) as total FROM `products` where is_deleted = 0";
        $stmt = $this->conn->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function normalStockProducts()
    {
        $query = "SELECT * FROM `products` WHERE is_deleted = 0 AND quantity >= 10";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $normalProducts = $stmt->fetchAll();
        return $normalProducts;
    }
    public function lowStockProducts()
    {
        $query = "SELECT * FROM `products` WHERE is_deleted = 0 AND quantity < 10 AND quantity != 0";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $lowStockProducts = $stmt->fetchAll();
        return $lowStockProducts;
    }
    public function stockOutProducts()
    {
        $query = "SELECT * FROM `products` WHERE is_deleted = 0 AND quantity = 0";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $outOfStockProducts = $stmt->fetchAll();
        return $outOfStockProducts;
    }


    public function getCategories()
    {
        $query = "SELECT * FROM `categories` where is_deleted = 0";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $categories = $stmt->fetchAll();

        return $categories;
    }
    public function getItems()
    {
        $query = "SELECT * FROM `items` where is_deleted = 0";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $items = $stmt->fetchAll();

        return $items;
    }
    public function getWarehouses()
    {
        $query = "SELECT * FROM `warehouses` where is_deleted = 0";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $warehouses = $stmt->fetchAll();

        return $warehouses;
    }

    public function getColors()
    {
        $query = "SELECT * FROM `colors` where is_deleted = 0";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $colors = $stmt->fetchAll();

        return $colors;
    }

    public function getSizes()
    {
        $query = "SELECT * FROM `sizes` where is_deleted = 0";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $sizes = $stmt->fetchAll();

        return $sizes;
    }

    public function getUnits()
    {
        $query = "SELECT * FROM `units` where is_deleted = 0";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $units = $stmt->fetchAll();

        return $units;
    }

}