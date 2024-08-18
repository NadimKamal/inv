<?php
namespace App;

use PDO;

class salesReport
{
    public $id = null;
    public $salesReport = null;
    public $conn = null;


    public function __construct()
    {
        // Connection to database

        $servername = "localhost";
        $username = "root";
        $password = "";

        $this->conn = new PDO("mysql:host=$servername; dbname=inv", $username, $password);
        // set the PDO error mode to exception

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    public function filteringData($postData)
    {
        $currentDate = date("Y-m-d");
        // Retrieve start and end dates from the form submission
        $startDate = filter_var($postData['start_date']);
        $endingDate = filter_var($postData['end_date']);
        $endDate = $endingDate . " 23:59:59";
        
        if ($endingDate == $currentDate) {
            $endDate = date("Y-m-d H:i:s");
        }

        $query = "SELECT * FROM sales_report WHERE updated_at BETWEEN :starting_date AND :ending_date";
        $statement = $this->conn->prepare($query);

        // Bind parameters with sanitized data
        $statement->bindParam(":starting_date", $startDate);
        $statement->bindParam(":ending_date", $endDate);

        $statement->execute();
        $filteredData = $statement->fetchAll();

        return $filteredData;
    }



    public function index()
    {

        //Insert Query
        $query = "SELECT * FROM `sales_report`";

        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();
        $salesReport = $stmt->fetchAll();

        return $salesReport;
    }


    public function downloadPdf(){
        
    $salesReports = $this->index();
    if ($_GET) {
        $salesReports = $this->filteringData($_GET);
    }
    // Fetch sales reports data

    // Initialize PDF object
    $mpdf = new \Mpdf\Mpdf();

    // Start buffering
    ob_start();

    // Start PDF content
    ?>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #dddddd;
            text-align: left;
            height: 25px; /* Set a consistent height */
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
    <h1 style="text-align: center; margin-bottom: 20px;">Inventory Management System</h1>
    <h3 style="text-align: center; margin-bottom: 20px;">Sales Report</h3>
    <table>
        <thead>
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
                <?php
                $total_qty = 0;
                $total_sold_price = 0;
                $total_profit = 0;
                $total_vat = 0;

                foreach ($salesReports as $salesReport) { ?>
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
                } ?>
                <tr>
                    <td style="background-color: #b2beb5" colspan="3"><strong>Total</strong></td>
                    <td style="background-color: #b2beb5"><strong><?php echo $total_qty; ?></strong></td>
                    <td style="background-color: #b2beb5"><strong><?php echo $total_sold_price; ?></strong></td>
                    <td style="background-color: #b2beb5"><strong><?php echo $total_profit; ?></strong></td>
                    <td style="background-color: #b2beb5"><strong><?php echo $total_vat; ?></strong></td>
                </tr>
            <?php } ?>
        </tbody>

    </table>
    <?php

    // End buffering
    $html = ob_get_clean();

    // Write HTML content to PDF
    $mpdf->WriteHTML($html);

    // Output PDF to browser
    $mpdf->Output('sales_report.pdf', 'D');
}
}