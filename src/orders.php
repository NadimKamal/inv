<?php
namespace App;

use PDO;

class orders
{
    public $id = null;
    public $c_name = null;
    public $c_address = null;
    public $c_phone = null;
    public $product = null;
    public $quantity = null;
    public $rate = null;
    public $amount = null;
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
        // Retrives data from an html form submitted via POST
        $_c_name = $_POST['c_name'];
        $_c_address = $_POST['c_address'];
        $_c_phone = $_POST['c_phone'];
        $_product = $_POST['product'];
        $product_details = $this->getProductDetails($_product);
        $_product_name = $product_details['product'];
        $_challan_no = $_POST['challan_no'];
        $_quantity = intval($_POST['quantity']);
        $_rate = intval($_POST['rate']);
        $_purchasing_price = intval($_POST['purchasing_price']);
        $_selling_price = intval($_POST['selling_price']);
        $_amount = $_quantity * $_rate; 

        // Check if all required fields are provided
        if ($_c_name !== false && $_c_address !== false && $_c_phone !== false && $_product !== false && $_quantity !== false && $_rate !== false) {

            $_is_active = isset($_POST['is_active']) ? 1 : 0;

            $_created_at = date("Y-m-d H:i:s");
            
            $order_query = "INSERT INTO `orders`(`c_name`, `c_address`, `c_phone`, `product`, `product_name`, `quantity`, `rate`, `amount`, `is_active`, `created_at`) 
            VALUES (:c_name, :c_address, :c_phone, :product, :product_name, :quantity, :rate, :amount, :is_active, :created_at)";

            $order_stmt = $this->conn->prepare($order_query);


            $order_stmt->bindParam(':c_name', $_c_name);
            $order_stmt->bindParam(':c_address', $_c_address);
            $order_stmt->bindParam(':c_phone', $_c_phone);
            $order_stmt->bindParam(':product', $_product);
            $order_stmt->bindParam(':product_name', $_product_name);
            $order_stmt->bindParam(':quantity', $_quantity);
            $order_stmt->bindParam(':rate', $_rate);
            $order_stmt->bindParam(':amount', $_amount);
            $order_stmt->bindParam(':is_active', $_is_active);
            $order_stmt->bindParam(':created_at', $_created_at);

            // Execute query for orders table
            $order_result = $order_stmt->execute();
            $order_id = $this->conn->lastInsertId(); // Get the last inserted order ID

            if ($order_result) {

                // Update product quantity
                $product_query = "UPDATE `products` SET `quantity` = `quantity` - :quantity, `modified_at` = :modified_at WHERE `id` = :product_id";

                $product_stmt = $this->conn->prepare($product_query);

                $product_stmt->bindParam(':product_id', $_product);
                $product_stmt->bindParam(':quantity', $_quantity);
                $product_stmt->bindParam(':modified_at', $_created_at);

                $product_execution = $product_stmt->execute();

                if (!$product_execution) {
                    // Handle product quantity update failure
                    // Rollback the order or handle the error as appropriate
                }

                // Insert into sales_report if product is not already in sales table
                $search_product_query = "SELECT * FROM products WHERE id = :product_id";
                $search_product_stmt = $this->conn->prepare($search_product_query);
                $search_product_stmt->bindParam(':product_id', $_product);
                $search_product_stmt->execute();
                $get_product = $search_product_stmt->fetch();

                $search_query = "SELECT * FROM sales_report WHERE product_id = :product_id";
                $search_stmt = $this->conn->prepare($search_query);
                $search_stmt->bindParam(':product_id', $_product);
                $search_stmt->execute();
                $product_in_sales = $search_stmt->fetch();

                if (!$product_in_sales) {
                    $_updated_at = date("Y-m-d H:i:s");
                    $vat = $_amount * 0.05;
                    $profit = ($_selling_price - $_purchasing_price) * $_quantity;

                    
                    $sales_report_query = "INSERT INTO sales_report (product_id, order_id, product_name, challan_no, purchasing_price, selling_price, total_sold_quantity, total_sold_price, profit, vat, created_at, updated_at) 
                    VALUES (:product_id, :order_id, :product_name, :challan_no, :purchasing_price, :selling_price, :total_sold_quantity, :total_sold_price, :profit, :vat, :created_at, :updated_at)";

                    $sales_report_stmt = $this->conn->prepare($sales_report_query);

                    $sales_report_stmt->bindParam(':product_id', $_product);
                    $sales_report_stmt->bindParam(':order_id', $order_id);
                    $sales_report_stmt->bindParam(':product_name', $_product_name);
                    $sales_report_stmt->bindParam(':challan_no', $_challan_no);
                    $sales_report_stmt->bindParam(':purchasing_price', $_purchasing_price);
                    $sales_report_stmt->bindParam(':selling_price', $_selling_price);
                    $sales_report_stmt->bindParam(':total_sold_quantity', $_quantity);
                    $sales_report_stmt->bindParam(':total_sold_price', $_amount);
                    $sales_report_stmt->bindParam(':profit', $profit);
                    $sales_report_stmt->bindParam(':vat', $vat);
                    $sales_report_stmt->bindParam(':created_at', $_created_at);
                    $sales_report_stmt->bindParam(':updated_at', $_updated_at);

                    $sales_report_result = $sales_report_stmt->execute();
                } else {
                    $_quantity_in_sales = $product_in_sales['total_sold_quantity'] + $_quantity;
                    $_new_sold_price = $product_in_sales['total_sold_price'] + $_amount;
                    $_new_vat = $product_in_sales['vat'] + ($_amount * 0.05);
                    $_new_profit = $product_in_sales['profit'] + (($get_product['price'] - $get_product['purchase_price']) * $_quantity);
                    $sales_report_query = "UPDATE sales_report SET `total_sold_quantity` = :total_sold_quantity, `total_sold_price` = :total_sold_price, `profit` = :profit, `vat` = :vat, `updated_at` = :updated_at WHERE `product_id` = :product_id";

                    $sales_report_stmt = $this->conn->prepare($sales_report_query);

                    $sales_report_stmt->bindParam(':total_sold_quantity', $_quantity_in_sales);
                    $sales_report_stmt->bindParam(':total_sold_price', $_new_sold_price);
                    $sales_report_stmt->bindParam(':profit', $_new_profit);
                    $sales_report_stmt->bindParam(':vat', $_new_vat);
                    $sales_report_stmt->bindParam(':product_id', $get_product['id']);
                    $sales_report_stmt->bindParam(':updated_at', $_updated_at);
                    $sales_report_result = $sales_report_stmt->execute();

                }
            } else {
                // Handle order insertion failure
            }
        } else {
            // Handle missing or invalid input data
        }

