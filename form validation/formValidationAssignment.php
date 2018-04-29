<?php

//Setup the variables used by the page
$nameErrMsg = "";
$socialErrMsg = "";
$mailErrMsg = "";


$validForm = false;

$inName = "";
$inSocial="";
$inMail="";
function validateName()
{
  global $inName, $validForm, $nameErrMsg;    //Use the GLOBAL Version of these variables instead of making them local
  $nameErrMsg = "";               //Clear the error message. 
  if($inName=="")
  {
    $validForm = false;         //Invalid name so the form is invalid
    $nameErrMsg = "Name is required"; //Error message for this validation 
  }
}
if( isset($_POST['submit']) )       //if the form has been submitted Validate the form data
{
  //pull data from the POST variables in order to validate their values
  $inName = $_POST['inName'];
  $validForm = true;          //Set form flag/switch to true.  Assumes a valid form so far
  
    validateName();         //call the validateName() function
}






function validateSocial()
{
  global $inSocial, $validForm, $socialErrMsg;  //Use the GLOBAL Version of these variables instead of making them local
  $socialErrMsg = "";             //Clear the error message. 
    
                        //Using a Regular Expression to FORMAT VALIDATION email address
  if (!preg_match("/^[0-9]{3}[- ]?[0-9]{2}[- ]?[0-9]{4}$/",$inSocial))    //Copied straight from W3Schools.  Uses a Regular Expression
    {
    $validForm = false;
      $socialErrMsg = "Please enter valid SSN"; 
    }   
}

function validateMail()
{
  global $inMail, $validForm, $mailErrMsg;  //Use the GLOBAL Version of these variables instead of making them local
  $MailErrMsg = "";               //Clear the error message.  
  
  if($inMail =="")
  {
    $validForm = false;
      $mailErrMsg = "Please select a response";       
  }
}



if( isset($_POST['submit']) )       //if the form has been submitted Validate the form data
{
  //pull data from the POST variables in order to validate their values
  $inName = $_POST['inName'];
  $inSocial = $_POST['inSocial'];
  $inMail = $_POST['contact'];
  
  
  $validForm = true;          
    validateName();
    validateSocial();       
    validateMail();         

    
    


    
}//Completes the Form Validation process for this page. 
?>


<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Form Validation Example</title>
<style>

#orderArea  {
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
<h1>WDV341 Intro PHP</h1>
<h2>Form Validation Assignment



<?php

if ($validForm)     //If the form has been entered and validated a confirmation page is displayed in the VIEW area.
{
?>
  <h3>Thank You!</h3>
    <p>Your information has been processed. An email has been sent to the provider for your records.</p>

<?php
} //end the true branch of the form view area
else
{ 
?>

</h2>
<div id="orderArea">
  <form id="form1" name="form1" method="post" action="formValidationAssignment.php">
  <h3>Customer Registration Form</h3>
  <table width="587" border="0">
    <tr>
      <td width="117">Name:</td>
      <td width="246"><input type="text" name="inName" id="inName" size="40" value="<?php echo $inName; //place data back in field ?>"/></td>
      <td width="210" class="error"><?php echo "$nameErrMsg"; //place error message on form  ?></td>
    </tr>
    <tr>
      <td>Social Security</td>
      <td><input type="text" name="inSocial" id="inSocial" size="40" value="<?php echo $inSocial; //place data back in field ?>"/></td>
      <td class="error"><?php echo "$socialErrMsg"; //place error message on form  ?></td>
    </tr>
    <tr>
      <td>Choose a Response</td>
      <td><p name="inMale" id="inMale">
        <label>
          <input type="radio" name="contact" id="radio1"  value="Phone" <?php if($inMail=="Phone"){echo "selected='selected'";}?>>
          Phone</label>
        <br>
        <label>
          <input type="radio" name="contact" id="radio2" value="Email" <?php if($inMail=="Email"){echo "selected='selected'";}?>> 
          Email</label>
        <br>
        <label>
          <input type="radio" name="contact" id="radio3" value="Mail" <?php if($inMail=="Mail"){echo "selected='selected'";}?>>
          US Mail</label>
        <br>
      </p></td>
      <td class="error"><?php echo "$mailErrMsg"; //place error message on form  ?></td>
    </tr>
  </table>
  <p>
    <input type="submit" name="submit" id="submit-button" value="Register" />
    <input type="reset" name="clear" id="clear" value="ClearForm" />
  </p>
</form>
</div>

<?php
} //end else branch for the View area
?>

</body>
</html>