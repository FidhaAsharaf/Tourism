<?php
session_start();
require '../razorpay/razorpay-php-2.8.7/Razorpay.php';

// Retrieve the 'rate' value from the form
if (isset($_POST['price'])) {
    $amount = $_POST['price'];
    $_SESSION['rate'] = $_POST['price'];

    // Check if 'BookingId' is set in the form
    $bookingId = isset($_POST['bookingId']) ? $_POST['bookingId'] : null;

    if ($bookingId !== null) {
        $_SESSION['BookingId'] = $bookingId; // Store BookingId in session
   
    
    // Initialize Razorpay with your test key and secret
    $razorpayKey = 'rzp_test_lljeruIJGqNssK';
    $razorpaySecret = 'iQJDXqyAWOgWLDJGNb0OAgPg';
    $api = new Razorpay\Api\Api($razorpayKey, $razorpaySecret);

    // Ensure that the amount is at least 1.00 (in paisa)
    $amount_in_paisa = max($amount * 100, 100);

    $receiptNumber = uniqid('receipt_', true);
    $transactionDateTime = date('Y-m-d H:i:s');

    $_SESSION['receiptNumber'] = $receiptNumber;
    $_SESSION['transactionDateTime'] = $transactionDateTime;

    // Create a Razorpay order
    $order = $api->order->create(array(
        'amount' => $amount_in_paisa,
        'currency' => 'INR',
        'payment_capture' => '1', // Add a comma here
        'notes' => array(
            'receipt' => $receiptNumber,
            'transaction_datetime' => $transactionDateTime
        ),
    ));
    }
    // Get the order ID
    $orderId = $order->id;

    // Display the payment form with Razorpay button
    echo '<form method="POST" action="razor-success.php">';
    echo '<script src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="' . $razorpayKey . '"
            data-amount="' . $amount_in_paisa . '"
            data-currency="INR"
            data-order_id="' . $orderId . '"
            data-buttontext="Pay with Razorpay"
            data-name="TOURISM"
            data-description="Tour Payment"
            data-image="your_logo_url"
            data-prefill.name="Your Name"
            data-prefill.email="your@example.com"
            data-theme.color="#F37254"
            data-webhook="razorpay_callback.php"></script>';
    echo '</form>';
} else {
    echo "Rate is not set";
}
?>
