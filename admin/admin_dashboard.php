<?php

session_start();
include '../database.php';

$userid=$_SESSION['id'];
$userfname=$_SESSION['firstname'];
$userlname=$_SESSION['lastname'];
$userpermission = $_SESSION['permission'];
$userstatus = $_SESSION['status'];


if(!isset($_SESSION['id']) || (!isset($userpermission)) || (!isset($userstatus))){
session_unset();
session_destroy();
header("location: admin_login.php");
}


$uquery = "SELECT * FROM users"; // query for getting users records in numbers.
$uresult = $con->query($uquery);
$urecord = mysqli_num_rows($uresult);

$aquery = "SELECT * FROM ads"; // query for getting total ads in numbers.
$aresult = $con->query($aquery);
$arecord = mysqli_num_rows($aresult);


$admquery = "SELECT * FROM admin"; // query for getting admin records in numbers.
$admresult = $con->query($admquery);
$admrecord = mysqli_num_rows($admresult);

$activeaquery = "SELECT * FROM ads WHERE status=1"; // query for getting total active ads in numbers.
$activearesult = $con->query($activeaquery);
$activearecord = mysqli_num_rows($activearesult);

$pendingaquery = "SELECT * FROM ads WHERE status=0"; // query for getting total pending ads in numbers.
$pendingaresult = $con->query($pendingaquery);
$pendingarecord = mysqli_num_rows($pendingaresult);

$rejectaquery = "SELECT * FROM ads WHERE status=2"; // query for getting total rejected ads in numbers.
$rejectaresult = $con->query($rejectaquery);
$rejectarecord = mysqli_num_rows($rejectaresult);

$catquery = "SELECT * FROM categories"; // query for getting total no. of categories available.
$catresult = $con->query($catquery);
$catrecord = mysqli_num_rows($catresult);

$visitorqry = "SELECT * FROM user_activity"; // query for getting total no. of user'a account activity
$visitorresult = $con->query($visitorqry);
$visitorrecord = mysqli_num_rows($visitorresult);





?>


<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>
	<div align="right" style="margin: 2px; padding: 2px;" ><b><?php echo "Welcome ".$_SESSION['firstname'].' '.$_SESSION['lastname'];  ?> <a class="usrad" href="admin_editprofile.php">Edit Profile</a>|<a class="usrad" href="admin_logout.php">Logout</a></b></div>

<div class="admindash" id="forback">
	
	


		<div   style="color: blue; font-size: 18px;" align="center"><h4 ><u><i>> ADMIN DASHBOARD</i></u></h4> </div>

		<div class="admindashview_left">
			<table cellpadding="5" cellspacing="0">

				<tr style=" background-color: orange; color: white; font-size: 18px;">
					<th height="40px" width="10%"> No. of registered users</th>
				</tr>		

				<tr class="a">
					<td height="40px" align="center" ><?php echo $urecord; ?></td>
				</tr>	

				<tr class="b" style="background-color: lightblue;">
					<td height="40px" align="center" ><a class="a1" href="user_list.php">Click here</a></td>
				</tr>	
		
			</table>
		</div>

		<div class="admindashview_right">
			<table cellpadding="5" cellspacing="0">
				
				<tr style=" background-color: orange; color: white; font-size: 18px;">
					<th height="40px" width="10%"> No. of admin registered</th>
				</tr>		

				<tr class="a">
					<td height="40px" align="center" ><?php echo $admrecord; ?></td>
				</tr>	

				<tr class="b" style="background-color: lightblue;">
					<td height="40px" align="center" ><a class="a1" href="admin_list.php">Click here</a></td>
				</tr>	
		
			</table>
		</div>

		<div  class="admindashview_left">
			<table cellpadding="5" cellspacing="0">
				
				<tr style=" background-color: orange; color: white; font-size: 18px;">
					<th height="40px" width="10%"> No. of ads submitted by users</th>
				</tr>		

				<tr class="a">
					<td height="40px" align="center" ><?php echo $arecord; ?></td>
				</tr>

				<tr class="b" style="background-color: lightblue;">
					<td height="40px" align="center" ><a class="a1" href="user_ads.php">Click here</a></td>
				</tr>	

		
			</table>
		</div>

		<div class="admindashview_right">
			<table cellpadding="5" cellspacing="0">
				
				<tr style=" background-color: orange; color: white; font-size: 18px;">
					<th height="40px" width="10%"> No. of active ads/running ads</th>
				</tr>		

				<tr class="a">
					<td height="40px" align="center" ><?php echo $activearecord; ?></td>
				</tr>		

				<tr class="b" style="background-color: lightblue;">
					<td height="40px" align="center" ><a class="a1" href="user_activeads.php">Click here</a></td>
				</tr>
		
			</table>
		</div>

		<div class="admindashview_left">
			<table cellpadding="5" cellspacing="0">
				
				<tr style=" background-color: orange; color: white; font-size: 18px;">
					<th height="40px" width="10%"> No. of ads pending for approval</th>
				</tr>		

				<tr class="a">
					<td height="40px" align="center" ><?php echo $pendingarecord; ?></td>
				</tr>		

				<tr class="b" style="background-color: lightblue;">
					<td height="40px" align="center" ><a class="a1" href="user_pendingads.php">Click here</a></td>
				</tr>
		
			</table>
		</div>

		<div class="admindashview_right">
			<table cellpadding="5" cellspacing="0">
				
				<tr style=" background-color: orange; color: white; font-size: 18px;">
					<th height="40px" width="10%"> No. of ads rejected by admin</th>
				</tr>		

				<tr class="a">
					<td height="40px" align="center" ><?php echo $rejectarecord; ?></td>
				</tr>		

				<tr class="b" style="background-color: lightblue;">
					<td height="40px" align="center" ><a class="a1" href="user_rejectedads.php">Click here</a></td>
				</tr>
		
			</table>
		</div>

		<div id="forbackcategories" class="admindashview_left">
			<table cellpadding="5" cellspacing="0">
				
				<tr style=" background-color: orange; color: white; font-size: 18px;">
					<th height="40px" width="10%"> Categories</th>
				</tr>		

				<tr class="a">
					<td height="40px" align="center" ><?php echo $catrecord; ?></td>
				</tr>		

				<tr class="b" style="background-color: lightblue;">
					<td height="40px" align="center" ><a class="a1" href="categories.php">Click here</a></td>
				</tr>
		
			</table>
		</div>

		<div id="forbackvisitor" class="admindashview_right">
			<table cellpadding="5" cellspacing="0">
				
				<tr style=" background-color: orange; color: white; font-size: 18px;">
					<th height="40px" width="10%"> User's activity record</th>
				</tr>		

				<tr class="a">
					<td height="40px" align="center" ><?php echo $visitorrecord; ?></td>
				</tr>		

				<tr class="b" style="background-color: lightblue;">
					<td height="40px" align="center" ><a class="a1" href="user_account_activity.php">Click here</a></td>
				</tr>
		
			</table>
		</div>
				

</div>

	<?php
	include 'footer.php';
	?>

</div>

</body>
</html>