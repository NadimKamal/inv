<?php
 session_start();
 // var_dump($_SESSION);
 // Check if user is logged in, if not, redirect to login page
 if (!isset($_SESSION['user_id'])) {
   header("Location: ../../signin.php");
   exit();
 }
 
 include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\products;

$_product= new products();
$product= $_product->show();

?>
    <?php ob_start();?>

<section>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-6">
                <!-- <h3 class="text-center mb-5">Show</h3> -->

                <ul class="nav d-flex justify-content-center fs-4 fw-bold mb-4">
               
               <li class="nav-item">
               <a class="nav-link text-success" href="index.php">Lists</a>
               </li>
              
              </ul>

              <!-- typography----descriptionlist alignment -->

                <dl class="row">

                    <!-- <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9"><?= $product['id'];?></dd> -->

                    <dt class="col-sm-3">Image:</dt>
                    <dd class="col-sm-9"><?= $product['picture'];?>
                    <img src="<?= $webroot?>public/uploads/<?= $product['picture'];?>" alt="Can't find the Product Image" class="img-fluid" height="200" width="300">
                    </dd> 

                    <dt class="col-sm-3">Product Name:</dt>
                    <dd class="col-sm-9"><?= $product['product'];?></dd>

                    <dt class="col-sm-3">Puschase Price:</dt>
                    <dd class="col-sm-9"><?= $product['purchase_price'];?></dd>

                    <dt class="col-sm-3">Selling Price:</dt>
                    <dd class="col-sm-9"><?= $product['price'];?></dd>

                    <dt class="col-sm-3">Quantity:</dt>
                    <dd class="col-sm-9"><?= $product['quantity'];?></dd>

                    <dt class="col-sm-3">Color:</dt>
                    <dd class="col-sm-9"><?= $product['color'];?></dd>

                    <dt class="col-sm-3">Size:</dt>
                    <dd class="col-sm-9"><?= $product['size'];?></dd>

                    <dt class="col-sm-3">Unit:</dt>
                    <dd class="col-sm-9"><?= $product['unit'];?></dd>

                    <dt class="col-sm-3">Item:</dt>
                    <dd class="col-sm-9"><?= $product['item'];?></dd>

                    <dt class="col-sm-3">Category:</dt>
                    <dd class="col-sm-9"><?= $product['category'];?></dd>

                    <dt class="col-sm-3">Warehouse:</dt>
                    <dd class="col-sm-9"><?= $product['warehouse'];?></dd>
                    
                    <!-- <dt class="col-sm-3">Availability:</dt>
                    <dd class="col-sm-9"><?= $product['availability'];?></dd> -->

                    <dt class="col-sm-3">Is Active:</dt>
                    <dd class="col-sm-9"><?= $product['is_active'] ? "Active" : " Inactive" ;?></dd>
                    
                    <dt class="col-sm-3">Created At:</dt>
                    <dd class="col-sm-9"><?= $product['created_at'];?></dd>

                    <dt class="col-sm-3">Modified At:</dt>
                    <dd class="col-sm-9"><?= $product['modified_at'];?></dd>




                </dl>



            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>





