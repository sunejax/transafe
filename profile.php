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
$db = mysqli_connect('transafedb.cdccbxx5nlwo.us-east-2.rds.amazonaws.com', 'transafe', 'transafe1234', 'transafe',3306);
$client = S3Client::factory();
$url_rc=$_SESSION['r']['doc_rc'];
$url_li=$_SESSION['r']['doc_li'];
$url_aa=$_SESSION['r']['doc_aa'];
if(isset($_POST['uploadFile_rc'])) {
    try {
        $pathToFile = $_FILES["fileToUpload_rc"]['name'];
        $key = $_SESSION['r']['uid'] . 'rc' . '.jpeg';
        $result = $client->upload($bucket, $key, fopen($_FILES['fileToUpload_rc']['tmp_name'], 'rb'), 'public-read');
    } catch (S3Exception $e) {
        die('Error:' . $e->getMessage());
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
    $url=$result->get('ObjectURL');
    $uid=$_SESSION['r']['uid'];
    $q = "UPDATE user SET doc_rc ='$url',doc_rc_s='1' WHERE uid='$uid'";
    $res=mysqli_query($db,$q);
    $_SESSION['r']['doc_rc']=$url;
    $_SESSION['r']['doc_rc_s']=1;
    unset($_POST['uploadFile_rc']);
}
if(isset($_POST['uploadFile_li'])) {
    try {
        $pathToFile = $_FILES["fileToUpload_li"]['name'];
        $key = $_SESSION['r']['uid'] . 'li' . '.jpeg';
        $result = $client->upload($bucket, $key, fopen($_FILES['fileToUpload_li']['tmp_name'], 'rb'), 'public-read');
    } catch (S3Exception $e) {
        die('Error:' . $e->getMessage());
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
    $url=$result->get('ObjectURL');
    $uid=$_SESSION['r']['email'];
    $q = "UPDATE user SET doc_li ='$url',doc_li_s='1' WHERE email='$uid'";
    $res=mysqli_query($db,$q);
    $_SESSION['r']['doc_li']=$url;
    $_SESSION['r']['doc_li_s']=1;
    unset($_POST['uploadFile_li']);
}
if(isset($_POST['uploadFile_aa'])) {
    try {
        $pathToFile = $_FILES["fileToUpload_aa"]['name'];
        $key = $_SESSION['r']['uid'] . 'aa' . '.jpeg';
        $result = $client->upload($bucket, $key, fopen($_FILES['fileToUpload_aa']['tmp_name'], 'rb'), 'public-read');
    } catch (S3Exception $e) {
        die('Error:' . $e->getMessage());
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
    $url=$result->get('ObjectURL');
    $uid=$_SESSION['r']['uid'];
    $q = "UPDATE user SET doc_aa ='$url',doc_aa_s='1' WHERE uid='$uid'";
    $res=mysqli_query($db,$q);
    $_SESSION['r']['doc_aa']=$url;
    $_SESSION['r']['doc_aa_s']=1;
    unset($_POST['uploadFile_aa']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transafe - <?php echo $_SESSION['r']['name']?></title>

    <style>
        /* Always set the map height explicitly to define the size of the div

        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background: #352f44;
        }
        img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 150px;
        }

        img:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Transafe - <? echo $_SESSION['username'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Transafe - Your Personal Travel Safety Manager" />

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico">

    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,700' rel='stylesheet' type='text/css'>
    <script src="js/jquery.min.js"></script>
    <!-- Animate.css -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="css/icomoon.css">
    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="css/simple-line-icons.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <link rel="stylesheet" href="css/style.css">

    <!-- Styleswitcher ( This style is for demo purposes only, you may delete this anytime. ) -->
    <link rel="stylesheet" id="theme-switch" href="css/style.css">
    <!-- End demo purposes only -->



    <!-- Modernizr JS -->
    <script src="js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- banner -->
<header role="banner" id="fh5co-header">
    <div class="container">
        <!-- <div class="row"> -->
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <!-- Mobile Toggle Menu Button -->
                <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
                <a class="navbar-brand" href="index.html">Transafe</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-nav-section="home"><span>Home</span></a></li>
                    <li><a href="#" data-nav-section="about"><span>Team</span></a></li>
                    <li><a href="#" data-nav-section="features"><span>Features</span></a></li>
                    <li><a href="quiz.php"><span>Practice</span></a></li>
                    <li class="active"><a href="profile.php"><?php echo $_SESSION['username']; ?></a></li>
                    <li><a href="profile.php?logout='1'">Sign out</a></li>
                </ul>
            </div>
        </nav>
        <!-- </div> -->
    </div>
</header>
<div id="slider" data-section="home">

    <!-- You may change the background color here. -->
    <div class="item" style="background: #352f44;">
        <div class="container" style="position: relative;">
            <div class="row">
                <div class="col-md-7 col-sm-7">
                    <div class="fh5co-owl-text-wrap">
                        <div class="fh5co-owl-text">
                            <h1 class="fh5co-lead to-animate">Travel with assurance</h1>
                            <h2 class="fh5co-sub-lead to-animate">Associate your emergency information like allergies, previous medical data, insurance details and emergency contact accessible only to registered professionals and medical staff in case of accidents.</h3>
                                <p class="to-animate-2"><a href="profile.php" class="btn btn-primary btn-lg">Go to your profile</a></p>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>

<div class="row dis ">
    <div class="col-sm-6">
        <ul class="list-group" style="color: #000000">
            <li class="list-group-item">Name: <?echo$_SESSION['r']['name']?></li>
            <li class="list-group-item">Email: <?echo$_SESSION['r']['email']?></li>
            <li class="list-group-item">Emergency Contact: <?echo$_SESSION['r']['em_no']?></li>
            <li class="list-group-item">Emergency Message: <?echo$_SESSION['r']['em_msg']?></li>
        </ul>
    </div>
    <div class ="col-sm-6 input-group">
        <form method="post" action="profile.php" enctype="multipart/form-data">
            <div>Registration Certificate:<? if(!isset($_SESSION['r']['doc_rc']))
                    echo "<input type='file' name='fileToUpload_rc'>
              <input type='submit' name='uploadFile_rc' value='Upload'>
            ";else echo "<a target='_blank' href='$url_rc'><img src ='$url_rc' class='proimage'>";
                if($_SESSION['r']['doc_rc_s']==1)echo "<p style='color: yellow;'>Under Review</p>";
                else if ($_SESSION['r']['doc_rc_s']==2)echo "<p style='color: green;'>Accepted</p>";
                else if ($_SESSION['r']['doc_rc_s']==3)echo "<p style='color: Red;'>Declined</p>";
                ?>
            </div>
        </form>
        <form method="post" action="profile.php" enctype="multipart/form-data">
            <div><p>Driving License:</p><? if(!isset($_SESSION['r']['doc_li']))
                    echo "<input type='file' name='fileToUpload_li'>
              <input type='submit' name='uploadFile_li' value='Upload'>
            "; else echo "<a target='_blank' href='$url_li'><img src ='$url_li' class='proimage'></a>";
                if($_SESSION['r']['doc_li_s']==1)echo "<p style='color: yellow;'>Under Review</p>";
                else if ($_SESSION['r']['doc_li_s']==2)echo "<p style='color: green;'>Accepted</p>";
                else if ($_SESSION['r']['doc_li_s']==3)echo "<p style='color: Red;'>Declined</p>";
                ?>
            </div>
        </form>
        <form method="post" action="profile.php" enctype="multipart/form-data">
            <div><p>AADHAR:</p><? if(!isset($_SESSION['r']['doc_aa']))
                    echo "<input type='file' name='fileToUpload_aa'>
              <input type='submit' name='uploadFile_aa' value='Upload'>
            ";else echo "<a target='_blank' href='$url_aa'><img src ='$url_aa' class='proimage'></a>";
                if($_SESSION['r']['doc_aa_s']==1)echo "<p style='color: yellow;'>Under Review</p>";
                else if ($_SESSION['r']['doc_aa_s']==2)echo "<p style='color: green;'>Accepted</p>";
                else if ($_SESSION['r']['doc_aa_s']==3)echo "<p style='color: Red;'>Declined</p>";

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
<!-- //here ends scrolling icon -->

<!-- jQuery -->

<!-- jQuery Easing -->
<script src="js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="js/jquery.waypoints.min.js"></script>
<!-- Owl Carousel -->
<script src="js/owl.carousel.min.js"></script>

<!-- For demo purposes only styleswitcher ( You may delete this anytime ) -->
<script src="js/jquery.style.switcher.js"></script>
<script>
    $(function(){
        $('#colour-variations ul').styleSwitcher({
            defaultThemeId: 'theme-switch',
            hasPreview: false,
            cookie: {
                expires: 30,
                isManagingLoad: true
            }
        });
        $('.option-toggle').click(function() {
            $('#colour-variations').toggleClass('sleep');
        });
    });
</script>
<!-- End demo purposes only -->

<!-- Main JS (Do not remove) -->
<script src="js/main.js"></script>
</body>
</html>
