<!DOCTYPE html>
<html lang="en">
<?php
           include_once("..//views/elements/head.php");
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
                        <div class="col-2">
                            <h5>Manage Permission</h5>
                        </div>
                        <div class="col-2 offset-8"><nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Permission</li>
                            </ol>
                          </nav>
                        </div>
                        <div class="col-2"><button type="button" class="btn btn-danger">Add Permission</button>
                        </div>

                    </div>
                </div>
                <section class="content mt-5">
                    <div class="row">
                        <div>
                            <table class="table border border-1">
                                <thead>
                                    <tr>
                                        <th>Permission Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Employee</td>
                                        <td>
                                            <a href="./edit.html" class="btn btn-warning m-1">Edit</a>
                                            <a href="#" class="btn btn-danger m-1">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Testing</td>
                                        <td>
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
    </section>

</div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>