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

        img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 150px;
        }

        img:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }
    </style>
</head>
<body>
<table>
   <? while ($row_users = $results->fetch_array(MYSQLI_ASSOC)) {
    //output a row here
       $rc=$row_users['doc_rc'];
       $li=$row_users['doc_li'];
       $aa=$row_users['doc_aa'];

    echo "<tr><td>".($row_users['name'])."</td><td>".($row_users['email'])."</td><td>".($row_users['em_no'])."</td><td><a target='_blank' href=$rc><img src =$rc></a></td><td><a target='_blank' href='$li'><img src =$li></a></td><td><a target='_blank' href='$aa'><img src =$aa></a></td></tr>";
    }?>
</table>
</body>

</html>




