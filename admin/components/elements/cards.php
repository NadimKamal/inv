<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");
use App\categories;

$_category = new categories();
$categories = $_category->index();

?>

<?php $title = 'Items';

include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");

use App\items;

$_item = new items();
$items = $_item->index();

?>

<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");

use App\orders;

$_order = new orders();
$orders = $_order->index();

?>

<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");

use App\products;

$_product = new products();
$products = $_product->index();

?>


<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");

use App\warehouses;

$_warehouse = new warehouses();
$warehouses = $_warehouse->index();

?>


<div class="row row-cols-1 row-cols-md-4 g-4">
    <!-- cards -->
    <div class="col-md-3">
        <div class="card card-1 h-100 w-100">
            <!-- Applying the background color to the first card -->
            <div class="card-header">
                <i class="fa-solid fa-bag-shopping"></i>
                Total Items
            </div>
            <div class="card-body">
                <span class="custom-card-text"><?php echo count($items); ?></span>
            </div>
            <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/items/index.php' ?>" class="card-footer text-right text-none">More Info &rarr;</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-2 h-100 w-100">
            <!-- Applying the background color to the second card -->
            <div class="card-header">
                <i class="fa-solid fa-bag-shopping"></i>
                Total Category
            </div>
            <div class="card-body">
                <span class="custom-card-text"><?php echo count($categories); ?></span>
            </div>
            <a href="../admin/categories/index.php" class="card-footer text-right text-none">More Info &rarr;</a>
        </div>


    </div>
    <div class="col-md-3">
        <div class="card card-3 h-100 w-100">
            <!-- Applying the background color to the third card -->
            <div class="card-header">
                <i class="fa-solid fa-dollar-sign"></i>
                Total Warehouses
            </div>
            <div class="card-body">
                <span class="custom-card-text"><?php echo count($warehouses); ?></span>
            </div>
            <a href="../admin/warehouses/index.php" class="card-footer text-right text-none">More Info &rarr;</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-4 h-100 w-100">
            <!-- Applying the background color to the fourth card -->
            <div class="card-header">
                <i class="fa-solid fa-bag-shopping"></i>
                Orders
            </div>
            <div class="card-body">
                <span class="custom-card-text"><?php echo count($orders); ?></span>
            </div>
            <a href="../admin/orders/index.php" class="card-footer text-right text-none">More Info &rarr;</a>
        </div>


    </div>
    <div class="col-md-3">
        <div class="card card-5 h-100 w-100">
            <!-- Applying the background color to the fifth card -->
            <div class="card-header">
                <i class="fa-solid fa-bag-shopping"></i>
                Total Products
            </div>
            <div class="card-body">
                <span class="custom-card-text"><?php echo count($products); ?></span>
            </div>
            <a href="../admin/products/product-details.php" class="card-footer text-right text-none">More Info
                &rarr;</a>
        </div>
    </div>



</div>



</div>