<?php

include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\roles;
$_category= new roles();
$roles= $_category->trash_index();

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
               <h1 class="text-center mb-5">Lists</h1>

              <ul class="nav d-flex justify-content-center fs-4 fw-bold mb-4">

               <li class="nav-item">
               <a class="nav-link text-success" href="index.php">List Items</a>

  
              </ul>

              <table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th scope="col" style="border-bottom: 2px solid black;">Role</th>
            <th scope="col" style="border-bottom: 2px solid black;">Status</th>
            <th scope="col" style="border-bottom: 2px solid black;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($roles as $role): ?>
            <tr>
                <td><?php echo $role['role_name']; ?></td>
                <td><?php echo $role['is_active'] ? "Active" : " Inactive" ;?></td>
                

                <td> 
                    <a href="restore.php?id=<?=$role['id']?>" class="btn btn-primary btn-sm">Restore</a>  
                    <a href="delete.php?id=<?=$role['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                </td>

            </tr>

        <?php endforeach; ?>
    </tbody>
              </table>

            </div>
        </div>
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>