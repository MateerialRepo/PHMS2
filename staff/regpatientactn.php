<?php
    include '../class/phmsclasses.php'; 

   // $admin = new Admin;

   $reg_error=array();

   #*****************FOR REGISTERING A NEW PATIENT BY THE ADMIN**********************************

  if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['patientreg'] == "register") {

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



    $surname = strip_tags(trim($_POST['surname']));
    $firstname = strip_tags(trim($_POST['firstname']));
    $othername = strip_tags(trim($_POST['othername']));
    $dob = strip_tags(trim($_POST['dob']));
    $address = strip_tags(trim($_POST['address']));
    $phone = strip_tags(trim($_POST['phone']));
    $email = strip_tags(trim($_POST['email']));
    $password = strip_tags(trim($_POST['password1']));
    $gender = strip_tags(trim($_POST['gender']));
    $blood_group = strip_tags(trim($_POST['blood_group']));
    $genotype = strip_tags(trim($_POST['genotype']));
    $occupation = strip_tags(trim($_POST['occupation']));
    $marital_stat = strip_tags(trim($_POST['marital_stat']));


    

} else if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['patientkinreg'] == "submit"){


#*****************FOR REGISTERING A NEW PATIENT NEXT OF KIN BY THE ADMIN**********************************
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


    $kinsurname = strip_tags(trim($_POST['kinsurname']));
    $kinfirstname = strip_tags(trim($_POST['kinfirstname']));
    $kinothername = strip_tags(trim($_POST['kinothername']));
    $kinaddress = strip_tags(trim($_POST['kinaddress']));
    $kinphone1 = strip_tags(trim($_POST['kinphone1']));
    $kinphone2 = strip_tags(trim($_POST['kinphone2']));
    $kinrelationship = strip_tags(trim($_POST['kinrelationship']));

}


?>