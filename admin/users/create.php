<?php ob_start();
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ./signin.php");
    exit();
}

include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");
use App\users;
$_user = new users();
$roles = $_user->getRoles();


?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="mb-5">Add New Members</h1>

            <form method="post" action="store.php">

                <div class="mb-3 row">
                    <label for="inputRole" class="form-label col-md-3">Role:</label>
                    <div class="col-md-9">
                        <select class="form-control" name="role_id" id="inputRole">
                            <option value="">~ Select Any One ~</option>
                            <?php foreach ($roles as $role) { ?>
                                <option value="<?php echo $role['id']; ?>"><?php echo $role['role_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputUserName" class="form-label col-md-3">User Name:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="user_name" id="inputUserName"
                            placeholder="Enter Your Name Here...">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputEmail" class="form-label col-md-3">Email:</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" name="email" value="" id="inputEmail">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputPassword" class="form-label col-md-3">Password:</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="user_password" value="" id="inputPassword">
                        <?php if (isset($error_msg)) {?>
                        <div class="alert alert-danger mt-3" role="alert">
                            <?php echo $error_msg ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputFname" class="form-label col-md-3">First Name:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="fname" value="" id="fname">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputLname" class="form-label col-md-3">Last Name:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="lname" value="" id="inputlname">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputPhone" class="form-label col-md-3">Phone No:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="phone" value="" id="inputPhone">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputGender" class="form-label col-md-3">Gender:</label>
                    <div class="col-md-9">
                        <select class="form-control" name="gender" id="inputGender">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9 form-check">
                        <input type="checkbox" class="form-check-input" name="is_active" value="1" id="inputIsActive">
                        <label for="inputIsActive" class="form-check-label">Active</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-secondary">Submit</button>


                <!-- <div class="mb-3 row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </div>
                </div> -->

            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>