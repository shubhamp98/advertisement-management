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


$query = "SELECT * FROM ads ORDER BY create_date ASC"; // query for showing ads list.
$result = $con->query($query);


$query1 = "SELECT * FROM ads"; // query for getting ads list to delete ads.
$result1 = $con->query($query1);

?>


<!DOCTYPE html>
<html>
<head>
	<title>View All Ads - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>
	<div align="right" style="margin: 2px; padding: 2px;" ><b><?php echo "Welcome ".$_SESSION['firstname'].' '.$_SESSION['lastname'];  ?> <a class="usrad" href="admin_editprofile.php">Edit Profile</a>|<a class="usrad" href="admin_logout.php">Logout</a></b></div>

<div class="ads_content">
	
	


		<div  style="color: blue; font-size: 18px;" align="center"><h4> > LIST OF ALL SUBMITTED ADS</h4><a class="a1" href="admin_dashboard.php#forback">Go Back</a> </div>
		<div class="uadsview">
			<table  align="center" cellpadding="4" cellspacing="0">
				<tr style=" background-color: orange; color: white; font-size: 18px;">
					<th align="center" width="15%">Id</th>
					<th align="center" width="15%">Ad Type</th>
					<th align="center" width="15%">Title</th>
					<th align="center" width="15%">Description</th>
					<th align="center" width="15%">Media</th>					
					<th align="center" width="15%">(Id)Posted by / on</th>
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
					<td align="center"><?php echo $rows['ads_type']; ?></td>
					<td align="center"><?php echo $rows['ad_title']; ?></td>
					<td align="center"><?php echo $rows['ad_description']; ?></td>

					<td align="center"><?php echo "<a class='usrad' target='_blank' href='../uploads/".$rows['ad_image']."' >Click Here</a>";	 ?></td>

					<td align="center"><?php echo "(".$rows['userid'].")".$rows['posted_by'].' / '.$rows['create_date']; ?></td>

					<td align="center"><?php if($rows['status']==0){ echo "Pending";} elseif ($rows['status']==1) { echo "Approved"; } else{ echo "Rejected"; } ?></td>

					<td>
						<?php 
						if($rows['status']==0){ ?> <a class="usrad" href="action_ads.php?approvepostid=<?php echo $rows['id']; ?>">Approve</a>|<a class="usrad" href="action_ads.php?rejectpostid=<?php echo $rows['id']; ?>">Reject</a><?php } 
					
						else if ($rows['status']==1) { ?> <a class="usrad" href="action_ads.php?rejectpostid=<?php echo $rows['id']; ?>">Reject</a>
						<?php }

						 else{ ?> <a class="usrad" href="action_ads.php?approvepostid=<?php echo $rows['id']; ?>">Approve</a> 
						 <?php } ?>
					</td>
				</tr>

				<?php
					}

					else{ ?>
					<tr class="b">
					<td align="center" ><?php echo $rows['id']; ?></td>
					<td align="center"><?php echo $rows['ads_type']; ?></td>
					<td align="center"><?php echo $rows['ad_title']; ?></td>
					<td align="center"><?php echo $rows['ad_description']; ?></td>
					<td align="center"><?php echo "<a class='usrad' target='_blank' href='../uploads/".$rows['ad_image']."' >Click Here</a>"; ?></td>

					<td align="center"><?php echo "(".$rows['userid'].")".$rows['posted_by'].' / '.$rows['create_date']; ?></td>

					<td align="center"><?php if($rows['status']==0){ echo "Pending";} elseif ($rows['status']==1) { echo "Approved"; } else{ echo "Rejected"; } ?> </td>

					<td>
						<?php 
						if($rows['status']==0){ ?> <a class="usrad" href="action_ads.php?approvepostid=<?php echo $rows['id']; ?>">Approve</a>|<a class="usrad" href="action_ads.php?rejectpostid=<?php echo $rows['id']; ?>">Reject</a><?php } 
					
						else if ($rows['status']==1) { ?> <a class="usrad" href="action_ads.php?rejectpostid=<?php echo $rows['id']; ?>">Reject</a>
						<?php }

						 else{ ?> <a class="usrad" href="action_ads.php?approvepostid=<?php echo $rows['id']; ?>">Approve</a> 
						 <?php } ?>
					</td>

				</tr>

				<?php 
					} 
					
				$test++;
				
				}
			}
			else{

				echo "<tr class='a'><td colspan='8' align='center'>Uh ho! Users didn't have posted any Ad(s) yet.</td></tr>";
			}

			?>
		
			</table>
		</div>

		<div align="center" style="margin: 20px; height: auto;  color: blue;"><i>*List of ad(s) submitted sum up here!*</i></div>
		


		<?php if ($userpermission==1){ ?>

		<div style="margin: 20px; //border: 2px solid black; height: 100px;">To delete Advertisement, select the id and click delete.<br>(Note: This action cannot be reversed nor there is any confirmation will show up before delete.)
				<div style="margin-top: 20px;">
					<form action="ads_delete.php" >
				<select name="deletead">
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