        // Redirect to appropriate page
        if ($order_result) {
            $msg = "Successfully Stored!";
            header('Location: index.php?msg=' . urlencode($msg));
            exit();
        }
    }

    // this is for my challan.php
    public function getOrderById($id)
    {
        // Use a prepared statement to prevent SQL injection
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function index()
    {

        //Insert Query
        $query = "SELECT * FROM `orders` where is_deleted = 0";

        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();
        $orders = $stmt->fetchAll();

        return $orders;
    }
    public function show()
    {
        $_id = $_GET['id'];

        $query = "SELECT o.*, pr.id AS product_id
        FROM `orders` AS o
        LEFT JOIN `products` AS pr
        ON o.product = pr.product  -- Corrected join condition
        WHERE o.id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $order = $stmt->fetch();
        return $order;

        //var_dump($order);
    }
    public function edit()
    {
        $_id = $_GET['id'];

        $query = "SELECT * FROM `orders` WHERE id= :id";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $order = $stmt->fetch();
        return $order;

    }
    public function update()
    {

        $_id = $_POST['id'];
        $_c_name = $_POST['c_name'];
        $_c_address = $_POST['c_address'];
        $_c_phone = $_POST['c_phone'];
        // $_product = $_POST['product'];
        // $_quantity = $_POST['quantity'];
        // $_rate = $_POST['rate'];
        // $_amount = $_POST['amount'];

        if (array_key_exists('is_active', $_POST)) {
            $_is_active = $_POST['is_active'];
        } else {
            $_is_active = 0;
        }

        $_modified_at = date("Y-m-d H:i:s");

        // $_status = $_POST['status'];

        // Insert Query

        $query = "UPDATE `orders` SET `c_name`= :c_name, `c_address`= :c_address,`c_phone`= :c_phone,  `is_active`= :is_active WHERE `orders`.`id`= :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':c_name', $_c_name);
        $stmt->bindParam(':c_address', $_c_address);
        $stmt->bindParam(':c_phone', $_c_phone);
        // $stmt->bindParam(':product', $_product);
        // $stmt->bindParam(':quantity', $_quantity);
        // $stmt->bindParam(':rate', $_rate);
        // $stmt->bindParam(':amount', $_amount);
        $stmt->bindParam(':is_active', $_is_active);

        $result = $stmt->execute();



        header('location:index.php');
    }
    public function delete()
    {
        $_id = $_GET['id'];

        $query = "DELETE FROM `orders` WHERE `orders`. `id` = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        header('location:trash_index.php');
    }
    public function trash()
    {
        $_id = $_GET['id'];
        $_is_deleted = 1;
        $_updated_at = date("Y-m-d H:i:s");

        $query = "UPDATE `orders` SET `is_deleted`= :is_deleted WHERE `orders`.`id`= :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':is_deleted', $_is_deleted);

        $queryResult = $stmt->execute();

        $searchQuery = "SELECT * FROM orders WHERE id = " . $_id;
        $searchStmt = $this->conn->prepare($searchQuery);

        $searchStmt->execute();
        $queryResultOutput = $searchStmt->fetch();


        if ($queryResult) {
            // Update product quantity
            $product = $this->getProductDetails($queryResultOutput['product']);
            $_new_quantity_in_products = $product['quantity'] + $queryResultOutput['quantity'];
            // var_dump($product['id']);
            $product_query = "UPDATE `products` SET `quantity` = :quantity, `modified_at` = :modified_at WHERE `id` = :product_id";

            $product_stmt = $this->conn->prepare($product_query);
            $product_stmt->bindParam(':product_id', $product['id']);
            $product_stmt->bindParam(':quantity', $_new_quantity_in_products);
            $product_stmt->bindParam(':modified_at', $_updated_at);

            $product_execution = $product_stmt->execute();

            if (!$product_execution) {
                // Handle product quantity update failure
                // Rollback the order or handle the error as appropriate
            }

            $search_query = "SELECT * FROM sales_report WHERE product_id = :product_id";
            $search_stmt = $this->conn->prepare($search_query);
            $search_stmt->bindParam(':product_id', $product['id']);
            $search_stmt->execute();
            $product_in_sales = $search_stmt->fetch();

            // If the product exists in the sales report, update the record
            if ($product_in_sales) {
                $_quantity_in_sales = $product_in_sales['total_sold_quantity'] - $queryResultOutput['quantity'];
                $_new_sold_price = $product_in_sales['total_sold_price'] - ($queryResultOutput['amount']);
                $_new_vat = $product_in_sales['vat'] - ($queryResultOutput['amount'] * 0.05);
                $_new_profit = $product_in_sales['profit'] - (($queryResultOutput['rate'] - $product['purchase_price']) * $queryResultOutput['quantity']);

                $sales_report_query = "UPDATE sales_report SET `total_sold_quantity` = :total_sold_quantity, `total_sold_price` = :total_sold_price, `profit` = :profit, `vat` = :vat, `updated_at` = :updated_at  WHERE `product_id` = :product_id";

                $sales_report_stmt = $this->conn->prepare($sales_report_query);

                $sales_report_stmt->bindParam(':total_sold_quantity', $_quantity_in_sales);
                $sales_report_stmt->bindParam(':total_sold_price', $_new_sold_price);
                $sales_report_stmt->bindParam(':profit', $_new_profit);
                $sales_report_stmt->bindParam(':vat', $_new_vat);
                $sales_report_stmt->bindParam(':product_id', $product['id']);
                $sales_report_stmt->bindParam(':updated_at', $_updated_at);

                $sales_report_result = $sales_report_stmt->execute();
            }



        } else {
            echo "not working";
        }

        header('location:index.php');
    }
    public function trash_index()
    {

        //Insert Query
        $query = "SELECT * FROM `orders` where is_deleted = 1";

        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();
        $orders = $stmt->fetchAll();
        return $orders;
    }
    public function restore()
    {

        $_id = $_GET['id'];
        $_is_deleted = 0;

        $query = "UPDATE `orders` SET `is_deleted`= :is_deleted WHERE `orders`.`id`= :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':is_deleted', $_is_deleted);

        $result = $stmt->execute();

        $searchQuery = "SELECT * FROM orders WHERE id = " . $_id;
        $searchStmt = $this->conn->prepare($searchQuery);

        $searchStmt->execute();
        $queryResultOutput = $searchStmt->fetch();

        if ($queryResultOutput) {
            $_updated_at = date("Y-m-d H:i:s");
            $product = $this->getProductDetails($queryResultOutput['product']);

            $_new_quantity_in_products = $product['quantity'] + $queryResultOutput['quantity'];

            $product_query = "UPDATE `products` SET `quantity` = :quantity, `modified_at` = :modified_at WHERE `id` = :product_id";

            $product_stmt = $this->conn->prepare($product_query);
            $product_stmt->bindParam(':product_id', $product['id']);
            $product_stmt->bindParam(':quantity', $_new_quantity_in_products);
            $product_stmt->bindParam(':modified_at', $_updated_at);

            $product_query_execution = $product_stmt->execute();

            if (!$product_query_execution) {
                // Handle product quantity update failure
                // Rollback the order or handle the error as appropriate
            }


            $search_query = "SELECT * FROM sales_report WHERE product_id = :product_id";
            $search_stmt = $this->conn->prepare($search_query);
            $search_stmt->bindParam(':product_id', $product['id']);
            $search_stmt->execute();
            $product_in_sales = $search_stmt->fetch();
            
            if ($product_in_sales) {
                $_quantity_in_sales = $product_in_sales['total_sold_quantity'] + $queryResultOutput['quantity'];
                $_new_sold_price = $product_in_sales['total_sold_price'] + ($queryResultOutput['amount']);
                $_new_vat = $product_in_sales['vat'] + ($queryResultOutput['amount'] * 0.05);
                $_new_profit = $product_in_sales['profit'] + (($queryResultOutput['rate'] - $product['purchase_price']) * $queryResultOutput['quantity']);

                $sales_report_query = "UPDATE sales_report SET `total_sold_quantity` = :total_sold_quantity, `total_sold_price` = :total_sold_price, `profit` = :profit, `vat` = :vat, `updated_at` = :updated_at  WHERE `product_id` = :product_id";

                $sales_report_stmt = $this->conn->prepare($sales_report_query);

                $sales_report_stmt->bindParam(':total_sold_quantity', $_quantity_in_sales);
                $sales_report_stmt->bindParam(':total_sold_price', $_new_sold_price);
                $sales_report_stmt->bindParam(':profit', $_new_profit);
                $sales_report_stmt->bindParam(':vat', $_new_vat);
                $sales_report_stmt->bindParam(':product_id', $product['id']);
                $sales_report_stmt->bindParam(':updated_at', $_updated_at);


                $sales_report_result = $sales_report_stmt->execute();
            }
        }


        header('location:index.php');

    }
    public function paginateOrders($perPage, $offset)
    {
        // Query to fetch orders for the current page with pagination
        $query = "SELECT * FROM `orders` WHERE is_deleted = 0 LIMIT :perPage OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $orders = $stmt->fetchAll();

        return $orders;
    }

    public function countTotalOrders()
    {
        // Query to count total orders
        $query = "SELECT COUNT(*) as total FROM `orders` WHERE is_deleted = 0";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result['total'];
    }

    public function getProducts()
    {
        $query = "SELECT * FROM `products` where is_deleted = 0";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }

    public function getProductDetails($productId)
    {
        if (isset($productId)) {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            // Query to fetch quantity of the selected product
            $query = "SELECT * FROM products WHERE id = " . $productId;
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute();

            $product = $stmt->fetch();
            return $product;
        }
    }

}
