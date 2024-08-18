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
                            <h5>Add New Products</h5>
                        </section>
                        <div class="col-2 offset-8"><nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Products</li>
                            </ol>
                          </nav>
                        </div>
                    </div>
                </div>
                <section class="main-content">
                    <div class="container-fluid"></div>
                    <div class="row"></div>
                    <form>

                      <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Image</label>
                        <input class="form-control" type="file" id="formFileMultiple" multiple>
                      </div>

                      <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="form-label">Product name</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter Product name">
                      </div>
                             
                      <div class="form-group mt-3">
                        <label for="formGroupExampleInput2" class="form-label">Price</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Enter Price">
                      </div>

                      <div class="form-group mt-3">
                        <label for="formGroupExampleInput2" class="form-label">Qty</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Enter Qty">
                      </div>

                      <div class="form-group mt-3">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Enter Description "></textarea>
                      </div>

                      <div class="form-group mt-3">
                        <label for="inputState">Color</label>
                        <select class="form-control" id="inputState">
                          <option selected></option>
                          <option>yellow</option>
                          <option>red</option>
                          <option>green</option>
                          <option>Gray</option>
                          <option>black</option>
                          <option>blue</option>
                        </select>
                      </div>

                      <div class="form-group mt-3">
                        <label for="inputState">Size</label>
                        <select class="form-control" id="inputState">
                          <option selected></option>
                          <option>S</option>
                          <option>M</option>
                          <option>L</option>
                          <option>XL</option>
                          <option>XXL</option>                          
                        </select>
                      </div>

                      <div class="form-group mt-3">
                        <label for="inputState">Items</label>
                        <select class="form-control" id="inputState">
                          <option selected></option>
                          <option>Computer</option>
                          <option>Laptop</option>
                          <option>Clothes</option>
                          <option>Smartphone</option>
                          <option>Accesories</option>
                          <option>Others</option>
                        </select>
                      </div>

                      <div class="form-group mt-3">
                        <label for="exampleFormControlSelect1">Category</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option selected></option>
                          <option>Electronic</option>
                          <option>Clothing</option>
                          <option>Chairs</option>
                          <option>Headsets</option>
                          <option>Shoes</option>
                        </select>
                      </div>

                      <div class="form-group mt-3">
                        <label for="exampleFormControlSelect1">Warehouse</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option selected></option>
                          <option>BD-DX</option>
                          <option>RED-X</option>
                        </select>
                      </div>
                      
                      <div class="form-group mt-3">
                        <label for="exampleFormControlSelect1">Availability</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option selected></option>
                          <option>Yes</option>
                          <option>No</option>
                        </select>
                      </div>
                      
                      <div class="mb-3 mt-4">
                        <!-- Added margin bottom for the buttons -->
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-danger">Back</button>
                    </div>
                </section>
            </form>
                
            </div>

        </div>
    </section>

</div>

















    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>