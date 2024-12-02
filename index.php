<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>TourEase</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">

    <!-- Font Awesome CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">

    <!-- Custom CSS -->
    <link href="css/mystyle.css" rel="stylesheet" type="text/css" />

    <!-- Import modal from bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Import jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Import popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Import bootstrap.js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <!-- Other links... -->

    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>

    <!-- Other links... -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>

    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui.js"></script>

    <script>
        new WOW().init();
    </script>

    <!-- add custom css -->
    <style>
        body {
            background-color: #F5F5F5 !important;
        }
    </style>
    <style>
        .image-div {
            width: 1519px; /* Set the width of the div */
            height: 640px; /* Set the height of the div */
            background-image: url("images/bagan-1137015_1920.jpg"); /* Set the background image */
            background-size: 100% auto;/* Adjust the background image size */
            background-position: center;
        }
        .image-text {
            position: absolute;
            text-align: center;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: 'Roboto', cursive; /* Replace 'Your Curly Font' with the actual font name */
            font-size: 30px; /* Adjust the font size as needed */
            color: black; /* Text color */
        }
        .gif-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%; /* Adjust the width as needed */
            height: 100%; /* Adjust the height as needed */
        }
        .explore-button {
            margin-top: 10px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.5); /* Transparent black background */
            color: #fff; /* Text color */
            font-size: 17px;
            padding: 2px 8px; /* Adjust padding as needed */
            text-decoration: none;
            border: 1px solid #fff; /* Optional: Add a white border */
            }

        .explore-button:hover {
            background-color: rgba(0, 0, 0, 0.7); /* Darker background on hover */
            }

    </style>
</head>

<body>
    <?php include('includes/header.php'); ?>
    <div class="banner">
        <!-- Banner content... -->
        <div class="image-div"><div class="image-text"><br><br>Travel far, travel often.<br><a href="package-list.php" class="explore-button">Explore</a></div></div>
                <br><br>
    </div>
    <!-- fetch data -->
    <div class="container">
        <section class="xolor">
            <div class="package-list">
           
                <br><br>
               
                <h3>Popular Destinations</h3>
                <br>
                <div class="card-deck">
                
                   <?php
                    $sql = "SELECT * from tbltourpackages order by rand() limit 4";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) { ?>
                            <div class="card">
                                <img class="card-img-top"
                                    src="admin/packageimages/<?php echo htmlentities($result->PackageImage); ?>"
                                    alt="Package Image" style="max-height: 130px;" />

                                <div class="card-body">
                                    
            
                                    <p class="text-muted"><span style="font-weight: bold;">
                                        <?php echo htmlentities($result->PackageLocation); ?>
                                    </p>

                                </div>
                                <a style="margin:0 20px 10px 20px;" href="package-loc-list.php?location=<?php echo htmlentities($result->PackageLocation); ?>" class="btn btn-primary">Visit</a>


                            </div>
                        <?php }
                    } ?>
                </div>
                <br>
                <div><a href="location-list.php" class="view-more">View All</a></div>
                <br>
        </section>
    </div>
    <div class="clearfix"></div>
    </div>
<br><br>

<!-- fetch data -->
<div class="container">
        <section class="xolor">
            <div class="package-list">
                <h3>Featured Packages</h3>
                <br>
                <div class="card-deck">
                    <?php
                    $sql = "SELECT * from tbltourpackages order by rand() limit 4";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) { ?>
                            <div class="card">
                                <img class="card-img-top"
                                    src="admin/packageimages/<?php echo htmlentities($result->PackageImage); ?>"
                                    alt="Package Image" style="max-height: 130px;" />

                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo htmlentities($result->PackageName); ?>
                                    </h5>
                                    <p class="card-text">
                                        <?php echo htmlentities($result->PackageType); ?>
                                    </p>
                                    <p class="text-muted"><b>Location:</b>
                                        <?php echo htmlentities($result->PackageLocation); ?>
                                    </p>

                                    <h5>₹<?php echo htmlentities($result->PackagePrice); ?>
                                    </h5>
                                </div>
                                <a style="margin:0 20px 10px 20px;" href="package-details.php?pkgid=<?php echo htmlentities($result->PackageId); ?>"
                                    class="btn btn-primary">Details</a>

                            </div>
                        <?php }
                    } ?>
                </div>
                <br>
                <div><a href="package-list.php" class="view-more">View All</a></div>
                <br>
        </section>
    </div>
    <div class="clearfix"></div>
    </div>



    <!-- strat service section -->

    

    <?php include('includes/footer.php'); ?>
    <?php include('includes/signup.php'); ?>
    <?php include('includes/signin.php'); ?>
    <?php include('includes/write-us.php'); ?>
</body>

</html>