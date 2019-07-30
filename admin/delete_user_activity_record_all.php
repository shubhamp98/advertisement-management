<?php

include '../database.php';

$qry = "TRUNCATE TABLE user_activity"; 
$qryresult = $con->query($qry);

header("location: user_account_activity.php");


?>