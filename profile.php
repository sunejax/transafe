<?php
include('login/server.php');
include('phpqrcode/qrlib.php');
require 'vendor/autoload.php';
use Aws\S3\S3Client;

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
if(isset($_POST['uploadFile'])){
    $pathToFile=$_FILES["fileToUpload"]['tmp_name'];
    $key=$_SESSION['r']['uid'].'rc'.'.jpeg';
    $result = $client->putObject(array(
        'Bucket'     => $bucket,
        'Key'        => $key,
        'SourceFile' => $pathToFile,

));
}

?>
<html>
<body>

<form method="post" action="profile.php">
    <? if(!isset($_SESSION['r']['doc_rc']))
        echo "<input type='file' name='fileToUpload'>
              <input type='button' name='uploadFile' value='Upload'>
            "?>'
</form>
<form method="get" action="qr.php">
    <button type="submit">Generate QR Code</button>
</form>
</body>
</html>
