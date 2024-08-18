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
                            <h5>Add New Orders</h5>
                        </section>
                        <div class="col-2 offset-8"><nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Orders</li>
                            </ol>
                          </nav>
                        </div>
                        <div class="col-2"><button type="button" class="btn btn-danger">Add Orders</button>
                        </div>
                    </div>
                </div>
                <div class="row"> 
                    <form class="row g-5">
                        <div class="row mt-1">
                            <div class="col-auto">
                                <label for="name1" class="visually-hidden">Name</label>
                                <input type="text" readonly class="form-control-plaintext" id="name1" value="Client Name">
                            </div>
                            <div class="col-5">
                                <label for="name2" class="visually-hidden">Name</label>
                                <input type="text" class="form-control" id="name2" placeholder="Enter Client Name">
                            </div>
                        </div>
                    
                        <div class="row mt-3 ">
                            <div class="col-auto">
                                <label for="address1" class="visually-hidden">Address</label>
                                <input type="text" readonly class="form-control-plaintext" id="address1" value="Client Address">
                            </div>
                            <div class="col-5">
                                <label for="address2" class="visually-hidden">Address</label>
                                <input type="text" class="form-control" id="address2" placeholder="Enter Client Address">
                            </div>
                        </div>
                        <div class="row mt-3 ">
                            <div class="col-auto">
                                <label for="phone1" class="visually-hidden">Phone</label>
                                <input type="text" readonly class="form-control-plaintext" id="phone1" value="Phone">
                            </div>
                            <div class="col-5">
                                <label for="phone2" class="visually-hidden">Phone</label>
                                <input type="tel" class="form-control" id="phone2" placeholder="Enter phone Number">
                            </div>
                        </div>
                        <div class="row mt-4 ">
                            <div class="col-md-6 col-lg-7">
                                <label for="selectOption" class="mb-1">Product Name</label>
                                <select class="form-select" id="selectOption">
                                    <option value="option1"></option>
                                  <option value="option2">Homall Gaming Chair	</option>
                                  <option value="option3">Rubik's Cube</option>
                                  <option value="option4">Apple MacBook Air </option>
                                  <option value="option2">Marbrasse 4-Trays Desk File Organizer</option>
                                  <option value="option3">Alienware Aurora R13 Gaming Desktop</option>
                                  <option value="option4">Predator Helios 300</option>
                                </select>
                              </div>
                            <div class="col-sm-6 col-md-3 col-lg-1">
                              <label for="input2" class="mb-1">	Qty</label>
                              <input type="text" class="form-control" id="input2" placeholder="">
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-1">
                              <label for="input3" class="mb-1">Rate</label>
                              <input type="text" class="form-control" id="input3" placeholder="">
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3">
                              <label for="input4" class="mb-1">Amount</label>
                              <input type="text" class="form-control" id="input4" placeholder="">
                            </div>
                          </div>
                    </form>
                    
                    <form class="row g-5">
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <label for="grossAmount" class="visually-hidden">Gross Amount</label>
                                <input type="text" readonly class="form-control-plaintext" id="grossAmount" value="Gross Amount">
                            </div>
                            <div class="col-3">
                                <label for="grossAmountValue" class="visually-hidden">Gross Amount</label>
                                <input type="text" class="form-control" id="grossAmountValue" name="grossAmountValue" disabled="" autocomplete="off" data-listener-added_cfda4d86="true">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <label for="grossAmount" class="visually-hidden">S-Charge 13 %</label>
                                <input type="text" readonly class="form-control-plaintext" id="grossAmount" value="S-Charge 13 %">
                            </div>
                            <div class="col-3">
                                <label for="grossAmountValue" class="visually-hidden">S-Charge 13 %</label>
                                <input type="text" class="form-control" id="grossAmountValue" name="grossAmountValue" disabled="" autocomplete="off" data-listener-added_cfda4d86="true">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <label for="grossAmount" class="visually-hidden">Vat 10 %</label>
                                <input type="text" readonly class="form-control-plaintext" id="grossAmount" value="Vat 10 %">
                            </div>
                            <div class="col-3">
                                <label for="grossAmountValue" class="visually-hidden">Vat 10 %</label>
                                <input type="text" class="form-control" id="grossAmountValue" name="grossAmountValue" disabled="" autocomplete="off" data-listener-added_cfda4d86="true">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <label for="grossAmount" class="visually-hidden">Discount</label>
                                <input type="text" class="form-control-plaintext" id="grossAmount" value="Net Amount">
                            </div>
                            <div class="col-3">
                                <label for="grossAmountValue" class="visually-hidden">Discount</label>
                                <input type="text" class="form-control" id="grossAmountValue" name="grossAmountValue" autocomplete="off" data-listener-added_cfda4d86="true">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <label for="grossAmount" class="visually-hidden">Net Amount</label>
                                <input type="text" readonly class="form-control-plaintext" id="grossAmount" value="Net Amount">
                            </div>
                            <div class="col-3">
                                <label for="grossAmountValue" class="visually-hidden">Net Amount</label>
                                <input type="text" class="form-control" id="grossAmountValue" name="grossAmountValue" disabled="" autocomplete="off" data-listener-added_cfda4d86="true">
                            </div>
                        </div>          
                    </form>
                    <div class="box-footer mt-5">
                        <input type="hidden" name="service_charge_rate" value="13" autocomplete="off">
                        <input type="hidden" name="vat_charge_rate" value="10" autocomplete="off">
                        <button type="submit" class="btn btn-success">Create Order</button>
                        <a href="#" class="btn btn-danger">Back</a>
                      </div>


                    <!-- end -->
                       
                </div>

 


            </div>

        </div>
    </section>

</div>

















    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>