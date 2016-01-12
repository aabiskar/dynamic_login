<?php
		$country = array ('Nepal','India','Maldives','Bhutan','Srilanka','Bangladesh','Afganistan');
		$month = array ('January','February','March','April','May','June','July','August','September','October','November','December');


		if(isset($_POST['signup']))
		{
				$firstname = $_POST['fname'];
	            $lastname = $_POST['lname'];
	            $email = $_POST['email'];
	            $phone = $_POST['phone'];
	            $address = $_POST['address'];
	            $dob_d= $_POST['day'];
	            $dob_m= $_POST['month'];
	            $dob_y= $_POST['year'];
	            
	            $username = $_POST['username'];
	            $password = $_POST['password'];

	            if (empty($username) && empty ($password) && empty ($firstname) && empty ($lastname) && empty ($email) && empty ($phone) && empty ($address) )
	            {
					echo "<h1>Every elements are required</h1>";
				}

				else
				{
					//connect to the database
		            $conn = new mysqli('localhost','root','','db_news_project');
		            print_r($conn);

		            //checking for database connection error
		            if($conn->connect_errno==0)
		            {
		            	$sql = "INSERT INTO registration(fname,lname,email,phone,address,username,password)
		            	       VALUES ('$firstname','$lastname','$email',$phone,'$address','$username','$password')";
		            }
		            else
		            {
		            	echo "Error in connection";
		            }

		            //$result = $conn->query($sql);
		            if ($conn->query($sql) === TRUE)
		            {
    					echo "New record created successfully";
    				}
						else
                    {
    						echo "Error: " . $sql . "<br>" . $conn->error;
    				}
                 }

	
				}

	            
		

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration Page</title>
	
</head>
<body>
  <center>
	<form action="registration.php" method="post">
		<p>
		<label for="fname">First Name
		<input type="text" name="fname" id="fname" required>
		</label>
		</p>
		
		<p>
		<label for="lname">Last Name</label>
		<input type="text" name="lname" id="lname">
		</p>

		<p>
		<label for="email">Email Address</label>
		<input type="email" name="email" id="email">
		</p>

		<p>
		<label for="phone">Phone Number</label>
		<input type="number" name="phone" id="phone">
		</p>

		<p>
		<label for="address">Address
		<input type="text" name="address" id="address" >
		</label>
		</p>
	

		<p>
		<label for="country">Country</label>
		<select>
	           <?php foreach ($country as $c) { ?>
			   <option> <?php echo $c ?></option>
		       <?php }  ?>
		</select>
		</p>

		<p>
		<label>Date of Birth:</label>
		<select name="day"> 
            <option>Day</option>
        		<?php for($i=1;$i<30;$i++){ ?>
            			<option value="<?php echo $i;?>"><?php echo $i;?> </option>
            <?php } ?>
        </select>

        <select name="month">
        	<?php foreach ($month as $m) { ?>
            <option> <?php echo $m ?></option>
         	<?php } ?>
        </select>

        <select name="year">
        	<option>year</option>
        	
            <?php
            $date = date('Y');
            echo $date;
            	for($i= ($date -50);$i<= $date;$i++){
			?>
            <option><?php echo $i;?></option>
            <?php } ?>


        </select>
        </p>

		<p>
			<label for="gender">Gender</label>
			<input type="radio" name = "gender" value = 1 checked='checked'> Male
			<input type="radio" name = "gender" value = 0> Female
		</p>

		<p>
			<label for="username">Username</label>
			<input type="text" name = "username" id="username">
		</p>

		<p>
			<label for="password">Password</label>
			<input type="password" name = "password" id='password'>
		</p>

		<p><label>Remember me</label><input type="checkbox" name="chkRemember"> </p>

		<input type="submit" value = 'signup' name='signup'>

		<p>Click <a href="login.php">here</a> to get back to login page</p>




    </form>
</body>
</center>
</html>