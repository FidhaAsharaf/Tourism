<?php
session_start();

// Check if the payment was successful
if (isset($_SESSION['payment_status']) && $_SESSION['payment_status'] === 'success') {
    echo '<script>alert("Payment Successful!");</script>';
} else {
    echo '<script>alert("Payment Failed!");</script>';
}

// Clear the session variable
unset($_SESSION['payment_status']);
?>
