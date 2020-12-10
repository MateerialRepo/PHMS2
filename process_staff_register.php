<?php 
  include 'phmsclasses.php';  

  $userauth = new Authentication;

  $reg_error=array();

  if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['register'] == "register") {
    # code...
    $firstname = strip_tags($_POST['staff_firstname']);
    $lastname = strip_tags($_POST['staff_surname']);
    $othername = strip_tags($_POST['staff_othername']);
    $gender = strip_tags($_POST['gender']);
    $address = strip_tags($_POST['staff_address']);
    $email = strip_tags($_POST['staff_email']);
    $username = strip_tags($_POST['staff_username']);
    $password = strip_tags($_POST['staff_password']);
    $phone = strip_tags($_POST['staff_phone']);
    $speciality = strip_tags($_POST['speciality']);
    $stafftype = strip_tags($_POST['stafftype']);

    if (empty($stafftype)) {
      # code...
      $reg_error['stafftype'] = "<div class='text-danger'>Please choose one option</div>";//
    } else{

      if ($_POST['stafftype'] == "doctor") {
          $stafftype = 2;
        } else{
          $stafftype = 3;
        }
    }
    

    #***************Input validation starts here***********************************
    //validate firstname
    if(empty($firstname)){
      $reg_error['fname'] = "<div class='text-danger'>First Name is required</div>";
    }

    //validate lastname
    if(empty($lastname)){
      $reg_error['lname'] = "<div class='text-danger'>Surname is required</div>";
    }

    //validate address
    if(empty($address)){
      $reg_error['add'] = "<div class='text-danger'>Address is required</div>";
    }

    //validate the email field
    if (empty($email)) {
      # validate the user input is not empty
      $reg_error['email'] = "<div class='text-danger'>Email Address field or Username and Password is required</div>";

    } elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
      # to check if the email is a proper email
      $reg_error['email'] = "<div class='text-danger'>Email Address is not valid</div>";

    }

    //validate phone number
    if(empty($phone)){
      $reg_error['phone'] = "<div class='text-danger'>Phone number is required</div>";
    }

    //validate gender
    if(empty($gender)){
      $reg_error['gender'] = "<div class='text-danger'>Please select your a gender you identify as</div>";
    }

     //validate username
    if(empty($username)){
      $reg_error['usrnam'] = "<div class='text-danger'>Please enter your preferred Username</div>";
    }


    //validate password field
    if(empty($passwrd)){
      $reg_error['password'] = "<div class='text-danger'>Password field is required</div>";
    } elseif (strlen($passwrd) < 6) {
      # code...
      $reg_error['password'] = "<div class='text-danger'>Password length is less than 6 characters </div>";
    }

    //check if there is no validation error
    if (count($reg_error) == 0) {
      # create object of the authentication
      $staffid = $userauth->staffregister($firstname, $lastname, $othername, $gender, $address, $email, $username, $password, $phone, $speciality, $stafftype);

      //set the session details
      $_SESSION['staffid'] = $staffid;
      $_SESSION['fname'] = $_POST['staff_firstname'];
      $_SESSION['lname'] = $_POST['staff_surname'];

      header("Location: dashboard.php");
    }

  }

?>