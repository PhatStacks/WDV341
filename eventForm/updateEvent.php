<?php

include 'connection.php';

//variables to filled from form
$updateId = $_GET['event_id'];
$eventName = "";
$eventDescription = "";
$eventPresenter = "";
$eventDate = "";
$eventTime = "";
//variables to hold error messages
$eventNameError = "";
$eventDescriptionError = "";
$eventPresenterError = "";
$eventDateError = "";
$eventTimeError = "";
//variable to determine if form is valid( initially set to "false" to return an invalid (initally blank) form)
$validForm = false;
//form validation functions


/*$verify_url = 'https://www.google.com/recaptcha/api/siteverify';
$args = array('secret' => '6LeAIFYUAAAAACPowlK1PHPty644Jw36gFTdXeKY',
'response' => $_POST['g-recaptcha'],
'remoteip' => $_SERVER['REMOTE_ADDR']);
$request_url = $verify_url.'?'.http_build_query($args);

// a JSON object is returned
$response = file_get_contents($request_url);

// decode the information
$json = json_decode($response, true); // true decodes it to an array instead of a PHP object



// handle the response
if($recaptcha['success'] == 1) {
// run code on successful reCAPTCHA
} else {
// run code on unsuccessful reCAPTCHA
}*/



function validateName() //Event Name must be included
{
	global $eventName, $eventNameError, $validForm;

	if($eventName == "")
	{
		$validForm = false;
		$eventNameError = "Please enter the name of the event.<br>";
	}
}
function validateDescription() //Event Description must be included
{
	global $eventDescription, $eventDescriptionError, $validForm;

	if($eventDescription == "")
	{
		$validform = false;
		$eventDescriptionError = "Please enter a description of the event.<br>";
	}
}
function validatePresenter() //Event Presenter must be included
{
	global $eventPresenter, $eventPresenterError, $validForm;

	if($eventPresenter =="")
	{
		$validForm = false;
		$eventPresenterError = "Please enter the name of the event presenter.<br>";
	}
}
function validateDate() //Event Date validation
{
	global $eventDate, $eventDateError, $validForm;

	if ($eventDate == " ")
	{
		$validForm = false;
		$eventDateError = "Please enter your event date.<br>";
	}		
}
function validateTime() //Event Start Time must be in hh:mm 
{
	global $eventTime, $eventTimeError, $validForm;


	if($eventTime == "" )
	{
		$validForm = false;
		$eventTimeError = "Please enter your event time.<br>";
	}
}
//function to determine if the "submit" button has been pressed (a form has been submitted)
if(isset($_POST["submit"]))
{
//fill variables from form
	$eventName = $_POST["eventName"];
	$eventDescription = $_POST["eventDescription"];
	$eventPresenter = $_POST["eventPresenter"];
	$eventDate = $_POST["eventDate"];
	$eventTime = $_POST["eventTime"];
//assume the form is valid before validating
	$validForm = true;


//validate form
	validateName();
	validateDescription();
	validatePresenter();
	validateDate();
	validateTime();


	$stmt = $conn->prepare("UPDATE wdv341_event SET event_date =:eventDate, event_description =:eventDescription, event_name =:eventName, event_presenter =:eventPresenter, event_time =:eventTime WHERE event_id = '$updateId' ");
	$stmt->bindParam(':eventName', $eventName);
	$stmt->bindParam(':eventDescription', $eventDescription);
	$stmt->bindParam(':eventPresenter', $eventPresenter);
	$stmt->bindParam(':eventDate', $eventDate);
	$stmt->bindParam(':eventTime', $eventTime);

	$stmt->execute();
	echo "<h2>Event Updated Inserted Correctly!</h2>";
	include 'selectEvents.php';

}

if($updateId == $updateId)
	$stmt = $conn->query("SELECT * FROM `wdv341_event` WHERE event_id = '$updateId' ");
while ($row = $stmt->fetch(PDO:: FETCH_ASSOC))
	{

		$eventName = $row['event_name'];
		$eventDescription = $row['event_description'];
		$eventPresenter = $row['event_presenter'];
		$eventDate = $row['event_date'];
		$eventTime = $row['event_time'];
	}


	?>

	<!DOCTYPE html>
	<html>
	<head>

		<title>WDV 341: Form Page for Events</title>

		<script src='https://www.google.com/recaptcha/api.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<style>

		#container  {
			width:600px;
			background-color:#CF9;
		}

		.error  {
			color:red;
			font-style:italic;  
		}
	</style>

</head>
<body>



	<!--Form with Event Name, Description, Presenter, Date, and Time -->
	<div id="container">
		<h1>Event Id: <?php echo $updateId?></h1>

		<form name="form1" method="post" action="updateEvent.php?id=<?php echo$updateId?>">
			<p>Event Name:<br> <span class="error"><?php echo$eventNameError?></span><input type="text" name="eventName" id="eventName" value="<?php echo$eventName?>"></p>

			<p>Event Description:<br><span class="error"><?php echo$eventDescriptionError?></span><textarea name="eventDescription" id="eventDescription" cols="45" rows="5"><?php echo$eventDescription?></textarea></p>


			<p>Event Presenter:<br><span class="error"><?php echo$eventPresenterError?></span><input type="text" name="eventPresenter" id="eventPresenter" value="<?php echo$eventPresenter?>"></p>

			<p>Event Date (yyyy-mm-dd):<br><span class="error"><?php echo$eventDateError?></span><input type="date" name="eventDate" id="eventDate" value="<?php echo$eventDate?>"></p>

			<p>Event Start Time (hh:mm):<br><span class="error"><?php echo$eventTimeError?></span><input type="time" name="eventTime" id="eventTime" value="<?php echo$eventTime?>"></p>

			<p><a href="selectEvents.php"> View all events.</a></p>

				<!--<div class="g-recaptcha" data-sitekey="6LeAIFYUAAAAACVyI_xUk1ePfihhR4Ka0ODG-syk"></div>-->


				<p><input type="submit" name="submit" value="Update information"></p>
				<p><input type="reset" name="reset" value="Reset Information"></p>




			</form>
		</div>

	</body>
	</html>