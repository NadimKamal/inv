<?php
 
 include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\colors;

$_color= new colors();
$color= $_color->show();

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
                    <!-- <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9"><?= $color['id'];?></dd> -->

                    <dt class="col-sm-3">Color:</dt>
                    <dd class="col-sm-9"><?= $color['color'];?></dd>

                    <dt class="col-sm-3">Is Active:</dt>
                    <dd class="col-sm-9"><?= $color['is_active'] ? "Active" : " Inactive" ;?></dd>

                    <dt class="col-sm-3">Created At:</dt>
                    <dd class="col-sm-9"><?= $color['created_at'];?></dd>

                    <dt class="col-sm-3">Modified At:</dt>
                    <dd class="col-sm-9"><?= $color['modified_at'];?></dd>

<!-- 
                    <dt class="col-sm-3">Status:</dt>
                    <dd class="col-sm-9"><?= $color['status'];?></dd> -->

                </dl>



            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>




