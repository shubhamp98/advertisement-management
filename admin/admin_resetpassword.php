<?php

include '../database.php';

$lerror = "";

if(isset($_POST['resetpassword'])){

	$email = $_POST['email'];
	$mobile = $_POST['mobile'];

	$query = "SELECT * FROM admin WHERE email='$email' AND phone='$mobile'";
	$result = $con->query($query);

	if(mysqli_num_rows($result)>0){
	//$dataarray = mysql_fetch_assoc($result);
	header("location: admin_updatepassword.php?email=".$email);
	}

	else{	
	$lerror = "Invalid user or No such user account.	";
	}

}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Reset Password - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>

<div class="container" >

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
				<td colspan="2"><font size="2">Please enter your details, If details found valid your request will proceed.</font></td>
			</tr>
			<tr>
				<td colspan="2"><span style="color: red; font-size: 18px;">
				<?php echo $lerror; ?>
				</span></td>			
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="email" name="email" required></td>
			</tr>
			<tr>
				<td>Mobile</td>
				<td><input type="password" name="mobile" required></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="resetpassword" value="RESET PASSWORD" class="button1"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="button" name="cancelchanges" onclick="javascript:history.back();" class="button1" value="CANCEL"></td>

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