<?php

include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\units ;
$_unit= new units ();
$units = $_unit->index();

// Pagination variables
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$unitsPerPage = 5; // Number of units per page
$offset = ($page - 1) * $unitsPerPage; // Offset for fetching units

// Fetch units for the current page
$units = $_unit->paginate($unitsPerPage, $offset);

// Fetch total number of units
$totalUnits = $_unit->countTotalUnits();
?>

<?php ob_start(); session_start();
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
            <h4>Manage units</h4>
        </div>
        <div class="col-2 offset-4 text-right">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">units</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <a href="create.php" class="btn btn-success m-1">Add units</a>
            <?php if ($_SESSION['role_id'] === 1) { ?>
            <a href="trash_index.php" class="btn btn-danger m-1">Trashed units</a>
            <?php } ?>
        </div>
    </div>

    
    <section class="content mt-5">

<table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th scope="col" style="border-bottom: 2px solid black;">Units</th>
            <th scope="col" style="border-bottom: 2px solid black;">Status</th>
            <th scope="col" style="border-bottom: 2px solid black;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($units as $unit): ?>
            <tr>
                <td><?php echo $unit['unit']; ?></td>
                <td><?php echo $unit['is_active'] ? "Active" : " Inactive"; ?></td>
                <td>
                    <a href="show.php?id=<?= $unit['id'] ?>" class="btn btn-success btn-sm">Show</a>
                    <a href="edit.php?id=<?= $unit['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <?php if ($_SESSION['role_id'] === 1) { ?>
                    <a href="trash.php?id=<?= $unit['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Trash</a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


    <!-- Pagination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= ceil($totalUnits / $unitsPerPage); $i++) : ?>
                <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?php echo $page >= ceil($totalUnits / $unitsPerPage) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
            </li>
        </ul>
    </nav>
</section>



<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>
