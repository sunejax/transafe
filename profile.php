<?php
include('login/server.php');
include('phpqrcode/qrlib.php');
/*if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login/login.php');

}
*/
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login/login.php");
}
QRcode::png($_SESSION['r'], 'qr.png', 'L', 4, 2);

?>
<html>
<body>
<img src="qr.png">
</body>
</html>
