<?php
session_start();
include '../database.php';

$lerror = "";

if(isset($_POST['login']))
{
$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
//print($query);
$result = $con->query($query);




if(mysqli_num_rows($result)>0){
	$data = mysqli_fetch_assoc($result);
	//print_r($data);
	if (($data['status'])==1) {
		
	
	$_SESSION['id'] = $data['id'];
	$_SESSION['firstname'] = $data['fname'];
	$_SESSION['lastname'] = $data['lname'];
	$_SESSION['permission'] = $data['permission'];
	$_SESSION['status'] = $data['status'];
	

	header("location: admin_dashboard.php");
}
else{
	header("location: unauthorise.php");

}
}


else
{
	
	$lerror = "Invalid user or No such user account.	";
}


}

?>





<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="../main.css">
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
				<th><h3> > ADMIN LOG IN</h3></th>
			</tr>
			<tr>
				<td colspan="2"><span style="color: red; font-size: 18px;">
				<?php echo $lerror; ?>
				</span></td>			
			</tr>
			<tr>
				<td>E-mail</td>
				<td><input type="email" name="email" required></td>
			</tr>

			<tr>
				<td>Password</td>
				<td><input type="password" name="password" required></td>
			</tr>

			<tr>
				<td></td>
				<td><input type="submit" name="login" value="LOG IN" class="button"></td>
			</tr>

			<tr>
				<td></td>
				<td><a class="a1" href="admin_resetpassword.php">Forgot Password?</a></td>
			</tr>
			
			<tr>
				<td></td>
				<td><a class="a1" href="admin_registeration.php">Register New Account</a></td>
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