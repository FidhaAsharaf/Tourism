<?php

use Razorpay\Api\Api;

// Include the autoload file from the Razorpay SDK
require '../razorpay/razorpay-php-2.8.7/libs/Requests-2.0.4/src/Autoload.php';

// Your Razorpay key and secret
$razorpayKey = 'rzp_test_lljeruIJGqNssK';
$razorpaySecret = 'iQJDXqyAWOgWLDJGNb0OAgPg';

// Initialize the Razorpay API with your key and secret
$api = new Api($razorpayKey, $razorpaySecret);

// Order data
$orderData = [
    'receipt'   => 'rcptid_11',
    'amount'    => 39900, // 39900 rupees in paise
    'currency'  => 'INR'
];

// Create the order
try {
    $razorpayOrder = $api->order->create($orderData);
    
    // Now $razorpayOrder contains the details of the created order
    print_r($razorpayOrder);
} catch (Exception $e) {
    // Handle exceptions
    echo 'Error creating Razorpay order: ' . $e->getMessage();
}
