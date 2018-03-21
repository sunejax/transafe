<?php
include('login/server.php');
include('phpqrcode/qrlib.php');
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login/login.php');

}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login/login.php");
}


?>
<html>
<body>
<?php
$qr=$_SESSION['r']['name'];
//QRcode::png($qr);
echo $_SESSION['r'];
?>

</body>
</html>
