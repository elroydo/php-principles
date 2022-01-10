<!DOCTYPE html>

<html lang="en">
	<head>
		<title>db</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
		
		
	</head>
<body>
<?php
	$servername = "localhost"; //database server name/location
	$username = "root"; //username of the online mysql database
	$password = "usbw"; //password of the online mysql database
	$dbname = "mas"; // database to connect to

	//create connection
	//sql statement to connect to the database
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	//check connection
	//execute the $conn variable
	if($conn->connect_error){
		//if fail - display error message
		die("Connection failed: " . $conn->connect_error);
	}else{
		//or will state the connection made
		echo "Connected successfully";
	}
?>
</body>
</html>