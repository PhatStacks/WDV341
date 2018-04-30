<?php
session_cache_limiter('none');      //This prevents a Chrome error when using the back button to return to this page.
session_start();
 
$inUsername = $_SESSION['userName'];


  if ($_SESSION['validUser'] == "yes"){                     //if valid user or already signed on, skip the rest
    $message = "Welcome Back <em>". $inUsername."</em> !";  //Create greeting for VIEW area   
  }else{
    if (isset($_POST['submitLogin']) ){              //if login portion was submitted do the following
    
      $inUsername = $_POST['user_name'];      //pull the username from the form
      $inPassword = $_POST['user_password'];  //pull the password from the form
      
      include 'connection.php';               //Connect to the database

      $sql = "SELECT user_name,user_password FROM product_user WHERE user_name = :username AND user_password = :password";        
      
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
<html lang="en">

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
          </ul>
        </div>
      </div>
    </nav>

    <div class = "container">
  
  <h2><?php echo $message?></h2>

<?php
  if ($_SESSION['validUser'] == "yes"){ //This is a valid user.  Show them the Administrator Page 
?>
    <div>
      <h2>Administrator Options</h2>
      <p><a href="addProduct.php" >Add Event</a></p>
      <p><a href="selectProduct.php">View Events</a></p>
      <p><a href="logout.php">logout</a></p>  
        </div>          
<?php
  }else{  //The user needs to log in.  Display the Login Form
?>
    <div>
      <h2>Administrator Login</h2>
            <form method="post" name="loginForm" action="login.php" >
                <p class="label">Username:</p> <input name="user_name" type="text" />
                <p class="label">Password:</p> <input name="user_password" type="password" />
                <p><input name="submitLogin" value="LOGIN" type="submit" /> <input name="" type="reset" value="RESET"/>&nbsp;</p>
            </form>
    </div>
                
<?php 
  }  //end of checking for a valid user     
?>
</div>

</body>
</html>