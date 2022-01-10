<!DOCTYPE html>

<html lang="en">
	<head>
		<title>register</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
	<form name="register" 
		method="post" 
		action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<b> Register Account</b><br><br>
		first name:
		<input type="text" name="name"/><br><br>
		surname: 
		<input type="text" name="sname"/><br><br>
		username:
		<input type="text" name="username"/><br><br>
		password:
		<input type="text" name="password"/><br><br>
		<input type="submit" value="register"/>
	</form>	

	<?php
		//validate registration form 
		if( (empty($_POST['name']))AND(empty($_POST['sname'])) ){
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
			
			$SQL = "SELECT * FROM user WHERE fname like '$Fname'";
			$result = $conn->query($SQL);
			
			if($result->num_rows>0){
				echo "This account already exists";
			}else{
				//sql statement to store data
				$sql = "insert into user(fname, sname, username, password) 
				values ('$Fname', '$Sname', '$USERname', '$PASSword')";
				
				//only fname and sname will work 
				
				//run the query
				if($conn->query($sql)=== true){
					echo "<br> record added successfully";
				}
			}
		}
		$conn->close();
	?>
	</body>
</html>