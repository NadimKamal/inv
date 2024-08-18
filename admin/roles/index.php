<?php

include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\roles;
$_role= new roles();
$roles= $_role->index();

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

        <div class="col-3 mb-3">
            <h4>Manage Role</h4>
        </div>
        <div class="col-3 offset-6"></div>
    </div>
    
    <div class="row mb-3">
    <div class="col-2">
        <a href="create.php" class="btn btn-success m-1">Add Roles</a>
        <a href="trash_index.php" class="btn btn-danger m-1">Trashed</a>
    </div>

    <div class="col-3 offset-7">
        <input type="text" class="form-control" id="searchInput" placeholder="Search items...">
    </div>
</div>


    <section class="content mt-4">
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
                        <td><?php echo $role['is_active'] ? "Active" : " Inactive"; ?></td>
                        <td>
                            <a href="show.php?id=<?=$role['id']?>" class="btn btn-success btn-sm">Show</a>
                            <a href="edit.php?id=<?=$role['id']?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="trash.php?id=<?=$role['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Trash</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


    </section>

</div>

<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>


