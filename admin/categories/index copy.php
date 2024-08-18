<?php

include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\categories;
$_category= new categories();
$categories= $_category->index();

?>
<?php ob_start(); session_start();?>

<section>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-6">
               <h1 class="text-center mb-5">Lists</h1>

              <ul class="nav d-flex justify-content-center fs-4 fw-bold mb-4">
               
               <li class="nav-category">
               <a class="nav-link text-success" href="create.php">Add New</a>
               </li>

               <li class="nav-item">
               <a class="nav-link text-success" href="trash_index.php"> All Trashed Items</a>

  
              </ul>

              <table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th scope="col" style="border-bottom: 2px solid black;">Category</th>
            <th scope="col" style="border-bottom: 2px solid black;">Status</th>
            <th scope="col" style="border-bottom: 2px solid black;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categories as $index => $category): ?>
            <tr>
                <td><?php echo $category['category']; ?></td>
                <td><?php echo $category['is_active'] ? "Active" : " Inactive" ;?></td>
                
                <!-- <td><?php echo $category['status']; ?></td> -->

                <td>
                    <a href="show.php?id=<?=$category['id']?>" class="btn btn-success btn-sm">Show</a>  
                    <a href="edit.php?id=<?=$category['id']?>" class="btn btn-primary btn-sm">Edit</a>  
                    <a href="trash.php?id=<?=$category['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Trash</a>  
                </td>

            </tr>

            <!-- <?php if ($index === count($categories) - 1): ?>
                <tr>
                    <td colspan="3" style="border-top: 2px solid black;"></td>
                </tr>
            <?php endif; ?> -->

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