<?php

session_start();
include '../database.php';

if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

$userid=$_SESSION['id'];
$userfname=$_SESSION['firstname'];
$userlname=$_SESSION['lastname'];
$userpermission=$_SESSION['permission'];
$userstatus=$_SESSION['status'];


if(!isset($_SESSION['id'])){
header("location: admin_login.php");
}


$query = "SELECT * FROM users"; // query for showing userlist.
$result = $con->query($query);

?>


<!DOCTYPE html>
<html>
<head>
	<title>User List - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>
	<div align="right" style="margin: 2px; padding: 2px;" ><b><?php echo "Welcome ".$_SESSION['firstname'].' '.$_SESSION['lastname'];  ?> <a class="usrad" href="admin_editprofile.php">Edit Profile</a>|<a class="usrad" href="admin_logout.php">Logout</a></b></div>
<div class="ads_content">
	
	


		<div  style="color: blue; font-size: 18px;" align="center"><h4 >> USERLIST</h4><a class="a1" href="admin_dashboard.php#forback">Go Back</a> </div>

		<div class="uadsview">
			<table  align="center" cellpadding="4" cellspacing="0">
				<tr style=" background-color: orange; color: white; font-size: 18px;">
					<th align="center" width="16%">User Id</th>
					<th align="center" width="15%">Name</th>
					<th align="center" width="15%">Email</th>
					<th align="center" width="15%">Phone</th>
					<th align="center" width="15%">Business Name</th>	
					<th align="center" width="15%">Ads Posted</th>					
										
					<th align="center" width="15%">Action</th>

				</tr>
			<?php

			if(isset($user_id)){

				$qry_specific = "SELECT * FROM users WHERE id='$user_id'"; // query for showing user details from User account activity.
				$result_specific = $con->query($qry_specific);

				if (mysqli_num_rows($result_specific)>0) {
				$test = 0;
				while ($rows = mysqli_fetch_array($result_specific)) {
				
					if ($test%2==0) {
						
					
				
				?>

				<tr class="a">
					<td align="center" ><?php echo $uid = $rows['id']; ?></td>
					<td align="center"><?php echo $rows['fname'].' '.$rows['lname']; ?></td>
					<td align="center"><?php echo $rows['email']; ?></td>
					<td align="center"><?php echo $rows['phone']; ?></td>					
					<td align="center"><?php echo $rows['business_name']; ?></td>
					<td align="center"><?php $adnos = "SELECT * FROM ads WHERE userid='$uid'"; $run= mysqli_query($con,$adnos); echo "<a class='a1' href='user_ads.php'>".$resrun = mysqli_num_rows($run)."</a>"; ?></td>
					<?php if ($userpermission==1) { ?>
						
					
					<td><a class="usrad" href="user_edit.php?id=<?php echo $rows['id']; ?> " >View/Edit</a>|<a class="usrad" href="user_delete.php?id=<?php echo $rows['id']; ?>">Delete</a></td>

					<?php }
					else{
					?>
					<td style="color: grey;">Disabled on your account.</td>
					<?php 
					}
					?> 


				</tr>

				<?php
					}

					else{ ?>
					<tr class="b">

						<td align="center" ><?php echo $uid = $rows['id']; ?></td>
					<td align="center"><?php echo $rows['fname'].' '.$rows['lname']; ?></td>
					<td align="center"><?php echo $rows['email']; ?></td>
					<td align="center"><?php echo $rows['phone']; ?></td>					
					<td align="center"><?php echo $rows['business_name']; ?></td>
					<td align="center"><?php $adnos = "SELECT * FROM ads WHERE userid='$uid'"; $run= mysqli_query($con,$adnos); echo "<a class='a1' href='user_ads.php'>".$resrun = mysqli_num_rows($run)."</a>"; ?></td>

					<?php if ($userpermission==1) { ?>
					
					<td><a class="usrad" href="user_edit.php?id=<?php echo $rows['id']; ?> " >View/Edit</a>|<a class="usrad" href="user_delete.php?id=<?php echo $rows['id']; ?>">Delete</a></td>

					<?php }
					else{
					?>
					<td style="color: grey;">Disabled on your account.</td>
					<?php 
					}
					?> 
					
				</tr>

				<?php 
					} 
					
				$test++;
				
				}
			}
			else{

				echo "<tr class='a'><td colspan='8' align='center'>Uh ho! No user found. (Tips: Increase your marketing and get attracted by users :) )</td></tr>";
			}

			}

				




				else{			// if user_id is not set then this condition will run.

			if (mysqli_num_rows($result)>0) {
				$test = 0;
				while ($rows = mysqli_fetch_array($result)) {
				
					if ($test%2==0) {
						
					
				
				?>

				<tr class="a">
					<td align="center" ><?php echo $uid = $rows['id']; ?></td>
					<td align="center"><?php echo $rows['fname'].' '.$rows['lname']; ?></td>
					<td align="center"><?php echo $rows['email']; ?></td>
					<td align="center"><?php echo $rows['phone']; ?></td>					
					<td align="center"><?php echo $rows['business_name']; ?></td>
					<td align="center"><?php $adnos = "SELECT * FROM ads WHERE userid='$uid'"; $run= mysqli_query($con,$adnos); echo "<a class='a1' href='user_ads.php'>".$resrun = mysqli_num_rows($run)."</a>"; ?></td>
					<?php if ($userpermission==1) { ?>
						
					
					<td><a class="usrad" href="user_edit.php?id=<?php echo $rows['id']; ?> " >View/Edit</a>|<a class="usrad" href="user_delete.php?id=<?php echo $rows['id']; ?>">Delete</a></td>

					<?php }
					else{
					?>
					<td style="color: grey;">Disabled on your account.</td>
					<?php 
					}
					?> 


				</tr>

				<?php
					}

					else{ ?>
					<tr class="b">

						<td align="center" ><?php echo $uid = $rows['id']; ?></td>
					<td align="center"><?php echo $rows['fname'].' '.$rows['lname']; ?></td>
					<td align="center"><?php echo $rows['email']; ?></td>
					<td align="center"><?php echo $rows['phone']; ?></td>					
					<td align="center"><?php echo $rows['business_name']; ?></td>
					<td align="center"><?php $adnos = "SELECT * FROM ads WHERE userid='$uid'"; $run= mysqli_query($con,$adnos); echo "<a class='a1' href='user_ads.php'>".$resrun = mysqli_num_rows($run)."</a>"; ?></td>

					<?php if ($userpermission==1) { ?>
					
					<td><a class="usrad" href="user_edit.php?id=<?php echo $rows['id']; ?> " >View/Edit</a>|<a class="usrad" href="user_delete.php?id=<?php echo $rows['id']; ?>">Delete</a></td>

					<?php }
					else{
					?>
					<td style="color: grey;">Disabled on your account.</td>
					<?php 
					}
					?> 
					
				</tr>

				<?php 
					} 
					
				$test++;
				
				}
			}
			else{

				echo "<tr class='a'><td colspan='8' align='center'>Uh ho! No user found. (Tips: Increase your marketing get attracted by users :) )</td></tr>";
			}

		}

			?>
		
			</table>
		</div>

		<div align="center" style="margin: 20px; height: 200px;  color: blue;"><i>*Userlist(s) sum up here!*</i></div>
		

</div>

	<?php
	include 'footer.php';
	?>

</div>

</body>
</html>