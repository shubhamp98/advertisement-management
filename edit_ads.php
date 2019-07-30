<?php 

session_start();
include 'database.php';

if(!isset($_SESSION['id'])){
header("location: user_login.php");
}


$postid = $_GET['postid'];

$editquery = "SELECT * FROM ads WHERE id='$postid'"; // getting ads data for respected id.
$runeditquery = $con->query($editquery);
$dataeditquery = mysqli_fetch_assoc($runeditquery);




$scaterror = '';
	$userid=$_SESSION['id'];
	$username=$_SESSION['firstname'].' '.$_SESSION['lastname'];
	$userbusiness=$_SESSION['businessname'];



if (isset($_POST['submitdata'])) {
	$adstype = $_POST['adstype'];
	$adstitle = $_POST['adstitle'];
	$adsdescription = $_POST['adsdescription'];
	$adslink = $_POST['adslink'];

	$finaladsfile = "";
	$filename = $_FILES['adsmedia']['name'];
	if ($filename!='') {
		$filename_arr = explode(".", $filename);
		$extension = end($filename_arr);
		$finaladsfile = time().".".$extension;
		move_uploaded_file($_FILES['adsmedia']['tmp_name'],"uploads/".$finaladsfile);
	}
	else{
		$finaladsfile = $_POST['oldmedia'];
	}

	$adsvoucher = $_POST['adsvoucher'];
	
	if (isset($_POST['selectcategories'])) {
		
	
	$selectcategories = count($_POST['selectcategories']); // used @ to hide count blank error.
	if($selectcategories>3 || $selectcategories<1){
	echo "<script>alert('Your ad post have some issues. Pls recheck any error appearing there. ');</script>";
	$scaterror = "Select upto 3 categories and also select image/video again(available on leftside).";

	}	
	else{
	$selectcategories = $_POST['selectcategories'];
	$selectcategories = implode(",", $selectcategories);
	
	$created_on = 	date("Y-m-d H:i:s");  // date() is a function that sets the current date and time automatically when the file is POSTting created use DATETIME datatype in mysql.

$insert = "UPDATE ads SET
ads_type = '$adstype',
ad_title = '$adstitle',
ad_description = '$adsdescription' ,
ad_image = '$finaladsfile' ,
ad_url = '$adslink' ,
category = '$selectcategories' ,
status = '0'
WHERE id = '$postid'";


 

$insertrun = $con->query($insert);



if($insertrun){
	echo "<script>alert('Your ad is successfully submitted. '); window.location='post_ads.php';</script>";

}
else{
	echo $con->error; // any errors will show with help of this line.
}
}
}
else{
	echo "<script>alert('Your ad post have some issues. Pls recheck any error appearing there. ');</script>";
	$scaterror = "Select atleast 1 category and also select image/video again(available on leftside).";
}
}



$query = "SELECT * FROM categories"; // query for showing categories.
$result = $con->query($query);





?>


<!DOCTYPE html>
<html>
<head>
	<title>Post Ads - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>
	<div align="right" style="margin: 2px; padding: 2px;" ><b><?php echo "Welcome ".$_SESSION['firstname'].' '.$_SESSION['lastname'].' '."(".$_SESSION['businessname'].")";  ?> <a class="usrad" href="user_ads.php">Your Ads</a>|<a class="usrad" href="user_logout.php">Logout</a></b></div>

<div class="ads_content">
	<form method="POST" enctype="multipart/form-data">
	<div class="ads_left">
		

		<div><h4>> TYPE</h4> </div>
		
		<div>You can select either image or video to be displayed on the website:</div>
		
		<div>
			
			<input type="radio" name="adstype" value="image" required <?php if($dataeditquery['ads_type']=='image'){ echo "checked"; }  ?> >IMAGE<br>
			<input type="radio" name="adstype" value="video" required <?php if($dataeditquery['ads_type']=='video'){ echo "checked"; }  ?> >VIDEO
		</div>
		

	<div>
		
		<div><h4> > DETAILS & UPLOAD</h4></div>
		
		<div>
			
			<table>
			<tr>
				<td>Ad Title</td>
				<td><input type="text" name="adstitle" size="22" required value="<?php 
				echo $dataeditquery['ad_title']; ?>" ></td>
			</tr>
			<tr>
				<td >Description</td>
				<td ><textarea name="adsdescription" required><?php echo $dataeditquery['ad_description']; ?></textarea></td>
			</tr>
			<tr>
				<td >Youtube/Vimeo Link</td>
				<td ><input type="url" name="adslink" size="22" value="<?php echo $dataeditquery['ad_url']; ?>" ></td>	
			</tr>
			<tr>
				<td >Video/Image</td>
				<td ><input type="file" name="adsmedia" ><input type="hidden" name="oldmedia" value="<?php echo $dataeditquery['ad_image']; ?>"></td>
			</tr>
			<tr>
				<td >Voucher</td>
				<td ><input type="text" size="22" name="adsvoucher" placeholder="(if you have one)" value="<?php echo $dataeditquery['voucher']; ?>" ></td>
			</tr>
			</table>
					
		</div>
		
	</div>

	<div class="ads_tnc">
		<p>Need Multiple ads? Make a new order.</p>
		<p>Need help? Email us at: <a href="mailto: shubhamp922@live.com">shubhamp922@live.com</a></p>
	</div>
	
	
	<div class="ads_tnc">
		<p>Are you a small business or a corporation? We offer monthly packages that will save your time and cut your costs.</p>
		<p>Interested? Email us at: <a href="mailto: shubhamp922@live.com">shubhamp922@live.com</a></p>
	</div>


	<div class="ads_tnc">
		Submission Criteria?
		<ul>
			<li><p>All must be of HIGH Quality and minimum 640 X 640 pixels.</p></li>
			<li><p>Maximum size per image is 1MB. (Mega Bytes)</p></li>
			<li><p>No explicit media content.</p></li>
			<li><p>Media not to be in order of Copyright.</p></li>
		</ul>
	</div>

</div>


<div class="ads_right">
		

		<div><h4> > CATEGORIES</h4></div>
		
		<div><p>Select upto 3 Categories in which will show your ads on SBM.</p></div>
		
		<span style=" background-color: yellow; color: red; font: 20px bold; ">
			<?php 
			 echo $scaterror; ?>
			 </span>
		
		<div>
		
			<table>
				<?php 
				if(mysqli_num_rows($result)>0){
				while ($rows = mysqli_fetch_assoc($result)) {
				?>
				<tr>
					<td>
						<?php $selectcategories_arr = explode(",", $dataeditquery['category']); //print_r($selectcategories_arr); ?>
						<input type="checkbox" name="selectcategories[]" value="<?php echo $rows['ctg_name'];?>" <?php if(in_array($rows['ctg_name'],$selectcategories_arr)){ echo "checked='checked'";} ?>  > 
					</td>
					<td><?php echo $rows['ctg_name']; ?></td>
				</tr>
				<?php
				}
				}
				?>
			
			<tr>
				<td colspan="2"><input type="submit" name="submitdata" value="SUBMIT" class="button"></td>
			</tr>

			</table>		
			</form>
		</div>
		
	</div>

</div>

	<?php
	include 'footer.php';
	?>

</div>

</body>
</html>