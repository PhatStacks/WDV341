<?php
//variables to filled from form

$productName = "";
$productDescription = "";
$productPrice = "";

	//variables to hold error messages
$productNameError = "";
$productDescriptionError = "";
$productPriceError = "";

	//variable to determine if form is valid( initially set to "false" to return an invalid (initally blank) form)
$validForm = false;
//form validation functions
		function validateName() //Event Name must be included
		{
			global $productName, $productNameError, $validForm;
			
			if($productName == "")
			{
				$validForm = false;
				$productNameError = "Please enter the name of the event.<br>";
			}
		}
		function validateDescription() //Event Description must be included
		{
			global $productDescription, $productDescriptionError, $validForm;
			
			if($productDescription == "")
			{
				$validform = false;
				$productDescriptionError = "Please enter a description of the event.<br>";
			}
		}
		function validatePrice() //Event Presenter must be included
		{
			global $productPrice, $productPriceError, $validForm;
			
			if($productPrice =="")
			{
				$validForm = false;
				$productPriceError = "Please enter the name of the event presenter.<br>";
			}
		}

		//function to determine if the "submit" button has been pressed (a form has been submitted)
		if(isset($_POST["submit"]))
		{
			//fill variables from form
			$productName = $_POST["productName"];
			$productDescription = $_POST["productDescription"];
			$productPrice = $_POST["productPrice"];
	
			//assume the form is valid before validating
			$validForm = true;
			
			//validate form
			validateName();
			validateDescription();
			validatePrice();

		}

		$verify_url = 'https://www.google.com/recaptcha/api/siteverify';
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

		<?php
	//if form is valid, print confirmation page and sent form information to wdv341 database
		if($validForm)
		{
			$hostname = "localhost";
			$username = "root";
			$password = "";
			$database = "wdv341";
			
			try 
			{
				$conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("INSERT INTO project (product_name, product_description, product_price) VALUES(:productName, :productDescription, :productPrice)");
				
				$stmt->bindParam(':productName', $productName);
				$stmt->bindParam(':productDescription', $productDescription);
				$stmt->bindParam(':productPrice', $productPrice);
				
				$stmt->execute();
			}
			catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}
			
			$conn = null;
		}
	
			?>
			<div id="container">
				<h1>product Submitted</h1>
				<p> <a href="selectProducts.php"> View all products.</a></p>
			</div>
			<?php
		}
		else
		{
			?>
			<!-- FORM -->
			<div id="container">
				<h1 >WDV 341: Form Page for Events</h1>

				<form name="form1" method="post" action="addProduct.php">
					<p>Product Name:<br> <span class="error"><?php echo$productNameError?></span><input type="text" name="productName" id="productName" value="<?php echo$productName?>"></p>

					<p>Product Description:<br><span class="error"><?php echo$productDescriptionError?></span><textarea name="productDescription" id="productDescription" cols="45" rows="5"><?php echo$productDescription?></textarea></p>


					<p>Product Price:<br><span class="error"><?php echo$productPriceError?></span><input type="number" name="productPrice" id="productPrice" value="<?php echo$productPrice?>"></p>

					<p>
					<div class="g-recaptcha" data-sitekey="6LeAIFYUAAAAACVyI_xUk1ePfihhR4Ka0ODG-syk"></div>
					<p> <a href="selectProducts.php"> View all events.</a></p>


					<p><input type="submit" name="submit" value="Submit Information">
						<input type="reset" name="reset" value="Reset Information">

					</form>
				</div>
				<?php
			}
			?>
		</body>
		</html>