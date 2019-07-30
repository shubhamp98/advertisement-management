<?php

session_start();
include '../database.php';

$userid=$_SESSION['id'];
$userfname=$_SESSION['firstname'];
$userlname=$_SESSION['lastname'];
$userpermission = $_SESSION['permission'];
$userstatus = $_SESSION['status'];


if(!isset($_SESSION['id']) || (!isset($userpermission)) || (!isset($userstatus))){
session_unset();
session_destroy();
header("location: admin_login.php");
}


$query = "SELECT * FROM user_activity";
$result = $con->query($query);


$query1 = "SELECT sno FROM user_activity";
$result1 = $con->query($query1);



?>

<!DOCTYPE html>
<html>
<head>
	<title>User Account Activity - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>
	<div align="right" style="margin: 2px; padding: 2px;" ><b><?php echo "Welcome ".$_SESSION['firstname'].' '.$_SESSION['lastname'];  ?> <a class="usrad" href="admin_editprofile.php">Edit Profile</a>|<a class="usrad" href="admin_logout.php">Logout</a></b></div>

<div class="ads_content">
	
	


		<div  style="color: blue; font-size: 18px;" align="center"><h4> > Pages visited by Users ( User's Account Activity )</h4><a class="a1" href="admin_dashboard.php#forbackvisitor">Go Back</a> </div>
		<div class="uadsview">
			<table  align="center" cellpadding="4" cellspacing="0">
				<tr style=" background-color: orange; color: white; font-size: 18px;">
					<th align="center" width="10%">S.No.</th>
					<th align="center" width="10%">Activity by/User Id</th>
					<th align="center" width="10%">IP Address</th>
					<th align="center" width="10%">Date and Time of Visit</th>
					<th align="center" width="10%">Page visited</th>
					<th align="center" width="10%">Referred from</th>
					
					
					
					

				</tr>
			<?php

			if (mysqli_num_rows($result)>0) {
				$test = 0;
				while ($rows = mysqli_fetch_array($result)) {
				
					if ($test%2==0) {
						
					
				
				?>

				<tr class="a">
					<td align="center" ><?php echo $rows['sno']; ?></td>
					<td align="center"><a href='user_list.php?user_id=<?php echo $rows['user_id']; ?>'><?php echo $rows['user_id']; ?></a></td>
					<td align="center"><?php echo $rows['ip_address']; ?></td>
					<td align="center"><?php echo $rows['date_time']; ?></td>
					<td align="center"><?php echo $rows['page']; ?></td>
					<td align="center"><?php echo $rows['referrer']; ?></td>
					
					

				</tr>


									
				<?php
					}

					else{ ?>

					<tr class="b">
					<td align="center" ><?php echo $rows['sno']; ?></td>
					<td align="center"><a href='user_list.php'><?php echo $rows['user_id']; ?></a></td>
					<td align="center"><?php echo $rows['ip_address']; ?></td>
					<td align="center"><?php echo $rows['date_time']; ?></td>
					<td align="center"><?php echo $rows['page']; ?></td>
					<td align="center"><?php echo $rows['referrer']; ?></td>
					
					
					

					
				</tr>

				<?php 
					} 
					
				$test++;
				
				}
			}
			else{

				echo "<tr class='a'><td colspan='8' align='center'>Uh ho! No Activity Found. Try again after some time.</td></tr>";
			}

			?>
		
			</table>
		</div>

		<div align="left" style="margin: 20px; height: auto;  color: blue;"><b><p>Click on user id to check about user.</p></b></div>


		<div align="center" style="margin: 20px; height: auto;  color: blue;"><i>*List of user's activity sum up here!*</i></div>
		


		<?php if ($userpermission==1){ ?>

		<div style="margin: 20px; //border: 2px solid black; height: 100px;"><p>To delete a record, select the id and click delete.<br>(Note: This action cannot be reversed nor there is any confirmation will show up before delete.)</p>
				<div style="margin-top: 20px;">
					<form action="delete_user_activity_record.php" >
				<select name="deleterecord">
					<option value="">select</option>
					<?php

					while ($row1 = mysqli_fetch_assoc($result1)) {
					?>
					<option value="<?php echo $row1['sno']; ?>"><?php echo $row1['sno']; ?></option>
					<?php
					}

					?>
					<input type="submit" name="deletesubmit" value="DELETE"> OR
					<a class="button" href="delete_user_activity_record_all.php">DELETE ALL</a>

				</select>
				</form>
				</div>
			
			</div>
			<?php
			}


			else{ ?>
				<div style="color: grey; font-size: 18px; height: 40px;">Delete Action is Disabled on your account.</div>
			<?php
			}
			?>

		

		

</div>

	<?php
	include 'footer.php';
	?>

</div>

</body>
</html>