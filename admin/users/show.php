<?php
 
 include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\users;

$_user= new users();
$user= $_user->show();

?>

<?php ob_start(); session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}?>

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
                    
                    <dt class="col-sm-3">Role:</dt>
                    <dd class="col-sm-9"><?= $user['role'];?></dd>

                    <dt class="col-sm-3">user:</dt>
                    <dd class="col-sm-9"><?= $user['name'];?></dd>

                    <dt class="col-sm-3">First Name :</dt>
                    <dd class="col-sm-9"><?= $user['fname'];?></dd>
                    
                    <dt class="col-sm-3">Last Name :</dt>
                    <dd class="col-sm-9"><?= $user['lname'];?></dd>

                    <dt class="col-sm-3">Phone No:</dt>
                    <dd class="col-sm-9"><?= $user['phone'];?></dd>

                    <dt class="col-sm-3">Gender:</dt>
                    <dd class="col-sm-9"><?= $user['gender'];?></dd>

                    <?php if ($_SESSION['role_id'] === 1) { ?>

                    <dt class="col-sm-3">Email:</dt>
                    <dd class="col-sm-9"><?= $user['email'];?></dd>

                    <dt class="col-sm-3">Password:</dt>
                    <dd class="col-sm-9"><?= $user['password'];?></dd>
                    <?php } ?>

                    <dt class="col-sm-3">Is Active:</dt>
                    <dd class="col-sm-9"><?= $user['is_active'] ? "Active" : " Inactive" ;?></dd>

                    <dt class="col-sm-3">Created At:</dt>
                    <dd class="col-sm-9"><?= $user['created_at'];?></dd>

                    <dt class="col-sm-3">Modified At:</dt>
                    <dd class="col-sm-9"><?= $user['modified_at'];?></dd>

<!-- 
                    <dt class="col-sm-3">Status:</dt>
                    <dd class="col-sm-9"><?= $user['status'];?></dd> -->

                </dl>



            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>






