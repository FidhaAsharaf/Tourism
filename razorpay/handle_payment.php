<?php
// require 'razorpay-php-2.8.7/Razorpay.php'; // Include Razorpay PHP library

// $keyId = 'rzp_test_Xq9Hmxi0pn6sQY';
// $keySecret = 'xVOkDMBvEbT2EqjWKmbUoTca';

// $api = new Razorpay\Api\Api($keyId, $keySecret);

// $paymentId = $_POST['razorpay_payment_id'];
// echo "ID:".$paymentId;
// try {
//     $payment = $api->payment->fetch($paymentId)->capture(array('amount' => 50000)); // Amount in paise
//     echo 'Payment successful. Payment ID: ' . $payment->id;
//     // Perform further actions after successful payment
// } catch (Razorpay\Api\Errors\BadRequestError $e) {
//     echo 'Payment failed 11: ' . $e->getMessage(); // Display specific BadRequestError
// } catch (Exception $e) {
//     echo 'Payment failed: ' . $e->getMessage(); // Catch other exceptions
// }


header("Location: bill.php");

?>
