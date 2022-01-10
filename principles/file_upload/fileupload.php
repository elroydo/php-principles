<!DOCTYPE html>

<html lang="en">
	<head>
			<title>file-upload</title>
			<meta charset="utf-8" />
			<link rel="stylesheet" type="text/css" href="style.css">
		</head>
	<body>
	file-upload<br>
		<a href="/">Home</a>
		|
		<a href="/principles/">back</a>
		<br>
	<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"> 
		<input type="hidden" name="MAX_FILE_SIZE" value="100000"/> <!-- allocates the max size for the text file -->
		Click <b>Browse</b> to upload a file: <input name="fileupload" type="file"/><br> 

		<input type="submit" value="Upload File"/> <!-- submit text file -->
	</form>

	<?php
		if (!empty($_FILES['fileupload'])) { //checks if the fileupload input section is empty
			$target_path = "docs/"; //the variable is assigned to the docs/ file directory; where it's going to be saved
			$target_path = $target_path . basename( $_FILES['fileupload']['name']); //the filename of the original file is added to the target directory

			if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $target_path)) { //checks the path of the temporary files, and the final directory
				echo "The file ".  basename( $_FILES['fileupload']['name']). 
				" has been uploaded"; //outputs that the file has successfully been uploaded
			}else{
				echo "There was an error uploading the file, please try again!"; //if not, an error is displayed
			}
		}else {
			echo "Please <b>upload</b> a text file to continue."; //if no file is present in uploaded file, this is displayed
		}
	?>
</body>
</html>