<?php
session_start();
include('includes/config.php');

if (empty($_SESSION['alogin'])) {
    header('location: index.php');
    exit;
}

if (isset($_POST['submit'])) {
    try {
        $pname = $_POST['packagename'];
        $ptype = $_POST['packagetype'];
        $pdays = $_POST['packagedays'];
        $plocation = $_POST['packagelocation'];
        $pprice = $_POST['packageprice'];
        $pfeatures = $_POST['packagefeatures'];
        $pdetails = $_POST['packagedetails'];
        $pinfo = $_POST['packageinfo'];

        // Handle file upload
        if (!empty($_FILES['packageimage']['name'])) {
            $pimage = $_FILES['packageimage']['name'];
            $targetDir = "packageimages/";
            $targetFile = $targetDir . basename($pimage);

            if (move_uploaded_file($_FILES['packageimage']['tmp_name'], $targetFile)) {
                // File upload was successful
            } else {
                throw new Exception("File upload failed.");
            }
        } else {
            $pimage = ''; // No image uploaded
        }

        $sql = "INSERT INTO tbltourpackages (PackageName, PackageType, days, PackageLocation, PackagePrice, PackageFetures, PackageDetails, PackageInfo, PackageImage) 
                VALUES (:pname, :ptype, :pdays, :plocation, :pprice, :pfeatures, :pdetails, :pinfo, :pimage)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':pname', $pname, PDO::PARAM_STR);
        $query->bindParam(':ptype', $ptype, PDO::PARAM_STR);
        $query->bindParam(':pdays', $pdays, PDO::PARAM_STR);
        $query->bindParam(':plocation', $plocation, PDO::PARAM_STR);
        $query->bindParam(':pprice', $pprice, PDO::PARAM_STR);
        $query->bindParam(':pfeatures', $pfeatures, PDO::PARAM_STR);
        $query->bindParam(':pdetails', $pdetails, PDO::PARAM_STR);
        $query->bindParam(':pinfo', $pinfo, PDO::PARAM_STR);
        $query->bindParam(':pimage', $pimage, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            $msg = "Package Created Successfully";
        } else {
            throw new Exception("Something went wrong. Please try again.");
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>TourEase | Admin Package Creation</title>

    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/morris.css" type="text/css" />
    <link href="css/font-awesome.css" rel="stylesheet">
    <script src="js/jquery-2.1.4.min.js"></script>
    <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet'
        type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />

    <script type="text/JavaScript">

        function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
};
//-->
</script>
    <script type="text/javascript" src="nicEdit.js"></script>
    <script type="text/javascript">
    bkLib.onDomLoaded(function() {
        nicEditors.allTextAreas()
    });
    </script>
    <style>
    .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    }

    .succWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    }
    </style>

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
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Create Package
                </li>
            </ol>
            <!--grid-->
            <div class="grid-form">

                <!---->
                <div class="grid-form1">
                    <h3>Create Package</h3>
                    
                    <div class="tab-content">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" name="package" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Package Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" name="packagename" id="packagename"
                                            placeholder="Create Package" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Package Type</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" name="packagetype" id="packagetype"
                                            placeholder=" Package Type eg- Family Package / Couple Package" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">No.of days</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" name="packagedays" id="packagedays"
                                            placeholder=" no of days" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Package Location</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" name="packagelocation"
                                            id="packagelocation" placeholder=" Package Location" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Package Price in
                                        Rs</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" name="packageprice" id="packageprice"
                                            placeholder=" Package Price in Rs " required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Package Features</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" name="packagefeatures"
                                            id="packagefeatures"
                                            placeholder="Package Features Eg-free Pickup-drop facility" required>
                                    </div>
                                </div>
                                <!-- package details with niceEdit -->
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Package Details</label>
                                    <div class="col-sm-8">
                                        <textarea name="packagedetails" id="packagedetails" cols="60"
                                            rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Additional
                                        Information</label>
                                    <div class="col-sm-8">
                                        <textarea name="packageinfo" id="packageinfo" cols="60" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Package Image</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="packageimage" id="packageimage" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <button type="submit" name="submit" class="btn-primary btn">Create</button>
                                        <button type="reset" class="btn-inverse btn">Reset</button>
                                    </div>
                                </div>
                        </div>

                        </form>





                        <div class="panel-footer">

                        </div>
                        </form>
                    </div>
                </div>
                <!--//grid-->

                <!-- script-for sticky-nav -->
                <script>
                $(document).ready(function() {
                    var navoffeset = $(".header-main").offset().top;
                    $(window).scroll(function() {
                        var scrollpos = $(window).scrollTop();
                        if (scrollpos >= navoffeset) {
                            $(".header-main").addClass("fixed");
                        } else {
                            $(".header-main").removeClass("fixed");
                        }
                    });

                });
                </script>
                <!-- /script-for sticky-nav -->
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
            $("#menu span").css({
                "position": "absolute"
            });
        } else {
            $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
            setTimeout(function() {
                $("#menu span").css({
                    "position": "relative"
                });
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
