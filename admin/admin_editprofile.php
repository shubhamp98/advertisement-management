<?php
session_start();
include '../database.php';


$userid=$_SESSION['id'];
$userfname=$_SESSION['firstname'];
$userlname=$_SESSION['lastname'];



if(!isset($_SESSION['id'])){
header("location: admin_login.php");

}



$editquery = "SELECT * FROM admin WHERE id='$userid'"; // getting admin data for respected id.
$runeditquery = $con->query($editquery);
$dataresult = mysqli_fetch_assoc($runeditquery);
//print_r($dataresult);


$passworderror = '';

if(isset($_GET['createaccount']))
{
	$firstname = $_GET['firstname'];
	$lastname = $_GET['lastname'];
	$email = $_GET['email'];
	$password = $_GET['password'];
	$confirmpassword = $_GET['confirmpassword'];
	$phone = $_GET['phone'];
	$country = $_GET['country'];
	
	//$botcheck = $_GET['botcheck'];
	//$tnc = $_GET['tnc'];

	if ($password==$confirmpassword) {
		
	

	$query = "UPDATE admin SET fname='$firstname',	lname='$lastname',	email='$email', phone='$phone',	password='$password',		country='$country',	order_email='$email' WHERE id='$userid'";
	$result = $con->query($query);

	
	

	
	
	if($result)
	{
		echo "<script>alert('Your profile has been updated.'); window.location= 'admin_dashboard.php';</script>";
		//header("location: home.php");
	}
	}
	else{
		$passworderror = "Password and Confirm Password must be same.";
	}
	
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Profile Edit - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>

	



	<div class="ar_content">
	
		<h3><u> > Edit Profile</u><div align="center"><a href="admin_dashboard.php">Go Back</a></div></h3>





			
				<div><h4> > PERSONAL INFO</h4></div>
				<form method="get">
				<table>
					<tr>
						<td>First Name</td>
						<td><input type="text" name="firstname" required value="<?php echo $dataresult['fname']; ?>"></td>
					</tr>

					<tr>
						<td>Last Name</td>
						<td><input type="text" name="lastname" required value="<?php echo $dataresult['lname']; ?>" ></td>
					</tr>

					<tr>
						<td>Email</td>
						<td><input type="email" name="email" required value="<?php echo $dataresult['email']; ?>" ></td>
					</tr>
					
					<tr>
						<td>Password</td>
						<td><input type="password" name="password" required value="<?php echo $dataresult['password']; ?>" > </td>
					</tr>
					<tr>
						<td></td>
						<td><span style="color: white; background-color: red; font-size: 18px;">
						<?php echo $passworderror; ?>
						</span></td>
					</tr>
					
					<tr>
						<td>Confirm Password</td>
						<td><input type="password" name="confirmpassword" required value="<?php echo $dataresult['password']; ?>" ></td>
					</tr>
					

					<tr>
						<td>Phone</td>
						<td><input type="text" name="phone" required value="<?php echo $dataresult['phone']; ?>"></td>
					</tr>

					<tr>
						<td>Country</td>
						<td><input type="text" name="country" required value="<?php echo $dataresult['country']; ?>" ></td>
					</tr>

					
					<tr>
						<td colspan="2"><i><u>*Please note that by default newly registered admin permission is set to read only (if no access key found)*</u></i></td>
						
					</tr>
					<tr>
						<td colspan="2"><input type="submit" name="createaccount" value="UPDATE DETAILS" class="button1"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="button" name="cancelchanges" onclick="javascript:history.back();" class="button1" value="CANCEL UPDATE"></td>
					</tr>
				</table>

			</form>
			
		</div>

	
	<?php
	include 'footer.php';
	?>

</div>

</body>
</html>