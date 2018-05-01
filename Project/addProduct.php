<?php

	session_start();

	$inUsername = $_SESSION['userName']; //get user

	if($_SESSION['validUser'] == "yes") { //if valid user , already signed in

		$messageSuccess = "Welcome back $inUsername ";

		

		include 'connection.php';

	//variables to filled from form
	$productName = "";
	$productDescription = "";
	$productPrice = "";

		//variables to hold error messages
	$productNameError = "";
	$productDescriptionError = "";
	$productPriceError = "";

	$displayMsg ="";
	$displayErrorMsg ="";

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
			
			if($productPrice <="")
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

		try{
			$result = $conn->prepare("INSERT INTO project (product_name, product_description, product_price) VALUES (:productName, :productDescription, :productPrice)");
			$result->bindParam(':productName', $productName);
			$result->bindParam(':productDescription', $productDescription);
			$result->bindParam(':productPrice', $productPrice);



			$result->execute();
		

			$displayMsg = "Product added";
		}
		catch(PDOException $e){
			$displayErrorMsg = "IT didn't work";
		}
		$conn = null;

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
</head>
<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Friendly Barber</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="main.php">Portfolio</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">About</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="contactForm.html">Contact</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="login.php">login</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="logout.php">logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
			
			
			<!-- FORM -->
			<!-- Header  Displays the table-->
    	<header class="masthead bg-primary text-white text-center">
			<div id="container">
				<h1 >Add a product</h1>

				<form name="form1" method="post" action="addProduct.php">
					<p>Product Name:<br> <span class="error"><?php echo$productNameError?></span><input type="text" name="productName" id="productName" value="<?php echo$productName;?>"></p>

					<p>Product Description:<br><span class="error"><?php echo$productDescriptionError?></span><input type="text" name="productDescription" id="productDescription" cols ="45" rows = "6" value="<?php echo$productDescription;?>"></p>


					<p>Product Price:<br><span class="error"><?php echo$productPriceError?></span><input type="number" name="productPrice" id="productPrice" value="<?php echo$productPrice;?>"></p>

			
					<p><button><a href="selectProduct.php"> View all products.</a></button></p>


					<p><input type="submit" name="submit" value="Submit Information"></p>
					<p>	<input type="reset" name="reset" value="Reset Information"></p>

					</form>
				</div>
			</header>
<?php
		}
		else{
		header('location: login.php');
	}
	?>

		</body>
		</html>