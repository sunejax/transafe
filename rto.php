<?php
include('login/server.php');

$q="Select name,email,em_no,doc_rc,doc_li,doc_aa from user";
$results=mysqli_query($db,$q);
echo "<table>";

while ($row_users = $results->fetch_array(MYSQLI_ASSOC)) {
    //output a row here
    echo "<tr><td>".($row_users['email'])."</td></tr>";
}

echo "</table>";