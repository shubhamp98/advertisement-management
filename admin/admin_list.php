<?php

session_start();
include '../database.php';

$userid=$_SESSION['id'];
$userfname=$_SESSION['firstname'];
$userlname=$_SESSION['lastname'];
$userpermission=$_SESSION['permission'];
$userstatus=$_SESSION['status'];


if(!isset($_SESSION['id'])){
header("location: admin_login.php");
}


$query = "SELECT * FROM admin"; // query for getting admin details.
$result = $con->query($query);


$query1 = "SELECT id FROM admin"; // query for getting admin id to enable delete function of admin.
$result1 = $con->query($query1);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Admin List - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>
	<div align="right" style="margin: 2px; padding: 2px;" ><b><?php echo "Welcome ".$_SESSION['firstname'].' '.$_SESSION['lastname'];  ?> <a class="usrad" href="admin_editprofile.php">Edit Profile</a>|<a class="usrad" href="admin_logout.php">Logout</a></b></div>
<div class="ads_content">
	
	


		<div  style="color: blue; font-size: 18px;" align="center"><h4 >> Admin List</h4><a class="a1" href="admin_dashboard.php#forback">Go Back</a> </div>

		<div class="uadsview">
			<table  align="center" cellpadding="4" cellspacing="0">
				<tr style=" background-color: orange; color: white; font-size: 18px;">
					<th align="center" width="15%">Id</th>
					<th align="center" width="15%">Name</th>
					<th align="center" width="15%">Email</th>
					<th align="center" width="15%">Phone</th>
					<th align="center" width="15%">Country</th>
					<th align="center" width="15%">Permission</th>	
					<th align="center" width="15%">Status</th>					
										
					<th align="center" width="15%">Action</th>

				</tr>
			<?php

			if (mysqli_num_rows($result)>0) {
				$test = 0;
				while ($rows = mysqli_fetch_array($result)) {
				
					if ($test%2==0) {
						
					
				
				?>

				<tr class="a">
					<td align="center" ><?php echo $rows['id']; ?></td>
					<td align="center"><?php echo $rows['fname'].' '.$rows['lname']; ?></td>
					<td align="center"><?php echo $rows['email']; ?></td>
					<td align="center"><?php echo $rows['phone']; ?></td>	
					<td align="center"><?php echo $rows['country']; ?></td>				
					<td align="center"><?php if($rows['permission']==0){ echo "Read only and Ads Action Access"; } else{ echo "Read, Modify, All";		} ?></td>
					<td align="center"><?php if($rows['status']==1){ echo "Active"; } else{ echo "Not Active";		} ?></td>

					<?php if (($userpermission==1) && ($userid!=$rows['id']) ) { ?>

					<td><a class="usrad" href="admin_action.php?enableid=<?php echo $rows['id']; ?> " >Enable</a>|<a class="usrad" href="admin_action.php?disableid=<?php echo $rows['id']; ?>">Disable</a></td>

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

						<td align="center" ><?php echo $rows['id']; ?></td>
					<td align="center"><?php echo $rows['fname'].' '.$rows['lname']; ?></td>
					<td align="center"><?php echo $rows['email']; ?></td>
					<td align="center"><?php echo $rows['phone']; ?></td>	
					<td align="center"><?php echo $rows['country']; ?></td>				
					<td align="center"><?php if($rows['permission']==0){ echo "Read Only and Ads Action Access"; } else{ echo "Read, Modify, All";		} ?></td>
					<td align="center"><?php if($rows['status']==1){ echo "Active"; } else{ echo "Not Active";		} ?></td>
					
					<?php if (($userpermission==1) && ($userid!=$rows['id']) ) { ?>

					<td><a class="usrad" href="admin_action.php?enableid=<?php echo $rows['id']; ?> " >Enable</a>|<a class="usrad" href="admin_action.php?disableid=<?php echo $rows['id']; ?>">Disable</a></td>

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

				echo "<tr class='a'><td colspan='8' align='center'>Uh ho! SBM didn't have any registered admin .</td></tr>";
			}

			?>
		
			</table>
		</div>

			<div align="center" style="margin: 20px; height: auto;  color: blue;"><i>*Admin List(s) sum up here!*</i></div>

			<?php if ($userpermission==1){ ?>

			<div style="margin: 20px; //border: 2px solid black; height: 120px;">To delete admin select the id and click delete.<br>(Note: This action cannot be reversed nor there is any confirmation will show up before delete.)
				<div style="margin-top: 20px;">
					<form action="admin_delete.php" >
				<select name="deleteadmin">
					<option value="">select</option>
					<?php

					while ($row1 = mysqli_fetch_assoc($result1)) {
					?>
					<option value="<?php echo $row1['id']; ?>"><?php echo $row1['id']; ?></option>
					<?php
					}

					?>
					<input type="submit" name="deletesubmit" value="DELETE">
				</select>
				</form>
				</div>

				<?php
			}
			else{ ?>
				<div style="color: grey;">Delete Action is Disabled on your account.</div>
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