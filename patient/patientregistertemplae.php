 <?php 
  include '../class/phmsclasses.php'; 

   $patient = new Patient;

   $reg_error=array();

  if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['register'] == "register") {

    //validate patient's name
    if(empty($_POST['surname']) || empty($_POST['firstname'])){
      $reg_error['names'] = "<div class='text-danger'><small>Surname and Firstname is required</small></div>";
    }

    //validate date of birth
    if(empty($_POST['dob'])){
      $reg_error['dob'] = "<div class='text-danger'><small>Date of birth is required</small></div>";
    }

    //validate address
    if(empty($_POST['address'])){
      $reg_error['address'] = "<div class='text-danger'><small>Patient's address is required</small></div>";
    }

    //validate phone number
    if(empty($_POST['phone'])){
      $reg_error['phone'] = "<div class='text-danger'><small>Phone number is required</small></div>";
    }

    //validate the email field
    if (empty($_POST['email'])) {
      # validate the user input is not empty
      $reg_error['email'] = "<div class='text-danger'><small>Email Address field is required</small></div>";

    } elseif (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
      # to check if the email is a proper email
      $reg_error['email'] = "<div class='text-danger'><small>Email Address is not valid. Please use a valid email.</small></div>";

    }

    //validate password field
    if(empty($_POST['password1']) || empty($_POST['password2'])){

      $reg_error['password'] = "<div class='text-danger'><small>Password fields are required</small></div>";

    } else if ($_POST['password1'] != $_POST['password2']) {
      # if the password is less than 6 characters
      $reg_error['password'] = "<div class='text-danger'><small>Passwords do not match </small></div>";

    }

    //validate gender
    if(empty($_POST['gender'])){
      $reg_error['gender'] = "<div class='text-danger'><small>Please choose your gender</small></div>";
    }

    //validate blood_group
    if(empty($_POST['blood_group'])){
      $reg_error['blood_group'] = "<div class='text-danger'><small>Please select your blood group</small></div>";
    }


    //validate genotype
    if(empty($_POST['genotype'])){
      $reg_error['genotype'] = "<div class='text-danger'><small>Please select your genotype</small></div>";
    }

    //validate gpatient's Occupation
    if(empty($_POST['occupation'])){
      $reg_error['occupation'] = "<div class='text-danger'><small>Please state your occupation</small></div>";
    }


    //validate marital_stat
    if(empty($_POST['marital_stat'])){
      $reg_error['marital_stat'] = "<div class='text-danger'><small>Please select your marital status</small></div>";
    }


  #**************************NEXT OF KIN VALIDATION*****************************************************

    //validate Next of kin names
    if(empty($_POST['kinsurname']) || empty($_POST['kinfirstname'])){
      $reg_error['kinnames'] = "<div class='text-danger'><small>Next of Kin Surname and Firstname is required</small></div>";
    }


    //validate next of Kin address
    if(empty($_POST['kinaddress'])){
      $reg_error['kinaddress'] = "<div class='text-danger'><small>Kindly enter next of Kin address</small></div>";
    }  

    //validate next of kin phone number
    if(empty($_POST['kinphone1'])){
      $reg_error['kinphone1'] = "<div class='text-danger'><small>Kindly enter next of Kin phone number</small></div>";
    } 

    //validate next of kin relationship
    if(empty($_POST['kinrelationship'])){
      $reg_error['kinrelationship'] = "<div class='text-danger'><small>Kindly enter your relationhip with your next of Kin</small></div>";
    } 


    //register the submited details into the database
    //writing the post values into a variable
    $surname = strip_tags(trim($_POST['surname']));
    $firstname = strip_tags(trim($_POST['firstname']));
    $othername = strip_tags(trim($_POST['othername']));
    $address = strip_tags(trim($_POST['address']));
    $dob = strip_tags(trim($_POST['dob']));
    $phone = strip_tags(trim($_POST['phone']));
    $email = strip_tags(trim($_POST['email']));
    $password = strip_tags(trim($_POST['password1']));
    $gender = strip_tags(trim($_POST['gender']));
    $blood_group = strip_tags(trim($_POST['blood_group']));
    $genotype = strip_tags(trim($_POST['genotype']));
    $occupation = strip_tags(trim($_POST['occupation']));
    $marital_stat = strip_tags(trim($_POST['marital_stat']));

    #****************this is for the next of Kin
    $kinsurname = strip_tags(trim($_POST['kinsurname']));
    $kinfirstname = strip_tags(trim($_POST['kinfirstname']));
    $kinothername = strip_tags(trim($_POST['kinothername']));
    $kinaddress = strip_tags(trim($_POST['kinaddress']));
    $kinphone1 = strip_tags(trim($_POST['kinphone1']));
    $kinphone2 = strip_tags(trim($_POST['kinphone2']));
    $kinrelationship = strip_tags(trim($_POST['kinrelationship']));

    // var_dump($reg_error);exit();
    //check if there is no validation error
    if (count($reg_error) == 0) {
      # create object of the authentication
      $patientid = $patient->patientRegister($firstname, $surname, $othername, $address, $dob, $phone, $email, $password, $gender, $blood_group, $genotype, $occupation, $marital_stat, $kinsurname, $kinfirstname, $kinothername, $kinaddress, $kinphone1, $kinphone2, $kinrelationship);

      //to check if registration was successful
      if ($patientid == true) {
        # if the result is true
        header("Location: patientlogin.php?msg=Registration Successful");
       

      } else{
        
        header("Location: patientregister.php?msg=Registration Unsuccessful");
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
            <div class="col-md-6">
              <!-- The Registration form -->
              <div class="register-wrapper">
                <div class="text-center mb-4">
                  <a href="../index.php"><img class="mb-4" src="../images/Pristine.png" alt="" width="72" height="72"></a>
                  <h3 class="mb-3 font-weight-normal">Patient Registration</h3>
                  <?php 
                        if (isset($staff)) {
                            //if registration fails from the patientclasses, the error message is displayed here
                          echo $staff;
                        }

                        //Logout message is displayed below
                        if (isset($_GET['msg']) && empty($_POST['login'])) {
                            //if login fails from the phmsclasses, the error message is displayed here
                          echo "<div class='alert alert-danger'>".$_GET['msg']."</div>";
                        }
                      ?>
                </div>
                <!-- Start of forms -->
                  <form action="" method="post">
                    <!-- Names -->
                    <div class="form-inline mb-1">
                        <input type="text" name="surname" placeholder="Surname" class="form-control mr-2" value="<?php if(!empty($_POST['surname'])){ echo $_POST['surname'];} ?>">
                        <input type="text" name="firstname" placeholder="First Name" class="form-control mr-2" value="<?php if(!empty($_POST['firstname'])){ echo $_POST['firstname'];} ?>">
                        <input type="text" name="othername" placeholder="Othername" class="form-control" <?php if(!empty($_POST['othername'])){ echo $_POST['othername'];} ?>>

                        <?php 
                        if (isset($reg_error['names'])) {
                          # this gets the error message from the validation and ouputs it
                          echo $reg_error['names'];
                        }
                        ?>

                      </div>

                      <!-- Date of Birth -->
                      <div class="form-group">
                        <label><h6> Date of Birth: </h6></label>
                        <input type="date" name="dob"  placeholder="Date of Birth" class="form-control" value="<?php if(!empty($_POST['dob'])){ echo $_POST['dob'];} ?>">

                        <?php 
                        if (isset($reg_error['dob'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['dob']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Address -->
                      <div class="form-group">
                        <input type="text" name="address"  placeholder="Address" class="form-control" value="<?php if(!empty($_POST['address'])){ echo $_POST['address'];} ?>">

                        <?php 
                        if (isset($reg_error['address'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['address']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Phone Number -->
                      <div class="form-group">
                        <input type="text" name="phone"  placeholder="Phone Number" class="form-control" value="<?php if(!empty($_POST['phone'])){ echo $_POST['phone'];} ?>">

                        <?php 
                        if (isset($reg_error['phone'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['phone']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Email Address -->
                      <div class="form-group">
                        <input type="email" name="email"  placeholder="Your Email" class="form-control" value="<?php if(!empty($_POST['email'])){ echo $_POST['email'];} ?>">

                        <?php 
                        if (isset($reg_error['email'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['email']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Password -->
                      <div class="form-group mb-3">
                      <input type="password" name="password1" class="form-control" placeholder="Enter Password" value="" >
                      <input type="password" name="password2" class="form-control" placeholder="Confirm Password" value="" >

                      <!-- Password error message -->
                      <?php 
                        if (!empty($reg_error['password'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['password']."</div>";
                        }
                      ?>
                    </div>

                    <!-- Gender -->
                      <div class="form-group">
                        <select class="form-control" id="" name="gender" value="<?php if(!empty($_POST['gender'])){ echo $_POST['gender'];} ?>">
                          <label for=""><h6>Patient's Gender:</h6></label>
                          <option value="">Please select Gender</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                        </select>

                        <?php 
                        if (!empty($reg_error['gender'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['gender']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Blood group -->
                      <div class="form-group">
                        <label for=""><h6> Patient's Blood group:</h6></label>
                        <select class="form-control" id="" name="blood_group" value="<?php if(!empty($_POST['blood_group'])){ echo $_POST['blood_group'];} ?>">
                          <option value="">Please select</option>
                          <option value="unsure">Not sure</option>
                          <option value="A">A</option>
                          <option value="B">B</option>
                          <option value="AB">AB</option>
                          <option value="0+">O+</option>
                          <option value="0-">O-</option>
                        </select>

                        <?php 
                        if (!empty($reg_error['blood_group'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['blood_group']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Genotype -->
                      <div class="form-group">
                        <label for=""><h6>Patient's Genotype:</h6></label>
                        <select class="form-control" id="" name="genotype" value="<?php if(!empty($_POST['genotype'])){ echo $_POST['genotype'];} ?>">
                          <option value="">Please select</option>
                          <option value="unsure">Not sure</option>
                          <option value="AA">AA</option>
                          <option value="AS">AS</option>
                          <option value="AC">AC</option>
                          <option value="SC">SC</option>
                          <option value="SS">SS</option>
                        </select>

                        <?php 
                        if (!empty($reg_error['genotype'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['genotype']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Occupation -->
                      <div class="form-group">
                        <input type="text" name="occupation" placeholder="Patient's Occupation" class="form-control" value="<?php if(!empty($_POST['occupation'])){ echo $_POST['occupation'];} ?>">

                        <?php 
                        if (!empty($reg_error['occupation'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['occupation']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Marital status -->
                      <div class="form-group">
                        <select class="form-control" id="" name="marital_stat" value="<?php if(!empty($_POST['marital_stat'])){ echo $_POST['marital_stat'];} ?>">
                          <option value="">Patient Marital status</option>
                          <option value="Single">Single</option>
                          <option value="Married">Married</option>
                          <option value="Divorced">Divorced</option>
                          <option value="Widowed">Widowed</option>
                        </select>

                        <?php 
                        if (!empty($reg_error['marital_stat'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['marital_stat']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Form for next of Kin -->
                      <h5 class="card-header text-center"> Patient's Next of Kin details</h5>

                      <!-- Next of Kin Names -->
                      <div class="form-inline mt-3 mb-3">
                        <input type="text" name="kinsurname" placeholder="Next of Kin Surname" class="form-control mr-2" value="<?php if(!empty($_POST['kinsurname'])){ echo $_POST['kinsurname'];} ?>" >
                        <input type="text" name="kinfirstname" placeholder="Next of Kin Firstname" class="form-control mr-2" value="<?php if(!empty($_POST['kinfirstname'])){ echo $_POST['kinfirstname'];} ?>" >
                        <input type="text" name="kinothername" placeholder="Next of Kin Othername" class="form-control" value="<?php if(!empty($_POST['kinothername'])){ echo $_POST['kinothername'];} ?>" >

                        <?php 
                        if (isset($reg_error['kinnames'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['kinnames']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Next of Kin address -->
                      <div class="form-group">
                        <input type="text" name="kinaddress" placeholder="Address of Next of Kin" class="form-control" value="<?php if(!empty($_POST['kinaddress'])){ echo $_POST['kinaddress'];} ?>" >

                        <?php 
                        if (isset($reg_error['kinaddress'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['kinaddress']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Next of kin phone numbers -->
                      <div class="form-group">
                        <input type="text" name="kinphone1" placeholder="Next of Kin Phone Number" class="form-control" value="<?php if(!empty($_POST['kinphone1'])){ echo $_POST['kinphone1'];} ?>" >

                        <?php 
                        if (isset($reg_error['kinphone1'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['kinphone1']."</div>";
                        }
                        ?>
                      </div>

                      <div class="form-group">
                        <input type="text" name="kinphone2" placeholder="Next of Kin Second Phone Number (if available)" class="form-control" value="<?php if(!empty($_POST['kinphone2'])){ echo $_POST['kinphone2'];} ?>" >
                      </div>

                      <!-- Kin relationship to patient -->
                      <div class="form-group">
                        <input type="text" name="kinrelationship" placeholder="Relationship to the Patient" class="form-control" value="<?php if(!empty($_POST['kinrelationship'])){ echo $_POST['kinrelationship'];} ?>" >

                        <?php 
                        if (isset($reg_error['kinrelationship'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['kinrelationship']."</div>";
                        }
                        ?>
                      </div>                    

                    
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="register" value="register">Register</button>
                  </form>
                  <div class="text-center mt-3">
                      <p class="">Have you registered before? <a href="patientlogin.php" class="">Please Login here</a></p>            
                  </div> 
              </div>
            </div>          
        </div>

          <p class="mt-5 mb-3 text-muted text-center">© Luqman Bello 2020</p>
        
        </div>


    <script src="../js/jquery.min.js" type="text/javascript"></script>
    <script src="../js/popper.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.js" type="text/javascript"></script>

    <?php

      function validate($name,$errormsg){
        if(empty($_POST[$name])){
          $reg_error[$name] = "<div>".$errormsg."</div>";
        }

      }

      function displayErrormsg($name){
        if (isset($reg_error[$name])) {
          # this gets the error message from the validation and ouputs it
          echo $reg_error[$name];
        }

      }



    ?>

</body>
</html>