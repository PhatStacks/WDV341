<?php
//variables to filled from form
$inEventName = "";
$inEventDescription = "";
$inEventPresenter = "";
$inEventDate = "";
$inEventTime = "";
	//variables to hold error messages
$eventNameError = "";
$eventDescriptionError = "";
$eventPresenterError = "";
$eventDateError = "";
$eventTimeError = "";
	//variable to determine if form is valid( initially set to "false" to return an invalid (initally blank) form)
$validForm = false;
//form validation functions
		function validateName() //Event Name must be included
		{
			global $inEventName, $eventNameError, $validForm;
			
			if($inEventName == "")
			{
				$validForm = false;
				$eventNameError = "Please enter the name of the event.<br>";
			}
		}
		function validateDescription() //Event Description must be included
		{
			global $inEventDescription, $eventDescriptionError, $validForm;
			
			if($inEventDescription == "")
			{
				$validform = false;
				$eventDescriptionError = "Please enter a description of the event.<br>";
			}
		}
		function validatePresenter() //Event Presenter must be included
		{
			global $inEventPresenter, $eventPresenterError, $validForm;
			
			if($inEventPresenter =="")
			{
				$validForm = false;
				$eventPresenterError = "Please enter the name of the event presenter.<br>";
			}
		}
		function validateDate() //Event Date must be in yyyy-mm-dd format
		{
			global $inEventDate, $eventDateError, $validForm;
			
			$date_regex = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/'; // yyyy-mm-dd
			
			if (!preg_match($date_regex, $inEventDate))
			{
				$validForm = false;
				$eventDateError = "Please enter your event date in the yyyy-mm-dd format.<br>";
			}		
		}
		function validateTime() //Event Start Time must be in hh:mm 
		{
			global $inEventTime, $eventTimeError, $validForm;
			
			$time_regex = '/^(?:1[012]|0[0-9]):[0-5][0-9]$/'; //hh:mm 
			
			if(!preg_match($time_regex, $inEventTime))
			{
				$validForm = false;
				$eventTimeError = "Please enter your event time in the HH:MM  format.<br>";
			}
		}
		//function to determine if the "submit" button has been pressed (a form has been submitted)
		if(isset($_POST["submit"]))
		{
			//fill variables from form
			$inEventName = $_POST["eventName"];
			$inEventDescription = $_POST["eventDescription"];
			$inEventPresenter = $_POST["eventPresenter"];
			$inEventDate = $_POST["eventDate"];
			$inEventTime = $_POST["eventTime"];
			//assume the form is valid before validating
			$validForm = true;
			
			//validate form
			validateName();
			validateDescription();
			validatePresenter();
			validateDate();
			validateTime();
		}
		?>

		<!DOCTYPE html>
		<html>
		<head>

			<title>WDV 341: Form Page for Events</title>

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

		<?php
	//if form is valid, print confirmation page and sent form information to wdv341 database
		if($validForm)
		{
			$hostname = "localhost";
			$username = "phattest_wdv341";
			$password = "adidas1";
			$database = "phattest_wdv341";
			
			try 
			{
				$conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("INSERT INTO wdv341_event (event_name, event_description, event_presenter, event_date, event_time) VALUES(:eventName, :eventDescription, :eventPresenter, :eventDate, :eventTime)");
				
				$stmt->bindParam(':eventName', $eventName);
				$stmt->bindParam(':eventDescription', $eventDescription);
				$stmt->bindParam(':eventPresenter', $eventPresenter);
				$stmt->bindParam(':eventDate', $eventDate);
				$stmt->bindParam(':eventTime', $eventTime);
				
				$eventName = $inEventName;
				$eventDescription = $inEventDescription;
				$eventPresenter = $inEventPresenter;
				$eventDate = $inEventDate;
				$eventTime = $inEventTime;
				$stmt->execute();
			}
			catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}
			
			$conn = null;
			?>
			<div id="container">
				<h1 class="projectTitle">WDV 341: Form Page for Events</h1>
				<p>&nbsp;</p>
				<h1>Thank You for Your Event Information!</h1>
				<h2>Your event information has been placed  into our database!</h2>
				<p>&nbsp;</p>
			</div>
			<?php
		}
		else
		{
			?>
			<!--Form with Event Name, Description, Presenter, Date, and Time -->
			<div id="container">
				<h1 class="projectTitle">WDV 341: Form Page for Events</h1>

				<form name="form1" method="post" action="eventsForm.php">
					<p>Event Name:<br> <span class="error"><?php echo$eventNameError?></span><input type="text" name="eventName" id="eventName" value="<?php echo$inEventName?>"></p>

					<p>Event Description:<br><span class="error"><?php echo$eventDescriptionError?></span><textarea name="eventDescription" id="eventDescription" cols="45" rows="5"><?php echo$inEventDescription?></textarea></p>


					<p>Event Presenter:<br><span class="error"><?php echo$eventPresenterError?></span><input type="text" name="eventPresenter" id="eventPresenter" value="<?php echo$inEventPresenter?>"></p>

					<p>Event Date (yyyy-mm-dd):<br><span class="error"><?php echo$eventDateError?></span><input type="text" name="eventDate" id="eventDate" value="<?php echo$inEventDate?>"></p>

					<p>Event Start Time (hh:mm):<br><span class="error"><?php echo$eventTimeError?></span><input type="text" name="eventTime" id="eventTime" value="<?php echo$inEventTime?>"></p>

					<p><input type="submit" name="submit" value="Submit Information">
						<input type="reset" name="reset" value="Reset Information">

					</form>
				</div>
				<?php
			}
			?>
		</body>
		</html>