<?php
include_once($_SERVER['DOCUMENT_ROOT']."/config.php");
use App\items;
$_item= new items();
$items= $_item->index();


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

<section>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-6">
               <h1 class="text-center mb-5">Lists</h1>

              <ul class="nav d-flex justify-content-center fs-4 fw-bold mb-4">
               
               <li class="nav-item">
               <a class="nav-link text-success" href="create.php">Add New</a>
               </li>
               <li class="nav-product">
              <a class="nav-link text-success" href="trash_index.php">All Trashed Items</a>
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
           foreach($items as $index => $item): 
        ?>
            <tr>
                <td><?php echo $item['item']; ?></td>
                <td><?php echo $item['is_active'] ? "Active" : " Inactive" ;?></td>
                
                <!-- <td><?php echo $item['status']; ?></td> -->
                <td>
                    <a href="show.php?id=<?=$item['id']?>" class="btn btn-success btn-sm">Show</a>  
                    <a href="edit.php?id=<?=$item['id']?>" class="btn btn-primary btn-sm">Edit</a>  
                    <a href="trash.php?id=<?=$item['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Trash</a>
               </td>

            </tr>

            <!-- <?php if ($index === count($items) - 1): ?>
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