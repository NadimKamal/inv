<?php

include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\colors ;
$_color= new colors ();
$colors = $_color->index();

// Pagination variables
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$colorsPerPage = 5; // Number of colors per page
$offset = ($page - 1) * $colorsPerPage; // Offset for fetching colors

// Fetch colors for the current page
$colors = $_color->paginate($colorsPerPage, $offset);

// Fetch total number of colors
$totalColors = $_color->countTotalColors();
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
            <h4>Manage colors</h4>
        </div>
        <div class="col-2 offset-4 text-right">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">colors</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <a href="create.php" class="btn btn-success m-1">Add colors</a>
            <?php if ($_SESSION['role_id'] === 1) { ?>
            <a href="trash_index.php" class="btn btn-danger m-1">Trashed colors</a>
            <?php } ?>
        </div>
    </div>

    
    <section class="content mt-5">

<table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th scope="col" style="border-bottom: 2px solid black;">Colors</th>
            <th scope="col" style="border-bottom: 2px solid black;">Status</th>
            <th scope="col" style="border-bottom: 2px solid black;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($colors as $color): ?>
            <tr>
                <td><?php echo $color['color']; ?></td>
                <td><?php echo $color['is_active'] ? "Active" : " Inactive"; ?></td>
                <td>
                    <a href="show.php?id=<?= $color['id'] ?>" class="btn btn-success btn-sm">Show</a>
                    <a href="edit.php?id=<?= $color['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <?php if ($_SESSION['role_id'] === 1) { ?>
                    <a href="trash.php?id=<?= $color['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Trash</a>
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
            <?php for ($i = 1; $i <= ceil($totalColors / $colorsPerPage); $i++) : ?>
                <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?php echo $page >= ceil($totalColors / $colorsPerPage) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
            </li>
        </ul>
    </nav>
</section>



<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>
