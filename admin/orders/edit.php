<?php 
ob_start();
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ./signin.php");
    exit();
}

include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");

use App\orders;

$_order = new orders();
$products = $_order->getProducts();
$order = $_order->edit();

?>



<section>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-5">Edit Sell</h1>

                <form method="post" action="update.php">

                    <div class="mb-3 row">
                        <input type="hidden" class="form-control" name="id" value="<?= $order['id']; ?>" id="inputID">
                    </div>

                    <div class="mb-3 row">
                        <label for="inputCname" class="form-label col-md-3">Client Name:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="c_name" value="<?= $order['c_name']; ?>"
                                id="inputCname">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="inputCaddress" class="form-label col-md-3">Client Address:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="c_address" value="<?= $order['c_address']; ?>"
                                id="inputCaddress">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="inputCphone" class="form-label col-md-3">Client Phone:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="c_phone" value="<?= $order['c_phone']; ?>"
                                id="inputCphone">
                        </div>
                    </div>

                    <!-- <div class="mb-3 row">
                        <label for="inputProduct" class="form-label col-md-3">Product Name:</label>
                        <div class="col-md-9">
                            <select class="form-control" name="product" id="inputProduct">
                                <option value="">~ Select Any One ~</option>
                                <?php foreach ($products as $product) { ?>

                                    <?php if ($product['is_active'] == 1): ?>
                                        <option value="<?php echo $product['id']; ?>"><?php echo $product['product'] ?></option>
                                    <?php endif; ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div> -->
<!-- 
                    <div class="mb-3 row">
                        <label for="inputQuantity" class="form-label col-md-3">Quantity:</label>
                        <div class="col-md-9">
                            <input type="number" min="1" class="form-control" name="quantity"
                                value="<?= $order['quantity']; ?>" id="inputQuantity">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="inputRate" class="form-label col-md-3">Rate:</label>
                        <div class="col-md-9">
                            <input type="number" min="1" class="form-control" name="rate" value="<?= $order['rate']; ?>"
                                id="inputRate">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="inputAmount" class="form-label col-md-3">Amount:</label>
                        <div class="col-md-9">
                            <input type="number" min="0" class="form-control" name="amount"
                                value="<?= $order['amount']; ?>" id="inputAmount">
                        </div>
                    </div> -->

                    <div class="mb-3 row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9 form-check">
                            <?php if ($order['is_active'] == 0): ?>
                                <input type="checkbox" class="form-check-input" name="is_active" value="1"
                                    id="inputIsActive">
                            <?php else: ?>
                                <input type="checkbox" class="form-check-input" name="is_active" value="1" checked
                                    id="inputIsActive">
                            <?php endif; ?>
                            <label for="inputIsActive" class="form-check-label">Active</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-secondary">Submit</button>

                    <!-- 
                    <div class="mb-3 row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </div> -->

                </form>
            </div>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>