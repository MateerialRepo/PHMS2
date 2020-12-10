<?php 
  session_start();
  include '../class/phmsclasses.php';

  $userauth = new Authentication;

  $login_error = array();

  if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['login'] == "login") {
    # code...
    $email = strip_tags($_POST['email']);
    $passwrd = strip_tags($_POST['password']);

    //validate the email field
    if (empty($email)) {
      # validate the user input is not empty
      $login_error['email'] = "<div class='text-danger'>Email Address field is required</div>";

    } elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
      # to check if the email is a proper email
      $login_error['email'] = "<div class='text-danger'><small>Email Address is not valid</small></div>";

    }

    //validate password field
    if(empty($passwrd)){
      $login_error['password'] = "<div class='text-danger'><small>Password field is required</small></div>";
    } elseif (strlen($passwrd) < 6){
      # code...
      $login_error['password'] = "<div class='text-danger'><small>Password length is less than 6 characters. </small></div>";
    }

    //check if there is no validation error
    if (count($login_error) == 0) {
      # create object of the authentication
      $output = $userauth->stafflogin($email, $passwrd);
    }

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="author" content="">
  <link rel="icon" href="favicon.ico">
  <link href="../css/bootstrap.css" type="text/css" rel="stylesheet">
  <link href="../css/login.css" type="text/css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Halant:wght@500;600&family=Montserrat&family=Nunito:ital,wght@0,400;1,300;1,400&display=swap" rel="stylesheet">
  
  <title>Pristine HMS - Login</title>

</head>


<body>
    <div class="container-fluid parent">
        <div class="row justify-content-center mb-2">
            <div class="col-md-5">
              <!-- The Login form -->
              <div class="login-wrapper">
                  <form action="" method="post">
                    <div class="text-center mb-4">
                      <a href="../index.php"><img class="mb-4" src="../images/Pristine.png" alt="" width="72" height="72"></a>
                      <h3 class="mb-3 font-weight-normal">Staff Sign in</h3>
                      <?php 
                        
                        if (isset($output)) {
                            //if login fails from the phmsclasses, the error message is displayed here
                          echo $output;
                        };

                        // Logout message is displayed below
                        if (isset($_GET['msg']) && empty($_POST['login'])) {
                            //if login fails from the phmsclasses, the error message is displayed here
                          echo "<div class='alert alert-success'>".$_GET['msg']."</div>";
                        }
                      ?>
                    </div>

                    <!-- Email input field -->
                    <div class="form-label-group mb-3">
                      <input type="email" id="email" name="email" class="form-control" placeholder="Email address" value="
                      <?php
                        if(isset($_POST['email'])){
                          echo $_POST['email'];
                        }
                       ?>" required>

                       <!-- Email validation error message -->
                      <?php 
                        if (isset($login_error['email'])) {
                          # this gets the message when there is an email validation error
                          echo $login_error['email'];
                        }
                      ?>
                    </div>

                    <!-- Password input field -->
                    <div class="form-label-group mb-3">
                      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" value="" required>
                      <?php 
                        if (isset($login_error['password'])) {
                          # this gets the message when there is a password validation error
                          echo $login_error['password'];
                        }
                      ?>
                    </div>

                    <div class="checkbox mb-2">
                      <label>
                        <input type="checkbox" value="remember-me"> Remember me
                      </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="login">Sign in</button>
                  </form>

                   <div class="text-center">
                      <small><a href="#!" class="text-muted m-2">Forgot password?</a></small>
                      <p class="">Don't have an account? <a href="register.php" class="">Register here</a></p>            
                  </div> 
              </div>
            </div>
          </div>

              <p class="mt-5 mb-3 text-muted text-center">© Luqman Bello 2020</p>        
    </div>



    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/popper.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>

</body>
</html>