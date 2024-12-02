<?php
session_start();
require 'includes/config.php'; // Include your database configuration file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer library

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $sql = "SELECT id, FullName FROM tblusers WHERE EmailId=:email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($query->rowCount() > 0) {
        // Generate and store a random OTP
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['user_id'] = $result['id'];

        // Set the forgot_password_email session variable
    $_SESSION['forgot_password_email'] = $email;


        // Send OTP via email
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 2; // Enable verbose debug output

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Your SMTP server
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'fidha23fda@gmail.com'; // Your email address
            $mail->Password = 'ukqbkjsaverqmese'; // Your email password
            $mail->setFrom('fidha23fda@gmail.com', 'fda');
            $mail->addAddress($email, $result['FullName']);
            $mail->Subject = 'Password Reset OTP';
            $mail->Body = 'Your OTP for password reset is: ' . $otp;

            $mail->send();

            // Redirect to OTP verification page
            header('Location: otp_verification.php');
            exit();
        } catch (Exception $e) {
            echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
        }
    } else {
        echo 'Email not found in the database.';
    }
}
?>

<!-- Your HTML form for entering the email -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your CSS styles here -->
</head>
<body>
    <form method="post">
        <input type="email" name="email" placeholder="Enter your registered email" required>
        <button type="submit" name="submit">Send OTP</button>
    </form>
</body>
</html>
