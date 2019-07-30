<?php

include '../database.php';

$catid = $_GET['catid'];

$query = "SELECT image FROM header_image WHERE category_id='$catid'";
$result = $con->query($query);
$row = mysqli_fetch_assoc($result);
//print_r($row);

echo "<img src='../headerimages/".$row['image']."' height='400px' width='400px'>";

?>