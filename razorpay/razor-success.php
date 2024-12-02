<?php
session_start();

// Check if the payment was successful
if (isset($_SESSION['payment_success']) && $_SESSION['payment_success']) {
    // Display the payment success information
    $paymentId = $_SESSION['payment_id'];
    $orderId = $_SESSION['order_id'];
    $amount = $_SESSION['amount'];

    echo "<div class='notice'>";
    echo "<h2>Payment Successful</h2>";
    echo "<p>Thank you for your payment!</p>";
    echo "<p>Payment ID: $paymentId</p>";
    echo "<p>Order ID: $orderId</p>";
    echo "<p>Amount: $amount INR</p>";
    // ... (you can add more details if needed)
    echo "</div>";

    // Clear the session variables
 
} else {
    // Redirect to the homepage or another page if accessed directly without successful payment
    header('Location:bill.php');
    exit;
}
?>
