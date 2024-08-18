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
                            <h5>Manage Products</h5>
                        </section>
                        <div class="col-2 offset-8"><nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Products</li>
                            </ol>
                          </nav>
                        </div>
                        <div class="col-2"><button type="button" class="btn btn-danger">Add Products</button>
                        </div>
                        <section class="content mt-5">
                            <div class="row">
                                <div>
                                    <table class="table border border-1">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Warehouse</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Homall Gaming Chair</td>
                                                <td>$189</td>
                                                <td>35</td>
                                                <td>BD-RDX</td>
                                                <td>
                                                    <a href="#" class="btn btn-success m-0 p-1">Active</a>
                                                </td>
                                                <td>
                                                    <a href="./show.html" class="btn btn-info m-1">Show</a>
                                                    <a href="./edit.html" class="btn btn-warning m-1">Edit</a>
                                                    <a href="#" class="btn btn-danger m-1">Delete</a>
                                                </td>
                                            </tr>
                  
                                            <tr>
                                              <td>Rubik's Cube</td>
                                              <td>$3</td>
                                              <td>55</td>
                                              <td>RED-X</td>
                                              <td>
                                                  <a href="#" class="btn btn-success m-0 p-1">Active</a>
                                              </td>
                                              <td>
                                                  <a href="./show.html" class="btn btn-info m-1">Show</a>
                                                  <a href="./edit.html" class="btn btn-warning m-1">Edit</a>
                                                  <a href="#" class="btn btn-danger m-1">Delete</a>
                                              </td>
                                          </tr>
                                          
                                          <tr>
                                            <td>	Apple MacBook Air</td>
                                            <td>$1129</td>
                                            <td>10</td>
                                            <td>Walmart</td>
                                            <td>
                                                <a href="#" class="btn btn-success m-0 p-1">Active</a>
                                            </td>
                                            <td>
                                              <a href="./show.html" class="btn btn-info m-1">Show</a>
                                                <a href="./edit.html" class="btn btn-warning m-1">Edit</a>
                                                <a href="#" class="btn btn-danger m-1">Delete</a>
                                            </td>
                                        </tr>
                  
                                        <tr>
                                          <td>Marbrasse 4-Trays Desk File Organizer</td>
                                          <td>$35</td>
                                          <td>27</td>
                                          <td>RED-X</td>
                                          <td>
                                              <a href="#" class="btn btn-success m-0 p-1">Active</a>
                                          </td>
                                          <td>
                                            <a href="./show.html" class="btn btn-info m-1">Show</a>
                                              <a href="./edit.html" class="btn btn-warning m-1">Edit</a>
                                              <a href="#" class="btn btn-danger m-1">Delete</a>
                                          </td>
                                      </tr> 
                                      <tr>
                                        <td>Alienware Aurora R13 Gaming Desktop</td>
                                        <td>$1349</td>
                                        <td>5</td>
                                        <td>Walmart</td>
                                        <td>
                                            <a href="#" class="btn btn-success m-0 p-1">Active</a>
                                        </td>
                                        <td>
                                          <a href="./show.html" class="btn btn-info m-1">Show</a>
                                            <a href="./edit.html" class="btn btn-warning m-1">Edit</a>
                                            <a href="#" class="btn btn-danger m-1">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                      <td>Predator Helios 300</td>
                                      <td>$1350</td>
                                      <td>12</td>
                                      <td>BD-RDX</td>
                                      <td>
                                          <a href="#" class="btn btn-success m-0 p-1">Active</a>
                                      </td>
                                      <td>
                                        <a href="./show.html" class="btn btn-info m-1">Show</a>
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