 <?php 
  include '../class/phmsclasses.php';  

  $userauth = new Staff;

  $reg_error=array();

  if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['register'] == "register") {

    // var_dump($_POST);
    // exit();
    # code...

    
    //Validate the kind of staff that is registering to pick the value
    if (empty($_POST['stafftype'])) {
      # code...
      $reg_error['stafftype'] = "<div class='text-danger'><small>Please choose one option</small></div>";//
    } else{

      if ($_POST['stafftype'] == "doctor") {
          $stafftype = 2;
        } else{
          $stafftype = 3;
        }
    }


    
    

    //validate firstname
    if(empty($_POST['staff_firstname'])){
      $reg_error['fname'] = "<div class='text-danger'><small>First Name is required</small></div>";
    }

    //validate lastname
    if(empty($_POST['staff_surname'])){
      $reg_error['lname'] = "<div class='text-danger'><small>Surname is required</small></div>";
    }

    //validate gender of the staff
    if(empty($_POST['gender'])){
      $reg_error['gender'] = "<div class='text-danger'><small>Please select a gender you identify as</div>";
    }else{
      $gender = strip_tags(trim($_POST['gender']));
    }

    //validate address
    if(empty($_POST['staff_address'])){
      $reg_error['add'] = "<div class='text-danger'><small>Address is required</small></div>";
    }

    //validate the email field
    if (empty($_POST['staff_email'])) {
      # validate the user input is not empty
      $reg_error['email'] = "<div class='text-danger'><small>Email Address field or Username and Password is required</small></div>";

    } elseif (!filter_var($_POST['staff_email'],FILTER_VALIDATE_EMAIL)) {
      # to check if the email is a proper email
      $reg_error['email'] = "<div class='text-danger'><small>Email Address is not valid</small></div>";

    }

    //validate phone number
    if(empty($_POST['staff_phone'])){
      $reg_error['phone'] = "<div class='text-danger'><small>Phone number is required</small></div>";
    }



    //validate password field
    if(empty($_POST['staff_password1']) || empty($_POST['staff_password2'])){

      $reg_error['password'] = "<div class='text-danger'><small>Password fields are required</small></div>";

    } else if ($_POST['staff_password1'] != $_POST['staff_password2']) {
      # if the password is less than 6 characters
      $reg_error['password'] = "<div class='text-danger'><small>Passwords do not match </small></div>";

    }


    $firstname = strip_tags(trim($_POST['staff_firstname']));
    $lastname = strip_tags(trim($_POST['staff_surname']));
    $othername = strip_tags(trim($_POST['staff_othername']));
    $address = strip_tags(trim($_POST['staff_address']));
    $email = strip_tags(trim($_POST['staff_email']));#*************
    $password = strip_tags(trim($_POST['staff_password1']));
    $phone = strip_tags(trim($_POST['staff_phone']));
    $speciality = strip_tags(trim($_POST['speciality']));

#***********************************************************************************************************************************
    // var_dump($reg_error);
    // exit();
    //check if there is no validation error
    if (count($reg_error) == 0) {
      # create object of the authentication
      $staffid = $userauth->staffRegister($firstname, $lastname, $othername, $gender, $address, $email, $password, $phone, $speciality, $stafftype);

      //to check if registration was successful
      if (!empty($staff)) {
        # if the staff variable is not empty
        header("Location: register.php?msg=Registration Unsuccessful");

      } else{
        # if the staff variable is empty i.e no returned value
        header("Location: login.php?msg=Registration Successful");

      }
      
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
    
    <title>Pristine HMS - Register</title>

</head>


<body>
    <div class="container-fluid parent">
        <div class="row justify-content-center mb-2">
            <div class="col-md-5">
              <!-- The Registration form -->
              <div class="register-wrapper">
                <div class="text-center mb-4">
                  <a href="../index.php"><img class="mb-4" src="../images/Pristine.png" alt="" width="72" height="72"></a>
                  <h3 class="mb-3 font-weight-normal">Staff Registration</h3>
                  <?php 
                        // if (isset($staff)) {
                        //     //if registration fails from the phmsclasses, the error message is displayed here
                        //   echo $staff;
                        //}

                        // Logout message is displayed below
                        // if (isset($_GET['msg']) && empty($_POST['login'])) {
                        //     //if login fails from the phmsclasses, the error message is displayed here
                        //   echo "<div class='alert alert-success'>".$_GET['msg']."</div>";
                        // }
                      ?>
                </div>
                <!-- Start of forms -->
                  <form action="" method="post">
                    <!-- staff type selection -->
                    <div class="form-group">
                      <label class="radio-inline">Doctor <input type="radio" name="stafftype" value="doctor" id="doctor" <?php if (!empty($_POST['stafftype'])) { if($_POST['stafftype'] == 'doctor'){ echo 'checked';}   }  ?>></label>
                      <label class="radio-inline">Nurse <input type="radio" name="stafftype" value="nurse" id="nurse" <?php if (!empty($_POST['stafftype'])) { if($_POST['stafftype'] == 'nurse'){ echo 'checked';}   }  ?> ></label>
                      <?php 
                        if (isset($reg_error['stafftype'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['stafftype']."</div>";
                        }
                      ?>
                    </div>

                    <!-- First Name -->
                    <div class="form-group mb-3">
                      <input type="text" name="staff_firstname" class="form-control" placeholder="First Name" value="<?php if(!empty($_POST['staff_firstname'])){ echo $_POST['staff_firstname'];} ?>" >

                       <!-- firstname Error message -->
                      <?php 
                        if (isset($reg_error['fname'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['fname']."</div>";
                        }
                      ?>
                    </div>

                    <!-- Surname -->
                    <div class="form-group mb-3">
                      <input type="text" name="staff_surname" class="form-control" placeholder="Surname" value="<?php if(!empty($_POST['staff_surname'])){ echo $_POST['staff_surname'];} ?>" >

                       <!-- Surname error message -->
                       <?php 
                        if (isset($reg_error['lname'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['lname']."</div>";
                        }
                      ?>
                    </div>

                    <!-- Othername -->
                    <div class="form-group mb-3">
                      <input type="text" name="staff_othername" class="form-control" placeholder="Othername" value="<?php if(!empty($_POST['staff_othername'])){ echo $_POST['staff_othername'];} ?>" >
                    </div>

                    <!-- Gender -->
                    <div class="form-group">
                      <label class="radio-inline">Male <input type="radio" name="gender" value="male" id="male" <?php if (!empty($_POST['gender'])) { if($_POST['gender'] == 'male'){ echo 'checked';}   }  ?>></label>
                      <label class="radio-inline">Female <input type="radio" name="gender" value="female" id="female" <?php if (!empty($_POST['gender'])) { if($_POST['gender'] == 'female'){ echo 'checked';}  } ?>></label>
                      <?php 
                        if (isset($reg_error['gender'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['gender']."</div>";
                        }
                      ?>
                    </div>

                    <!-- Address -->
                    <div class="form-group mb-3">
                      <input type="text" name="staff_address" class="form-control" placeholder="House Address" value="<?php if(!empty($_POST['staff_address'])){ echo $_POST['staff_address'];} ?>" >

                       <!-- House address error message -->
                       <?php 
                        if (isset($reg_error['add'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['add']."</div>";
                        }
                      ?>
                    </div>

                    <!-- Email Address -->
                    <div class="form-group mb-3">
                      <input type="email" name="staff_email" class="form-control" placeholder="Email address" value="
                      <?php
                        if(!empty($_POST['staff_email'])){
                          echo $_POST['staff_email'];
                        }
                       ?>" >

                       <!-- Email address error message -->
                      <?php 
                        if (!empty($reg_error['email'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['email']."</div>";
                        }
                      ?>
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-3">
                      <input type="password" name="staff_password1" class="form-control" placeholder="Password" value="" >
                      <input type="password" name="staff_password2" class="form-control" placeholder="Confirm Password" value="" >

                      <!-- Password error message -->
                      <?php 
                        if (!empty($reg_error['password'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['password']."</div>";
                        }
                      ?>
                    </div>

                    <!-- Phone -->
                    <div class="form-group">
                      <input type="text" name="staff_phone" value="<?php if(!empty($_POST['staff_phone'])){ echo $_POST['staff_phone'];} ?>" placeholder="Phone Number" class="form-control">

                      <!-- Phone number error message -->
                      <?php 
                        if (!empty($reg_error['phone'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['phone']."</div>";
                        }
                      ?>
                    </div>

                    <!-- Speciality -->
                    <div class="form-group">
                      <input type="text" name="speciality" id="speciality" value="<?php if(!empty($_POST['speciality'])){ echo $_POST['speciality'];} ?>" placeholder="Speciality" class="form-control">
                    </div>                    

                    
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="register" value="register">Register</button>
                  </form>
                  <div class="text-center mt-3">
                      <p class="">Have you registered before? <a href="login.php" class="">Please Login here</a></p>            
                  </div> 
              </div>
            </div>          
        </div>

          <p class="mt-5 mb-3 text-muted text-center">© Luqman Bello 2020</p>
        
        </div>


    <script src="../js/jquery.min.js" type="text/javascript"></script>
    <script src="../js/popper.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
      // var staff_typecheck = document.getElementbyid('staff_type').value;
      // if (staff_typecheck == 1) {
      //   document.getElementbyid('speciality').value = 'text';
      // }

      $(document).ready(function(){

        $("#speciality").hide();


        $("#doctor").click(function(){

            $("#speciality").show();

          });


        $("#nurse").click(function(){

          $("#speciality").hide();

          });


      });

    </script>

</body>
</html>