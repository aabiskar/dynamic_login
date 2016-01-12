<?php
	session_start();

	if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin']!=true)
	{
	
		header('location:login.php?msg=2');
	}
	?>

	

	<?php include ('category.php') ?>
