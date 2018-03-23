<?php
include('login/server.php');

$q="Select (name,email,em_no,doc_rc,doc_li,doc_aa) from user";
$results=mysqli_query($db,$q);
echo "<table>";

while ($row_users = mysql_fetch_array($results)) {
    //output a row here
    echo "<tr><td>".($row_users['email'])."</td></tr>";
}

echo "</table>";