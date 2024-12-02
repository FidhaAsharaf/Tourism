<?php
error_reporting(0);
if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$mnumber=$_POST['mobilenumber'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql="INSERT INTO  tblusers(FullName,MobileNumber,EmailId,Password) VALUES(:fname,:mnumber,:email,:password)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mnumber',$mnumber,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="You are Scuccessfully registered. Now you can login ";
header('location:thankyou.php');
}
else 
{
$_SESSION['msg']="Something went wrong. Please try again.";
header('location:thankyou.php');
}
}
?>
<!--Javascript for check email availabilty-->
<script>
function checkAvailability() {

    $("#loaderIcon").show();
    jQuery.ajax({
        url: "check_availability.php",
        data: 'emailid=' + $("#email").val(),
        type: "POST",
        success: function(data) {
            $("#user-availability-status").html(data);
            $("#loaderIcon").hide();
        },
        error: function() {}
    });
}
</script>

<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Add my custom css -->
            <style>
        .login-left li {
        display: inline-block;
        margin: 0 10px;
    }

    .login-left a {
        color: #fff;
        text-decoration: none;
        display: inline-block;
        padding: 12px;
        border: 2px solid #fff;
        border-radius: 5px;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .login-left a.fb {
        background-color: #1877f2;
    }

    .login-left a.goog {
        background-color: #ea4335;
    }



            </style>




            <div class="modal-header">
                <button style="color: white;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <section>
                <div class="modal-body modal-spa">
                    <div class="login-grids">
                        <div class="login">
                            <div class="login-left">
                                <ul>
                                    <li><a class="fb" href="#"><i></i>Facebook</a></li>
                                    <li><a class="goog" href="#"><i></i>Google</a></li>

                                </ul>
                            </div>
                            <div class="login-right">
                            <form name="signup" method="post" onsubmit="return validateForm();">
    <h3>Create your account</h3>

    <input type="text" value="" placeholder="Full Name" name="fname" id="fname" autocomplete="off" required>
    <span id="fnameError" class="error"></span>

    <input type="text" value="" placeholder="Mobile number" maxlength="10" name="mobilenumber" id="mobilenumber" autocomplete="off" required>
    <span id="mobilenumberError" class="error"></span>

    <input type="text" value="" placeholder="Email id" name="email" id="email" onBlur="checkAvailability()" autocomplete="off" required>
    <span id="user-availability-status" style="font-size:12px;"></span>
    <span id="emailError" class="error"></span>

    <input type="password" value="" placeholder="Password" name="password" id="password" required>
    <span id="passwordError" class="error"></span>

    <input type="submit" name="submit" id="submit" value="CREATE ACCOUNT">
</form>

<script>
    function validateForm() {
        var fname = document.getElementById("fname").value;
        var mobilenumber = document.getElementById("mobilenumber").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;

        var isValid = true;

        // Full Name validation
        if (fname.trim() === "") {
            document.getElementById("fnameError").textContent = "Full Name is required";
            isValid = false;
        } else {
            document.getElementById("fnameError").textContent = "";
        }

        // Mobile Number validation
        if (mobilenumber.trim() === "" || !/^\d{10}$/.test(mobilenumber)) {
            document.getElementById("mobilenumberError").textContent = "Enter a valid 10-digit mobile number";
            isValid = false;
        } else {
            document.getElementById("mobilenumberError").textContent = "";
        }

        // Email validation
        if (email.trim() === "" || !/\S+@\S+\.\S+/.test(email)) {
            document.getElementById("emailError").textContent = "Enter a valid email address";
            isValid = false;
        } else {
            document.getElementById("emailError").textContent = "";
        }

        // Password validation (optional)
        if (password.trim() === "") {
            document.getElementById("passwordError").textContent = "Password is required";
            isValid = false;
        } else {
            document.getElementById("passwordError").textContent = "";
        }

        return isValid;
    }
</script>


                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <br>
                        <p style="color: white;" >By logging in you agree to our <a style=" color: #CCD6F6;" href="page.php?type=terms">Terms and Conditions</a> and <a style=" color: #CCD6F6;" 
                            href="page.php?type=privacy">Privacy Policy</a></p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>