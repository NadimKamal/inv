<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");

use App\items;

$_item = new items();
$item = $_item->show();

?>

<?php ob_start(); 
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}


?>
<div class="row d-flex justify-content-center">
    <div class="col-sm-6">
        <h1 class="text-center mb-5">Show</h1>

        <ul class="nav d-flex justify-content-center fs-4 fw-bold mb-4">

            <li class="nav-item">
                <a class="nav-link text-success" href="index.php">Lists</a>
            </li>

        </ul>

        <dl class="row">
            <!-- <dt class="col-sm-3">ID:</dt>
            <dd class="col-sm-9"><?= $item['id']; ?></dd> -->

            <dt class="col-sm-3">Item:</dt>
            <dd class="col-sm-9"><?= $item['item']; ?></dd>

            <dt class="col-sm-3">Is Active:</dt>
            <dd class="col-sm-9"><?= $item['is_active'] ? "Active" : " Inactive"; ?></dd>

        </dl>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>