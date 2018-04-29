<!DOCTYPE html>
<html>
<head>

<?php

function mmDdYyyyDate($date) //creates a date format with Month day and year.
{
	$timeStamp = strtotime($date);
	$date = date("m/d/Y", $timeStamp);
	echo $date;
}

function ddMmYyyyDate($date)		//function to create a date format with day/month/year.
{
	$timeStamp = strtotime($date);
	$date = date("d/m/Y", $timeStamp);
	echo $date;
}

function stringInput($str)		//this function does it all to the string. Character count, untrimemed reg, trim, lowercase, 
{
		$charNum = strlen($str);
		$strTrim = trim($str);
		$lowerStr = strtolower($strTrim);
		$trimmedCharNum = strlen($strTrim);
		
		echo("<strong>Character Count:</strong> $charNum<br/>		
		<strong>Untrimmed, Regular Case String: </strong>$str<br/>
		<strong>Trimmed, Lowercase String:</strong> $lowerStr<br/>
		<strong>Trimmed Character Count:</strong>$trimmedCharNum<br/>");
		
		if(strpos($lowerStr, 'dmacc') !== false)		//if statement to make sure the word dmacc is in there
		{
		echo("The string contains DMACC.");
		}
		else
		{
		echo("The string does not contain DMACC.");
		}
}

function formatNum($inNum)
{
	echo(number_format($inNum));
}

function formatMoney($inNum)
{
		$amount = number_format($inNum, 2, ".", ",");
		echo("$".$amount);
}
?>


</head>
<body>
<h1> PHP Functions</h1>
<h3>MM/DD/YYYY Date</h3>
</p><?php mmDdYyyyDate("January 8 2020");?></p>

<h3>DD/MM/YYYY Date</h3>
<p><?php ddMmYyyyDate("November 24 2020");?></p>


<h3>String Input Results</h3>
<p><?php stringInput("   Phat Luong at Dmacc  "); ?></p>


<h3>Formatted Number</h3>
<p><?php formatNum(1234567890); ?></p>

<h3>Formatted Money</h3>
<p><?php formatMoney(123456); ?></p>
</body>
</html>