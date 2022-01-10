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
            $file = "errorlog/error_log.txt"; //store the location of the external text file
            $fp = fopen($file, "a+"); //opens the external text file for changes
            $machine = gmdate('d/m/Y#h:i:sa') . "#" . "DATABASE" . "#" . $_SERVER['REMOTE_ADDR'] . "#"; //store the structure and various data in the $machine variable
            $conn = new mysqli($servername, $username, $password, $dbname); //create connection, sql statement to connect to the database
            
            if($conn->connect_error){ //check connection, execute the $conn variable
                //if fail - display and write error message to error_log.txt
                fwrite($fp, $machine . "Connection failed: " . $conn->connect_error); //write the error to the external text file
                die("Connection failed: " . $conn->connect_error); //if connection fails terminate the process and echo error
            }else{
                //or will state the connection made
                echo "Connected successfully<br>Database storage ready.<br>";
            }
            fclose($fp); //closes the external text file
        ?>
    </body>
</html>