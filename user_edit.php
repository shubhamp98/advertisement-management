<?php
session_start();
include 'database.php';

if(!isset($_SESSION['id'])){
header("location: user_login.php");
}

$userid=$_SESSION['id'];
$userfname=$_SESSION['firstname'];
$userlname=$_SESSION['lastname'];
$userbusiness=$_SESSION['businessname'];

// getting user's device details.
date_default_timezone_set('Asia/Kolkata');
 $ipaddress = $_SERVER['REMOTE_ADDR'];
 $page = "http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'];
 $referrer = $_SERVER['HTTP_REFERER'];
 $datetime = date('Y-m-d H:i:s');
 $useragent = $_SERVER['HTTP_USER_AGENT'];

// query for inserting user's details and page activity.
 $query = "INSERT INTO user_activity (ip_address,user_id,date_time,page,referrer,client_used) VALUES ('$ipaddress','$userid','$datetime','$page','$referrer','$useragent')";
 $runquery = $con->query($query);



$editquery = "SELECT * FROM users WHERE id='$userid'"; // getting user data for respected id.
$runeditquery = $con->query($editquery);
$dataresult = mysqli_fetch_assoc($runeditquery);



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
		
	

	$query = "UPDATE users SET fname='$firstname',lname='$lastname',email='$email',password='$password',phone='$phone',	country='$country',	business_name='$businessname',	business_description='$businessdescription',business_phone='$businessphone',	business_email='$businessemail',	business_website='$businesswebsite',	whatsapp='$businesswhatsapp',	instagram='$businessinstagram',	twitter='$businesstwitter',	facebook='$businessfacebook',	location='$businesslocation' WHERE id='$userid'";
	$result = $con->query($query);

	
	

	
	
	if($result)
	{
		echo "<script>alert('You have successfully updated your details with us.'); window.location= 'user_ads.php';</script>";
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
	<title>Edit Profile - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>
	<div align="right" style="margin: 2px; padding: 2px;" ><b><?php echo "Welcome ".$_SESSION['firstname'].' '.$_SESSION['lastname'].' '."(".$_SESSION['businessname'].")";  ?> <a class="usrad" href="user_edit.php?id=<?php echo $userid; ?>">Edit Profile</a>|<a class="usrad" href="post_ads.php">Post Ads</a>|<a class="usrad" href="user_logout.php">Logout</a></b></div>
	<div class="ur_content">
	<div class="ur_left">
		<h3><u> > Edit Profile</u></h3>



			
				<div><b> > PERSONAL INFO<br><br> </b></div>
				<form method="get">
				<table>
					<tr>
						<td>First Name</td>
						<td><input type="text" name="firstname" required value="<?php echo $dataresult['fname']; ?>"></td>
					</tr>

					<tr>
						<td>Last Name</td>
						<td><input type="text" name="lastname" required value="<?php echo $dataresult['lname']; ?>"" ></td>
					</tr>

					<tr>
						<td>Email</td>
						<td><input type="email" name="email" required value="<?php echo $dataresult['email']; ?>"></td>
					</tr>
					
					<tr>
						<td>Password</td>
						<td><input type="password" name="password" required value="<?php echo $dataresult['password']; ?>"  > </td>
					</tr>
					<tr>
						<td></td>
						<td><span style="color: white; background-color: red; font-size: 18px;">
						<?php echo $passworderror; ?>
						</span></td>
					</tr>
					
					<tr>
						<td>Confirm Password</td>
						<td><input type="password" name="confirmpassword" required value="<?php echo $dataresult['password']; ?>"></td>
					</tr>
					

					<tr>
						<td>Phone</td>
						<td><input type="text" name="phone" required value="<?php echo $dataresult['phone']; ?>"></td>
					</tr>

					<tr>
						<td>Country</td>
						<td><input type="text" name="country" required value="<?php echo $dataresult['country']; ?>" ></td>
					</tr>
				</table>

			</div>
	

			<div class="ur_right">
					<div><b> > BUSINESS INFO <br><br></b></div>
					<table>
					<tr>
						<td>Business Name</td>
						<td><input type="text" name="businessname" required value="<?php echo $dataresult['business_name']; ?>" ></td>
					</tr>

					<tr>
						<td>Describe your Business</td>
						<td><textarea name="businessdescription" rows="2" cols="5" placeholder="(upto 2 lines)" maxlength="80"><?php echo $dataresult['business_description']; ?></textarea></td>
					</tr>

					<tr>
						<td>Phone</td>
						<td><input type="text" name="businessphone" value="<?php echo $dataresult['business_phone']; ?>" ></td>
					</tr>					

					<tr>
						<td>Business Email</td>
						<td><input type="email" name="businessemail" required value="<?php echo $dataresult['business_email']; ?>" ></td>
					</tr>

					<tr>
						<td>Website</td>
						<td><input type="url" name="businesswebsite" value="<?php echo $dataresult['business_website']; ?>" ></td>
					</tr>

					<tr>
						<td>WhatsApp</td>
						<td><input type="text" name="businesswhatsapp" value="<?php echo $dataresult['whatsapp']; ?>" ></td>
					</tr>
					<tr>
						<td>Instagram</td>
						<td><input type="url" name="businessinstagram" value="<?php echo $dataresult['instagram']; ?>" ></td>
					</tr>

					<tr>
						<td>Twitter</td>
						<td><input type="url" name="businesstwitter" value="<?php echo $dataresult['twitter']; ?>" ></td>
					</tr>
					<tr>
						<td>Facebook</td>
						<td><input type="url" name="businessfacebook" value="<?php echo $dataresult['facebook']; ?>" ></td>
					</tr>
					<tr>
						<td>Location</td>
						<td><input type="text" name="businesslocation" required value="<?php echo $dataresult['location']; ?>" ></td>
					</tr>
					<tr>
						<td>Answer This and prove you are human: 1+0</td>
						<td><input type="text" name="botcheck"></td>
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
		</div>

	
	<?php
	include 'footer.php';
	?>

</div>

</body>
</html>