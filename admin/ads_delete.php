<?php
 
 include '../database.php';

 $postid = $_GET['deletead'];

 $delete = "DELETE FROM ads WHERE id = '$postid'";
 $result = $con->query($delete);
 header("location: user_ads.php");
 


?>