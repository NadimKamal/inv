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
                        <div class="col-2">
                            <h5>Add New Member</h5>
                        </div>
                        <div class="col-2 offset-8"><nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Members</li>
                            </ol>
                          </nav>
                        </div>
                        

                    </div>
                </div>

                <!-- start -->
                <div class="box box-default">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                    <div class="col-md-12 col-xs-12">
                                                               
                        <form role="form" action="" method="post">
                          <div class="box-body">
            
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group mt-3">
                            <label for="groups">Permission</label>
                            <select class="form-control" id="groups" name="groups">
                                <option value="">Select Permission</option>
                                <option value="5">Testing</option>
                                <option value="6">Employee</option>
                            </select>
                            </div>
                            </div>
                           <div class="col-md-6">
                            <div class="form-group mt-3">
                              <label for="fname">First name</label>
                              <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" autocomplete="off">
                            </div>
                            </div>
            
                            <div class="col-md-6">
                            <div class="form-group mt-3">
                              <label for="username">Username</label>
                              <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" data-listener-added_8547c545="true">
                            </div>
                            </div>
                            
                           
                             <div class="col-md-6">
                            <div class="form-group mt-3">
                              <label for="lname">Last name</label>
                              <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" autocomplete="off">
                            </div>
                            </div>   
                              <div class="col-md-6">
                            <div class="form-group mt-3">
                              <label for="password">Password</label>
                              <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" data-listener-added_8547c545="true">
                            </div>
                            </div>
            
                             <div class="col-md-6">            
                            <div class="form-group mt-3">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off">
                            </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group mt-3">
                              <label for="cpassword">Confirm password</label>
                              <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" autocomplete="off">
                            </div>
                            </div>
                                                                        
                            <div class="col-md-6">      
                            <div class="form-group mt-3">
                              <label for="phone">Phone</label>
                              <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" autocomplete="off">
                            </div>
                            </div>
                            </div>
            
                            <div class="form-group mt-3">
                              <label for="gender">Gender</label>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="gender" id="male" value="1">
                                  Male
                                </label>
                                <label>
                                  <input type="radio" name="gender" id="female" value="2">
                                  Female
                                </label>
                              </div>
                            </div>
            
                          </div>
                          <!-- /.box-body -->
            
                          <div class="box-footer mt-3">
                            <button type="submit" class="btn btn-primary">Save &amp; Close</button>
                            <a href="#" class="btn btn-warning">Back</a>
                          </div>
                        </form>
                      </div>
                      <!-- /.box -->
                    </div>
                    <!-- col-md-12 -->
                  </div>
                      <!-- /.row -->
                    </div>
                <!-- end -->
            </div>

        </div>
    </section>

</div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>