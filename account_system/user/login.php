<!DOCTYPE html>

<html lang="en">
	<head>
		<title>login</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
		
		
	</head>
	<body>
	<form name="register" 
		method="post" 
		action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<b>login</b><br><br>
		username:
		<input type="text" name="username"/><br><br>
		password:
		<input type="text" name="password"/><br><br>
		<input type="submit" value="login"/>
	</form>	

	<?php
		//validate registration form 
		if( (empty($_POST['username']))AND(empty($_POST['password'])) ){
			//if the values are empty
			//do the same for both text fields
			echo "<br> Please enter your details";
		}else{
			//if the inputs have values, store the data into local variables
			echo "<br> Process Validation";
			
			$Fname = $_POST['name'];
			$Sname = $_POST['sname'];
			$USERname = $_POST['username'];
			$PASSword = $_POST['password'];
			
			//if first name has any special characters
			//if sname has numerical char
			//if sname char < 2
			//if username is email format
			//all the password validations
			//if the check variable validation is true then begin storing data in the database
			
			
			echo "<br>ready to store database"; 
			require_once('db.php'); //connect to the database
			
			$SQL = "SELECT * FROM user WHERE username='$USERname' and password='$PASSword'";
			$result = $conn->query($SQL);
			
			if($result->num_rows>0){
				echo "<br>Login successful<br>";
			}else{
				echo "<br>username or password incorrect<br>";
			}
			$conn->close();
		}
		
	?>
	</body>
</html>