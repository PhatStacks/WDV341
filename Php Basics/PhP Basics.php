<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - PHP Basics</title>


<style>
body {text-align: center;
}

</style>

</head>

<body>
<h1>WDV341 Intro PHP Basics</h1>

    <p> 1. Create a variable called yourName.  Assign it a value of your name.</p>
	<?php 
	$yourName ="Phat Luong";
	?>

    <p> 2. Display the assignment name in an h1 element on the page. Include the elements in your output. </p>
	 
	<?php echo "<h1>PhP Basics</h1>"; ?>
	
	
    <p> 3.Use HTML to put an h2 element on the page. Use PHP to display your name inside the element using the variable.</p>
	<h2><?php echo $yourName;
	?></h2>
    <p> 4.Create the following variables:  number1, number2 and total.  Assign a value to them.  </p>
	
	<?php
	$number1 ="5";
	$number2 ="6";
	$total ="11";
	?>
	
    <p> 5.Display the value of each variable and the total variable when you add them together.  </p>
	<?php echo "<p>The number1 variable contains " . $number1 . ". </p>";?>
	<br>
	<?php echo "<p>The number2 variable contains " . $number2 . ". </p>";?>
	<br>
	<?php
function sum($number1, $number2) {
     $z = $number1 + $number2;
     return $z;
}
echo "5 + 6 = " . sum(5,6) . "<br>";
?>
	
	
</body>
</html>
