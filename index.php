<?php

include 'database.php';



$category = '';
$categoryid = '';
$rows='';
$searchresult ='';

$adsquery = "SELECT * FROM ads WHERE status=1 ORDER BY create_date DESC LIMIT 10";
$runadsquery = $con->query($adsquery);


if (isset($_GET['categories'])) {
	$category = $_GET['categories'];
	$query = "SELECT * FROM categories WHERE ctg_name='$category'"; // query for getting category id and displaying category image when respected category is selected.
	$result = $con->query($query);
	$idarray = mysqli_fetch_assoc($result);
	//print_r($idarray);
	$categoryid = $idarray['id'];

}






$query = "SELECT * FROM categories"; // query for showing category name.
$result = $con->query($query);

$limit = 6;
$count = 0;

?>


<!DOCTYPE html>
<html>
<head>
	<title>Home - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	
		
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>
	<!--- Ads media coding -->
	<div class="main_content" align="center">
		<div style="color: blue;" align="left"><h3> > RECENTLY POSTED ADS. <i>Info: Click on Ad/Image to check the details.</i> </h3></div>

		<?php

		if (mysqli_num_rows($runadsquery)>0) {
			while ($adsdata_arr = mysqli_fetch_assoc($runadsquery)) {
			
			
			
			echo "<a href='ads_details.php?ad-id=".$adsdata_arr['id']."' style='margin: 0; padding: 0;' class='mySlides'><img style='margin: 1px; border: 1px solid black;' height='420px' width='99%' src='uploads/".$adsdata_arr['ad_image']."'></a>";
			
			

		
			 }
		

				}
				else{
					echo "<span style='color: red;'><h4>No ads are available</h4></span>";
				}


		?>
	</div>
		
<script>
var slideIndex = 0;
carousel();

function carousel() {
     var i;
    var x = document.getElementsByClassName("mySlides");
     for (i = 0; i < x.length; i++) {
      x[i].style.display  = "none"; 
    }
    slideIndex++;
     if (slideIndex > x.length) {slideIndex = 1} 
     x[slideIndex-1].style.display = "block"; 
    setTimeout(carousel,  2000); // Change image every 2 seconds
}

</script>


		



	<div align="center" class="homecat">
		<table border="0" cellpadding="2" cellspacing="2" width="100%">
			<h3 align="left" id="category"> > CATEGORIES: <?php if(isset($_GET['categories'])){ echo $category; }  ?> </h3>
			<td colspan="6" class='homecategories' align='center'>
				<a class="a1" href="home.php#category" >SHOW ALL</a>
			</td>
			
			
				<?php
				if (mysqli_num_rows($result)>0) {
					
				
				while ($rows = mysqli_fetch_assoc($result)) {
				//$rows['ctg_name'] = $rows['ctg_name'];

				if($count < $limit){

					if($count==0){
					echo "<tr>";
					}

				echo "<td width='25%' class='homecategories' align='center'><a  class='a1' name='displaycategories' href='home.php?categories=".$rows['ctg_name']."#category'  >".$rows['ctg_name']."</a></td>";
				}
				else{
					$count = 0;
					echo "</tr><tr><td width='25%' class='homecategories' align='center'><a class='a1' href='home.php?categories=".$rows['ctg_name']."#category'>".$rows['ctg_name']."</a></td>";
				}
				
				$count++;
				}
				echo "</tr>";
				}
				else{
					echo "No Categories Found";
				}

				?>

							
			
		</table>		
	</div>

	<div>

		<div class="bottomsection" >
		<div class="r_added">
		<h3 style="display: inline;">>RECENTLY ADDED CATEGORIES<br></h3>
		<i>Info: Click on Ad/Image to check the details.</i>
	</div>
	
	
	<div class="search">
		<form method="get" action="#category">
		<input type="search" name="searchbox" placeholder="Input text here">
		<input type="submit" name="search" value="Search" >
		</form>
	</div>
	</div>

	<div align="center" style="margin-top: 10px; " >
		<?php

		if (isset($_GET['searchbox'])) {
			$searchq = $_GET['searchbox'];
			$query = "SELECT ctg_name FROM categories WHERE ctg_name LIKE '%$searchq%' "; // wildcard search
			$searchresult = $con->query($query);
			echo "<h3>Search Result For: $searchq</h3>";
			if (mysqli_num_rows($searchresult)>0) {

		
		while ($sresult = mysqli_fetch_assoc($searchresult)) {
			echo "<a class='a1' href='home.php?categories=".$sresult['ctg_name']."#category'>".$sresult['ctg_name']."</a><br><br><br><br>";
		}
	}
	else{
		echo "No search result found";
	}


}
		

		else if($category!=''){
		$headerquery = "SELECT * FROM header_image WHERE category_id='$categoryid'"; // query for fetching header image of categories.
		$sql = $con->query($headerquery);

		if(mysqli_num_rows($sql)>0){
				$headerimg = mysqli_fetch_assoc($sql);
				echo "<a href='cat_wise_ads.php?c_id=".$headerimg['category_id']."'><img id='catimage' style='margin: 2px; border: 1px solid black;' src='headerimages/".$headerimg['image']."' height='300px' width='50%'></a>";
		}	
		}
		else {		
			$hdrimgqry = "SELECT * FROM header_image ORDER BY id DESC LIMIT 4";
			$run = $con->query($hdrimgqry);

			if (mysqli_num_rows($run)>0) {
				while ($headerdata_arr = mysqli_fetch_assoc($run)) {	
					echo "<a href='cat_wise_ads.php?c_id=".$headerdata_arr['category_id']."'><img style='margin: 2px; border: 1px solid black;' height='280px' width='22%' src='headerimages/".$headerdata_arr['image']."'></a>";
				}
			}
		} 

	?>
	</div>
	</div>
	
	<?php
	include 'footer.php';
	?>

</div>

</body>
</html>