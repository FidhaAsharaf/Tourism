<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>TourEase | Package List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><!--bootstrap css-->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">

    <!--font-awesome css-->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">

    <!--custom css-->
    <link href="css/mystyle.css" rel="stylesheet" type="text/css" />
    <!--import modal from bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!--import jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--import popper.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!--import bootstrap.js-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" /><!--stylesheet-->



    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />


    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>

    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui.js"></script>
    <!-- add custom css -->
    <style>
        /* Banner */
        .banner-3 {
            padding: 10px 0;
            color: #fff;
            text-align: center;
        }

        body {
            background-color: rgb(51 65 85) !important;
        }

        /* Room Cards */
        .room-bottom {
            margin-top: 30px;
        }

        .room-bottom h3 {
            color: #fff;
        }

        .rom-btm {
            background: #F6F4EB;

            margin-bottom: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            opacity: 0.9;
        }

        .room-left img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .room-midle {
            padding: 20px;
        }

        .room-midle h4 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        .room-midle h6 {
            color: #888;
        }

        .room-midle p {
            margin: 10px 0;
        }

        .room-right {
            text-align: center;
            padding-top: 20px;
        }

        .room-right h5 {
            color: #007bff;
        }

        .view {
            display: inline-block;
            padding: 5px 20px;
            color: #fff;
            background: #5cb85c;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s ease-in-out;
            text-decoration: none!important;

        }

        .rom-btm {
            background: #fff;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            /* Use flexbox to align items */
            align-items: center;
            /* Align items vertically in the middle */
        }


        .view:hover {
            background: RGB(92, 174, 120);
            color:#F6F4EB;
        }

        .clearfix {
            clear: both;
        }

        
    </style>
    <!-- add custom css -->

    <script>
        new WOW().init();
    </script>
    <!--//end-animate-->
</head>

<body>
    <?php include('includes/header.php'); ?>
    <div class="container">
    <div class="banner-3">
    <br>
            <h1 class="wow zoomIn animated animated" data-wow-delay=".5s"
                style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> Popular Destination</h1>
        </div></div>
        <!-- Banner content... -->
    </div>
    <!-- fetch data -->
    <div class="room">
    <div class="container">
        
        
        <div class="room-bottom">
        <style>
        .row-spacing {
            margin-bottom: 20px; /* Adjust the margin as needed */
        }
    </style>
    <div class="row">
                
                <div class="card-deck">
                
                   <?php
                    
                    $sql = "SELECT DISTINCT PackageLocation, MAX(PackageImage) AS LocationImage FROM tbltourpackages GROUP BY PackageLocation";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        $count = 0; // Counter to identify the last card in each row
                        $totalCards = count($results); // Total number of cards
                        $cardsPerRow = 4; // Number of cards per row
                        
                       
                      $marginBetweenCards = '10px'; // Adjust the margin between cards
                       $marginBetweenRows = '20px'; // Adjust the margin between rows
                       //echo '<style>.row:last-child { margin-bottom: 20px; }</style>'; // Apply margin to the last row

                       echo '<div class="row">'; // Start the first row
                   
                        foreach ($results as $result) { 
                           
                            $cardClass = 'location-card'; // Add a class to the card element

        // Check if the card is the last card in the row
        if ($count % $cardsPerRow === $cardsPerRow - 1) {
            // Add a special class for the last card in the row to remove its right margin
            $cardClass .= ' last-card';
        }
        
                            ?>
                            <div class="col-md-3">
        <div class="card" style="height: 250px; width: 250px;">
        
        <img class="card-img-top" src="admin/pacakgeimages/<?php echo htmlentities($result->LocationImage); ?>" alt="Location Image" style="max-height: 130px;" />

            <div class="card-body">
                <p class="text-muted" style="text-align: center;"><span style="font-weight: bold;"><?php echo htmlentities($result->PackageLocation); ?></span></p>
            </div>
            <a style="margin:0 20px 10px 20px;" href="package-loc-list.php?location=<?php echo htmlentities($result->PackageLocation); ?>" class="btn btn-primary">Details</a>
        </div>
        <div class="clearfix"></div>
    </div>
                           
                        <?php 
                         $count++;
                         if ($count % $cardsPerRow === 0 && $count < $totalCards) {
                            echo '</div>'; // Close the previous row
                            
            echo '<style>.row:last-child { margin-bottom: 20px; }</style>'; // Apply margin to the last row
                            echo '<div class="row" style="margin-top: ' . $marginBetweenRows . ';">'; // Start a new row with margin
                            echo '<div class="row">';
                        }
                        
                    }
                     
                    
    echo '</div>';
                    } ?></div>
                </div>
                
                
                
        
    </div>
    
    </div>
    

        


            </div>
        </div>
    </div>
    <!--- /rooms ---->

    <!--- /footer-top ---->
    <?php include('includes/footer.php'); ?>
    <!-- signup -->
    <?php include('includes/signup.php'); ?>
    <!-- //signu -->
    <!-- signin -->
    <?php include('includes/signin.php'); ?>
    <!-- //signin -->
    <!-- write us -->
    <?php include('includes/write-us.php'); ?>
    <!-- //write us -->
</body>

</html>
