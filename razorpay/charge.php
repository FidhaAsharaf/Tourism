<?php
require 'razorpay-php-2.8.7/Razorpay.php';

$keyId = 'rzp_test_Xq9Hmxi0pn6sQY';
$keySecret = 'xVOkDMBvEbT2EqjWKmbUoTca';

$api = new Razorpay\Api\Api($keyId, $keySecret);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = isset($_POST['amount']) ? $_POST['amount'] : null;
    $receipt = isset($_POST['receipt']) ? $_POST['receipt'] : null;
    $currency = isset($_POST['currency']) ? $_POST['currency'] : 'INR'; // Default to INR if not provided


    // Check if the form data is valid
    if ($amount !== null && $receipt !== null && $currency !== null) {
        $order = $api->order->create(array(
            'amount' => $amount,
            'currency' => $currency,
            'receipt' => $receipt,
        ));

        $orderId = $order['id'];
        $orderId = $order->id;

        // Display the payment form with Razorpay button
        echo '<form method="POST">';
        echo '<script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="' . $keyId . '"
                data-amount="'.$amount.'" 
                data-currency="INR"
                data-order_id="' . $orderId . '"
                data-buttontext="Pay with Razorpay"
                data-name="KBoat"
                data-description="Dummy Payment"
                data-image="your_logo_url"
                data-prefill.name="KBOAT"
                data-prefill.email="your@example.com"
                data-theme.color="#F37254"></script>';
        echo '</form>';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>amount</title>
</head>
<body>

<form method="post" action="charge.php">
    <label for="amount">Amount:</label>
    <input type="text" name="amount" id="amount" />

    <label for="receipt">Receipt:</label>
    <input type="text" name="receipt" id="receipt" />

    <label for="currency">Currency:</label>
    <input type="text" name="currency" id="currency" />

    <input type="submit" value="Submit" />
</form>

</body>
</html>
