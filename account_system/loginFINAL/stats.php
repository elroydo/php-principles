<!DOCTYPE html>

<html lang="en">
    <?php
        $stats = fopen("counter/stats.txt","r"); //opens counter/visits.txt to read the number of hits
        $count = fgets($stats); //gets the content from the stats variable
        $count++; //increments the value of count
        $stats = fopen("counter/stats.txt","w"); //opens countlog.txt to change new hit number
        
        fwrite($stats, $count); //writes to the external text file 
        fclose($stats); //closes the external text file
    ?>
	<head>
		<title>Statistics</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
        <b>Statistics</b>
		<br><br>
		<?php
            $loginviews = fgets(fopen("counter/login.txt","r")); //get the data content from the external text file
            $registrationviews = fgets(fopen("counter/registration.txt","r")); //get the data content from the external text file
            $accountviews = fgets(fopen("counter/account.txt","r")); //get the data content from the external text file
            $logoutviews = fgets(fopen("counter/logout.txt","r")); //get the data content from the external text file
            $statsviews = fgets(fopen("counter/stats.txt","r")); //get the data content from the external text file
            $totalviews = $loginviews + $registrationviews + $accountviews + $logoutviews + $statsviews; //calculate the total views
            
            echo "Login page = " . $loginviews . " views"; //output this
            echo "<br>Registration page = " . $registrationviews . " views"; //output this
            echo "<br>Accounts page = " . $accountviews . " views"; //output this
            echo "<br>Logout page = " . $logoutviews . " views"; //output this
            echo "<br>Statistics page = " . $statsviews . " views"; //output this
            echo "<br>Total views = " . $totalviews . " views"; //output this
        ?>
        <br>
        <br>
        <a href="login.php "name="register">Home</a> <!--link-->
	</body>
</html>