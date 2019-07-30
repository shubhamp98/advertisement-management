<?php
include 'database.php';

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
	$businessname = $_GET['businessname'];
	$businessdescription = $_GET['businessdescription'];
	$businessphone = $_GET['businessphone'];
	$businessemail = $_GET['businessemail'];
	$businesswebsite = $_GET['businesswebsite'];
	$businesswhatsapp = $_GET['businesswhatsapp'];
	$businessinstagram = $_GET['businessinstagram'];
	$businesstwitter = $_GET['businesstwitter'];
	$businessfacebook = $_GET['businessfacebook'];
	$businesslocation = $_GET['businesslocation'];
	$botcheck = $_GET['botcheck'];
	//$tnc = $_GET['tnc'];

	if ($password==$confirmpassword) {
		
	

	$query = "INSERT INTO users(fname,	lname,	email,	password,	phone,	country,	business_name,	business_description,	business_email,	business_website,	whatsapp,	instagram,	twitter,	facebook,	location) VALUES('$firstname','$lastname','$email','$password','$phone','$country','$businessname','$businessdescription','$businessemail','$businesswebsite','$businesswhatsapp','$businessinstagram','$businesstwitter','$businessfacebook','$businesslocation')";
	$result = $con->query($query);

	
	

	
	
	if($result)
	{
		echo "<script>alert('You have successfully registered with us.'); window.location= 'user_login.php';</script>";
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
	<title>Register - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>
	<div class="ur_content">
	<div class="ur_left">
		<h4>Register with SBM and start uploading with your ads on our growing platform</h4>



			
				<div><b> > PERSONAL INFO<br><br> </b></div>
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
				</table>

			</div>
	

			<div class="ur_right">
					<div><b> > BUSINESS INFO <br><br></b></div>
					<table>
					<tr>
						<td>Business Name</td>
						<td><input type="text" name="businessname" required value="<?php if(isset($_GET['businessname'])){ $bn = $_GET['businessname']; echo $bn; }  ?>" ></td>
					</tr>

					<tr>
						<td>Describe your Business</td>
						<td><textarea name="businessdescription" rows="2" cols="21" placeholder="(upto 2 lines)"><?php if(isset($_GET['businessdescription'])){ $bd = $_GET['businessdescription']; echo $bd; }  ?></textarea></td>
					</tr>

					<tr>
						<td>Phone</td>
						<td><input type="text" name="businessphone" value="<?php if(isset($_GET['businessphone'])){ $bp = $_GET['businessphone']; echo $bp; }  ?>" ></td>
					</tr>					

					<tr>
						<td>Business Email</td>
						<td><input type="email" name="businessemail" required value="<?php if(isset($_GET['businessemail'])){ $be = $_GET['businessemail']; echo $be; }  ?>" ></td>
					</tr>

					<tr>
						<td>Website</td>
						<td><input type="url" name="businesswebsite" value="<?php if(isset($_GET['businesswebsite'])){ $bw = $_GET['businesswebsite']; echo $bw; }  ?>" ></td>
					</tr>

					<tr>
						<td>WhatsApp</td>
						<td><input type="text" name="businesswhatsapp" value="<?php if(isset($_GET['businesswhatsapp'])){ $bw = $_GET['businesswhatsapp']; echo $bw; }  ?>" ></td>
					</tr>
					<tr>
						<td>Instagram</td>
						<td><input type="url" name="businessinstagram" value="<?php if(isset($_GET['businessinstagram'])){ $bi = $_GET['businessinstagram']; echo $bi; }  ?>" ></td>
					</tr>

					<tr>
						<td>Twitter</td>
						<td><input type="url" name="businesstwitter" value="<?php if(isset($_GET['businesstwitter'])){ $bt = $_GET['businesstwitter']; echo $bt; }  ?>" ></td>
					</tr>
					<tr>
						<td>Facebook</td>
						<td><input type="url" name="businessfacebook" value="<?php if(isset($_GET['businessfacebook'])){ $bf = $_GET['businessfacebook']; echo $bf; }  ?>" ></td>
					</tr>
					<tr>
						<td>Location</td>
						<td><input type="text" name="businesslocation" required value="<?php if(isset($_GET['businesslocation'])){ $bl = $_GET['businesslocation']; echo $bl; }  ?>" ></td>
					</tr>
					<tr>
						<td>Answer This and prove you are human: 1+0</td>
						<td><input type="text" name="botcheck"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="checkbox" name="tnc" value="1" required>By registering I hereby accept SBM's <b>Privacy Policy & Terms of Use</b></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" name="createaccount" value="CREATE ACCOUNT" class="button1"></td>
					</tr>
				</table>
		
			</form>
			</div>
		</div>

	
	<?php
	include 'footer.php';
	?>

</div>

</body>
</html>