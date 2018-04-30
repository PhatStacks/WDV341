<?php
	//use current session 
	
	session_start();


	//user is no longer valid
	$_SESSION['validUser'] = 'no';

	session_unset(); 		//remove all session variables
	session_destroy(); 	//remove current session

	//redirect to login page
	header('location: login.php');


?>