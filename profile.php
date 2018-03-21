<?php
include('login/server.php');
include('phpqrcode/qrlib.php');
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login/login.php');

}
$str=$_SESSION['r']['name'].' '.$_SESSION['r']['em_no'].' '.$_SESSION['r']['em_msg'];
QRcode::png($str);
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
