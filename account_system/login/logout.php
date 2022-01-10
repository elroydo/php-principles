<!DOCTYPE html>

<html lang="en">
    <?php
        session_start();
        session_destroy();

        //opens counter/visits.txt to read the number of hits
        $stats = fopen("counter/logout.txt","r"); //gets the content from the stats variable
        $count = fgets($stats); //increments the value of count
        $count++; //opens countlog.txt to change new hit number
        // opens countlog.txt to change new hit number
        $stats = fopen("counter/logout.txt","w");
        fwrite($stats, $count); //writes to the external text file
        fclose($stats); //closes the external text file
    ?>
	<head>
		<title>Logout</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<b>End of session.</b>
		<br>
		<?php
			echo "Going home..."; //output this
			header('Refresh:5; login.php'); //navigates to the login page
		?>
		<br>
		<a href="login.php"name="urlloc" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">Home</a> <!--link-->
	</body>
</html>