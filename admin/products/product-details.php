<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");

use App\products;

$_product = new products();
$products = $_product->index();
$normal_products = $_product->normalStockProducts();
$low_stock_products = $_product->lowStockProducts();
$out_of_stock_products = $_product->stockOutProducts();

?>

<?php ob_start(); 
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}?>


<div class="container-fluid">
  <div class="row">
    <div class="col-6">
      <h4>Manage Products</h4>
    </div>
    <div class="col-2 offset-4 text-right">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-6">
      <a href="create.php" class="btn btn-success m-1">Add Product</a>
      <a href="index.php" class="btn btn-danger m-1">Managed Products</a>
    </div>
  </div>


  <section class="content mt-5">

    <div class="row g-4 my-4">
      <h3>Stocked Out Products</h3>
        <div class="col-md-3">
          <div class="card card-4 h-100 w-100">
            <!-- Applying the background color to the fourth card -->
            <div class="card-header">
              <b>Stockwise Product Details</b>
            </div>
            <div class="card-body">
              <span class="card-text">In this section, You may check the products details accordingly stock</span>
            </div>
            <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/products/stockwise-products.php' ?>" class="card-footer text-right text-none">More Info &rarr;</a>
          </div>


        </div>
        <div class="col-md-3">
          <div class="card card-1 h-100 w-100">
            <div class="card-header">
              <b>Warehouse Wise Product Detais</b>
            </div>
            <div class="card-body">
              <span class="card-text">In this section, You may check the products details accordingly warehouse</span>
            </div>
            <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/products/warehousewise-products.php' ?>" class="card-footer text-right text-none">More Info &rarr;</a>
          </div>
        </div>
    </div>


</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>