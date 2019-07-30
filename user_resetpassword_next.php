


<!DOCTYPE html>
<html>
<head>
	<title>Reset Password - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

<div class="container" >

	<?php
	include 'header.php';
	?>
	
	<div  class="loginarea" align="center">
		
		
	
		<table>
			<tr>
				<th><h3> > RESET PASSWORD</h3></th>
			</tr>	

			<tr>
				<td><span style="color: red; font-size: 20px;">
				<?php echo "We have sucessfully sent a reset password link to your registered email id."; ?>
				</span></td>
			</tr>

			<tr>
				<td><span style="font-size: 18px;">
				<?php echo "Not received any email? Check spam folder or <a class='button1' href='javascript:history.back();'>TRY RESET PASSWORD AGAIN</a>"; ?>
				</span></td>			
			</tr>
		</table>
	</div>

	
	<?php
	include 'footer.php';
	?>

</div>

</body>
</html>