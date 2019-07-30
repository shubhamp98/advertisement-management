<?php

include '../database.php';

if (isset($_GET['enableid'])) {

	$id = $_GET['enableid'];	
	$updatequery = "UPDATE admin SET status='1' WHERE id='$id' ";
	$result = $con->query($updatequery);
	header("location: admin_list.php");
}

if (isset($_GET['disableid'])) {

	$id = $_GET['disableid'];	
	$updatequery = "UPDATE admin SET status='0' WHERE id='$id' ";
	$result = $con->query($updatequery);
	header("location: admin_list.php");
}


?>