<?php  
	       if(!session_id())
             session_start(); 
	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
		header('location:login.php?msg=2');
	}

	


	if (isset($_POST['btnSave'])) {

		$name = $_POST['txtCategoryName'];
		$desc = $_POST['txtCategoryDesc'];
		$status = $_POST['rdoStatus'];
		$rank = $_POST['txtCategoryRank'];
		$image = $_FILES['txtCategoryImage']['name'];
		$a = $_SESSION['username'];
		$date = date('Y-m-d H:i:s');
print_r($_FILES);
if (isset($_FILES['txtCategoryImage']['error']) &&  $_FILES['txtCategoryImage']['error'] == 0 ) {
	move_uploaded_file($_FILES['txtCategoryImage']['tmp_name'], 'images/'.$_FILES['txtCategoryImage']['name']);
	//chmod('images/'.$_FILES['txtCategoryImage']['name'],'0777');
	
}


		$conn = new mysqli('localhost', 'root', '', 'db_news_project');

		// checking for database connection error
		if ($conn->connect_errno == 0) {
				$sql = "INSERT INTO tbl_category (name,descrip,status,rank,image,created_by,created_date) VALUES
					('$name','$desc',$status,$rank,'$image','$a','$date')";
					

				$conn->query($sql);

				if ($conn->affected_rows == 1 && !empty($conn->insert_id)) {
						echo "Data inserted";
				} else {
					echo " insert error";
				}

		} else {
			echo "database Connection error";
		}
			


}

		$conn = new mysqli('localhost','root','','db_news_project');

		// checking for database connection error
		if ($conn->connect_errno == 0) {
				$sql = "Select * from tbl_category";
					

				$res = $conn->query($sql);

				if ($res->num_rows > 0) {
						
						while($row = $res->fetch_assoc()){
							$category[]= $row;

						}


				} else {
					echo " insert error";
				}

		} else {
			echo "database Connection error";
		}



?>


<style type="text/css">
	table,td,tr,th{
		border: 3px solid black;


	}
	
	table {
		width: 500px;
		height: 300px;
		border-radius: 10px;
	}

	th{
		color:red;
	}

	

	.odd{
		background-color: #996699;
	}

	.red{
		background-color: red;
	}

	.even{
		background-color: #999999;
	}

.green{
		background-color: green;
	}

</style>
Welcome  <?php echo ucwords($_SESSION['username']) ?>
<a href="logout.php">Logout</a>
<a href="category.php">Category</a>


<form method="post" action="category.php" enctype="multipart/form-data">

	<label>Category Name</label>

	<input type="text" name="txtCategoryName" >
	<br>

	<label>Category Description</label>

	<input type="text" name="txtCategoryDesc" >
<br>
	<label>Category Status</label>

	<input type="radio" name="rdoStatus" value="1"> Active
	<input type="radio" name="rdoStatus" value="0"  checked="" > De active
<br>
	<label>Category Rank</label>

	<input type="text" name="txtCategoryRank" >
<br>
	<label>Category Image</label>


	<input type="file" name="txtCategoryImage" >

<br>
	<input type="submit" name="btnSave" value="Save Category">


</form>

<?php 
if (isset($_GET['delmsg']) && $_GET['delmsg'] == 1) {
	echo "Category Deleted";
}

if (isset($_GET['editmsg']) && $_GET['editmsg'] == 1) {
	echo "Category Updated";
}



 ?>


<table border="2px">
	<thead>
		<tr>
				<th>Category Name</th>
				<th>Description</th>
				<th>Status</th>		
				<th>Rank</th>	
				<th>Image</th>	
				<th>Created</th>	
				<th>Action</th>	
		</tr>
	</thead>
	<tbody>
	<?php 
	    $i= 2;
		foreach ($category as $c) {

				if ($i%3 == 0) {
					$class = "even";
				} else if ($i%3 == 1) {
					$class = "red";
				}  else {
					$class = "odd";
				}
				$i++;
		 ?>
			<tr class="<?php echo $class ?>">
					<td><?php echo $c['name'] ?></td>
					<td><?php echo $c['descrip'] ?></td>
					<td><?php 
					if ($c['status'] == 1) {
						
						echo "<label class=green>Active</label>";
					} else {
					
						echo "<label class=red> De Active</label>";
					}



					//echo $c['status'] ?></td>
					<td><?php echo $c['rank'] ?></td>
					<td><img src="images/<?php echo $c['image']  ?>" height="50" width="50"> </td>
					<td><?php echo $c['created_date'] ?></td>
					<td> <a href="edit_category.php?id=<?php echo $c['id'] ?>" >Edit</a> / <a href="delete_category.php?id=<?php echo $c['id'] ?>" >Delete</a></td>
			</tr>
	<?php } ?>
	</tbody>

</table>