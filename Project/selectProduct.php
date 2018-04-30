
<?php

	session_start();

	$inUsername = $_SESSION['userName']; //get user

	if($_SESSION['validUser'] == "yes") { //if valid user , already signed in
	include 'connection.php';
	
	try {
      // set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "<table class = 'table'>" ;
		echo "<tr>" ;
		echo "<th>product_id</th>" ;
		echo "<th>product_name</th>";
		echo "<th>product_description</th>";
		echo "<th>product_price</th>" ;
		echo "<th>update</th>" ;
		echo "<th>delete</th>";
		echo "</tr>" ;
		$stmt = $conn->query("SELECT `product_id`, `product_name`, `product_description`, `product_price` FROM `project` ");
		$stmt->execute();

		while ($row = $stmt->fetch(PDO:: FETCH_ASSOC))
		{
			
			echo "<tr>";
			echo "<td>" . $row['product_id'] . "</td>" ;
			echo "<td>" . $row['product_name'] . "</td>";
			echo "<td>" . $row['product_description'] . "</td>";
			echo "<td>" . $row['product_price'] . "</td>" ;
			echo "<td><a href='addProduct.php?product_id=" . $row['product_id'] . "'>Update</a></td>";
			echo "<td><a href='deleteProduct.php?product_id=" . $row['product_id'] . "'>Delete</a></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}
	
}
else{
	header('location: login.php');
}


?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Freelancer - Start Bootstrap Theme</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/freelancer.min.css" rel="stylesheet">


<style>

#container {
	width: 75%;
	margin: 2% 10%;
	border: 2px solid black;
	text-align: center;
	padding: 25px;
}
.tableFormat {
	border: 1px solid black;
	margin: 0 auto;

}
th {
	border: 1px solid black;
	padding: 10px;
	
}
td {
	border: 1px solid black;
	padding: 10px;
	text-align: center;
	
}
h1 {
	text-align: center;
	text-decoration: underline;
}
p {
	text-align: center;
}
</style>
</head>
<body>



</body>
</html>