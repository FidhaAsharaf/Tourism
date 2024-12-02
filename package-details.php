<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['submit2'])) {
    $pid = intval($_GET['pkgid']);
    $useremail = $_SESSION['login'];
    $fromdate = $_POST['selected_date'];
    $total_price = $_POST['total_price'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $seniors = $_POST['seniors'];
    $package_type = $_POST['package_type'];
    $selected_addons = $_POST['selected_addons'];
    $status = 0;
    $sql = "INSERT INTO tblbooking(PackageId,UserEmail,FromDate,status,addsOn,pkgtype,child,adult,senior,total) VALUES
(:pid,:useremail,:fromdate,:status,:selected_addons,:package_type,:children,:adults,:seniors,:total_price)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pid', $pid, PDO::PARAM_STR);
    $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
    $query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':selected_addons', $selected_addons, PDO::PARAM_STR);
    $query->bindParam(':package_type', $package_type, PDO::PARAM_STR);
    $query->bindParam(':children', $children, PDO::PARAM_STR);
    $query->bindParam(':adults', $adults, PDO::PARAM_STR);
    $query->bindParam(':seniors', $seniors, PDO::PARAM_STR);
    $query->bindParam(':total_price', $total_price, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        $msg = "Booked Successfully";
    } else {
        $error = "Something went wrong. Please try again";
    }

}



// ... Existing code ...

// Check if the user is logged in
if ($_SESSION['login']) {
    // Add rating and feedback
    if (isset($_POST['submit_rating'])) {
        $user_email = $_SESSION['login'];
        $package_id = intval($_GET['pkgid']);
        $rating = $_POST['rating'];
        $feedback = $_POST['feedback'];

        // Check if the user has already rated for the package
        $check_rating_sql = "SELECT * FROM tblratings WHERE PackageId = :package_id AND UserEmail = :user_email";
        $check_rating_query = $dbh->prepare($check_rating_sql);
        $check_rating_query->bindParam(':package_id', $package_id, PDO::PARAM_INT);
        $check_rating_query->bindParam(':user_email', $user_email, PDO::PARAM_STR);
        $check_rating_query->execute();

        if ($check_rating_query->rowCount() > 0) {
            $error = "You have already rated for this package.";
        } else {
            $insert_rating_sql = "INSERT INTO tblratings(PackageId, UserEmail, Rating, Feedback, CreatedAt, user_id) VALUES
                (:package_id, :user_email, :rating, :feedback, NOW(), :user_id)";
            $insert_rating_query = $dbh->prepare($insert_rating_sql);
            $insert_rating_query->bindParam(':package_id', $package_id, PDO::PARAM_INT);
            $insert_rating_query->bindParam(':user_email', $user_email, PDO::PARAM_STR);
            $insert_rating_query->bindParam(':rating', $rating, PDO::PARAM_INT);
            $insert_rating_query->bindParam(':feedback', $feedback, PDO::PARAM_STR);
            $insert_rating_query->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $insert_rating_query->execute();

            $msg = "Rating and feedback submitted successfully.";
        }
    }

    // ... Existing code ...
}

// ... Existing code ...

?>




<!DOCTYPE HTML>
<html>

