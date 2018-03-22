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
        $pathToFile = $_FILES["fileToUpload"]['tmp_name'];
        $key = $_SESSION['r']['uid'] . 'rc' . '.jpeg';
        $result = $client->putObject(array(
            'Bucket' => $bucket,
            'Key' => $key,
            'SourceFile' => $pathToFile,
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
}
?>
<html>
<body>

<form method="post" action="profile.php" enctype="multipart/form-data">
    <div><p>Registration Certificate:</p><? if(!isset($_SESSION['r']['doc_rc']))
            echo "<input type='file' name='fileToUpload'>
              <input type='submit' name='uploadFile' value='Upload'>
            ";
        if($_SESSION['r']['doc_rc_s']==1)echo "<p style='color: yellow;'>Under Review</p>";
        else if ($_SESSION['r']['doc_rc_s']==2)echo "<p style='color: green;'>Confirmed</p>";
        else echo "<p>Status Check here</p>";?>
    </div>
    <div><p>Driving License</p><? if(!isset($_SESSION['r']['doc_li']))
            echo "<input type='file' name='fileToUpload'>
              <input type='submit' name='uploadFile' value='Upload'>
            ";
        if($_SESSION['r']['doc_li_s']==1)echo "<p style='color: yellow;'>Under Review</p>";
        else if ($_SESSION['r']['doc_li_s']==2)echo "<p style='color: green;'>Confirmed</p>";
        else echo "<p>Status Check here</p>";?>
    </div>
    <div><p>AADHAR</p><? if(!isset($_SESSION['r']['doc_aa']))
            echo "<input type='file' name='fileToUpload'>
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
</body>
</html>
