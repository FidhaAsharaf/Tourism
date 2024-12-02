<?php
session_start();
require 'includes/config.php';

if (!isset($_SESSION['reset_password']) || $_SESSION['reset_password'] !== true) {
    // Redirect the user to the OTP verification page if not verified
    header('Location: otp_verification.php');
    exit();
}

if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate password and confirm password
    if ($password !== $confirmPassword) {
        $error = 'Passwords do not match. Please try again.';
    } else {
        // Hash the new password using md5 (same as in the signup page)
        $hashedPassword = md5($password);

        // Update the user's password in the database using the email from forgot_password.php
        $email = $_SESSION['forgot_password_email'];
        $sql = "UPDATE tblusers SET Password=:password WHERE EmailId=:email";
        $query = $dbh->prepare($sql);
        $query->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);

        try {
            if ($query->execute()) {
                // Password updated successfully
                header('Location: index.php'); // Redirect to login page or any other page
                exit();
            } else {
                // Error updating password
                $error = 'Error updating password. Please try again.';
            }
        } catch (PDOException $e) {
            // Print the PDO exception for debugging
            echo 'PDO Exception: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your CSS styles here -->
</head>
<body>
    <h2>Reset Password</h2>
    
    <form method="post">
        <label for="password">New Password:</label>
        <input type="password" name="password" required>
        
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required>
        
        <button type="submit" name="submit">Reset Password</button>
    </form>

    <?php
    if (isset($error)) {
        echo '<p>' . $error . '</p>';
    }
    ?>
</body>
</html>
