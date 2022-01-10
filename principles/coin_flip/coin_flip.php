<!DOCTYPE html>

<html lang="en">
	<head>
		<title>coin flip</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
		
	</head>
	<body>
	three in a row coin flip<br>
	<a href="/">Home</a>
	|
	<a href="/principles/">back</a>
	<br><br>
	<a href="/principles/coin_flip/coin_flip.php">flip again</a>
	<br><br>
	<?php
	/*	$count = 0;
		
		while($count<5){
			echo $count."<br>";
			$count ++;
		}
		
		$count = 10;
		
		while($count>0){
			echo $count."<br>";
			$count --;
		}
		
		$count = rand();
		
		while($count>0){
			echo $count."<br>";
			$count --;
		}
		
		$count = 1;
		
		do{
			echo $count."<br>";
			$count ++;
		}while($count>2);
		
		for($count = 1; $count <=10; $count ++){
			echo $count."<br>";
		}
		
		$FastFood = array("Pizza", "Chips", "Burger", "Fried Chicken", "Shawarma");
		
		for($count = 0; $count <5; $count ++){
			echo $FastFood[$count]."<br>";
		}*/
		
		$headcount = 0;
		$tailcount = 0;
		$flipcount = 0;
		
		while($headcount<3) {
			$flip = rand(0,1);
			$flipcount ++;
			
			if ($flip == 0){
				$headcount ++;
				echo "tails<br>";
				$tailcount = 0;
			}
			else{
				$tailcount ++;
				echo "heads<br>";
				$headcount = 0;
			}
		}
		echo "<br>It took: ".$flipcount." flips<br>";
	?>
	</body>
</html>