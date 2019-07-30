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


$query = "SELECT * FROM categories";
$result = $con->query($query);


$query1 = "SELECT id FROM categories";
$result1 = $con->query($query1);



?>

<!DOCTYPE html>
<html>
<head>
	<title>Categories - Ad Management</title>
	<link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>

<div class="container">

	<?php
	include 'header.php';
	?>
	<div align="right" style="margin: 2px; padding: 2px;" ><b><?php echo "Welcome ".$_SESSION['firstname'].' '.$_SESSION['lastname'];  ?> <a class="usrad" href="admin_editprofile.php">Edit Profile</a>|<a class="usrad" href="admin_logout.php">Logout</a></b></div>

<div class="ads_content">
	
	


		<div  style="color: blue; font-size: 18px;" align="center"><h4> > LIST OF ADS CATEGORIES</h4><a class="a1" href="admin_dashboard.php#forbackcategories">Go Back</a> </div>
		<div class="uadsview">
			<table  align="center" cellpadding="4" cellspacing="0">
				<tr style=" background-color: orange; color: white; font-size: 18px;">
					<th align="center" width="10%">Id</th>
					<th align="center" width="10%">Category Name</th>
					<th align="center" width="10%">Orders</th>
					<th align="center" width="10%">Status</th>
					<th align="center" width="5%">Header Image</th>

					

				</tr>
			<?php

			if (mysqli_num_rows($result)>0) {
				$test = 0;
				while ($rows = mysqli_fetch_array($result)) {
				
					if ($test%2==0) {
						
					
				
				?>

				<tr class="a">
					<td align="center" ><?php echo $rows['id']; ?></td>
					<td align="center"><?php echo $rows['ctg_name']; ?></td>
					<td align="center"><?php echo $rows['orders']; ?></td>
					<td align="center"><?php echo $rows['status']; ?></td>


					<td align="center"><?php echo "<a class='usrad' target='_blank' href='showheader_image.php?catid=".$rows['id']."' >Click Here</a>";	 ?></td>

					
				<?php
					}

					else{ ?>
					<tr class="b">
					<td align="center" ><?php echo $rows['id']; ?></td>
					<td align="center"><?php echo $rows['ctg_name']; ?></td>
					<td align="center"><?php echo $rows['orders']; ?></td>
					<td align="center"><?php echo $rows['status']; ?></td>


					<td align="center"><?php echo "<a class='usrad' target='_blank' href='showheader_image.php?catid=".$rows['id']."' >Click Here</a>";	 ?></td>

					
				</tr>

				<?php 
					} 
					
				$test++;
				
				}
			}
			else{

				echo "<tr class='a'><td colspan='8' align='center'>Uh ho! No Categories Found.</td></tr>";
			}

			?>
		
			</table>
		</div>

		<div align="center" style="margin: 20px; height: auto;  color: blue;"><i>*List of ad(s) categories sum up here!*</i></div>
		


		<?php if ($userpermission==1){ ?>

		<div id="forback" style="margin: 20px; //border: 2px solid black; "><p>To Add Category<a class href="add_category.php">Click Here</a></p></div>

		<div  style="margin: 20px; //border: 2px solid black; "><p>*To Edit Category, You need to delete that particular category first and then create new category with the respective name.</p></div>

		<div style="margin: 20px; //border: 2px solid black; height: 100px;"><p>To delete Category, select the id and click delete.<br>(Note: This action cannot be reversed nor there is any confirmation will show up before delete.)</p>
				<div style="margin-top: 20px;">
					<form action="category_delete.php" >
				<select name="deletecat">
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