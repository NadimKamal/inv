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
           include_once("../admin/components/partials/head.php");
          ?>

<body>
    <div class="full">
    <?php
           include_once("../admin/components/partials/header.php");
          ?>


    <section class="wrapper">

        <div class="container-fluid">
          <div class="row">
          <?php
           include_once("../admin/components/partials/sidebar.php");
          ?>

            <div class="col-sm-10">
                <div class="container-fluid">
                    <div class="row">
                        <section class="content-header col-2">
                            <h5>Manage Orders</h5>
                        </section>
                        <div class="col-2 offset-8"><nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Orders</li>
                            </ol>
                          </nav>
                        </div>
                        <div class="col-2"><button type="button" class="btn btn-danger">Add Orders</button>
                        </div>

                        <section class="content mt-5">
                            <div class="row">
                                <div>
                                    <table class="table border border-1">
                                        <thead>
                                            <tr>
                                                <th>Bill No</th>
                                                <th>Client</th>
                                                <th>Contact</th>
                                                <th>DateTime</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>BILPR-DF05</td>
                                                <td>Demo Customer</td>
                                                <td>7770000000</td>
                                                <td>06-11-2021 05:49 pm</td>
                                                <td>4</td>                                                
                                                <td>$112</td>                                                
                                                <td>
                                                    <a href="./show.html" class="btn btn-info m-1">Print</a>
                                                    <a href="./edit.html" class="btn btn-warning m-1">Edit</a>
                                                    <a href="#" class="btn btn-danger m-1">Delete</a>
                                                </td>
                                            </tr>
                                            			
                                            <tr>
                                              <td>BILPR-D7E1</td>
                                              <td>Steeve</td>
                                              <td>7545558650</td>
                                              <td>19-04-2021 07:02 pm</td>
                                              <td>1</td>
                                              <td>$12</td>
                                              <td>
                                                  <a href="./show.html" class="btn btn-info m-1">Print</a>
                                                  <a href="./edit.html" class="btn btn-warning m-1">Edit</a>
                                                  <a href="#" class="btn btn-danger m-1">Delete</a>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>BILPR-D7E1</td>
                                              <td>Steeve</td>
                                              <td>7545558650</td>
                                              <td>19-04-2021 07:02 pm</td>
                                              <td>1</td>
                                              <td>$32</td>
                                              <td>
                                                  <a href="./show.html" class="btn btn-info m-1">Print</a>
                                                  <a href="./edit.html" class="btn btn-warning m-1">Edit</a>
                                                  <a href="#" class="btn btn-danger m-1">Delete</a>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>BILPR-D7E1</td>
                                              <td>Steeve</td>
                                              <td>7545558650</td>
                                              <td>19-04-2021 07:02 pm</td>
                                              <td>1</td>
                                              <td>$223</td>
                                              <td>
                                                  <a href="./show.html" class="btn btn-info m-1">Print</a>
                                                  <a href="./edit.html" class="btn btn-warning m-1">Edit</a>
                                                  <a href="#" class="btn btn-danger m-1">Delete</a>
                                              </td>
                                            </tr>                                          
                                        </tbody>
                                    </table>
                                </div>        
                            </div>
        
        
                        </section>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>

















    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>