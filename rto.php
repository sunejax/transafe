<?php
include('login/server.php');


if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login/login.php');

}


if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login/login.php");
}
$q="Select uid,name,email,em_no,doc_rc,doc_li,doc_aa from user WHERE ad_rights is NULL ";
$results=mysqli_query($db,$q);
if (isset($_POST['accept'])) {
    $postid = $_POST['postid'];
    if($_POST['accept']==1)
        $result = mysqli_query($db, "UPDATE user SET doc_rc_s=2,doc_li_s=2,doc_aa_s=2  WHERE uid=$postid");
    else if($_POST['accept']==2)
        $result = mysqli_query($db, "UPDATE user SET doc_rc_s=3,doc_li_s=3,doc_aa_s=3  WHERE uid=$postid");
    exit();
}
?>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: center;
            /*border-bottom: 1px solid #ddd;*/
            border: 1px solid #dddddd;
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
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- light-box -->
    <link rel="stylesheet" href="css/lightbox.css">
    <!-- //light-box -->
    <script src="js/SmoothScroll.min.js"></script>
    <script src="js/jquery.min.js"></script>

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
    <style>
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

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap2-toggle.min.css" rel="stylesheet">
    <script type='text/javascript' src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap2-toggle.min.js"></script>
</head>
<body>
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
                        <li><a href="rto.php" class="active"><?php echo $_SESSION['username']; ?></a></li>
                        <li><a href="rto.php?logout='1'">Logout</a></li>
                    </ul>
                    <div class="clearfix"> </div>
                </div>
            </nav>
        </div>

    </div>
    <!--//header-->

</div>
<table>
    <? while ($row_users = $results->fetch_array(MYSQLI_ASSOC)) {
        //output a row here
        $rc=$row_users['doc_rc'];
        $li=$row_users['doc_li'];
        $aa=$row_users['doc_aa'];
        $uid=$row_users['uid'];

        echo "<tr><td>".($row_users['name'])."</td><td>".($row_users['email'])."</td><td>".($row_users['em_no'])."</td><td><a target='_blank' href=$rc><img src =$rc></a></td><td><a target='_blank' href=$li><img src =$li></a></td><td><a target='_blank' href=$aa><img src =$aa></a></td><td><input class='switcher' id=$uid data-toggle='toggle' data-on='Accept' data-width=100 data-height=34 data-off='Decline' data-onstyle='success' data-offstyle='danger' type='checkbox'></td></tr>";
        ;}
    ?>
</table>
<script>
    $(document).ready(function(){
        // when the user clicks on switch
        $(".switcher").change(function(){
            var postid = $(this).attr('id');
            if($(this).is(":checked")) {
                $.ajax({
                    url: 'rto.php',
                    type: 'post',
                    data: {
                        'accept': 1,
                        'postid': postid
                    }
                });
            }
            else
            {$.ajax({
                url: 'rto.php',
                type: 'post',
                data: {
                    'accept': 2,
                    'postid': postid
                }
            });
            }
        });
    });
</script>
</body>

</html>




