<!DOCTYPE html>

<html lang="en">
    <?php
        require_once('db.php'); //connect to the database
        
        session_start(); //starts a session
        
        if (isset($_SESSION['user_login']) AND isset($_SESSION['login_time']) AND isset($_SESSION['gmtime'])) { //checks if the session variables user_login,  login_time, and gmtime is set
            echo "<h3>" . $_SESSION['user_login'] . " you are already logged in.</h3>";
            header('Refresh:3; account.php');
        }
        
        $file = "errorlog/error_log.txt";//store the location of the external text file
        $fp = fopen($file, "a+");//opens the external text file for changes
        $machine = gmdate('d/m/Y#h:i:sa') . "#" . "LOGINPAGE" . "#" . $_SERVER['REMOTE_ADDR'] . "#";//store the structure and various data in the $machine variable
        $stats = fopen("counter/login.txt","r"); //opens counter/visits.txt to read the number of hits
        $count = fgets($stats); //gets the content from the stats variable
        $count++; //increments the value of count
        $stats = fopen("counter/login.txt","w"); //opens countlog.txt to change new hit number
        
        fwrite($stats, $count); //writes to the external text file
        fclose($stats); //closes the external text file
    ?>
	<head>
		<title>Login</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
        <br>
        <b>Login</b>
		<br>
        <!-- enctype="multipart/form-data" is important for code to function correctly -->
	    <!-- action refers to the PHP -->
	    <!-- sends info to server via POST -->
		<form name="login" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <br>
			<input type= "text" placeholder="Username" name= "username"> <!--input-->
			<input type= "password" placeholder="Password" name= "password"> <!--input-->
			<input type="submit" value="Login" /> <!--submit button for the inputs-->
			<br>
		</form>
		<?php
            $lqs = "SELECT ref_no, fname, sname, username, password FROM user"; //selects the necessary data from the database
            $tluser = $conn->query($lqs); //store found queries in the variable
        
            //checks if the input fields are not empty, if not, code is executed
			if ((!empty($_POST['username']) AND ($_POST['password']))) { 
                $username = $_POST['username']; //store the input
                $password = $_POST['password']; //store the input
                $SQL = "SELECT * FROM user WHERE username='$username' and password='$password'"; //selects the necessary data from the database
                $result = $conn->query($SQL); //store found queries in the variable
                //validates the input
				if (filter_var($_POST['username'], FILTER_VALIDATE_EMAIL) AND preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%].{8,12}$/', $_POST['password'])) {
                    if ($result->num_rows>0) { //if match found, login
                        echo "Welcome.<br>Please wait..."; //output this
                        $_SESSION['user_login'] = $username; //store username input in the session variable
                        $_SESSION['login_time'] = time(); //stores the login time of the user in the session variable
                        $_SESSION['gmtime'] = gmdate('H:i:s'); //stores the gmdate in the session variable
                        header('Refresh:3; account.php'); //navigate to the account page
                    }else{
                        echo "Username or password is incorrect"."<br>"; //output this
                        fwrite($fp, $machine . "Username or password is incorrect" . "\n"); //write the error to the external text file
                    }
				}else{
					echo "Username or password is incorrect"."<br>"; //output this
                    fwrite($fp, $machine . "Username or password is incorrect" . "\n"); //write the error to the external text file 
				}
			}else{
				echo "<b>Login</b> text fields are empty"; //output this
			}
		?>
        <br><br>
		<a href="registration.php "name="register">Register</a> <!--link-->
        <a href="stats.php "name="statistics">Statistics</a> <!--link-->
        <br>
        <?php
            if($tluser->num_rows > 0){ //
                //output data of each row
                while($row = $tluser->fetch_assoc()){
                    echo "<br>#############################";
                    //echo "<br> Ref no: " . $row["ref_no"];
                    //echo "<br> Name: " . $row["fname"];
                    //echo "<br> Surname: " . $row["sname"];
                    echo "<br>user: " . $row["username"];
                    echo "<br>pass: " . $row["password"];
                }
            }else{
                echo "No database records display";
                fwrite($fp, $machine . "No database records display" . "\n"); //write the error to the external text file
            }
            $conn->close(); //closes the connection to the database
            fclose($fp); //closes the external text file
        ?>
	</body>
</html>