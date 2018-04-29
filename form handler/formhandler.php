<?php

$tableBody = "";		//use a variable to store the body of the table being built by the script
	
	foreach($_POST as $key => $value)		//This will loop through each name-value in the $_POST array
	{
		$tableBody .= "<tr>";				//formats beginning of the row
		$tableBody .= "<td>$key</td>";		//dsiplay the name of the name-value pair from the form
		$tableBody .= "<td>$value</td>";	//dispaly the value of the name-value pair from the form
		$tableBody .= "</tr>";				//End this row
	} 

$inmyName = $_POST["myName"];		
$inComments = $_POST["Comments"];		
$incontactBox = $_POST["contactBox"];
$insendMore = $_POST["sendMore"];	
$inColors = $_POST["time"];
$inselectedProduct = $_POST["selectedService"];			
	?>
	<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV 341 Intro PHP - Code Example</title>
</head>

<body>
<h1>WDV341 Intro PHP</h1>
<h2>Form Handler Result Page - Code Example</h2>
<p>This page displays the results of the Server side processing. </p>
<h3>Display the values </h3>

<p>
	<table border='a'>
    <tr>
    	<th>Field Name</th>
        <th>Value of Field</th>
    </tr>
	<?php echo $tableBody;  ?>
	</table>
</p>


<p>Name: <?php echo $inmyName; ?></p>
<p>Contact Me: <?php echo $incontactBox;?></p>
<p>Send More: <?php echo $insendMore;?></p>
<p>Color: <?php echo $inColors;?></p>
<p>Selected Product: <?php echo $inselectedProduct;?></p>
<p>Comments for contact info and details: <?php echo $inComments; ?></p>
</p>
</body>
</html>