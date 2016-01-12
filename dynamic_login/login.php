<?php

if(isset($_COOKIE['username']) && !empty($_COOKIE['username']))
{
	header('location:loginwelcome.php');
}

if(isset($_POST["btnlogin"]))
{
	$username = $_POST['txtEmail'];
	$password = $_POST['pwdPassword'];

	if (empty($username) && empty ($password))
	{
		echo "Please enter the username and password";
	}

	else if(empty($username))
	{
		echo "Please enter the username";
	}

	else if(empty($password))
	{
       echo "Please enter your password";
	}

	else
	{
		//connect to the database
		$conn = new mysqli('localhost','root','','db_news_project');

		//checking for database connection error
		if($conn->connect_errno==0)   //Successfully connected to the database
		{
		  $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
		  $sql = "SELECT * FROM registration WHERE username = '$username' AND password = '$password'";
		  
		}
		else
		{
			echo "Database connection error";
		}

		$result = $conn->query($sql);
		//print_r($result);

		if($result->num_rows == 1)
		{
				echo "Username and password found in the database";
				session_start();
		    	$_SESSION['username']=$username;
		    	$_SESSION['loggedin']=true;

		  		if(isset($_POST['chkRemember']))
		  		{
					$time = time() + 7*24*60*60;
					setcookie('username',$username, $time);
					setcookie('remember', true, $time);
		  		}

				header('location:loginwelcome.php');
	   }

		

		else
		{
			echo "Error,try again";
		}
	}

	/*
	else if($username=="manoj" && $password=="12345")
	{
		session_start();
		$_SESSION['username']=$username;
		$_SESSION['loggedin']=true;

		if(isset($_POST['chkRemember']))
		{
			$time = time() + 7*24*60*60;
			setcookie('username',$username, $time);
			setcookie('remember', true, $time);
		}

		header('location:loginwelcome.php');
	}

	else
	{
		echo "Error";
	}
	*/
  }

?>

<?php

	if (isset($_GET['msg']) && $_GET['msg']==2)
	{
		echo "Please login at first";
	}

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login Page</title>
</head>
<body>
	<form action="login.php" method = "post">
		
	<label for="abc"> Username </label>
    <input type="text" name = "txtEmail" id="abc">
    <label for="bcd"> Password </label>
    <input type="password" name = "pwdPassword" id="bcd">
    <input type="checkbox" value="remember" name="chkRemember">
    <label>Remember me for 1 week</label>

    <input type="submit"  name="btnlogin" value ='login'>
    
	</form>
	<p>Not a member yet click <a href="registration.php">here </a> for registration.</p>
	

</body>
</html>