
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
            <h1 class="mb-5">Add New Item</h1> <!-- Remove text-center class to keep it aligned to the left -->
            <form method="post" action="store.php">

                <div class="mb-3">
                    <label for="inputItem" class="form-label">Item</label>
                    <input type="text" class="form-control" name="item" value="" id="inputItem">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="is_active" value="1" id="inputIsActive">
                    <label for="inputIsActive" class="form-check-label">Active</label>
                </div>

                    <button type="submit" class="btn btn-secondary">Submit</button>

            </form>
        </div>
    </div>
</div>
 
        <?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>