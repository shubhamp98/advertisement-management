<?php
 
 include '../database.php';

 $id = $_GET['deleteadmin'];

 $delete = "DELETE FROM admin WHERE id = '$id'";
 $result = $con->query($delete);
 header("location: admin_list.php");
 


?>