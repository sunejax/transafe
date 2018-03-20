<?php

require '../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

// AWS Info
$bucketName = 'transafedocs';
$IAM_KEY = 'AKIAJFPPYA63IIRKDU2Q';
$IAM_SECRET = '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';

// Connect to AWS
try {
    // You may need to change the region. It will say in the URL when the bucket is open
    // and on creation.
    $s3 = S3Client::factory(
        array(
            'credentials' => array(
                'key' => $IAM_KEY,
                'secret' => $IAM_SECRET
            ),
            'version' => 'latest',
            'region'  => 'us-east-2'
        )
    );
} catch (Exception $e) {
    // We use a die, so if this fails. It stops here. Typically this is a REST call so this would
    // return a json object.
    die("Error: " . $e->getMessage());
}

if(isset($_POST['uploadFiles'])) {
// For this, I would generate a unqiue random string for the key name. But you can do whatever.
    $keyName = 'test_example/' . basename($_FILES["fileToUpload"]['tmp_name']);
    $pathInS3 = 'https://s3.us-east-2.amazonaws.com/' . $bucketName . '/' . $keyName;

// Add it to S3

    try {
        // Uploaded:
        $file = $_FILES["fileToUpload"]['tmp_name'];

        $s3->putObject(
            array(
                'Bucket' => $bucketName,
                'Key' => $keyName,
                'SourceFile' => $file,
                'StorageClass' => 'REDUCED_REDUNDANCY'
            )
        );

    } catch (S3Exception $e) {
        die('Error:' . $e->getMessage());
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}

echo 'Done';

// Now that you have it working, I recommend adding some checks on the files.
// Example: Max size, allowed file types, etc.
?>
<html>
<body>
<form action="" method='post' enctype="multipart/form-data">
    <h3>Upload Image</h3><br/>
    <input type='file' name="fileToUpload"/>
    <input type='submit' name="uploadFiles" value='Upload'/>
</form>
</body>
</html>
