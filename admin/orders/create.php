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

?>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-5">Add New Sell</h1>
            <form method="post" action="store.php">

                <div class="mb-3 row">
                    <label for="inputCname" class="form-label col-md-3">Client Name:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="c_name" value="" id="inputCname">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputCaddress" class="form-label col-md-3">Client Address:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="c_address" value="" id="inputCaddress">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputCphone" class="form-label col-md-3">Client Phone:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="c_phone" value="" id="inputCphone">
                    </div>
                </div>

                <div class="mb-3 row">
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
                </div>


                <div class="mb-3 row">
                    <label for="inputQuantity" class="form-label col-md-3">Quantity:</label>
                    <div class="col-md-4">
                        <input type="number" min="1" class="form-control" name="quantity" value="" id="inputQuantity">
                    </div>
                    <div class="col-md-4">
                        <p id="quantityDisplay"></p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputRate" class="form-label col-md-3">Rate:</label>
                    <div class="col-md-9">
                        <input type="number" min="0" class="form-control" name="rate" value="" id="inputRate" readonly>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputAmount" class="form-label col-md-3">Amount:</label>
                    <div class="col-md-9">
                        <input type="number" min="0" class="form-control" name="amount" value="" id="inputAmount"
                            readonly>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9 form-check">
                        <input type="checkbox" class="form-check-input" name="is_active" value="1" id="inputIsActive">
                        <label for="inputIsActive" class="form-check-label">Paid</label>
                    </div>
                </div>

                <input type="hidden" name="product_name" id="inputProductName">
                <input type="hidden" name="challan_no" id="inputChallanNo">
                <input type="hidden" name="purchasing_price" id="inputPurchasingPrice">
                <input type="hidden" name="selling_price" id="inputSellingPrice">

                <button type="submit" class="btn btn-secondary" id="submitBtn">Submit</button>

            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#inputProduct').change(function () {
            var productId = $(this).val();
            $.ajax({
                url: 'get_quantity.php', // Assuming PHP script to fetch quantity is named get_quantity.php
                type: 'POST',
                data: { productId: productId },
                dataType: 'json',
                success: function (response) {
                    if (response.quantity <= 0) {
                        // Clear the input fields
                        alert("Selected product is out of stock!");

                        $('#quantityDisplay').text('Stock Quantity: 0');
                        $('#inputRate').val('N/A');
                        $('#inputProductName').val('N/A');
                        $('#inputChallanNo').val('N/A');
                        $('#inputPurchasingPrice').val('N/A');
                        $('#inputSellingPrice').val('N/A');
                        $('#inputQuantity').val('0');
                        $('#submitBtn').prop('disabled', true);
                    } else {
                        $('#quantityDisplay').text('Stock Quantity: ' + response.quantity);
                        $('#inputRate').val(response.price);
                        $('#inputProductName').val(response.product);
                        $('#inputChallanNo').val(response.challan_no);
                        $('#inputPurchasingPrice').val(response.purchase_price);
                        $('#inputSellingPrice').val(response.price);
                        $('#inputQuantity').attr('max', response.quantity);
                        $('#submitBtn').prop('disabled', false);
                    }
                }
            });
        });

        $('#inputQuantity').on('input', function () {
            var maxQuantity = parseInt($(this).attr('max'));
            var enteredQuantity = parseInt($(this).val());

            // Check if entered quantity is greater than product quantity
            if (enteredQuantity > maxQuantity) {
                $(this).val(maxQuantity); // Set the value to maximum allowed quantity
            }
        });
        $('#inputQuantity, #inputRate').on('input', function () {
            updateAmount();
        });


        function updateAmount() {
            var quantity = parseInt($('#inputQuantity').val());
            var rate = parseFloat($('#inputRate').val());
            var amount = quantity * rate;
            // Check if amount is NaN(Not-a-Number) or Infinity
            if (!isNaN(amount) && isFinite(amount)) {
                $('#inputAmount').val(amount.toFixed(2)); // Limiting to 2 decimal places
            } else {
                $('#inputAmount').val('');
            }
        }
    });
</script>




<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>