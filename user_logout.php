<?php

session_start(); //session starts here.
unset($_SESSION['id']); //unset is a function to exit or unset the session variables
unset($_SESSION['firstname']);
unset($_SESSION['lastname']);
unset($_SESSION['businessname']);

session_destroy(); // session destroy here.
header("location: user_login.php");


?>