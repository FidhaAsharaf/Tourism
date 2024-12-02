<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['bookingId'])) {
        $bookingId = $_POST['bookingId'];

        // Fetch booking details for the selected BookingId
        $bookingSql = "SELECT tblbooking.BookingId as bookid, tblbooking.PackageId as pkgid, tbltourpackages.PackageName as packagename, tblbooking.FromDate as fromdate, tblbooking.status as status, tblbooking.RegDate as regdate, tblbooking.CancelledBy as cancelby, tblbooking.UpdationDate as upddate, tblbooking.addsOn as addOn, tblbooking.child as child, tblbooking.adult as adult, tblbooking.senior as senior, tblbooking.total as price
                FROM tblbooking
                JOIN tbltourpackages ON tbltourpackages.PackageId=tblbooking.PackageId
                WHERE tblbooking.BookingId=:bookingId AND tblbooking.UserEmail=:uemail";

        $paymentSql = "SELECT status as paymentStatus FROM payment WHERE BookingId=:bookingId";

        $bookingQuery = $dbh->prepare($bookingSql);
        $bookingQuery->bindParam(':bookingId', $bookingId, PDO::PARAM_STR);
        $bookingQuery->bindParam(':uemail', $_SESSION['login'], PDO::PARAM_STR);
        $bookingQuery->execute();
        $bookingResult = $bookingQuery->fetch(PDO::FETCH_OBJ);

        $paymentQuery = $dbh->prepare($paymentSql);
        $paymentQuery->bindParam(':bookingId', $bookingId, PDO::PARAM_STR);
        $paymentQuery->execute();
        $paymentResult = $paymentQuery->fetch(PDO::FETCH_OBJ);

        if ($bookingQuery->rowCount() > 0) {
            ?>
            <!DOCTYPE HTML>
            <html>

            <head>

    <title>TourEase - Receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/mystyle.css" rel="stylesheet" type="text/css" />
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<!-- Add the html2pdf.js script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

<script>
    // Function to generate and download the entire page as a PDF
    function downloadPageAsPDF() {
        // Set the options for html2pdf
        var options = {
            margin: 10,
            filename: 'TourEase_Receipt.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        // Use html2pdf to generate the PDF
        html2pdf(document.body, options);
    }

    // Attach the downloadPageAsPDF function to the button click event
    document.getElementById('downloadBtn').addEventListener('click', function () {
        downloadPageAsPDF();
    });
</script>
</head>



            </head>

            <body>
                <?php include('includes/header.php'); ?>
                <!-- ... Your existing header code ... -->
                <div class="container" id="receiptContent">
                    <h3 class="text-center mt-3">Receipt for Booking ID: <?php echo htmlentities($bookingResult->bookid); ?></h3>
                    <table class="table table-bordered mt-3">
                        <tr>
                            <th>Package Name</th>
                            <td><?php echo htmlentities($bookingResult->packagename); ?></td>
                        </tr>
                        <tr>
                            <th>Journey Date</th>
                            <td><?php echo htmlentities($bookingResult->fromdate); ?></td>
                        </tr>
                        <tr>
                            <th>Booking Date</th>
                            <td><?php echo htmlentities($bookingResult->regdate); ?></td>
                        </tr>
                        <tr>
                            <th>Add-Ons</th>
                            <td><?php echo htmlentities($bookingResult->addOn); ?></td>
                        </tr>
                        <tr>
                            <th>No. of Persons</th>
                            <td><?php echo htmlentities($bookingResult->adult); ?> Adult,
                                <?php echo htmlentities($bookingResult->child); ?> Child,
                                <?php echo htmlentities($bookingResult->senior); ?> Senior
                            </td>
                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <td><?php echo htmlentities($bookingResult->price); ?></td>
                        </tr>
                        <tr>
                            <th>Payment Status</th>
                            <td><?php echo isset($paymentResult->paymentStatus) ? htmlentities($paymentResult->paymentStatus) : 'Pending'; ?></td>
                        </tr>
                        
                    </table>
                    <!-- Add a "Download Receipt" button -->
 <!-- Add a "Download Receipt" button -->
<!-- Add a "Download Receipt" button -->
<button type="button" class="btn btn-primary" id="downloadBtn">Download Receipt</button>


                </div>
                <?php include('includes/footer.php'); ?>
                <!-- Your existing footer code -->
            </body>

            </html>
        <?php
    } else {
        echo "Invalid Request!";
    }
} else {
    echo "Invalid Request!";
}}
?>
