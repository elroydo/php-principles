<!DOCTYPE html>

<html lang="en">
	<head>
		<title>display</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
		
		
	</head>
	<body>
	<?php
		require_once('db.php');
		
		$sql = "SELECT ref_no, fname, sname, username, password FROM user";
		$result = $conn->query($sql); //store found queries in the variable $result
		
		if($result->num_rows > 0){ //
			//output data of each row
			while($row = $result->fetch_assoc()){
				echo "<br> Ref no: " . $row["ref_no"];
				echo "<br> Name: " . $row["fname"];
				echo "<br> Surname: " . $row["sname"];
				echo "<br> Username: " . $row["username"];
				echo "<br> Password: " . $row["password"];
			}
		}else{
			echo "No record display";
		}
		
		$conn->close();
	?>
	</body>
</html>