<?php

include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\users;
$_user= new users();
$users= $_user->index();


// Pagination variables
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$usersPerPage = 5; 
$offset = ($page - 1) * $usersPerPage; 

// Fetch users for the current page
$users = $_user->paginateUsers($usersPerPage, $offset);

// Fetch total number of users
$totalUsers = $_user->countTotalUsers();

?>

<?php ob_start(); session_start();


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
      <h4>Manage Members</h4>
    </div>
    <div class="col-2 offset-4 text-right">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Members</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-6">
    <?php if ($_SESSION['role_id'] === 1) { ?>
      <a href="create.php" class="btn btn-success m-1">Add Member</a>
      <a href="trash_index.php" class="btn btn-danger m-1">Trashed</a>
            <?php } ?>
    </div>
  </div>

  
  <section class="content mt-5">

              <table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th scope="col" style="border-bottom: 2px solid black;">User Name</th>
            <th scope="col" style="border-bottom: 2px solid black;">Role</th>
            <?php if ($_SESSION['role_id'] === 1) { ?>
            <th scope="col" style="border-bottom: 2px solid black;">Email</th>
            <?php } ?>
            <th scope="col" style="border-bottom: 2px solid black;">Phone no</th>
            <th scope="col" style="border-bottom: 2px solid black;">Gender</th>
            <th scope="col" style="border-bottom: 2px solid black;">Status</th>
            <th scope="col" style="border-bottom: 2px solid black;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
            <tr>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <?php if ($_SESSION['role_id'] === 1) { ?>
                <td><?php echo $user['email']; ?></td>
                <?php } ?>
                <td><?php echo $user['phone']; ?></td>
                <td><?php echo $user['gender']; ?></td>
                <td><?php echo $user['is_active'] ? "Active" : " Inactive" ;?></td>
                

                <td>
                <div class="btn-group" role="group" aria-label="User Actions">
                  <a href="show.php?id=<?=$user['id']?>" class="btn btn-success btn-sm mx-1">Show</a>   
                  <?php if ($_SESSION['role_id'] === 1) { ?>
                    <a href="edit.php?id=<?=$user['id']?>" class="btn btn-primary btn-sm ">Edit</a>   
                    <a href="trash.php?id=<?=$user['id']?>" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Are you sure?')">Trash</a> 
                <?php } ?> 
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
        <?php for ($i = 1; $i <= ceil($totalUsers / $usersPerPage); $i++): ?>
        <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
          <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
        <?php endfor; ?>
        <li class="page-item <?php echo $page >= ceil($totalUsers / $usersPerPage) ? 'disabled' : ''; ?>">
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