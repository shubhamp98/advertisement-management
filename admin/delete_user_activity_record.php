<?php

include '../database.php';

if ($_GET['deleterecord']=="") {

	echo "Please select a id and then try again.";
	echo "<a href='user_account_activity.php'>Go Back</a>";

}

else{


$recordid = $_GET['deleterecord'];

$qry = "DELETE FROM user_activity WHERE sno='$recordid'"; // query for visitor record deletion.
$qryresult = $con->query($qry);

header("location: user_account_activity.php");

}

?>