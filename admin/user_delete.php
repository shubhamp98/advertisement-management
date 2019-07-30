<?php
 
 include '../database.php';

 $id = $_GET['id'];

 $delete = "DELETE FROM users WHERE id = '$id'";
 $result = $con->query($delete);
 header("location: user_list.php");
 


?>