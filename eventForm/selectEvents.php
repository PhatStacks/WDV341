
<?php
	include 'connection.php';
	
	try {
      // set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "<table class = 'table'>" ;
		echo "<tr>" ;
		echo "<th>event_id</th>" ;
		echo "<th>event_name</th>";
		echo "<th>event_description</th>";
		echo "<th>event_presenter</th>" ;
		echo "<th>event_date</th>" ;
		echo "<th>event_time</th>";
		echo "<th>update</th>" ;
		echo "<th>delete</th>";
		echo "</tr>" ;
		$stmt = $conn->query("SELECT `event_id`, `event_name`, `event_description`, `event_presenter`, `event_date`, `event_time`  FROM `wdv341_event` ");
		$stmt->execute();

		while ($row = $stmt->fetch(PDO:: FETCH_ASSOC))
		{
			
			echo "<tr>";
			echo "<td>" . $row['event_id'] . "</td>" ;
			echo "<td>" . $row['event_name'] . "</td>";
			echo "<td>" . $row['event_description'] . "</td>";
			echo "<td>" . $row['event_presenter'] . "</td>" ;
			echo "<td>" . $row['event_date'] . "</td>";
			echo "<td>" . $row['event_time'] . "</td>" ;
			echo "<td><a href='updateEvent.php?event_id=" . $row['event_id'] . "'>Update</a></td>";
			echo "<td><a href='deleteEvent.php?event_id=" . $row['event_id'] . "'>Delete</a></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}
	?>



<!DOCTYPE html>
<html>

<head>

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