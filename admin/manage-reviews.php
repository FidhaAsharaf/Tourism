<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
    header('location:index.php');
}
else { 
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>TourEase | Admin Manage Reviews</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/morris.css" type="text/css"/>
    <!-- Graph CSS -->
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <!-- jQuery -->
    <script src="js/jquery-2.1.4.min.js"></script>
    <!-- //jQuery -->
    <!-- tables -->
    <link rel="stylesheet" type="text/css" href="css/table-style.css" />
    <link rel="stylesheet" type="text/css" href="css/basictable.css" />
    <script type="text/javascript" src="js/jquery.basictable.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          $('#table').basictable();
          // other table initialization scripts...
        });

        // Add your script to handle deletion (AJAX can be used for a smoother experience)
        function deleteReview(ratingId) {
            if (confirm("Are you sure you want to delete this review?")) {
                window.location.href = "delete-review.php?rating_id=" + ratingId;
            }
        }
    </script>
    <!-- //tables -->
    <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
    <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- lined-icons -->
    <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
    <!-- //lined-icons -->
</head> 
<body>
    <div class="page-container">
        <!--/content-inner-->
        <div class="left-content">
            <div class="mother-grid-inner">
                <!--header start here-->
                <?php include('includes/header.php');?>
                <div class="clearfix"> </div>    
            </div>
            <!--heder end here-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Manage Reviews</li>
            </ol>
            <div class="agile-grids">   
                <!-- tables -->
                <div class="agile-tables">
                    <div class="w3l-table-info">
                        <h2>Manage Reviews</h2>
                        <table id="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Package ID</th>
                                    <th>User Email</th>
                                    <th>Rating</th>
                                    <th>Feedback</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT * FROM tblratings";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if($query->rowCount() > 0) {
                                        foreach($results as $result) { ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt);?></td>
                                                <td><?php echo htmlentities($result->PackageId);?></td>
                                                <td><?php echo htmlentities($result->UserEmail);?></td>
                                                <td><?php echo htmlentities($result->Rating);?></td>
                                                <td><?php echo htmlentities($result->Feedback);?></td>
                                                <td><?php echo htmlentities($result->CreatedAt);?></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" onclick="deleteReview(<?php echo htmlentities($result->RatingId);?>)">Delete</button>
                                                </td>
                                            </tr>
                                        <?php $cnt = $cnt + 1;
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--inner block start here-->
            <div class="inner-block">
            </div>
            <!--inner block end here-->
            <!--copy rights start here-->
            <?php include('includes/footer.php');?>
            <!--COPY rights end here-->
        </div>
    </div>
    <!--//content-inner-->
    <!--/sidebar-menu-->
    <?php include('includes/sidebarmenu.php');?>
    <div class="clearfix"></div>        
</div>
<script>
    var toggle = true;
    
    $(".sidebar-icon").click(function() {                
        if (toggle) {
            $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
            $("#menu span").css({"position":"absolute"});
        } else {
            $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
            setTimeout(function() {
                $("#menu span").css({"position":"relative"});
            }, 400);
        }
        toggle = !toggle;
    });
</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!-- /Bootstrap Core JavaScript -->
</body>
</html>
<?php } ?>
