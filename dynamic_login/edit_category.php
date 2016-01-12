<?php


if(!session_id())
session_start();
if (isset($_POST['btnUpdate'])) {

		$name = $_POST['txtCategoryName'];
		$id = $_POST['txtCategoryId'];
		$desc = $_POST['txtCategoryDesc'];
		$status = $_POST['rdoStatus'];
		$rank = $_POST['txtCategoryRank'];
		$image = $_FILES['txtCategoryImage']['name'];
		$a = $_SESSION['username'];
		$date = date('Y-m-d H:i:s');

		if (isset($_FILES['txtCategoryImage']['error']) &&  $_FILES['txtCategoryImage']['error'] == 0 ) {
			$imgname = $_FILES['txtCategoryImage']['name'];
			move_uploaded_file($_FILES['txtCategoryImage']['tmp_name'], 'images/'.$_FILES['txtCategoryImage']['name']);
			chmod('images/'.$_FILES['txtCategoryImage']['name'],'0777');
		}


		$conn = new mysqli('localhost', 'root', '', 'db_news_project');

		// checking for database connection error
		if ($conn->connect_errno == 0) {
				/*$sql = "INSERT INTO tbl_category (name,descrip,status,rank,image,created_by,created_date) VALUES
					('$name','$desc',$status,$rank,'$image','$a','$date')";
				*/

					if (isset($imgname)) {
						$sql = "UPDATE tbl_category SET image='$imgname',name='$name',descrip='$desc',rank=$rank,status=$status,modified_by='$a',modified_date='$date' where id=$id";

					} else {
						$sql = "UPDATE tbl_category SET name='$name',descrip='$desc',rank=$rank,status=$status,modified_by='$a',modified_date='$date' where id=$id";

					}
				

echo $sql;
				$conn->query($sql);

				if ($conn->affected_rows == 1) {
						echo "Data Updated";
						header('location:category.php?editmsg=1');
				} else {
					echo " Update Error";
				}

		} else {
			echo "database Connection error";
		}
			


}










if (isset($_GET['id'])) {

$id = $_GET['id'];
	$conn = new mysqli('localhost', 'root', '', 'db_news_project');

		// checking for database connection error
		if ($conn->connect_errno == 0) {
			$sql = "select * from tbl_category where id=$id";
			$res = $conn->query($sql);

			if ($res->num_rows > 0) {
						
				while($row = $res->fetch_assoc()){
					$category= $row;
				}

print_r($category);
			} 	

		} else {
			echo "database Connection error";
		}
}



?>



<form method="post" action="edit_category.php" enctype="multipart/form-data">
<input type="hidden" name="txtCategoryId" value="<?php echo  $category['id'] ?>" >
	
	<label>Category Name</label>

	<input type="text" name="txtCategoryName" value="<?php echo  $category['name'] ?>" >
	<br>

	<label>Category Description</label>

	<input type="text" name="txtCategoryDesc" value="<?php echo  $category['descrip'] ?>" >
<br>
	<label>Category Status</label>
	<?php if ($category['status'] == 1) { ?>

		<input type="radio" name="rdoStatus" value="1" checked=""> Active
		<input type="radio" name="rdoStatus" value="0"  > De active
	<?php } else { ?>
				<input type="radio" name="rdoStatus" value="1"> Active
				<input type="radio" name="rdoStatus" value="0" checked=""  > De active
	<?php 	} ?>

	
<br>
	<label>Category Rank</label>

	<input type="text" name="txtCategoryRank" value="<?php echo  $category['rank'] ?>" >
<br>
	<label>Category Image</label>


	<input type="file" name="txtCategoryImage" >

<br>
	<input type="submit" name="btnUpdate" value="Update Category">


</form>