<?php

include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\sizes;
$_size= new sizes();
$sizes= $_size->trash_index();
?>

<?php ob_start(); session_start();
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
            <th scope="col" style="border-bottom: 2px solid black;">size</th>
            <th scope="col" style="border-bottom: 2px solid black;">Status</th>
            <th scope="col" style="border-bottom: 2px solid black;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($sizes as $size): ?>
            <tr>
                <td><?php echo $size['size']; ?></td>
                <td><?php echo $size['is_active'] ? "Active" : " Inactive" ;?></td>
                
                <td> 
                    <a href="restore.php?id=<?=$size['id']?>" class="btn btn-primary btn-sm">Restore</a>  
                    <a href="delete.php?id=<?=$size['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                </td>

            </tr>

        <?php endforeach; ?>
    </tbody>
              </table>

<!-- pagination -->
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>

            </div>
        </div>
    </div>
    
</section>


<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>