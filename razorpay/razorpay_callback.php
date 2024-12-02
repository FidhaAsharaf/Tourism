<?php
require '../razorpay/razorpay-php-2.8.7/Razorpay.php';

function verifyRazorpaySignature($postData, $signatureHeader) {
    $razorpayKey = 'rzp_test_lljeruIJGqNssK'; // Your Razorpay key
    $razorpaySecret = 'iQJDXqyAWOgWLDJGNb0OAgPg'; // Your Razorpay secret

    // Check if 'razorpay_signature' key exists in the $postData array
    if (isset($postData['razorpay_signature'])) {
        $signature = $postData['razorpay_signature'];

        // Remove the signature from the response array
        unset($postData['razorpay_signature']);

        // Create an array with your Razorpay secret and the data received in the callback
        $expectedSignature = hash_hmac('sha256', implode('|', $postData), $razorpaySecret);

        // Verify if the signatures match
        return $signature == $expectedSignature;
    } elseif (!empty($signatureHeader)) {
        // If the signature is not in POST, check in headers
        $expectedSignature = hash_hmac('sha256', file_get_contents('php://input'), $razorpaySecret);

        // Verify if the signatures match
        return $signatureHeader == $expectedSignature;
    } else {
        return false;
    }
}

// Check if the payment is successful
if (isset($_POST['razorpay_signature'])) {
    $signatureHeader = isset(getallheaders()['X-Razorpay-Signature']) ? getallheaders()['X-Razorpay-Signature'] : null;

    $success = verifyRazorpaySignature($_POST, $signatureHeader);

    if ($success) {
        // Payment successful
        $paymentStatus = true;

        // You should also get the order ID from Razorpay callback response
        $orderId = $_POST['razorpay_order_id'];

        if ($paymentStatus) {
            // Update payment status in the database
            updatePaymentStatusInDatabase($orderId);
            echo "Payment successful! Payment status updated in the database.";
        } else {
            echo "Payment failed!";
        }
    } else {
        // Payment failed
        echo "Payment failed!";
    }
} else {
    echo "Invalid request!";
}

// Function to update payment status in the database
function updatePaymentStatusInDatabase($orderId) {
    // Add your database connection code here
    include("../dbconn.php");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Assuming your order ID is stored in the 'receipt' field of the notes
    $updateSql = "UPDATE booking_details SET payment_status = 1 WHERE order_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("s", $orderId);

    if ($stmt->execute()) {
        echo "Payment status updated successfully!";
    } else {
        echo "Error updating payment status: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
