<?php

session_start();
require 'config.php';
if(isset($_POST['signin']))
{
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT EmailId,Password FROM tblusers WHERE EmailId=:email and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
        $_SESSION['login'] = $_POST['email'];
        echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    } 
    else
    {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <!-- add custom css -->
            <style>
    .modal-content {
        border-radius: 10px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        background-color: rgb(51 65 85);
    }

    .modal-header {
        border-bottom: none;
    }

    .modal-body {
        padding: 30px;
    }

    .social-icons li {
        display: inline-block;
        margin: 0 10px;
    }

    .social-icons a {
        color: #fff;
        text-decoration: none;
        display: inline-block;
        padding: 12px;
        border: 2px solid #fff;
        border-radius: 5px;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .social-icons a.fb {
        background-color: #1877f2;
    }

    .social-icons a.goog {
        background-color: #ea4335;
    }

    .login form h3 {
        margin: 0;
        font-size: 30px;
        color: #24D4D5;
        font-weight: 600;
        padding: 15px;
        border-radius: 5px;
    }

    .login form input[type="text"],
    .login form input[type="password"] {
        width: 100%;
        padding: 15px;
        margin-bottom: 20px;
        border: none;
        border-bottom: 2px solid #ddd;
        outline: none;
        font-size: 16px;
        background-color: transparent; 
        color: white;
    }

    .login form h4 a {
        color: #CCD6F6;
        text-decoration: none;
    }

    .login form input[type="submit"] {
        background-color: #24D4D5;
        color: black;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 18px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s;
    }

    .login-right input{
        color: white;
    }

    .login form input[type="submit"]:hover {
        background-color: cyan;
    }

    .login p {
        margin-top: 20px;
        color: white!important;
    }

    .login p a {
        color: white!important;
        text-decoration: none!important;
        
    }

    .login p a:hover {
        text-decoration: underline;
    }
</style>

 
                <button style="color: white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="login-grids">
                    <div class="login">
                        <div class="login-left">
                           
                        </div>
                        <div class="login-right">
                            <form method="post">
                                <h3>Sign in with your account</h3>
                                <input type="text" name="email" id="email" placeholder="Enter your Email" required="">
                                <input type="password" name="password" id="password" placeholder="Password" required minlength="6">
                                <script>
  function validateForm() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // Simple email format validation
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!email.match(emailPattern)) {
      alert("Please enter a valid email address.");
      return false;
    }

    // Password length validation
    if (password.length < 6) {
      alert("Password must be at least 6 characters long.");
      return false;
    }

    // If all validations pass, the form will be submitted.
    return true;
  }
</script>

                                <h4><a href="forgot_password.php">Forgot password</a></h4>
                                <br>
                                <input type="submit" name="signin" value="SIGN IN">
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <br>
                   
                </div>
            </div>
        </div>
    </div>
</div>
