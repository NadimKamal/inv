<?php
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../signin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once ("../admin/components/partials/head.php");
?>

<body>
    <div class="full">
        <?php
        include_once ("../admin/components/partials/header.php");
        ?>

        <section class="wrapper">

            <div class="container-fluid">
                <div class="row">
                    <?php
                    include_once ("../admin/components/partials/sidebar.php");
                    ?>

                    <div class="col-sm-10">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-2">
                                    <h4>Manage Items</h4>
                                </div>
                                <div class="col-2 offset-8">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Items</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="col-2">
                                    <a href="#" class="btn btn-danger m-1">Add Items</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <?php
                            include_once ("../admin/components/partials/Items_Table.php");
                            ?>

                        </div>

                    </div>

                </div>
        </section>

    </div>

















    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>