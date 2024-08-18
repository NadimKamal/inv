<?php ob_start(); 
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}
include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");

use App\orders;
use App\products;

$_order = new orders();
$_product = new products();

$categories = $_product->getCategories();
$items = $_product->getItems();
$warehouses = $_product->getWarehouses();

?>

<section>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-4">
                <div class="report-section">
                <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/reports/stock-report.php' ?>">
                        <div class="card card-1">
                            <div class="card-body"><b>Stock Report</b></div>
                        </div>
                    </a>
                </div>
            </div>
            

            <?php if ($_SESSION['role_id'] === 1) { ?>
            <div class="col-md-4">
                <div class="report-section">    
                    <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/reports/sales-report.php' ?>">
                        <div class="card card-1">
                            <div class="card-body"><b>Sales Report</b></div>
                        </div>
                    </a>
                </div>
            </div>
            <?php } ?>


        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>