<?php

include 'database.php';

$ad_id = $_REQUEST['ad-id']; // $_REQUEST can fetch data from GET and POST both.

$adsquery = "SELECT * FROM ads WHERE id='$ad_id'";
$runadsquery = $con->query($adsquery);
$adsdata_arr = mysqli_fetch_assoc($runadsquery);

$userid = $adsdata_arr['userid'];
$adown_qry = "SELECT * FROM users WHERE id='$userid'";
$run = $con->query($adown_qry);
$adsown_arr = mysqli_fetch_assoc($run);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Ads Details - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>
	
	<div class="main_content">
		<div align="center"><a class="a1" href="javascript:history.back()">Go Back</a> </div>
		<div style="color: blue; font-size: 20px; font-weight: bold;" align="left"><h> > Ads Details:</i> </h3></div>		
		<img width="50%" height="500px" src="uploads/<?php echo $adsdata_arr['ad_image']; ?>" >

	<div class="ads-det-right">
			<?php
			echo "<h3 style='color: blue;'><u>Ads Info:</u></h3><div style='line-height: 1.8;'>";
				echo "<b>Title:</b> ".$adsdata_arr['ad_title']."<br>";
				echo "<b>Description:</b> ".$adsdata_arr['ad_description']."<br>";
				echo "<b>Category:</b> ".$adsdata_arr['category']."<br>";
				echo "<b>Posted on:</b> ".$adsdata_arr['create_date']."</div>";

			echo "<h3 style='color: blue;'><u>Ad Owner Info:</u></h3><div style='line-height: 1.8;'>";
				echo "<b>Posted by:</b> ".$adsown_arr['fname'].' '.$adsown_arr['lname']."<br>";
				echo "<b>Mobile:</b> ".$adsown_arr['phone']."<br>";
				echo "<b>Email:</b> ".$adsown_arr['email']."<br>";								
				echo "<b>Business name:</b> ".$adsown_arr['business_name']."<br>";
				echo "<b>Business description:</b> ".$adsown_arr['business_description']."<br>";
				echo "<b>Business mobile:</b> ".$adsown_arr['business_phone']."<br>";
				echo "<b>Business email:</b> ".$adsown_arr['business_email']."<br>";
				echo "<b>Business website:</b> ".$adsown_arr['business_website']."<br></div>";
				

			?>		
		</div>




	</div>


		
	

	
	
	<?php
	include 'footer.php';
	?>

</div>

</body>
</html>