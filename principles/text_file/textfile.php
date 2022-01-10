<!DOCTYPE html>

<html lang="en">
	<head>
			<title>text-file</title>
			<meta charset="utf-8" />
			<link rel="stylesheet" type="text/css" href="style.css">
		</head>
	<body>
	text-file<br>
		<a href="/">Home</a>
		|
		<a href="/principles/">back</a>
		<br>
	
	<!-- enctype="multipart/form-data" is important for code to function correctly -->
	<!-- action refers to the PHP -->
	<!-- sends info to server via POST -->
	<form name="nameInput" enctype="multipart/form-data" 
	action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" 
	method="POST">
		<b>Input:</b> <br>
		<input type= "text" placeholder="forename" name= "foreName"> <!-- input forename -->
		<input type= "text" placeholder="surname" name= "surName"> <!-- input surname -->
		<input type="submit" value="Write" /> <!-- input submit -->
		<br>
	</form>
	
	<?php
	$file = "text/file.txt"; //the text file directory is assigned to the file variable
	$fp = fopen($file, "a+"); //the fp variable opens the text file through the '$file' variable for reading and writing 'a+'
	
	if ((!empty($_POST['foreName']) AND ($_POST['surName']))) { //checks if the forename and surname fields in the input section are not empty, if not, code is executed
		
		$inputText = "[" . $_POST['foreName'] . " " . $_POST['surName'] . "]" . "\n"; //the data entered in 'foreName' and 'surName' are stored in the inputText variable
		
		fwrite($fp, $inputText); //writes the input text to the text file
		
		echo "Details successfully entered"; //outputs this text
	}else{
		echo "<b>Forename</b> and <b>surname</b> text fields are empty"; //outputs this text
	}
	?>
	
	<br><br>

	<form name="nameReplacer" enctype="multipart/form-data" 
	action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" 
	method="POST">
		<b>Search:</b> <br>
		<input type= "text" placeholder="search forename" name= "foreSearch"> <!--forename search -->
		<input type= "text" placeholder="search surname" name= "surSearch"> <!--surname search -->
		<br>
		<b>Replace with:</b> <br>
		<input type= "text" placeholder="forename replacer" name= "foreNew"> <!--forename replacer -->
		<input type= "text" placeholder="surname replacer" name= "surNew"> <!--surname replacer -->
		<input type="submit" value="Replace" />
	</form>
	
	<?php
	//checks if the search and replacer forename and surname fields in the input section are not empty, if not, code is executed
	if ((!empty($_POST['foreSearch']) AND ($_POST['surSearch']) AND ($_POST['foreNew']) AND ($_POST['surNew']))) { 
		$searchText = "[" . $_POST['foreSearch'] . " " . $_POST['surSearch'] . "]"; //the data entered in 'foreSearch' and 'surSearch' are stored in the searchText variable
		$replacementText = "[" . $_POST['foreNew'] . " " . $_POST['surNew'] . "]"; //the data entered in 'foreNew' and 'surNew' are stored in the replacementText variable
		$assort = file($file); //the assort variable is declared as an array to store the contents of the text file

		//loop begins at the first data entry in the text file, i.e. '0' and increments till the last entry
		for($i=0;$i<count($assort);$i++) {
			//the searchText searches for matching data entries to replace with the replacementText data entered by the user
			$assort[$i] = str_ireplace($searchText, $replacementText, $assort[$i]);
		}
		file_put_contents($file, $assort); //replaces the matched data entry with the replacementText data
		echo "Details successfully replaced"; //outputs this text
	}else{
		echo "<b>Search</b> and <b>replacer</b> text fields are empty"; //outputs this text
	}

	echo "<br><br><b>File contents:</b><br>"; //outputs this text
	if (filesize($file) == 0) { //checks if the text file is empty
		echo "Empty."; //if empty, this text is output
	}else{
		echo nl2br(file_get_contents($file)); //if not, all the contents are output
	}
	fclose($fp); //the text file is closed
	?>
</body>
</html>