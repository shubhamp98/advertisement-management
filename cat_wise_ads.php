<?php

include 'database.php';

$c_id = $_REQUEST['c_id']; // $_REQUEST can fetch data from GET and POST both.

$catquery = "SELECT ctg_name FROM categories WHERE id='$c_id'"; // getting category name using category id
$runcatquery = $con->query($catquery);
$catdata_arr = mysqli_fetch_assoc($runcatquery);
$catname = $catdata_arr['ctg_name'];

$adsrch_qry = "SELECT * FROM ads WHERE category LIKE '%$catname%'"; // wildcard search using Like.
$run = $con->query($adsrch_qry);


?>

<!DOCTYPE html>
<html>
<head>
	<title>Ads By Category - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>
	
	<div align="center" class="main_content">
		<div align="center"><a class="a1" style="font-size: 18px;" href="javascript:history.back()">Go Back</a> </div>
		<div style="color: blue; font-size: 20px; font-weight: bold;" align="left">> Ads by Category: <?php echo $catname; ?></div>
		<div align="left"><i>Info: Click on Ad/Image to check the details.</i></div>

			<?php

			if (mysqli_num_rows($run)>0) {
				while ($aresult = mysqli_fetch_assoc($run)) {
					echo "<a href='ads_details.php?ad-id=".$aresult['id']."'><img style='margin: 02px; padding: 02px;' width='22%' height='280px' src='uploads/".$aresult['ad_image']."' ></a>";
				}
			}
			else {
				echo "<div align='center' style='margin: 60px; padding: 80px; height: 120px; width: 60%; font-size: 20px; font-style: italic;'>Uh ho! No ads found for your selected category :( <br> Please try after few good sleeps :)</div>";
			}

			?>
		
	</div>	
	
	<?php
	include 'footer.php';
	?>

</div>

</body>
</html>