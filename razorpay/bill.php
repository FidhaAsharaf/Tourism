<?php
session_start();
include('includes/config.php');

// Check if session variables exist and assign them to local variables
$transactionDateTime = $_SESSION['transactionDateTime'] ?? null;
$receiptNumber = $_SESSION['receiptNumber'] ?? null;
$amountPaid = $_SESSION['rate'] ?? null;
$bookingId = $_SESSION['BookingId'] ?? null; // Assuming BookingId is stored in the session

// Assuming you have established a database connection using $dbh
if ($dbh) {
    try {
        // Prepare the SQL INSERT statement
        $sql = "INSERT INTO payment (transaction_date, receipt_number, amount_paid, status, BookingId) VALUES (:transaction_date, :receipt_number, :amount_paid, 'Success', :bookingId)";

        // Assuming you are using named placeholders in PDO
        $stmt = $dbh->prepare($sql);

        // Bind the parameters and execute the query
        $stmt->bindParam(':transaction_date', $transactionDateTime, PDO::PARAM_STR);
        $stmt->bindParam(':receipt_number', $receiptNumber, PDO::PARAM_STR);
        $stmt->bindParam(':amount_paid', $amountPaid, PDO::PARAM_STR);
        $stmt->bindParam(':bookingId', $bookingId, PDO::PARAM_INT); // Assuming BookingId is an integer

        if ($stmt->execute()) {
            echo "<script>alert('Payment Successful');</script>";
        } else {
            throw new Exception($stmt->errorInfo()[2]); // Get the specific error message
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Database connection error.";
}
?>




<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Payment Receipt</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            .wrapper {
                width: 100%;
                max-width: 600px;
                margin: 20px auto;
                overflow-x: auto;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <h1>Payment Receipt</h1>
            <table>
            <tr>
                    <th>BookingId</th>
                    <td><?php echo $bookingId; ?></td>
                </tr>
            <tr>
                    <th>Date</th>
                    <td><?php echo $transactionDateTime; ?></td>
                </tr>
                <tr>
                    <th>Receipt Number</th>
                    <td><?php echo $receiptNumber; ?></td>
                </tr>
                <tr>
                    <th>Amount Paid</th>
                    <td><?php echo $amountPaid; ?></td>
                </tr>
            </table>
                    <!-- Button to go back to confirmed.php -->
                    <a class="back-button" href="../confirmed.php"><Button>Go Back</Button></a>

    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script> <!-- Add any additional information or styling here -->
        </div>
    </body>
    </html>