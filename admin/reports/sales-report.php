<?php ob_start();
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ./signin.php");
    exit();
}

include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");

use App\salesReport;

$_salesReports = new salesReport();
$salesReports = $_salesReports->index();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_salesReport = new salesReport();
    $salesReports = $_salesReport->filteringData($_POST);

}

$total_qty = 0;
$total_sold_price = 0;
$total_profit = 0;
$total_vat = 0;

?>

<section>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <div class="card card-report">
                    <div class="card-head">
                        <h3 class="m-4" style="color: black;">Sales Report</h3>
                        <!-- <div class="mt-4 me-3 text-right">
                            <a class="btn btn-primary" href="sales-report-download.php" role="button">Download Pdf</a>
                        </div> -->
                    </div>
                    <div class="card-body">
                        <table id="salesReportTable" class="table table-responsive text-center">
                            <thead>
                                <tr>
                                    <th colspan="7">
                                        <form action="./sales-report.php" method="POST">
                                            <label for="start_date">Start Date:</label>
                                            <input type="date" id="start_date" name="start_date" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                echo $_POST['start_date'];
                                            } ?>">

                                            <label for="end_date">End Date:</label>
                                            <input type="date" id="end_date" name="end_date" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                echo $_POST['end_date'];
                                            } ?>">

                                            <button type="submit">Apply Filter</button>
                                        </form>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Purchasing Price</th>
                                    <th>Selling Price</th>
                                    <th>Sold Qty</th>
                                    <th>Sold Price</th>
                                    <th>Profit</th>
                                    <th>Provided Vat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!$salesReports) { ?>
                                    <tr>
                                        <td colspan="7" style="text-align: center;">No Record Found</td>
                                    </tr>
                                <?php } else { ?>
                                    <?php foreach ($salesReports as $salesReport) { ?>
                                        <tr>
                                            <td><?php echo $salesReport['product_name'] ?></td>
                                            <td><?php echo $salesReport['purchasing_price'] ?></td>
                                            <td><?php echo $salesReport['selling_price'] ?></td>
                                            <td><?php echo $salesReport['total_sold_quantity'] ?></td>
                                            <td><?php echo $salesReport['total_sold_price'] ?></td>
                                            <td><?php echo $salesReport['profit'] ?></td>
                                            <td><?php echo $salesReport['vat'] ?></td>
                                        </tr>
                                        <?php
                                        $total_qty += $salesReport['total_sold_quantity'];
                                        $total_sold_price += $salesReport['total_sold_price'];
                                        $total_profit += $salesReport['profit'];
                                        $total_vat += $salesReport['vat'];
                                        ?>
                                    <?php } ?>
                                    <tr>
                                        <td style="background-color: #b2beb5" colspan="3"><strong>Total</strong></td>
                                        <td style="background-color: #b2beb5"><strong><?php echo $total_qty; ?></strong>
                                        </td>
                                        <td style="background-color: #b2beb5">
                                            <strong><?php echo $total_sold_price; ?></strong>
                                        </td>
                                        <td style="background-color: #b2beb5"><strong><?php echo $total_profit; ?></strong>
                                        </td>
                                        <td style="background-color: #b2beb5"><strong><?php echo $total_vat; ?></strong>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                        <div class="mt-4 text-right">
                            <a class="btn btn-primary"
                                href="sales-report-download.php<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    echo "?start_date=" . $_POST['start_date'] . "&end_date=" . $_POST['end_date'];
                                } ?>"
                                role="button">Download Pdf</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>