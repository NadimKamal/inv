<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");

use App\products;
use App\warehouses;

$_product = new products();
$_warehouse = new warehouses();
$products = $_product->index();
$warehouses = $_warehouse->index();


?>

<?php ob_start(); 
session_start();


if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}
?>


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
      <?php foreach ($warehouses as $warehouse) { ?>
        <h3><?php echo $warehouse['warehouse'] ?></h3>
        <?php foreach ($products as $product) { ?>
          <?php if ($product['warehouse'] == $warehouse['id']) { ?>
            <div class="col-md-2">
              <div class="card card-4 h-100 w-100">
                <div class="card-header">
                  <b><?php echo $product['product'] ?></b>
                </div>
                <div class="card-body">
                  <span class="custom-card-text"><?php echo $product['quantity']; ?></span>
                </div>
                <a href="show.php?id=<?= $product['id'] ?>" class="card-footer text-right text-none">More Info
                  &rarr;</a>
              </div>


            </div>
          <?php } ?>
        <?php } ?>
      <?php } ?>

    </div>

  </section>

  <?php $content = ob_get_clean(); ?>

  <?php include '../components/master-design.php'; ?>