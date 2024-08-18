<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");
// session_start();


use App\orders;

$_order = new orders();
$orders = $_order->index();

// Pagination variables
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$ordersPerPage = 5; // Number of orders per page
$offset = ($page - 1) * $ordersPerPage; // Offset for fetching orders

// Fetch orders for the current page
$orders = $_order->paginateOrders($ordersPerPage, $offset);

// Fetch total number of orders
$totalOrders = $_order->countTotalOrders();
?>

<?php ob_start();
session_start(); 
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';

?>

<div class="container-fluid">
  <div class="row">
  <?php if ($msg !== '') { ?>
            <div class="alert alert-success" role="alert">
                <?php echo($msg); ?>
            </div>
        <?php } ?>

    <div class="col-6">
      <h4>Manage Sells</h4>
    </div>
    <div class="col-2 offset-4 text-right">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Sells</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-6">
      <a href="create.php" class="btn btn-success m-1">Add Order</a>
      <?php if ($_SESSION['role_id'] === 1) { ?>
      <a href="trash_index.php" class="btn btn-danger m-1">Trashed Orders</a>
       <?php } ?>
    </div>
  </div>

  <section class="content mt-5">


    <table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
      <thead>
        <tr>
          <th scope="col" style="border-bottom: 2px solid black;">Product Name</th>
          <th scope="col" style="border-bottom: 2px solid black;">Client</th>
          <th scope="col" style="border-bottom: 2px solid black;">Address</th>
          <th scope="col" style="border-bottom: 2px solid black;">Contact</th>
          <th scope="col" style="border-bottom: 2px solid black;">DateTime</th>
          <th scope="col" style="border-bottom: 2px solid black;">Quantity</th>
          <th scope="col" style="border-bottom: 2px solid black;">Amount</th>
          <th scope="col" style="border-bottom: 2px solid black;">Status</th>
          <th scope="col" style="border-bottom: 2px solid black;">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orders as $order): ?>
          <tr>
            <td><?php echo $order['product_name']; ?></td>
            <td><?php echo $order['c_name']; ?></td>
            <td><?php echo $order['c_address']; ?></td>
            <td><?php echo $order['c_phone']; ?></td>
            <td><?php echo $order['created_at']; ?></td>
            <td><?php echo $order['quantity']; ?></td>
            <td><?php echo $order['amount']; ?></td>
            <td><?php echo $order['is_active'] ? "Paid" : "Unpaid"; ?></td>

            <td>
              <div class="btn-group" role="group" aria-label="User Actions">
                <a href="show.php?id=<?= $order['id'] ?>" class="btn btn-success btn-sm mx-1">Show</a>
                <a href="edit.php?id=<?= $order['id'] ?>" class="btn btn-primary btn-sm mx-1">Edit</a>

                <?php if ($_SESSION['role_id'] === 1) { ?>
                  <a href="trash.php?id=<?= $order['id'] ?>" class="btn btn-danger btn-sm mx-1"
                    onclick="return confirm('Are you sure?')">Trash</a>
                <?php } ?>
                
                <a href="challan.php?id=<?= $order['id'] ?>" class="btn btn-warning btn-sm mx-1">PDF</a>

              </div>
            </td>

          </tr>

        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- pagination -->
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
          <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
        </li>
        <?php for ($i = 1; $i <= ceil($totalOrders / $ordersPerPage); $i++): ?>
          <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
          </li>
        <?php endfor; ?>
        <li class="page-item <?php echo $page >= ceil($totalOrders / $ordersPerPage) ? 'disabled' : ''; ?>">
          <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
        </li>
      </ul>
    </nav>

</div>
</div>
</div>

</section>


<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>