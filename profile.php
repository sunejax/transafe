<?php
include('login/server.php');
include('phpqrcode/qrlib.php');
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login/login.php');

}
QRcode::png($_SESSION['r']['name']);
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

echo $_SESSION['r']['name'];
?>

</body>
</html>
