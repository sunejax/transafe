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
                    <li><a href="home.php"><span>Home</span></a></li>
                    <li><a href="quiz.php"><span>Practice</span></a></li>
                    <li class="active" data-nav-section="home"><a href="profile.php"><?php echo $_SESSION['username']; ?></a></li>
                    <li><a href="profile.php?logout='1'">Sign out</a></li>
                </ul>
            </div>
        </nav>
        <!-- </div> -->
    </div>
</header>
<div id="slider" data-section="home">
    <div class="owl-carousel owl-carousel-fullwidth">
        <!-- You may change the background color here. -->
        <div class="item" style="background: #352f44;">
            <div class="container" style="position: relative;">
                <div class="row">
                    <div class="col-md-7 col-sm-7">
                        <div class="fh5co-owl-text-wrap">
                            <div class="fh5co-owl-text">
                                <h1 class="fh5co-lead to-animate">Travel with assurance</h1>
                                <h2 class="fh5co-sub-lead to-animate">Associate your emergency information like allergies, previous medical data, insurance details and emergency contact accessible only to registered professionals and medical staff in case of accidents.</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- You may change the background color here.  -->
        <div class="item" style="background: #38569f;">
            <div class="container" style="position: relative;">
                <div class="row">
                    <div class="col-md-7 col-md-push-1 col-md-push-5 col-sm-7 col-sm-push-1 col-sm-push-5">
                        <div class="fh5co-owl-text-wrap">
                            <div class="fh5co-owl-text">
                                <h1 class="fh5co-lead to-animate">Online Verification</h1>
                                <h2 class="fh5co-sub-lead to-animate">Link and verify your registration, license and AADHAR all from the comfort of your home.</h3>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>