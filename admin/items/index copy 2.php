<?php
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}
include_once($_SERVER['DOCUMENT_ROOT']."/config.php");
use App\items;
$_item= new items();
$items= $_item->index();

?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once ("../components/partials/head.php");
?>

<body>

  <?php
  include_once ("../components/partials/header.php");
  ?>

  <div class="full">
    <section class="wrapper">

      <div class="container-fluid">
        <div class="row">

          <?php
          include_once ("../components/partials/sidebar.php");
          ?>

          <div class="col-sm-10">
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

                <!-- <table class="table">
        <thead>
          <tr>
            <th scope="col">Item</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>

      <tbody>
       <?php
       foreach ($items as $item):
         ?>
       <tr>
      <td><?php echo $item['item']; ?></td>
      <td><?php echo $item['status']; ?></td>
      <td>  <a href="show.php?id=<?= $item['id'] ?>">Show</a>| 
            <a href="edit.php?id=<?= $item['id'] ?>">Edit</a>|
            <a href="delete.php?id=<?= $item['id'] ?>">Delete </a>
      </td>
      </tr>

    <?php
       endforeach;
       ?>
  </tbody>
      </table> -->


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
                    foreach ($items as $item):
                      ?>
                      <tr>
                        <td><?php echo $item['item']; ?></td>
                        <td><?php echo $item['is_active'] ? "Active" : " Inactive"; ?></td>

                        <!-- <td><?php echo $item['status']; ?></td> -->
                        <td>
                          <a href="show.php?id=<?= $item['id'] ?>" class="btn btn-success btn-sm">Show</a>
                          <a href="edit.php?id=<?= $item['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                          <a href="trash.php?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">Trash</a>
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
        </div>
    </section>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
</body>

</html>