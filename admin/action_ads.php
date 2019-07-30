<?php

include '../database.php';

if (isset($_GET['approvepostid'])) {

	$postid = $_GET['approvepostid'];	
	$updatequery = "UPDATE ads SET status='1' WHERE id='$postid' ";
	$result = $con->query($updatequery);
	header("location: user_ads.php");
}

if (isset($_GET['rejectpostid'])) {

	$postid = $_GET['rejectpostid'];	
	$updatequery = "UPDATE ads SET status='2' WHERE id='$postid' ";
	$result = $con->query($updatequery);
	header("location: user_ads.php");
}

if (isset($_GET['auaapostid'])) {

	$postid = $_GET['auaapostid'];	
	$updatequery = "UPDATE ads SET status='1' WHERE id='$postid' ";
	$result = $con->query($updatequery);
	header("location: user_activeads.php");
}

if (isset($_GET['ruaapostid'])) {

	$postid = $_GET['ruaapostid'];	
	$updatequery = "UPDATE ads SET status='2' WHERE id='$postid' ";
	$result = $con->query($updatequery);
	header("location: user_activeads.php");
}

if (isset($_GET['aupapostid'])) {

	$postid = $_GET['aupapostid'];	
	$updatequery = "UPDATE ads SET status='1' WHERE id='$postid' ";
	$result = $con->query($updatequery);
	header("location: user_pendingads.php");
}

if (isset($_GET['rupapostid'])) {

	$postid = $_GET['rupapostid'];	
	$updatequery = "UPDATE ads SET status='2' WHERE id='$postid' ";
	$result = $con->query($updatequery);
	header("location: user_pendingads.php");
}

if (isset($_GET['aurapostid'])) {

	$postid = $_GET['aurapostid'];	
	$updatequery = "UPDATE ads SET status='1' WHERE id='$postid' ";
	$result = $con->query($updatequery);
	header("location: user_rejectedads.php");
}

if (isset($_GET['rurapostid'])) {

	$postid = $_GET['rurapostid'];	
	$updatequery = "UPDATE ads SET status='2' WHERE id='$postid' ";
	$result = $con->query($updatequery);
	header("location: user_rejectedads.php");
}

?>