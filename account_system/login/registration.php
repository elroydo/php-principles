<!DOCTYPE html>

<html lang="en">
    <?php
        require_once('db.php'); //connect to the database
        $file = "errorlog/error_log.txt";//store the location of the external text file
        $fp = fopen($file, "a+");//opens the external text file for changes
        $machine = gmdate('d/m/Y#h:i:sa') . "#" . "REGISTRATIONPAGE" . "#" . $_SERVER['REMOTE_ADDR'] . "#";//store the structure and various data in the $machine variable
        $stats = fopen("counter/registration.txt","r"); //opens counter/visits.txt to read the number of hits
        $count = fgets($stats); //gets the content from the stats variable
        $count++; //increments the value of count
        $stats = fopen("counter/registration.txt","w"); //opens countlog.txt to change new hit number
    
        fwrite($stats, $count); //writes to the external text file
        fclose($stats); //closes the external text file
    ?>
	<head>
		<title>Registration</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
    <body>
        <b>Register</b>
        <form name="nameInput" enctype="multipart/form-data" 
        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" 
        method="POST">
            <b>Input:</b> <br>
            <input type="text" placeholder="firstname" name="name"/><!--input-->
            <input type="text" placeholder="surname" name="sname"/><br><br><!--input-->
            <input type= "text" placeholder="username" name= "username"><!--input-->
            <input type= "password" placeholder="password" name= "password"><!--input-->
            <br><br>
            <input type="submit" value="Register" /> <!--submit button for the inputs-->
            <br>
        </form>
        <?php
            //checks if the input fields are not empty, if not, code is executed
            if ((!empty($_POST['name']) AND ($_POST['sname'])AND ($_POST['username'])AND ($_POST['password']))) { 
                $firstName = ucfirst($_POST['name']);//ucfirst changes the first letter of the string to an uppercase letter
                $surName = ucfirst($_POST['sname']); //ucfirst changes the first letter of the string to an uppercase letter
                $username = $_POST['username']; //store input in variable
                $password = $_POST['password']; //store input in variable
                //validates the input from the fistname, lastname, username, and password
                if (preg_match('/^(?=.*[A-Za-z]).{2,20}$/', $firstName) AND preg_match('/^(?=.*[A-Za-z]).{2,20}$/', $surName) AND filter_var($username, FILTER_VALIDATE_EMAIL) AND preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%].{8,12}$/', $password)) {
                    $SQL = "SELECT * FROM user WHERE username like '$username'"; //selects the necessary data from the database
                    $result = $conn->query($SQL); //store found queries in the variable
                    //if the data entered is the same as in the database, ouput error
                    if($result->num_rows>0){ 
                        echo "This account already exists"; //output this
                        fwrite($fp, $machine . "Account already exists" . "\n"); //write the error to the external text file
                    }else{
                        //sql statement to store data
                        $sql = "insert into user(fname, sname, username, password) 
                        values ('$firstName', '$surName', '$username', '$password')"; //enter the input data into the database
                        //run the query
                        //if entered successfully, output contents
                        if($conn->query($sql)=== true){
                            echo "Details successfully entered"; //output this
                        }else{
                            echo "Entry of detials unsuccessful"; //output this
                            fwrite($fp, $machine . "Entry of detials was unsuccessful" . "\n"); //write the error to the external text file
                        }
                    }
                }else{
                    echo "Please follow the firstname, lastname, username, and password conventions"; //output this
                    fwrite($fp, $machine . "The firstname, lastname, username, and password conventions were not followed" . "\n"); //write the error to the external text file
                }
            }else{
                echo "<b>Firstname,</b> <b>lastname,</b> <b>username,</b> and <b>password</b> text fields are empty"; //outputs this text
            }
            fclose($fp); //closes the external text file
        ?>
        <br>
        <p>
            Firstname: Alphabetical, ranging from 2-20 characters.<br>
            Lastname: Alphabetical, ranging from 2-20 characters.<br>
            Username: An email format.<br>
            Password: An uppercase and lowercase letter, number, symbol, and 8-12 characters long.
        </p>
        <a href="login.php "name="register">Home</a> <!--link-->
    </body>
</html>