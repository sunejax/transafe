<?php
include('login/server.php');


if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login/login.php');

}

$q="Select name,email,em_no,doc_rc,doc_li,doc_aa from user WHERE ad_rights is NULL ";
$results=mysqli_query($db,$q);
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
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
<table>
   <? while ($row_users = $results->fetch_array(MYSQLI_ASSOC)) {
    //output a row here
    echo "<tr><td>".($row_users['name'])."</td><td>".($row_users['email'])."</td><td>".($row_users['em_no'])."</td><td>".($row_users['doc_rc'])."</td><td>".($row_users['doc_li'])."</td><td>".($row_users['doc_aa'])."</td></tr>";
    }?>
</table>
</body>

</html>




