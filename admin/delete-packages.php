<?php
session_start();
include('includes/config.php');

if (empty($_SESSION['alogin'])) {
    header('location: index.php');
    exit;
}?>


<?php
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    try {
        $sql = "DELETE FROM tbltourpackages WHERE PackageId = :packageid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':packageid', $deleteId, PDO::PARAM_INT);
        $query->execute();

        if ($query->rowCount() > 0) {
            $msg = "Package Deleted Successfully";
        } else {
            throw new Exception("Package not found or already deleted.");
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Fetch all packages from the database
$sql = "SELECT * FROM tbltourpackages";
$query = $dbh->prepare($sql);
$query->execute();
$packages = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Delete Package | TourEase</title>
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

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
<!-- //tables -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
    
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="page-container">

        <div class="left-content">
            <div class="mother-grid-inner">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Delete Package</li>
                </ol>

                <?php
                if (isset($msg)) {
                    echo '<div class="succWrap"><strong>SUCCESS</strong>: ' . $msg . '</div>';
                } elseif (isset($error)) {
                    echo '<div class="errorWrap"><strong>ERROR</strong>: ' . $error . '</div>';
                }
                ?>

                <div class="grid-form">
                    <div class="grid-form1">
                        <h3>Delete Package</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Package ID</th>
                                    <th>Package Name</th>
                                    <th>Package Type</th>
                                    <th>Package Location</th>
                                    <th>Package Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($packages as $package) { ?>
                                    <tr>
                                        <td><?php echo $package['PackageId']; ?></td>
                                        <td><?php echo $package['PackageName']; ?></td>
                                        <td><?php echo $package['PackageType']; ?></td>
                                        <td><?php echo $package['PackageLocation']; ?></td>
                                        <td><?php echo $package['PackagePrice']; ?></td>
                                        <td>
                                            <a href="delete-packages.php?delete_id=<?php echo $package['PackageId']; ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php include('includes/footer.php'); ?>
            </div>
        </div>
        <?php include('includes/sidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
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

        <!-- Add your JS links here -->
    </div>
</body>
</html>