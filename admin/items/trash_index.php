<?php
include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\items;
$_item= new items();
$items= $_item->trash_index();

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
               
              <li class="nav-product">
              <a class="nav-link text-success" href="index.php">List Items</a>
              </li>


              </ul>
      
      <table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
      <thead>
        <tr>
            <th scope="col" style="border-bottom: 2px solid black;">Items</th>
            <th scope="col" style="border-bottom: 2px solid black;">Status</th>
            <th scope="col" style="border-bottom: 2px solid black;">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
           foreach($items as  $item): 
        ?>
            <tr>
                <td><?php echo $item['item']; ?></td>
                <td><?php echo $item['is_active'] ? "Active" : " Inactive" ;?></td>
                
                <!-- <td><?php echo $item['status']; ?></td> -->
                <td>
                    <a href="restore.php?id=<?=$item['id']?>" class="btn btn-primary btn-sm">Restore</a>  
                    <a href="delete.php?id=<?=$item['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
               </td>

            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<!-- pagination -->
<!-- <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav> -->

            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>

