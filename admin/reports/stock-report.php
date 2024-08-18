<?php ob_start();

session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ./signin.php");
    exit();
}

include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");


use App\products;
use App\warehouses;
use App\categories;
use App\stocksReport;

$_product = new products();
$_stock_reports = new stocksReport();
$products = $_product->index();
$normal_products = $_product->normalStockProducts();
$low_stock_products = $_product->lowStockProducts();
$out_of_stock_products = $_product->stockOutProducts();


$_category = new categories();
$categories = $_category->index();
$_warehouse = new warehouses();
$warehouses = $_warehouse->index();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST) {
        $category_id = null;
        $warehouse_id = null;
        $stock = null;
        $products = $_stock_reports->getFilteredData($_POST);
    }
}


?>

<section>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <div class="card card-report">
                    <div class="card-head">
                        <h3 class="m-4" style="color: black;">Stock Report</h3>
                    </div>
                    <div class="card-body">
                        <div class="filter-area">
                            <form action="./stock-report.php" method="POST">
                                <div class="row">
                                    <div class="col-3">
                                        <select class="form-control" id="categorySelect" name="category"
                                            onchange="categoryWise()">
                                            <option value="">Select Category</option>
                                            <?php foreach ($categories as $category) { ?>
                                                <option value="<?php echo $category['id'] ?>">
                                                    <?php echo $category['category'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <select class="form-control" name="stock" id="stockSelect"
                                            onchange="stockWise()">
                                            <option value="">Select Stock Level</option>
                                            <!-- <option value="0">Nill</option> -->
                                            <option value="1">Low Stock</option>
                                            <option value="2">Normal Stock</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <select class="form-control" id="warehouseSelect" name="warehouse"
                                            onchange="warehouseWise()">
                                            <option value="">Select Warehouse</option>
                                            <?php foreach ($warehouses as $warehouse) { ?>
                                                <option value="<?php echo $warehouse['id'] ?>">
                                                    <?php echo $warehouse['warehouse'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="printDiv">
                            <h3>Stock Report</h3>
                            <table id="stocksReportTable" class="table table-responsive text-center">
                                <thead>
                                    <tr>
                                        <th class="text-start">Product</th>
                                        <th>Category</th>
                                        <th>Quantity</th>

                                        <?php if ($_SESSION['role_id'] === 1) { ?>
                                            <th>Price</th>
                                        <?php } ?>

                                        <th>Warehouse</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product) { ?>
                                        <tr class="table-row" >
                                            <td class="text-start"><?php echo $product['product'] ?></td>
                                            <td><?php echo $_category->getCategory($product['category']) ?></td>
                                            <td><?php echo $product['quantity'] ?></td>

                                            <?php if ($_SESSION['role_id'] === 1) { ?>
                                                <td><?php echo $product['price'] ?></td>
                                            <?php } ?>

                                            <td><?php echo $_warehouse->getWarehouse($product['warehouse']) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 text-left">
                            <a class="btn btn-danger" onclick="printContent('printDiv')" href="javascript:void(0);"
                                role="button">Download Pdf</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- <script>

    function categoryWise() {
    var selectedCategory = document.getElementById('categorySelect').value;
    var rows = document.querySelectorAll('.table-row');
    rows.forEach(function (row) {
        var categoryName = row.getAttribute('data-category');
        if (!selectedCategory || categoryName === selectedCategory) {
            row.style.display = 'table-row';
        } else {
            row.style.display = 'none';
        }
    });
    document.getElementById('stockSelect').selectedIndex = ""; // Reset stock dropdown
    document.getElementById('warehouseSelect').selectedIndex = "";
}


    function stockWise() {
        var selectedStock = document.getElementById('stockSelect').value;
        var rows = document.querySelectorAll('.table-row');
        rows.forEach(function (row) {
            var quantity = parseInt(row.getAttribute('data-quantity')); // Parse quantity as integer
            var stockLevel = ""; // Variable to store the stock level

            // Determine the stock level based on the quantity
            if (quantity < 30 && quantity > 0) {
                stockLevel = "low_stock";
            } else if (quantity === 0) {
                stockLevel = "nill";
            } else {
                stockLevel = "normal_stock";
            }

            // Check if the selected stock level matches the row's stock level
            if (!selectedStock || stockLevel === selectedStock) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
        document.getElementById('categorySelect').selectedIndex = ""; // Reset stock dropdown
        document.getElementById('warehouseSelect').selectedIndex = "";
    }

    function warehouseWise() {
        var selectedWarehouse = document.getElementById('warehouseSelect').value;
        var rows = document.querySelectorAll('.table-row');
        rows.forEach(function (row) {
            var warehouseName = row.getAttribute('data-warehouse');
            if (!selectedWarehouse || warehouseName === selectedWarehouse) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
        document.getElementById('stockSelect').selectedIndex = ""; // Reset stock dropdown
        document.getElementById('categorySelect').selectedIndex = "";
    }

</script> -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    function printContent(el) {
        var printContent = document.getElementById(el).innerHTML;
        var originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
        window.location.reload();
    }
</script>


<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>