<?php include('server.php');
require('../vendor/autoload.php');
use Aws\S3\S3Client;

/*$s3 = new S3Client([
    'credentials' => [
        'key'    => 'AKIAJFPPYA63IIRKDU2Q',
        'secret' => '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',
    ],

]);*/
$s3 = S3Client::factory(array(
    'key'    => 'AKIAJFPPYA63IIRKDU2Q',
    'secret' => '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'
));
//$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
$bucket='transafedocs'
?>
<!DOCTYPE html>
<html>
<head>
	<title>Transafe - SignUp</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Register</h2>
	</div>
	
<!--	<form enctype="multipart/form-data" action="--><?//=$_SERVER['PHP_SELF']?><!--" method="POST">-->
<!---->
<!--		--><?php //include('errors.php'); ?>
<!---->
<!--		<div class="input-group">-->
<!--			<label>Username</label>-->
<!--			<input type="text" name="username" value="--><?php //echo $name; ?><!--">-->
<!--		</div>-->
<!--		<div class="input-group">-->
<!--			<label>Email</label>-->
<!--			<input type="email" name="email" value="--><?php //echo $email; ?><!--">-->
<!--		</div>-->
<!--		<div class="input-group">-->
<!--			<label>Password</label>-->
<!--			<input type="password" name="password_1">-->
<!--		</div>-->
<!--		<div class="input-group">-->
<!--			<label>Confirm password</label>-->
<!--			<input type="password" name="password_2">-->
<!--		</div>-->
<!--		<div class="input-group">-->
<!--			<button type="submit" class="btn" name="reg_user">Register</button>-->
<!--		</div>-->
<!--		<p>-->
<!--			Already a member? <a href="login.php">Sign in</a>-->
<!--		</p>-->



<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    // FIXME: add more validation, e.g. using ext/fileinfo
    try {
        // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
        //$upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
        $result = $s3->putObject([
            'Bucket'     => $bucket,
            'Key'        => $_FILES['userfile']['name'],
            'SourceFile' => $_FILES['userfile'],
        ]);
        ?>
        <p>Upload <a href="<?=htmlspecialchars($result->get('ObjectURL'))?>">successful</a> :)</p>
    <?php } catch(Exception $e) { echo $e;?>
        <p>Upload error :(</p>
    <?php } } ?>
<h2>Upload a file</h2>
    <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
    <input name="userfile" type="file"><input type="submit" value="Upload" name="">
</form>
</body>
</html>