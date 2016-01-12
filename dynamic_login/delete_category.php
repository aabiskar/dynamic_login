<?php

if (isset($_GET['id'])) {

$id = $_GET['id'];
	$conn = new mysqli('localhost', 'root', '', 'db_news_project');

		// checking for database connection error
		if ($conn->connect_errno == 0) {
				$sql = "Delete from tbl_category where id=$id";
					

				$conn->query($sql);

				if ($conn->affected_rows == 1) {
						
						echo "record deleted";

						header('location:category.php?delmsg=1');

				} else {
					echo " delete error";
				}

		} else {
			echo "database Connection error";
		}
}



?>