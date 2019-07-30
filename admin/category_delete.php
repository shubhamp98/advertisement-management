<?php

include '../database.php';

$catid = $_GET['deletecat'];

$hdrqry = "DELETE FROM header_image WHERE category_id='$catid'"; // query to delete headerimage data first because here category id is foreign key.
$hdrimgresult = $con->query($hdrqry);

$query = "DELETE FROM categories WHERE id='$catid'"; // to delete category after deleting header image record of respected id.
$result = $con->query($query);

header("location: categories.php#forback");

?>