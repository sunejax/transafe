<?php
include('login/server.php');
include('phpqrcode/qrlib.php');
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login/login.php');

}
$str=
QRcode::png($str);
?>