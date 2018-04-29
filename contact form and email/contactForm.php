<?php
$name = $_POST["name"];
$email = $_POST["email"];
$reason = $_POST["reason"];
$comment = $_POST["comment"];
$list = isset($_POST["list"]);
$sendMore = isset($_POST["sendMore"]);
$sendFail = "";
$sendSuccess = "";




if ($list == TRUE)
{
	$listLine = "You're now in our email list!\r\n";
}
else
{
	$listLine="";
}
if ($sendMore == TRUE)
{
		$sendMoreLine = "More information of our products is on your way!\r\n";
}
else
{
		$sendMoreLine = "";
}
$to = $_POST["email"]; 
$to .= ",luongphat7@gmail.com";
$subject = "Contact Form Confirmation";
$from = "from: contact@phatluong.com";
$message = " Dear $name,\r\n Thank you for taking the time to fill out our contact form. We understand that you have a comment regarding the $reason category.\r\n$listLine$sendMoreLine Thank You!\r\n THE INFORMATION YOU PROVIDED:\r\nName: $name\r\nEmail: $email\r\nReason: $reason\r\nYour Comment: $comment";
if (mail($to, $subject, $message, $from))
{
	$sendSuccess = "Your information has sent through!";
	$sendFail = "";
}
else
{
	
	$sendFail = "Error, Please try again ";
	$sendSuccess = " ";
	
	
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

<html>
<head>

</head>
<body>
<div id="container">

<div id="form">
<h1><?php echo "$sendSuccess"; echo "$sendFail";?></h1>

<h3>This is the Information You Provided:</h3>

<p><strong>NAME:</strong> <?php echo"$name"?></p>
<p><strong>EMAIL:</strong> <?php echo"$email"?></p>
<p><strong>REASON:</strong> <?php echo"$reason"?></p>
<p><strong>COMMENTS:</strong> <?php echo"$comment"?></p>

<h4>A confirmation email will be sent to the provided email address.</h4>
<h2>Thank You!</h2>
</div>

</div>
</body>
</html>
