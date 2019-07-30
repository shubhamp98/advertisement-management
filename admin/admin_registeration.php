<?php
include '../database.php';

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
	$accesskey = $_GET['accesskey'];
	
	//$botcheck = $_GET['botcheck'];
	//$tnc = $_GET['tnc'];

	if ($password==$confirmpassword) {

		if ($accesskey==1234) {
			# code...
		
		
	

	$query = "INSERT INTO admin(fname,	lname,	email, phone,	password,		country,	permission,	order_email, status, access_key) VALUES('$firstname','$lastname','$email','$phone','$password','$country','1','$email','1','$accesskey')";
	$result = $con->query($query);

	}
	else{
		$query = "INSERT INTO admin(fname,	lname,	email, phone,	password,		country,	permission,	order_email, status, access_key) VALUES('$firstname','$lastname','$email','$phone','$password','$country','0','$email','0','0')";
	$result = $con->query($query);

	}

	
	

	
	
	if($result)
	{
		echo "<script>alert('You have successfully registered with us.'); window.location= 'admin_login.php';</script>";
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
	<title>Admin Registration - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>

	<div align="right" style="margin: 2px; padding: 2px; border-bottom: 1px solid red;" ><marquee>Welcome to SBM! Register yourself with as a admin on our growing platform and start managing ads and users.</marquee></div>

	<div class="ar_content">
	
		<h3>Register with SBM as a admin and start managing ads and users on our growing platform</h3>



			
				<div><h4> > PERSONAL INFO</h4></div>
				<form method="get">
				<table>
					<tr>
						<td>First Name</td>
						<td><input type="text" name="firstname" required value="<?php if(isset($_GET['firstname'])){ $fn = $_GET['firstname']; echo $fn; }  ?>"></td>
					</tr>

					<tr>
						<td>Last Name</td>
						<td><input type="text" name="lastname" required value="<?php if(isset($_GET['lastname'])){ $ln = $_GET['lastname']; echo $ln; }  ?>" ></td>
					</tr>

					<tr>
						<td>Email</td>
						<td><input type="email" name="email" required value="<?php if(isset($_GET['email'])){ $em = $_GET['email']; echo $em; }  ?>" ></td>
					</tr>
					
					<tr>
						<td>Password</td>
						<td><input type="password" name="password" required  > </td>
					</tr>
					<tr>
						<td></td>
						<td><span style="color: white; background-color: red; font-size: 18px;">
						<?php echo $passworderror; ?>
						</span></td>
					</tr>
					
					<tr>
						<td>Confirm Password</td>
						<td><input type="password" name="confirmpassword" required></td>
					</tr>
					

					<tr>
						<td>Phone</td>
						<td><input type="text" name="phone" required value="<?php if(isset($_GET['phone'])){ $phn = $_GET['phone']; echo $phn; }  ?>"></td>
					</tr>

					<tr>
						<td>Country</td>
						<td><input type="text" name="country" required value="<?php if(isset($_GET['country'])){ $cntry = $_GET['country']; echo $cntry; }  ?>" ></td>
					</tr>
					<tr>
						<td>Access Key<span style="color: red;"> (Leave it blank if you don't have.)</span></td>
						<td><input type="text" name="accesskey" placeholder="If you have/contact admin" pattern="[1-4]{4}" ></td>
					</tr>

					
					<tr>
						<td colspan="2"><input type="checkbox" name="tnc" value="1" required>By registering I hereby accept SBM's <b>Privacy Policy & Terms of Use</b></td>
					</tr>
					<tr>
						<td colspan="2"><i><u>*Please note that by default newly registered admin permission is set to read only (if no access key found)*</u></i></td>
						
					</tr>
					<tr>
						<td colspan="2"><input type="submit" name="createaccount" value="CREATE ACCOUNT" class="button1"></td>
					</tr>
					<tr>				
					<td colspan="2"><input type="button" name="cancelchanges" onclick="javascript:history.back();" class="button1" value="CANCEL"></td>

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