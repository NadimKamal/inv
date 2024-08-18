<?php
 session_start();
 // var_dump($_SESSION);
 // Check if user is logged in, if not, redirect to login page
 if (!isset($_SESSION['user_id'])) {
   header("Location: ./signin.php");
   exit();
 }
 
 include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\orders;

$_order= new orders();
$order= $_order->show();

?>
<?php ob_start();
?>


<section>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-6">
                <h1 class="text-center mb-5">Show</h1>

                <ul class="nav d-flex justify-content-center fs-4 fw-bold mb-4">
               
               <li class="nav-item">
               <a class="nav-link text-success" href="index.php">Lists</a>
               </li>
              
              </ul>

                <dl class="row">

                    <dt class="col-sm-3">Client Name:</dt>
                    <dd class="col-sm-9"><?= $order['c_name'];?></dd>

                    <dt class="col-sm-3">Client Address:</dt>
                    <dd class="col-sm-9"><?= $order['c_address'];?></dd>

                    <dt class="col-sm-3">Client Phone:</dt>
                    <dd class="col-sm-9"><?= $order['c_phone'];?></dd>
                    
                    <dt class="col-sm-3">Product Name:</dt>
                    <dd class="col-sm-9"><?= $order['product_name'];?></dd>

                    <dt class="col-sm-3">Quantity:</dt>
                    <dd class="col-sm-9"><?= $order['quantity'];?></dd>

                    <dt class="col-sm-3">Rate:</dt>
                    <dd class="col-sm-9"><?= $order['rate'];?></dd>

                    <dt class="col-sm-3">Amount:</dt>
                    <dd class="col-sm-9"><?= $order['amount'];?></dd>


                    <dt class="col-sm-3">Is Active:</dt>
                    <dd class="col-sm-9"><?= $order['is_active'] ? "Active" : " Inactive" ;?></dd>

                    <dt class="col-sm-3">Created At:</dt>
                    <dd class="col-sm-9"><?= $order['created_at'];?></dd>

                    <dt class="col-sm-3">Modified At:</dt>
                    <dd class="col-sm-9"><?= $order['modified_at'];?></dd>

                </dl>



            </div>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>





