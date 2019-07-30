<?php

session_start();
include 'database.php';



$userid=$_SESSION['id'];
$userfname=$_SESSION['firstname'];
$userlname=$_SESSION['lastname'];
$userbusiness=$_SESSION['businessname'];

if(!isset($_SESSION['id']) || (!isset($userbusiness))){

header("location: user_login.php");
session_unset();
session_destroy();

}

// getting user's device details.
date_default_timezone_set('Asia/Kolkata');
 $ipaddress = $_SERVER['REMOTE_ADDR'];
 $page = "http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'];
 $referrer = $_SERVER['HTTP_REFERER']; //only upto 80 characters referrer url will save in Mysql
 $datetime = date('Y-m-d H:i:s');
 $useragent = $_SERVER['HTTP_USER_AGENT'];

// query for inserting user's details and page activity.
 $query = "INSERT INTO user_activity (ip_address,user_id,date_time,page,referrer,client_used) VALUES ('$ipaddress','$userid','$datetime','$page','$referrer','$useragent')";
 $runquery = $con->query($query);



$query = "SELECT * FROM ads WHERE userid='$userid' ORDER BY create_date DESC"; // query for showing ads list.
$result = $con->query($query);

?>


<!DOCTYPE html>
<html>
<head>
	<title>View Ads - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>
	<div align="right" style="margin: 2px; padding: 2px;" ><b><?php echo "Welcome ".$_SESSION['firstname'].' '.$_SESSION['lastname'].' '."(".$_SESSION['businessname'].")";  ?> <a class="usrad" href="user_edit.php?id=<?php echo $userid; ?>">Edit Profile</a>|<a class="usrad" href="post_ads.php">Post Ads</a>|<a class="usrad" href="user_logout.php">Logout</a></b></div>

<div class="ads_content">
	
	


		<div  style="color: blue; font-size: 18px;" align="center"><h4 >> YOUR POSTED ADS</h4> </div>
		<div class="uadsview">
			<table  align="center" cellpadding="4" cellspacing="0">
				<tr style=" background-color: orange; color: white; font-size: 18px;">
					<th align="center" width="15%">Id</th>
					<th align="center" width="15%">Ad Type</th>
					<th align="center" width="15%">Title</th>
					<th align="center" width="15%">Description</th>
					<th align="center" width="15%">Media</th>					
					<th align="center" width="15%">Posted on</th>
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
					<td align="center"><?php echo $rows['create_date']; ?></td>
					<td align="center"><?php if($rows['status']==0){ echo "Pending";} elseif ($rows['status']==1) { echo "Approved"; } else{ echo "Rejected"; } ?></td>
					<td><a class="usrad" href="edit_ads.php?postid=<?php echo $rows['id']; ?> " >Edit</a>|<a class="usrad" href="delete_ads.php?postid=<?php echo $rows['id']; ?>">Delete</a></td>
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
					<td align="center"><?php echo $rows['create_date']; ?></td>
					<td align="center"><?php if($rows['status']==0){ echo "Pending";} elseif ($rows['status']==1) { echo "Approved"; } else{ echo "Rejected"; } ?> </td>
					<td><a class="usrad" href="edit_ads.php?postid=<?php echo $rows['id']; ?>">Edit</a>|<a class="usrad" href="delete_ads.php?postid=<?php echo $rows['id']; ?>">Delete</a></td>
				</tr>

				<?php 
					} 
					
				$test++;
				
				}
			}
			else{

				echo "<tr class='a'><td colspan='8' align='center'>Uh ho! You didn't have posted any Ad(s) yet. To start your first ad, Just click the link 'Post Ads' available at top-right corner.</td></tr>";
			}

			?>
		
			</table>
		</div>

		<div align="center" style="margin: 20px; height: 200px;  color: blue;"><i>*Your posted ad(s) sum up here!*</i></div>
		

</div>

	<?php
	include 'footer.php';
	?>

</div>

</body>
</html>