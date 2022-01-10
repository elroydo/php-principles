<!DOCTYPE html>

<html lang="en">
    <?php
        session_start(); //starts the session
        
        $file = "errorlog/error_log.txt"; //store the location of the external text file
        $fp = fopen($file, "a+");//opens the external text file for changes
        $machine = gmdate('d/m/Y#h:i:sa') . "#" . "ACCOUNTPAGE" . "#" . $_SERVER['REMOTE_ADDR'] . "#";//store the structure and various data in the $machine variable
        $stats = fopen("counter/account.txt","r"); //opens counter/visits.txt to read the number of hits
        $count = fgets($stats); //gets the content from the stats variable
        $count++; //increments the value of count
        $stats = fopen("counter/account.txt","w"); // opens countlog.txt to change new hit number
    
        fwrite($stats, $count); //writes to the external text file
        fclose($stats); //closes the external text file
    ?>
	<head>
		<title>Account</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<b>Your account</b>
		<br>
		<?php
             if (isset($_SESSION['user_login']) AND isset($_SESSION['login_time']) AND isset($_SESSION['gmtime'])) { //checks if the session variables user_login,  login_time, and gmtime is set
                 
                require_once('db.php'); //connect to the database
                echo "<br>";
                
                $username = $_SESSION['user_login']; //stores the data from the session variable from the login page in the $username variable
                $login_time = $_SESSION['login_time']; 
                //sends the session as time variable//
                $logintime = $_SESSION['gmtime']; //time of login is stored in the session variable
                $expirytime = 60; //expiry time
                $userexpirytime = "00:00:60";
                $endusertime = strtotime($login_time) + strtotime($userexpirytime);
                
                $lqs = "SELECT * FROM user WHERE username = '$username'"; //selects the necessary data from the database
                $tluser = $conn->query($lqs); //store found queries in the variable
                $row = $tluser->fetch_assoc(); //stores the relevant data in the row array

                //outputs the relevant information
                echo "Ref no: " . $row["ref_no"];
                echo "<br> Name: " . $row["fname"];
                echo "<br> Surname: " . $row["sname"];
                echo "<br>Username: " . $row["username"];
                echo "<br>Password: " . $row["password"];
                
                echo "<br><br>Login user time = " . $logintime;
                echo "<br>Login time = " . $login_time;
                echo "<br>Current time = " . time();
                echo "<br>End time = " . $endusertime;
                echo "<br>Allocated time limit =  " . $expirytime . " seconds<br>";
                 
                //if the time expires or logout button is clicked, it logs the user out
                if(time() - $login_time >= $expirytime OR !empty($_POST)) {
                    echo "<br>Sesson timed out/ended; logging out...<br>"; //output this
                    header('Refresh:3; logout.php'); //navigate to the logout page
                }
            }else{
                echo "Unauthorised user.<br>";
                fwrite($fp, $machine . "Unauthorised user" . "\n"); //write the error to the external text file
                header('Refresh:3; logout.php');
            }
		?>
		<br>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<input name="logout" type="submit" value="logout"/> <!--logout button-->
		</form>
		<br>
	</body>
</html>