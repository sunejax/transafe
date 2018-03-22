<?php
include('login/server.php');
include('phpqrcode/qrlib.php');
require 'vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login/login.php');

}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login/login.php");
}
$bucket='transafe';

$client = S3Client::factory();
if(isset($_POST['uploadFile'])) {
    try {
        $pathToFile = $_FILES["fileToUpload"]['name'];
        $key = $_SESSION['r']['uid'] . 'rc' . '.jpeg';
        $result = $client->putObject(array(
            'Bucket' => $bucket,
            'Key' => $key,
            'SourceFile' => $pathToFile,
            'ContentType'=> 'image/jpeg'
            ));
    } catch (S3Exception $e) {
        die('Error:' . $e->getMessage());
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
    $url=$result['ObjectURL'];
    $em=$_SESSION['r']['email'];

    $q = "INSERT INTO user (doc_rc) VALUES('$url') WHERE email='$em'";
    mysqli_query($db,$q);
    unset($_POST['uploadFile']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transafe - <?php echo $_SESSION['r']['name']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!--// bootstrap-css -->
    <!-- css -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--// css -->
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- font -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <!-- //font -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- light-box -->
    <link rel="stylesheet" href="css/lightbox.css">
    <!-- //light-box -->
    <script src="js/SmoothScroll.min.js"></script>
    <!--search jQuery-->
    <script src="js/main.js"></script>
    <!--//search jQuery-->
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<!-- banner -->
<div class="banner">
    <!--header-->
    <div class="header">
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <h1><a  href="home.php">Transafe</a></h1>
                </div>
                <!--navbar-header-->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="home.php" >Home</a></li>
                        <li><a href="profile.php" class="active"><?php echo $_SESSION['username']; ?></a></li>
                        <li><a href="profile.php?logout='1'">Logout</a></li>
                        <li><a href="http://driving-tests.in/learners-licence-practice-test-1/" >Take a Test</a></li>
                    </ul>
                    <div class="clearfix"> </div>
                </div>
            </nav>
        </div>

    </div>
    <!--//header-->

</div>
<div class="row dis ">
    <div class="col-sm-6">
        <ul>
            <li>Name: <?echo$_SESSION['r']['name']?></li>
            <li>Email: <?echo$_SESSION['r']['email']?></li>
            <li>Emergency Contact: <?echo$_SESSION['r']['em_no']?></li>
            <li>Emergency Message: <?echo$_SESSION['r']['em_msg']?></li>
        </ul>
    </div>
    <div class ="col-sm-6 input-group">
    <form method="post" action="profile.php" enctype="multipart/form-data">
        <div>Registration Certificate:<? if(!isset($_SESSION['r']['doc_rc']))
                echo "<input type='file' name='fileToUpload'>
              <input type='submit' name='uploadFile' value='Upload'>
            ";
            if($_SESSION['r']['doc_rc_s']==1)echo "<p style='color: yellow;'>Under Review</p>";
            else if ($_SESSION['r']['doc_rc_s']==2)echo "<p style='color: green;'>Confirmed</p>";
            else echo "<p>Status Check here</p>";?>
        </div>
        <div><p>Driving License:</p><? if(!isset($_SESSION['r']['doc_li']))
                echo "<input type='file' name='fileToUpload_1'>
              <input type='submit' name='uploadFile' value='Upload'>
            ";
            if($_SESSION['r']['doc_li_s']==1)echo "<p style='color: yellow;'>Under Review</p>";
            else if ($_SESSION['r']['doc_li_s']==2)echo "<p style='color: green;'>Confirmed</p>";
            else echo "<p>Status Check here</p>";?>
        </div>
        <div><p>AADHAR:</p><? if(!isset($_SESSION['r']['doc_aa']))
                echo "<input type='file' name='fileToUpload_2'>
              <input type='submit' name='uploadFile' value='Upload'>
            ";
            if($_SESSION['r']['doc_aa_s']==1)echo "<p style='color: yellow;'>Under Review</p>";
            else if ($_SESSION['r']['doc_aa_s']==2)echo "<p style='color: green;'>Confirmed</p>";
            else echo "<p>Status Check here</p>";
            ?>

        </div>
    </form>
    <form method="get" action="qr.php">
        <button type="submit">Generate QR Code</button>
    </form>
    </div>
</div>
<!-- //banner -->
<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="w3-agileits-footer">
            <div class="agileinfo-social-grids">
                <ul>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                    <li><a href="#"><i class="fa fa-vk"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- //footer -->
<script src="js/jarallax.js"></script>
<script type="text/javascript">
    /* init Jarallax */
    $('.jarallax').jarallax({
        speed: 0.5,
        imgWidth: 1366,
        imgHeight: 768
    })
</script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<!-- here stars scrolling icon -->
<script type="text/javascript">
    $(document).ready(function() {
        /*
            var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
            };
        */

        $().UItoTop({ easingType: 'easeOutQuart' });

    });
</script>
<!-- //here ends scrolling icon -->

</body>
</html>
