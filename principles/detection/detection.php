<!DOCTYPE html>

<html lang="en">
	<head>
		<title>browser-detection</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<body>
	browser-detection<br>
	<a href="/">Home</a>
	|
	<a href="/principles/">back</a>
	<br>
	
	<?php
		session_start(); //a session is created via a GET or POST request
		if(isset($_SESSION['screen_width']) AND isset($_SESSION['screen_height'])){ //determines if the session values for the screen width and height are set
			echo 'USER RESOLUTION: <b>' . $_SESSION['screen_width'] . '</b>x<b>' . $_SESSION['screen_height'] . '</b><br>'; //if yes, the retrieved values are output
		} else if(isset($_REQUEST['width']) AND isset($_REQUEST['height'])) { //determines if the requested values for the screen width and height are set
			$_SESSION['screen_width'] = $_REQUEST['width']; //requested values are stored in the session
			$_SESSION['screen_height'] = $_REQUEST['height']; 
			header('Location: ' . $_SERVER['PHP_SELF']); //raw HTTP header sent to client and reloads the domain page
		} else {
			//javascript used to retrieve the resolution width and height of the screen
			echo '<script type="text/javascript">window.location = "' . $_SERVER['PHP_SELF'] . '?width="+screen.width+"&height="+screen.height;</script>'; 
		}
	
		function getBrowserName($user_agent) //a fuction is created with an argument to retrieve the browser
			{
				//if statement runs to check and return the browser/ engine
				if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) { //checks the browser engine for Opera
					return 'Opera'; //returns the identified browser back to the $user_agent argument
				}elseif (strpos($user_agent, 'Edge')) { //checks the browser engine for Microsoft Edge
					return 'Edge'; 
				}elseif (strpos($user_agent, 'Chrome')) { //checks the browser engine for Google Chrome
					return 'Chrome'; 
				}elseif (strpos($user_agent, 'Safari')) { //checks the browser engine for Safari
					return 'Safari'; 
				}elseif (strpos($user_agent, 'Firefox')) { //checks the browser engine for Firefox
					return 'Firefox'; 
				}elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident')) { //checks the browser engine For Internet Explorer
					return 'Internet Explorer'; 
				}else{
					return 'Other'; //if no browser engine is detected, other is returned to the $$user_agent argument
				}
			}
			echo 'WEB BROWSER: <b>' . getBrowserName($_SERVER['HTTP_USER_AGENT']) . '</b>';	//outputs the browser name
	?>
</body>
</html>