<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ./signin.php");
    exit();
}

include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");

use App\orders;

$_order = new orders();

// Checks if the id parameter is present in the URL.
if (!isset($_GET['id'])) {
    header("Location: ./orders.php");
    exit();
}

// gets the order ID from the URL and stores it in the variable $order_id
$order_id = $_GET['id'];
$order = $_order->getOrderById($order_id);

// Checks if the order exists.
if (!$order) {
    header("Location: ./orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        .invoice-header,
        .invoice-details,
        .invoice-summary {
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            vertical-align: middle;
        }

        @media print {
            .btn-danger {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div id="printDiv">
        <div class="container">
            <div class="row invoice-header">
                <div class="col-md-6">
                    <h2>Invoice</h2>
                </div>
                <div class="col-md-6 text-right">
                    <h4>Turnago Enterprise</h4>
                    <p>Islam Mansion, (5th Floor),<br> Plot- 39, Road- 126, Gulshan-1,<br> Dhaka, Bangladesh<br></p>
                </div>
            </div>

            <div class="row invoice-details">
                <div class="col-md-6">
                    <h5>To: </h5>
                    <p>Client Name: <?php echo $order['c_name']; ?><br>
                        Address: <?php echo $order['c_address']; ?><br>
                        Phone: <?php echo $order['c_phone']; ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col" style="border-bottom: 2px solid black;">Client</th>
                                <th scope="col" style="border-bottom: 2px solid black;">Product Name</th>
                                <th scope="col" style="border-bottom: 2px solid black;">Order Date</th>
                                <th scope="col" style="border-bottom: 2px solid black;">Price</th>
                                <th scope="col" style="border-bottom: 2px solid black;">Quantity</th>
                                <th scope="col" style="border-bottom: 2px solid black;">Amount</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $order['c_name']; ?></td>
                                <td><?php echo $order['product_name']; ?></td>
                                <td><?php echo $order['created_at']; ?></td>
                                <td><?php echo $order['rate']; ?></td>
                                <td><?php echo $order['quantity']; ?></td>
                                <td><?php echo $order['amount']; ?></td>
                                
                            </tr>

                            <tr>
                            <td style="background-color: #b2beb5" colspan="5"><strong>Total</strong></td>
                            <td style="background-color: #b2beb5"><strong><?php echo $order['amount']; ?></strong>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <a class="btn btn-danger" onclick="printContent('printDiv')" href="javascript:void(0);"
                    role="button">Download Pdf</a>
            </div>
        </div>
    </div>

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
</body>

</html>