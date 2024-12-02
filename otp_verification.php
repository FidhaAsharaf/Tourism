<?php
session_start();
require 'includes/config.php'; // Include your database configuration file

if (isset($_POST['submit'])) {
    $enteredOTP = $_POST['otp'];

    if (isset($_SESSION['otp']) && $enteredOTP == $_SESSION['otp']) {
        // Correct OTP entered, allow password reset
        $_SESSION['reset_password'] = true;
        header('Location: reset_password.php');
        exit();
    } else {
        $error = 'Invalid OTP. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your CSS styles here -->
</head>
<body>
    <form method="post">
        <label for="otp">Enter OTP:</label>
        <input type="text" name="otp" required>
        <button type="submit" name="submit">Verify OTP</button>
    </form>

    <?php
    if (isset($error)) {
        echo '<p>' . $error . '</p>';
    }
    ?>
</body>
</html>
