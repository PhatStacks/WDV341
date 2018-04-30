<?php
session_cache_limiter('none');      //This prevents a Chrome error when using the back button to return to this page.
session_start();
 
  if ($_SESSION['validUser'] == "yes"){                     //if valid user or already signed on, skip the rest
    $message = "Welcome Back <em>". $inUsername."</em> !";  //Create greeting for VIEW area   
  }else{
    if (isset($_POST['submitLogin']) ){              //if login portion was submitted do the following
    
      $inUsername = $_POST['event_user_name'];      //pull the username from the form
      $inPassword = $_POST['event_user_password'];  //pull the password from the form
      
      include 'connection.php';               //Connect to the database

      $sql = "SELECT event_user_name,event_user_password FROM event_user WHERE event_user_name = :username AND event_user_password = :password";        
      
      $query = $conn->prepare($sql);                 //prepare the query
      
      $query->bindParam(':username', $inUsername);   //bind parameters to prepared statement
      $query->bindParam(':password', $inPassword);
      
      $query->execute();
      
      $query->fetch();  
      
      if ($query->rowCount() == 1 ){               //If this is a valid user there should be ONE row only
      
        $_SESSION['validUser'] = "yes";       //this is a valid user so set your SESSION variable
        $message = "Welcome Back <em>". $inUsername."</em> !";
        
      }else{
        
        $_SESSION['validUser'] = "no";        //error in login, not valid user  
        $message = "<em>Username or Password is incorrect. <br>Please try again.</em>";
      }     
      
      $conn = null;
      
    }else{
      //user needs to see form
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>WDV341 Intro PHP - Login and Control Page</title>
  
</head>

<body>
  
  <h2><?php echo $message?></h2>

<?php
  if ($_SESSION['validUser'] == "yes"){ //This is a valid user.  Show them the Administrator Page 
?>
    <div>
      <h2>Administrator Options</h2>
      <p><a href="eventsForm.php" >Add Event</a></p>
      <p><a href="selectEvents.php">View Events</a></p>
      <p><a href="logout.php">logout</a></p>  
        </div>          
<?php
  }else{  //The user needs to log in.  Display the Login Form
?>
    <div>
      <h2>Administrator Login</h2>
            <form method="post" name="loginForm" action="login.php" >
                <p class="label">Username:</p> <input name="event_user_name" type="text" />
                <p class="label">Password:</p> <input name="event_user_password" type="password" />
                <p><input name="submitLogin" value="LOGIN" type="submit" /> <input name="" type="reset" value="RESET"/>&nbsp;</p>
            </form>
    </div>
                
<?php 
  }  //end of checking for a valid user     
?>

</body>
</html>