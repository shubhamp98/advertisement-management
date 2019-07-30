<?php
include 'database.php';

$lerror = "";


$email = $_GET['email'];
$password_token = $_GET['password_token'];

$check = "SELECT * FROM users WHERE email='$email' AND password_token='$password_token'";
$result = $con->query($check);

if(mysqli_num_rows($result)<1){
	echo "<script type='text/javascript'>alert('Invalid link or Link is Expired!'); window.location= 'index.php';</script>";
}



if(isset($_POST['update'])){
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];


	if($password==$confirmpassword){
		$query = "UPDATE users SET password='$password', password_token=''  WHERE email='$email' AND password_token='$password_token'";
		$result = $con->query($query);


		if($result){
			echo "<script type='text/javascript'>alert('Password succesfully updated.'); window.location= 'user_login.php';</script>";	
		}
		else {
			$lerror = $con->error."Password updation failed.";
		}
	}
	else {	
	$lerror = "Password and Confirm Password should be same.	";
	}


	//header("location: http://localhost/project/user_login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Reset Password - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>
	
	<div  class="loginarea" align="center">
		
	<form method="POST">
		<table>
			<tr>
				<th><h3> > RESET PASSWORD</h3></th>
			</tr>
			<tr>
				<td colspan="2"><span style="color: red; font-size: 18px;">
				<?php echo $lerror; ?>
				</span></td>			
			</tr>
			<tr>
				<td>E-mail</td>
				<td><input type="email" name="email" required disabled value="<?php echo $email ?>"></td>
			</tr>

			<tr>
				<td>Password</td>
				<td><input type="password" name="password" required></td>
			</tr>

			<tr>
				<td>Confirm Password</td>
				<td><input type="password" name="confirmpassword" required></td>
			</tr>

			<tr>
				<td></td>
				<td><input type="submit" name="update" value="Update Password" class="button1"></td>
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