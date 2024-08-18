<?php ob_start();
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ./signin.php");
    exit();
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="mb-5">Add New Role</h1> <!-- Remove text-center class to keep it aligned to the left -->
            <form method="post" action="store.php">

                <div class="mb-3">

                    <select class="form-control" name="role_name" id="inputRole">
                        <option value="">Select Role</option>
                        <?php if ($_SESSION['role_id'] === 1) { ?>
                            <option value="admin">Admin</option>
                        <?php } ?>
                        <option value="employee">Employee</option>
                    </select>
                </div>
                <!-- <div class="mb-3">
                    <label for="inputRole" class="form-label">Role</label>
                    <input type="text" class="form-control" name="role_name" value="" id="inputRole">
                </div> -->

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="is_active" value="1" id="inputIsActive">
                    <label for="inputIsActive" class="form-check-label">Active</label>
                </div>

                <button type="submit" class="btn btn-secondary">Submit</button>
            </form>

        </div>
    </div>

    <!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <h1 class="mb-5">Add New Category</h1>
            <form method="post" action="store.php">

                <div class="mb-3 row">
                    <label for="inputCategory" class="col-sm-2 col-form-label">Category:</label>
                    <div class="col-sm-10">
                        <input 
                            type="text" 
                            class="form-control" 
                            name="category" 
                            value="" 
                            id="inputCategory">
                    </div>
                </div>

                <div class="mb-3 row form-check">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <input 
                            type="checkbox" 
                            class="form-check-input" 
                            name="is_active" 
                            value="1" 
                            id="inputIsActive">
                        <label for="inputIsActive" class="form-check-label">Active</label>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div> -->

    <?php $content = ob_get_clean(); ?>

    <?php include '../components/master-design.php'; ?>