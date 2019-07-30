<?php

session_start();
include '../database.php';

$userid=$_SESSION['id'];
$userfname=$_SESSION['firstname'];
$userlname=$_SESSION['lastname'];


if(!isset($_SESSION['id'])){
header("location: admin_login.php");
}


$query = "SELECT * FROM ads WHERE status=1"; // query for showing categories.
$result = $con->query($query);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Active Ads - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>
	<div align="right" style="margin: 2px; padding: 2px;" ><b><?php echo "Welcome ".$_SESSION['firstname'].' '.$_SESSION['lastname'];  ?> <a class="usrad" href="admin_editprofile.php">Edit Profile</a>|<a class="usrad" href="admin_logout.php">Logout</a></b></div>

<div class="ads_content">
	
	


		<div  style="color: blue; font-size: 18px;" align="center"><h4> > LIST OF ACTIVE ADS</h4><a class="a1" href="admin_dashboard.php#forback">Go Back</a> </div>
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
					<td align="center"><?php echo "<a class='usrad' target='_blank' href='uploads/".$rows['ad_image']."' >Click Here</a>";	 ?></td>
					<td align="center"><?php echo "(".$rows['userid'].")".$rows['posted_by'].' / '.$rows['create_date']; ?></td>
					<td align="center"><?php if($rows['status']==0){ echo "Pending";} elseif ($rows['status']==1) { echo "Approved"; } else{ echo "Rejected"; } ?></td>
					<td><a class="usrad" href="action_ads.php?ruaapostid=<?php echo $rows['id']; ?>">Reject</a></td>
				</tr>

				<?php
					}

					else{ ?>
					<tr class="b">
					<td align="center" ><?php echo $rows['id']; ?></td>
					<td align="center"><?php echo $rows['ads_type']; ?></td>
					<td align="center"><?php echo $rows['ad_title']; ?></td>
					<td align="center"><?php echo $rows['ad_description']; ?></td>
					<td align="center"><?php echo "<a class='usrad' target='_blank' href='uploads/".$rows['ad_image']."' >Click Here</a>"; ?></td>
					<td align="center"><?php echo "(".$rows['userid'].")".$rows['posted_by'].' / '.$rows['create_date']; ?></td>
					<td align="center"><?php if($rows['status']==0){ echo "Pending";} elseif ($rows['status']==1) { echo "Approved"; } else{ echo "Rejected"; } ?> </td>
					<td><a class="usrad" href="action_ads.php?ruaapostid=<?php echo $rows['id']; ?>">Reject</a></td>
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

		<div align="center" style="margin: 20px; height: 100px;  color: blue;"><i>*List of active ad(s) sum up here!*</i></div>

		<div style="margin: 20px; //border: 2px solid black; width: 100%; height: auto;">To delete Advertisement <a href="user_ads.php">Click Here</a> and select the id and click delete.</div>
		

</div>

	<?php
	include 'footer.php';
	?>

</div>

</body>
</html>