<head>
    <title>TourEase | Package Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="applijewelleryion/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
    </script>
    <!--bootstrap css-->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <!--font-awesome css-->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">

    <!--custom css-->
    <link href="css/mystyle.css" rel="stylesheet" type="text/css" />
    <link href="css/package.css" rel="stylesheet" type="text/css" media="all">

    <!--import modal from bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!--import jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--import popper.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!--import bootstrap.js-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />


    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>

    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui.js"></script>

    <script>
        new WOW().init();
    </script>
    <script src="js/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#datepicker,#datepicker1").datepicker();
        });
    </script>
    <style>
        .journey,
        .total {
            padding: 10px 40px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;

        }

        .details {
            box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
        }

        .descc {
            margin: 20px auto;
            box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
            background-color: #ebf0f4;
        }

        #addsOnDiv {
            padding: 10px 40px;
            display: flex;
            flex-direction: column;
            font-size: 24px;
        }

        .number span {
            padding-left: 10px;
            padding-right: 10px;
        }

        .number button {
            font-size: 25px;
            padding-top: 0px;
            padding-bottom: 0px;
        }

        .person {
            display: none;
            padding: 10px 20px;
            flex-direction: column;
            justify-content: center;
        }

        .adult,
        .child,
        .senior {
            padding: 8px 20px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }

        .succWrap {
            margin-top: 30px!important;
            padding: 10px;
            margin: 0 0 20px 0;
            background: #14A44D;
            width: 50%;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            color: #fff;
            font-weight: 700;
        }
    </style>
     
     <style>
        /* Add CSS styles for the star rating */
       

        .star {
            width: 20px;
    height: 20px;
    background-color: grey; /* default star color */
    clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
    display: inline-block;
            cursor: pointer;
        }

        .star:before {
            content: '\2605'; /* Unicode character for a solid star */
            font-size: 20px;
            color: grey; /* Default color */
        }

        .star.selected:before {
            color: gold; /* Selected (golden) color */
        }
        
    </style>

<style>
.rating {
    display: inline-block;
}

.stars {
    width: 20px;
    height: 20px;
    background-color: grey; /* default star color */
    clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
    display: inline-block;
}

.selected {
    background-color: gold; /* selected (filled) star color */
}

    </style>


</head>

