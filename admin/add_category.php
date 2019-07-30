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


if (isset($_POST['submitdata'])) {
	$categoryname = strtoupper($_POST['categoryname']);
	
	
	$filename = $_FILES['categorymedia']['name'];	
	move_uploaded_file($_FILES['categorymedia']['tmp_name'],"../headerimages/".$filename);


	

$insert = "INSERT INTO categories (ctg_name) VALUES ('$categoryname')";
$insertrun = $con->query($insert);

$query = "SELECT * FROM categories WHERE ctg_name='$categoryname'";
$run = $con->query($query);
$rows = mysqli_fetch_assoc($run);
$catid = $rows['id'];
//print($catid);

$insertimg = "INSERT INTO header_image (category_id,image) VALUES ('$catid','$filename')";
$insertimgrun = $con->query($insertimg);

echo "<script>alert('Category has been successfully created.')</script>";



}




?>


<!DOCTYPE html>
<html>
<head>
	<title>Add Category - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>
	<div align="right" style="margin: 2px; padding: 2px;" ><b><?php echo "Welcome ".$_SESSION['firstname'].' '.$_SESSION['lastname'];  ?> <a class="usrad" href="admin_editprofile.php">Edit Profile</a>|<a class="usrad" href="admin_logout.php">Logout</a></b></div>


<div class="ads_content" align="center">
	<form method="POST" enctype="multipart/form-data">
	
		
		<div><h4> > CATEGORY DETAILS & HEADER IMAGE UPLOAD</h4></div>

		<div align="center"><a class="a1" href="categories.php">Go Back</a></div>
		
		<div>
			
			<table>
			<tr>
				<td>Category Name</td>
				<td><input type="text" name="categoryname" size="22" required></td>
			</tr>
			
			<tr>
				<td >Header Image</td>
				<td ><input type="file" name="categorymedia" required ></td>
			</tr>
			<tr>
				<td ></td>
				<td ><input type="submit" name="submitdata" value="SUBMIT" class="button"></td>
			</tr>
			<tr>
					<td></td>
					<td><input type="button" name="cancelchanges" onclick="javascript:history.back();" class="button" value="CANCEL"></td>
			</tr>
			
			</table>
			</form>		
		</div>

		<div><p><b>Please note that in header image, Category name should be mentioned.</b></p></div>

		<div><p><i>*While adding category, make sure that the same category is not available in SBM Database already. To view Categories List<a class="a1" href="categories.php" target="_blank">Click Here</a></i></p></div>

		
		
	</div>

	

	<?php
	include 'footer.php';
	?>

</div>

</body>
</html>