<?php

include 'database.php';

$lerror = "";

if(isset($_POST['resetpassword'])){

	$email = $_POST['email'];
	$mobile = $_POST['mobile'];

	$query = "SELECT * FROM users WHERE email='$email' AND phone='$mobile'";
	$result = $con->query($query);

	if(mysqli_num_rows($result)>0){
	//$dataarray = mysql_fetch_assoc($result);
		$unique_code = rand(10000,99999); //generating random 6Digit code using rand function. Here min is 10000 and max is 99999 for numbers.
		$update = "UPDATE users SET password_token='$unique_code' WHERE email='$email' AND phone='$mobile'"; //random 6Digit code updated to DB in specified record.
		$result = $con->query($update);

		if($result){  //if result success then it will run if condition.			
			$to = $email;
        	$subject = "Password reset for SBM - Ad Management account";         	
         	$message = "Hello,<br><br>You have requested for password reset of your SBM - Ad Management.";
         	$message .= "<h4>Here is your one time reset link:</h4> http://sbm.rlpcargologistics.in/user_updatepassword.php?email=".$email."&"."password_token=".$unique_code."<br><br>Thanks<br>Shubham<br>SBM-Ad Management<br><a href='http://sbm.rlpcargologistics.in/contact.php'>Contact</>";         
    	    $header = "From:shubham@rlpcargologistics.in \r\n";
         	$header .= "Cc:shubhamp922@live.com  \r\n";
         	$header .= "MIME-Version: 1.0\r\n";
         	$header .= "Content-type: text/html\r\n";         
         	$retval = mail ($to,$subject,$message,$header); // mail sending

         	$field = array( // sms gateway code start
    		"sender_id" => "FSTSMS",
    		"message" => "Hello! As per your request for password reset of your SBM - Ad Management account, We have sucessfully sent the email to your registered email id.Thanks Shubham SBM - Ad Management",
    		"language" => "english",
    		"route" => "p",
    		"numbers" => $mobile,
    		"flash" => "0",
    		"variables" => "{#AA#}|{#CC#}",
    		"variables_values" => "123456787|asdaswdx"
			);

			$curl = curl_init();
			curl_setopt_array($curl, array(
  			CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
  			CURLOPT_RETURNTRANSFER => true,
  			CURLOPT_ENCODING => "",
  			CURLOPT_MAXREDIRS => 10,
  			CURLOPT_TIMEOUT => 30,
  			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  			CURLOPT_CUSTOMREQUEST => "POST",
  			CURLOPT_POSTFIELDS => json_encode($field),
  			CURLOPT_HTTPHEADER => array(
    		"authorization: z9sr4no5RST7X6EeJpuK2UiHIMOPGkg0AY1b3FqZ8dDmaVhjlQbW8xfHpRIqm1rCnNcSaO9Q2A3uVosK",
    		"cache-control: no-cache",
    		"accept: */*",
    		"content-type: application/json"
  			),));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);

			if ($err) {
  				$lerror = "cURL Error #:" . $err;
			} 
			
         
         	if( $retval == true ) {
         		header("location: user_resetpassword_next.php");            
         	}
         	else {
            	$lerror = "Message sending failed";            
         	}
        }
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
	<link rel="stylesheet" type="text/css" href="main.css">
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