<body>
    <?php include('includes/header.php'); ?>
    <div class="container" margin-bottom="20px">

        <?php
        if ($error) { ?>
            <div class="errorWrap">
                <strong>ERROR</strong>:
                <?php echo htmlentities($error); ?>
            </div>
        <?php } else if ($msg) { ?>
                <div class="succWrap"><strong>SUCCESS</strong>:
                <?php echo htmlentities($msg); ?>
                </div>
        <?php } ?>
        <?php
        $pid = intval($_GET['pkgid']);
        $sql = "SELECT * from tbltourpackages where PackageId=:pid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':pid', $pid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
            foreach ($results as $result) { ?>
<br>
                <!-- title of the package -->
                <h2 class="text-left">
                   <?php echo htmlentities($result->PackageName); ?>
                    
                </h2>
                <br>

                <!-- image of the package -->
                <div class="row">
                    <div class="col-md-8">
                        <img src="admin/packageimages/<?php echo htmlentities($result->PackageImage); ?>" class="img-responsive"
                            alt="image not found" width="100%" height="400">
                    </div>

                    <!-- details of the package -->
                    <div class="col-md-4">
                        <div class="details" style="background-color:#ebf0f4" height="400">
                            <!-- create map with mapboxgl_map with 100% width and height 200px -->
                            <div class="mapouter">
                                <div class="gmap_canvas">
                                    <iframe width="100%" height="200" id="gmap_canvas"
                                        src="https://maps.google.com/maps?q=<?php echo htmlentities($result->PackageLocation); ?>&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                </div>
                            </div>
                            <div class="desc" style="padding:18px;">
                                <!-- adding wifi, playground, pool, breakfast,lunch,dinner with icon in a list -->
                                <ul style="font-size:25px">
                                    <li><i style="color:black;" class="fa fa-wifi" aria-hidden="true"></i>
                                        Wifi</li>
                                    <li><i style="color:green;" class="fa fa-play" aria-hidden="true"></i>
                                        Playground</li>
                                    <li><i style="color:blue;" class="fa fa-check" aria-hidden="true"></i>
                                        Pool</li>
                                    <li><i class='fas fa-hamburger' style='color:red'></i>
                                        Breakfast, Dinner</li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- description  add on, total price ,include and exclude ,tour plan -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="pkgtype">
                            <!-- radio button selector -->
                            <h3>Select Package Type</h3>
                            <form class="myform">
                                <input type="radio" id="single" name="pkgtype" value="single" checked>
                                <label for="single">Single</label><br>
                                <input type="radio" id="couple" name="pkgtype" value="couple">
                                <label for="couple">Couple</label><br>
                                <input type="radio" id="family" name="pkgtype" value="family">
                                <label for="family">Family</label><br>
                                <input type="radio" id="group" name="pkgtype" value="group">
                                <label for="group">Group</label><br>
                                <!-- check if radio button is group or family show number of person input -->
                            </form>
                        </div>
                        <div class="addsOn">
                            <!-- adds one check boxes -->
                            <h3>Adds On</h3>
                            <form class="myform">
                                <input type="checkbox" id="guide" name="guide" value="guide">
                                <label for="guide">Guide</label><br>
                                <input type="checkbox" id="photographer" name="photographer" value="photographer">
                                <label for="photographer">Photographer</label><br>
                                <input type="checkbox" id="transport" name="transport" value="transport">
                                <label for="transport">Transport</label><br>
                                <input type="checkbox" id="spa" name="spa" value="spa">
                                <label for="spa">Spa</label><br>
                            </form>
                        </div>
                        <div class="others">
                            <div class="description">
                                <button type="button" class="collapsible">
                                    <h5>Description</h5> <i class="fa fa-chevron-down"></i>
                                </button>
                                <div class="content">
                                    <p>
                                        <?php echo ($result->PackageDetails); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="info">
                                <button type="button" class="collapsible">
                                    <h5>Additional Information</h5> <i class="fa fa-chevron-down"></i>
                                </button>
                                <div class="content">
                                    <p>
                                        <?php echo ($result->PackageInfo); ?>
                                    </p>

                                </div>
                               

                            </div>
                           <!-- Display Ratings and Feedback -->
                           <?php
// Function to display star rating
function displayStarRating($rating)
{
    $output = '<div class="rating">';
    for ($i = 1; $i <= 5; $i++) {
        $output .= '<div class="stars' . ($i <= $rating ? ' selected' : '') . '"></div>';
    }
    $output .= '</div>';
    return $output;
}

// ... (your existing PHP code)

// Fetch ratings and feedback for the package
$sqlFetchRatings = "SELECT * FROM tblratings WHERE PackageId = :pid";
$queryFetchRatings = $dbh->prepare($sqlFetchRatings);
$queryFetchRatings->bindParam(':pid', $pid, PDO::PARAM_STR);
$queryFetchRatings->execute();
$ratingsData = $queryFetchRatings->fetchAll(PDO::FETCH_ASSOC);

// Display the ratings and feedback
if ($ratingsData) {
    foreach ($ratingsData as $rating) {
        $userRating = $rating['Rating'];
        $userFeedback = $rating['Feedback'];
        $userEmail = $rating['UserEmail'];

        // Display the user's email, rating, and feedback
        echo "<p>User: $userEmail</p>";
        echo "<p>Rating: " . displayStarRating($userRating) . "</p>";
        echo "<p>Feedback: $userFeedback</p>";
        echo "<hr>";
    }
} else {
    echo "No ratings and feedback available for this package.";
}

// ... (the rest of your PHP code)
?>


                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="descc" style="padding:18px;">
                            <!-- add journey date input from date picker -->
                            <div class="journey">
                                <h4>Journey Date</h4>
                                <input type="date" id="datePicker" name="datePicker" placeholder="Journey Date" required="">
                            </div>

                            <!-- add number of person input -->
                            <div class="person" id="person">
                                <div class="adult">
                                    <h6>Adult</h6>
                                    <div class="number">
                                        <button type="button" class="btn btn-outline-danger"
                                            onclick="decrement('adultNumber')">-</button>
                                        <span id="adultNumber">1</span>
                                        <button type="button" class="btn btn-outline-success"
                                            onclick="increment('adultNumber')">+</button>
                                    </div>
                                </div>

                                <div class="child">
                                    <h6>Child</h6>
                                    <div class="number">
                                        <button type="button" class="btn btn-outline-danger"
                                            onclick="decrement('childNumber')">-</button>
                                        <span id="childNumber">0</span>
                                        <button type="button" class="btn btn-outline-success"
                                            onclick="increment('childNumber')">+</button>
                                    </div>
                                </div>
                                <div class="senior">
                                    <h6>Senior Citizen</h6>
                                    <div class="number">
                                        <button type="button" class="btn btn-outline-danger"
                                            onclick="decrement('seniorNumber')">-</button>
                                        <span id="seniorNumber">0</span>
                                        <button type="button" class="btn btn-outline-success"
                                            onclick="increment('seniorNumber')">+</button>
                                    </div>
                                </div>

                            </div>
                            <div class="add" id="addsOnDiv">
                                <!-- The selected addons will be displayed here -->
                            </div>
                            <div class="total" id="totalDiv">
                                <!-- The total cost will be displayed here -->
                            </div>
                            <form method="post" name="book">
                                <ul>
                                    <li>
                                        <input type="hidden" name="total_price" id="total_price" value="">
                                        <input type="hidden" name="adults" id="adults" value="">
                                        <input type="hidden" name="children" id="children" value="">
                                        <input type="hidden" name="seniors" id="seniors" value="">
                                        <input type="hidden" name="selected_date" id="selected_date" value="">
                                        <input type="hidden" name="package_type" id="package_type" value="">
                                        <input type="hidden" name="selected_addons" id="selected_addons" value="">
                                    </li>
                                    <?php if ($_SESSION['login']) { ?>
                                        <li>
                                            <button type="submit" name="submit2" class="btn btn-success">Book Now</button>
                                        </li>
                                    <?php } else { ?>
                                        <li class="sigi" align="center">
                                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal4">Book
                                                now</a>
                                        </li>
                                    <?php } ?>

                                </ul>
                            </form>

                        </div>

                        <div class="descc" style="padding:18px;">
<?php
// ...

// Check if the user is logged in
// ...

// Check if the user is logged in
if ($_SESSION['login']) {
    // Check if the user has already submitted a review for this package
    $userEmail = $_SESSION['login'];
    $sqlCheckReview = "SELECT * FROM tblratings WHERE PackageId = :pid AND UserEmail = :useremail";
    $queryCheckReview = $dbh->prepare($sqlCheckReview);
    $queryCheckReview->bindParam(':pid', $pid, PDO::PARAM_STR);
    $queryCheckReview->bindParam(':useremail', $userEmail, PDO::PARAM_STR);
    $queryCheckReview->execute();
    $hasReview = $queryCheckReview->rowCount() > 0;

    // Display the rating and feedback section only if the user hasn't submitted a review
    if (!$hasReview) {
        ?>
        <!-- Add HTML for rating and feedback section here -->

        <form method="post" name="rateAndFeedback">
            <label for="rating">Rate This Package:</label>
            <!-- HTML for the star rating system -->
            <div class="rating" id="starRating">
        <div class="star" onclick="rate(1)"></div>
        <div class="star" onclick="rate(2)"></div>
        <div class="star" onclick="rate(3)"></div>
        <div class="star" onclick="rate(4)"></div>
        <div class="star" onclick="rate(5)"></div>
    </div>

    <!-- Hidden input field to store the selected rating -->
    <input type="hidden" id="rating" name="rating" value="0">

    <!-- JavaScript to handle star rating -->
    <script>
        // Update the hidden input field with the selected rating
        function rate(rating) {
            document.getElementById('rating').value = rating;

            // Update the stars to reflect the selected rating
            updateStars();
        }

        function updateStars() {
            const stars = document.querySelectorAll('.star');
            const selectedRating = parseInt(document.getElementById('rating').value);

            stars.forEach((star, index) => {
                if (index < selectedRating) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        }
    </script>

    <br>
    <label for="feedback">Feedback:</label>
    <textarea id="feedback" name="feedback" rows="3" cols="40" align="center"></textarea>
    <br>
    <button type="submit" name="submitRating" class="btn btn-success">Submit</button>
</form>

<?php

if (isset($_POST['submitRating'])) {
    // Process the submitted rating and feedback
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

    // Fetch the user_id from tblusers based on the user's email
    $sqlUserId = "SELECT id FROM tblusers WHERE EmailId = :useremail";
    $queryUserId = $dbh->prepare($sqlUserId);
    $queryUserId->bindParam(':useremail', $userEmail, PDO::PARAM_STR);
    $queryUserId->execute();
    $resultUserId = $queryUserId->fetch(PDO::FETCH_ASSOC);

    if ($resultUserId) {
        $user_id = $resultUserId['id'];

        // Insert the rating and feedback into tblratings
        $sqlRating = "INSERT INTO tblratings(PackageId, UserEmail, Rating, Feedback, CreatedAt, user_id) VALUES (:pid, :useremail, :rating, :feedback, NOW(), :user_id)";
        $queryRating = $dbh->prepare($sqlRating);
        $queryRating->bindParam(':pid', $pid, PDO::PARAM_STR);
        $queryRating->bindParam(':useremail', $userEmail, PDO::PARAM_STR);
        $queryRating->bindParam(':rating', $rating, PDO::PARAM_INT);
        $queryRating->bindParam(':feedback', $feedback, PDO::PARAM_STR);
        $queryRating->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $queryRating->execute();

        // Refresh the page or display a success message
    } else {
        // Handle the case where the user_id couldn't be found
        echo "Error: User ID not found.";
    }
}
} else {
// Inform the user that they have already submitted a review
echo "You have already submitted a review for this package.";
}

// ...

} else {
// Display a message or redirect to the login page
echo "Please sign in to submit a rating and feedback.";
}
// ...
?>





    
</div>

                       
                                    </div>
                                    
                                    </div></div>

                        <!-- add total price -->

                        <!-- add book now button -->

                    </div>
                </div>
               
             
          



        <?php }
        } ?>
    <!-- footer -->
    <?php include('includes/footer.php'); ?>

    <script>
        // Get references to the checkboxes
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        // Get a reference to the addsOn div
        const addsOnDiv = document.getElementById('addsOnDiv');

        // Function to update the addsOn div based on the selected checkboxes
        function updateAddsOnDiv() {
            // Create an array to store the selected addons
            const selectedAddons = [];

            // Loop through the checkboxes to find the selected ones
            for (const checkbox of checkboxes) {
                if (checkbox.checked) {
                    selectedAddons.push(checkbox.value);
                }
            }

            // Update the content of the addsOn div
            if (selectedAddons.length > 0) {
                // Display an <ul> element with the selected addons with fa check green
                addsOnDiv.innerHTML = `
        <h5>Adds On</h5>
        <ul>
            ${selectedAddons.map(addon => `<li><i class="fa fa-check" style="color:green;"></i> ${addon}</li>`).join('')}
        </ul>
        `;
            } else {
                // Clear the content if no addons are selected
                addsOnDiv.innerHTML = '';
            }
        }

        // Add a change event listener to each checkbox
        for (const checkbox of checkboxes) {
            checkbox.addEventListener('change', updateAddsOnDiv);
        }

        // Initial update when the page loads to display any initially selected checkboxes
        updateAddsOnDiv();
    </script>


    <script>
        const addonCosts = {
            guide: 50,
            photographer: 100,
            transport: 300,
            spa: 200
        };

        function increment(elementId) {
            const element = document.getElementById(elementId);
            const currentValue = parseInt(element.innerText);
            element.innerText = currentValue + 1;
            calculateTotal();
        }

        function decrement(elementId) {
            const element = document.getElementById(elementId);
            const currentValue = parseInt(element.innerText);
            if (currentValue > 0) {
                element.innerText = currentValue - 1;
                calculateTotal();
            }
        }
        let packagePrice = <?php echo $result->PackagePrice; ?>;





        
        function calculateTotal() {
            let packageType = '';
            for (const radioButton of radioButtons) {
                if (radioButton.checked) {
                    packageType = radioButton.value;
                    break;
                }
            }
<?php
$pid = intval($_GET['pkgid']);
$sql = "SELECT *, days from tbltourpackages where PackageId=:pid";
$query = $dbh->prepare($sql);
$query->bindParam(':pid', $pid, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$days = $results[0]->days;
?>

            let adultnumber = document.getElementById('adultNumber');
            let childnumber = document.getElementById('childNumber');
            let seniornumber = document.getElementById('seniorNumber');
            //parse int value
            adultnumber = parseInt(adultnumber.innerText);
            childnumber = parseInt(childnumber.innerText);
            seniornumber = parseInt(seniornumber.innerText);

            console.log(adultnumber, childnumber, seniornumber);

            let total = 0;
            if (packageType === 'single') {
                total = packagePrice;
                adultnumber = 1;
                childnumber = 0;
                seniornumber = 0;
            } else if (packageType === 'couple') {
                total = packagePrice * 2;
                adultnumber = 2;
                childnumber = 0;
                seniornumber = 0;
            } else if (packageType === 'family') {
                total = (adultnumber * packagePrice) + (childnumber * packagePrice * 0.8) + (seniornumber * packagePrice *
                    1.2);
            } else if (packageType === 'group') {
                total = (adultnumber * packagePrice) + (childnumber * packagePrice * 0.8) + (seniornumber * packagePrice *
                    1.2);
            }

            for (const checkbox of checkboxes) {
                if (checkbox.checked) {
                    total += addonCosts[checkbox.value];
                }
            }
            total *= <?php echo $days; ?>;
            document.getElementById('totalDiv').innerHTML = `
    <h3>Total</h3>
    <h3>Rs ${total}</h3>
    `;
            // Create an array to store the selected addons
            const selectedAddons = [];

            // Loop through the checkboxes to find the selected ones
            for (const checkbox of checkboxes) {
                if (checkbox.checked) {
                    selectedAddons.push(checkbox.value);
                }
            }



            // Set the values of the hidden input fields
            document.getElementById('total_price').value = total;
            document.getElementById('adults').value = adultnumber;
            document.getElementById('children').value = childnumber;
            document.getElementById('seniors').value = seniornumber;
            document.getElementById('selected_date').value = document.getElementById('datePicker').value;
            document.getElementById('package_type').value = packageType;
            document.getElementById('selected_addons').value = selectedAddons.join(
                ','); // Store selected addons as a comma-separated string


        }

        // Get references to the radio buttons
        const radioButtons = document.querySelectorAll('input[type="radio"]');
        // Get a reference to the total div
        const totalDiv = document.getElementById('totalDiv');

        // Add a change event listener to each radio button
        for (const radioButton of radioButtons) {
            radioButton.addEventListener('change', calculateTotal);
        }
        for (const checkbox of checkboxes) {
            checkbox.addEventListener('change', calculateTotal);
        }


        //add change event listener to each checkbox
        for (const checkbox of checkboxes) {
            checkbox.addEventListener('change', calculateTotal);
        }

        //add event listener to the number of persons input fields
        document.getElementById('adultNumber').addEventListener('change', calculateTotal);
        document.getElementById('childNumber').addEventListener('change', calculateTotal);
        document.getElementById('seniorNumber').addEventListener('change', calculateTotal);

        // Initial update when the page loads to display the total cost


        calculateTotal();
    </script>

    <script>
        // Get radio buttons and the number of persons input field
        var groupRadio = document.getElementById("group");
        var familyRadio = document.getElementById("family");
        var personsInput = document.getElementById("person");

        // Add event listeners to radio buttons
        groupRadio.addEventListener("change", function () {
            if (this.checked) {
                // If "Group" is selected, show the input field
                personsInput.style.display = "block";
            }
        });

        familyRadio.addEventListener("change", function () {
            if (this.checked) {
                // If "Family" is selected, show the input field
                personsInput.style.display = "block";
            }
        });

        // Add event listener to "Single" and "Couple" to hide the input field
        var singleRadio = document.getElementById("single");
        var coupleRadio = document.getElementById("couple");

        singleRadio.addEventListener("change", function () {
            if (this.checked) {
                // If "Single" is selected, hide the input field
                personsInput.style.display = "none";
            }
        });

        coupleRadio.addEventListener("change", function () {
            if (this.checked) {
                // If "Couple" is selected, hide the input field
                personsInput.style.display = "none";
            }
        });
    </script>


    <script>
        // Get all elements with class "collapsible"
        var coll = document.querySelectorAll(".collapsible");

        // Add click event listeners to toggle the content
        for (var i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }
    </script>
    
    <?php include('includes/signup.php'); ?>
    <?php include('includes/signin.php'); ?>
    <?php include('includes/write-us.php'); ?>
</body>

</html>