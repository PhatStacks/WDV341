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

      $sql = "SELECT event_user_name,event_user_password FROM event_user WHERE event_user_name = :username AND event_user_password = :password";   
      
      $query = $conn->prepare($sql);                 //prepare the query
      
      $query->bindParam(':username', $inUsername);   //bind parameters to prepared statement
      $query->bindParam(':password', $inPassword);
      
      $query->execute();
      
      $query->fetch();  
      
      if ($query->rowCount() == 1 ){               //If this is a valid user there should be ONE row only
      
        $_SESSION['validUser'] = "yes";       //this is a valid user so set your SESSION variable
        $messageSuccess = "Welcome Back <em>". $inUsername."</em> !";
        
      }else{
        
        $_SESSION['validUser'] = "no";        //error in login, not valid user  
        $messageError = "<em>Username or Password is incorrect. <br>Please try again.</em>";
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

<?php
  if ($_SESSION['validUser'] == "yes"){ //This is a valid user.  Show them the Administrator Page 
?>

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
            <li><a id ="greeting"> <?php echo $messageSuccess;?></a></li>
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



   <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
      <div class="container">
        <button><a href="addProduct.php" >Add Product</a></button>
        <button><a href="selectProduct.php" >view Product</a></button>
      </div>
    </header>


<?php
  }else{  //The user needs to log in.  Display the Login Form
?>

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
            <li><a id ="greeting"> <?php echo $messageSuccess;?></a></li>
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

    <!-- Login form -->
<header class="masthead bg-primary text-white text-center">
  <div class="container">
    <div> 
      <h2>Administrator Login <?php echo $messageError;?></h2>
            <form method="post" name="loginForm" action="login.php" >
                <p class="label">Username:</p> <input name="user_name" type="text" />
                <p class="label">Password:</p> <input name="user_password" type="password" />
                <p><input name="submitLogin" value="LOGIN" type="submit" /> <input name="" type="reset" value="RESET"/>&nbsp;</p>
            </form>
    </div>
  </div>
</header>
                

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>

<?php 
  }  //end of checking for a valid user     
?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/freelancer.min.js"></script>

</body>
</html>





