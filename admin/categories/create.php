<?php ob_start(); // used to capture and store the output buffer content
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}


?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="mb-5">Add New Category</h1> 
            <form method="post" action="store.php">

                <div class="mb-3">
                    <label for="inputCategory" class="form-label">Category</label>
                    <input type="text" class="form-control" name="category" value="" id="inputCategory">
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
