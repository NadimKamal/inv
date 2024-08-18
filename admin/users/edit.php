<?php

include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\users;
$_user= new users();
$user= $_user->edit();

?>


<?php ob_start(); session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}?>

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-5">Edit User</h1>

            <form method="post" action="update.php">

                <div class="mb-3 row">
                        <input type="hidden" class="form-control" name="id" value="<?= $user['id'];?>" id="inputID">
                </div>


                <div class="mb-3 row">
                    <div class="col-sm-3">
                        <label for="inputUserName" class="form-label">User Name:</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="user_name" value="<?= $user['name']; ?>" id="inputUserName">
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-3">
                        <label for="inputRole" class="form-label">Role:</label>
                    </div>
                    <div class="col-sm-8">
                        <select class="form-control" name="role_name" id="inputRole">
                            <option value="">Select Role</option>
                            <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                            <option value="employee" <?= ($user['role'] == 'employee') ? 'selected' : ''; ?>>Employee</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-3">
                        <label for="inputEmail" class="form-label">Email:</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" name="email" value="<?= $user['email']; ?>" id="inputEmail">
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-3">
                        <label for="inputPassword" class="form-label">Password:</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="user_password" value="<?= $user['password']; ?>" id="inputPassword">
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-3">
                        <label for="inputFname" class="form-label">First Name:</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="fname" value="<?= $user['fname']; ?>" id="inputFname">
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-3">
                        <label for="inputLname" class="form-label">Last Name:</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="lname" value="<?= $user['lname']; ?>" id="inputLname">
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-3">
                        <label for="inputPhone" class="form-label">Phone No:</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="phone" value="<?= $user['phone']; ?>" id="inputPhone">
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-3">
                        <label for="inputGender" class="form-label">Gender:</label>
                    </div>
                    <div class="col-sm-8">
                        <select class="form-control" name="gender" id="inputGender">
                            <option value="male" <?= ($user['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                            <option value="female" <?= ($user['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                            <option value="others" <?= ($user['gender'] == 'others') ? 'selected' : ''; ?>>Others</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row form-check">
                    <div class="col-sm-10">
                        <?php if ($user['is_active'] == 0): ?>
                            <input type="checkbox" class="form-check-input" name="is_active" value="1" id="inputIsActive">
                        <?php else: ?>
                            <input type="checkbox" class="form-check-input" name="is_active" value="1" checked id="inputIsActive">
                        <?php endif; ?>
                    </div>
                    <label for="inputIsActive" class="col-sm-3 form-check-label">Active</label>
                </div>

                <button type="submit" class="btn btn-secondary">Submit</button>
            </form>
        </div>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>