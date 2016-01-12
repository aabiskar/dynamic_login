<?php
	session_start();

	unset($_SESSION['username']); 
	unset($_SESSION['loggedin']);

	setcookie('username' , null , time()-1);
	setcookie('remember' , null , time()-1);

	session_destroy();

	header('location:login.php');


?>