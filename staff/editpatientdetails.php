 <?php
  ob_start();
  include 'asideandheader.php';
  include '../class/phmsclasses.php';  

  // var_dump($_GET); exit();
  //declaring the array variables to hold the validation errors my form
  $reg_error=array();
  $kinreg_error=array();

  //statement below is to fetch the data of the patient and next of kin for the update
  if (isset($_GET)) {
    # code...
    $admin = new Patient;

    $patientdetails = $admin->patientAndKindetails($_GET['patientid']);
    //var_dump($patientdetails); exit();

  }


  //The statement below is to check if the update button has been clicked then run the update function
  if (!empty($_POST) && $_POST['update'] == 'Update Details'){

    #*****************FORM VALIDATION starts here***********************
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

    //validate gender
    if(empty($_POST['gender'])){
      $reg_error['gender'] = "<div class='text-danger'><small>Please choose your gender</small></div>";
    }

    //validate blood_group
    if(empty($_POST['bloodgroup'])){
      $reg_error['bloodgroup'] = "<div class='text-danger'><small>Please select your blood group</small></div>";
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


    #************************************VALIDATE THE KIN DETAILS FIELD***************************************
     //validate Next of kin names
    if(empty($_POST['kinsurname']) || empty($_POST['kinfirstname'])){
      $kinreg_error['kinnames'] = "<div class='text-danger'><small>Next of Kin Surname and Firstname is required</small></div>";
    }


    //validate next of Kin address
    if(empty($_POST['kinaddress'])){
      $kinreg_error['kinaddress'] = "<div class='text-danger'><small>Kindly enter next of Kin address</small></div>";
    }  

    //validate next of kin phone number
    if(empty($_POST['kinphone1'])){
      $kinreg_error['kinphone1'] = "<div class='text-danger'><small>Kindly enter next of Kin phone number</small></div>";
    } 

    //validate next of kin relationship
    if(empty($_POST['kinrelationship'])){
      $kinreg_error['kinrelationship'] = "<div class='text-danger'><small>Kindly enter your relationhip with your next of Kin</small></div>";
    } 


    #***********************Patient variables*******************
    $patientid = $_POST['patientid'];
    $surname = strip_tags(trim($_POST['surname']));
    $firstname = strip_tags(trim($_POST['firstname']));
    $othername = strip_tags(trim($_POST['othername']));
    $dob = strip_tags(trim($_POST['dob']));
    $address = strip_tags(trim($_POST['address']));
    $phone = strip_tags(trim($_POST['phone']));
    $email = strip_tags(trim($_POST['email']));
    $gender = strip_tags(trim($_POST['gender']));
    $bloodgroup = strip_tags(trim($_POST['bloodgroup']));
    $genotype = strip_tags(trim($_POST['genotype']));
    $occupation = strip_tags(trim($_POST['occupation']));
    $marital_stat = strip_tags(trim($_POST['marital_stat']));


    #*************************Next of Kin variables****************
    $kinfirstname = strip_tags(trim($_POST['kinfirstname']));
    $kinsurname = strip_tags(trim($_POST['kinsurname']));
    $kinothername = strip_tags(trim($_POST['kinothername']));
    $kinaddress = strip_tags(trim($_POST['kinaddress']));
    $kinphone1 = strip_tags(trim($_POST['kinphone1']));
    $kinphone2 = strip_tags(trim($_POST['kinphone2']));
    $kinrelationship = strip_tags(trim($_POST['kinrelationship']));


    //var_dump($_POST); exit();
     //check if there is no validation error
    if (count($reg_error) == 0 && count($kinreg_error) == 0) {
      # create the object of the admin class
      $admin = new Patient;
      //var_dump("There are no errors"); exit();
      if ($patientdetails['kin_surname'] == '') {
        # do fresh kin detail registration

      }else{
        //just update the patient kin details
        $regstatus = $admin->updatePatientDetails($patientid, $firstname, $surname, $othername, $dob, $address, $phone, $email, $gender, $occupation, $bloodgroup, $genotype, $marital_stat, $kinfirstname, $kinsurname, $kinothername, $kinaddress, $kinphone1, $kinphone2, $kinrelationship);
      }
      

      //var_dump($regstatus); exit();

      //to check if registration was successful
      if ($regstatus = true) {
       //it means it returns the patientID and the registration was successful
         $msg=true;

         header("Location: http://localhost/phms/staff/viewpatientprofile.php?patientid=$patientid&msg=$msg");

         //redirect to the fetch all page without the edit function

      } else{
        # if the staff variable is empty i.e no returned value
          $msg="<div class='alert alert-danger'>Profile Update Unsuccessful</div>";
          //redirect to the fetch all page without the edit function
         
      }
      
    }

  }
  

?>



<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header text-center"> Edit Patient Details</h5>
            <div class="card-body">
             	<div class="row justify-content-center text-center">
                <div class="col-9">
                  <div class="card-body">
                  <?php
                      if (isset($_GET['msg'])) {
                        # code...
                        echo $_GET['msg'];
                      }
                    ?>
                    <form action="" method="post">
                      <!-- Names -->
                      <input type="hidden" name="patientid" value="<?php echo $_GET['patientid']; ?>">
                    <div class="form-inline mb-1">
                        <input type="text" name="surname" placeholder="Surname" class="form-control mr-2" value="<?php echo $patientdetails['patient_lname']; ?>">
                        <input type="text" name="firstname" placeholder="First Name" class="form-control mr-2" value="<?php if(isset($patientdetails)){echo $patientdetails['patient_fname'];} ?>">
                        <input type="text" name="othername" placeholder="Othername" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['patient_othername'];} ?>">

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
                        <input type="date" name="dob"  placeholder="Date of Birth" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['patient_dob'];} ?>">

                        <?php 
                        if (isset($reg_error['dob'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['dob']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Address -->
                      <div class="form-group">
                        <input type="text" name="address"  placeholder="Address" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['patient_address'];} ?>">

                        <?php 
                        if (isset($reg_error['address'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['address']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Phone Number -->
                      <div class="form-group">
                        <input type="text" name="phone"  placeholder="Phone Number" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['patient_phone'];} ?>">

                        <?php 
                        if (isset($reg_error['phone'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['phone']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Email Address -->
                      <div class="form-group">
                        <input type="email" name="email"  placeholder="Your Email" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['patient_email'];} ?>">

                        <?php 
                        if (isset($reg_error['email'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['email']."</div>";
                        }
                        ?>
                      </div>

                    <!-- Gender -->
                      <div class="form-group">
                        <select class="form-control" id="" name="gender">
                          <label for=""><h6>Patient's Gender:</h6></label>
                          <option value="" <?php if(isset($patientdetails['patient_gender']) && $patientdetails['patient_gender']=="" ){ echo "selected";} ?>>Please select Gender</option>
                          <option value="male" <?php if(isset($patientdetails['patient_gender']) && $patientdetails['patient_gender']=="male" ){ echo "selected";} ?>>Male</option>
                          <option value="female" <?php if(isset($patientdetails['patient_gender']) && $patientdetails['patient_gender']=="female" ){ echo "selected";} ?>>Female</option>
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
                        <select class="form-control" id="" name="bloodgroup">
                          <option value="" <?php if(isset($patientdetails['patient_bloodgroup']) && $patientdetails['patient_bloodgroup']=="" ){ echo "selected";} ?>>Please select</option>
                          <option value="unsure" <?php if(isset($patientdetails['patient_bloodgroup']) && $patientdetails['patient_bloodgroup']=="unsure" ){ echo "selected";} ?>>Not sure</option>
                          <option value="A" <?php if(isset($patientdetails['patient_bloodgroup']) && $patientdetails['patient_bloodgroup']=="A" ){ echo "selected";} ?>>A</option>
                          <option value="B" <?php if(isset($patientdetails['patient_bloodgroup']) && $patientdetails['patient_bloodgroup']=="B" ){ echo "selected";} ?>>B</option>
                          <option value="AB" <?php if(isset($patientdetails['patient_bloodgroup']) && $patientdetails['patient_bloodgroup']=="AB" ){ echo "selected";} ?>>AB</option>
                          <option value="O+" <?php if(isset($patientdetails['patient_bloodgroup']) && $patientdetails['patient_bloodgroup']=="O+" ){ echo "selected";} ?>>O+</option>
                          <option value="O-" <?php if(isset($patientdetails['patient_bloodgroup']) && $patientdetails['patient_bloodgroup']=="O-" ){ echo "selected";} ?>>O-</option>
                        </select>

                        <?php 
                        if (!empty($reg_error['bloodgroup'])) {
                          # this gets the error message from the validation and outputs it
                          echo "<div class='alert'>".$reg_error['bloodgroup']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Genotype -->
                      <div class="form-group">
                        <label for=""><h6>Patient's Genotype:</h6></label>
                        <select class="form-control" id="" name="genotype">
                          <option value="" <?php if(isset($patientdetails['patient_genotype']) && $patientdetails['patient_genotype']=="" ){ echo "selected";} ?>>Please select</option>
                          <option value="unsure" <?php if(isset($patientdetails['patient_genotype']) && $patientdetails['patient_genotype']=="unsure" ){ echo "selected";} ?>>Not sure</option>
                          <option value="AA" <?php if(isset($patientdetails['patient_genotype']) && $patientdetails['patient_genotype']=="AA" ){ echo "selected";} ?>>AA</option>
                          <option value="AS" <?php if(isset($patientdetails['patient_genotype']) && $patientdetails['patient_genotype']=="AS" ){ echo "selected";} ?>>AS</option>
                          <option value="AC" <?php if(isset($patientdetails['patient_genotype']) && $patientdetails['patient_genotype']=="AC" ){ echo "selected";} ?>>AC</option>
                          <option value="SC" <?php if(isset($patientdetails['patient_genotype']) && $patientdetails['patient_genotype']=="SC" ){ echo "selected";} ?>>SC</option>
                          <option value="SS" <?php if(isset($patientdetails['patient_genotype']) && $patientdetails['patient_genotype']=="SS" ){ echo "selected";} ?>>SS</option>
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
                        <input type="text" name="occupation" placeholder="Patient's Occupation" class="form-control" value="<?php if(isset($patientdetails['patient_occupation'])){ echo $patientdetails['patient_occupation'];} ?>">

                        <?php 
                        if (!empty($reg_error['occupation'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['occupation']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Marital status -->
                      <div class="form-group">
                        <select class="form-control" id="" name="marital_stat">
                          <option value="">Patient Marital status</option>
                          <option value="Single" <?php if(isset($patientdetails['patient_maritalstat']) && $patientdetails['patient_maritalstat']=="Single" ){ echo "selected";} ?>>Single</option>
                          <option value="Married" <?php if(isset($patientdetails['patient_maritalstat']) && $patientdetails['patient_maritalstat']=="Married" ){ echo "selected";} ?>>Married</option>
                          <option value="Divorced" <?php if(isset($patientdetails['patient_maritalstat']) && $patientdetails['patient_maritalstat']=="Divorced" ){ echo "selected";} ?>>Divorced</option>
                          <option value="Widowed" <?php if(isset($patientdetails['patient_maritalstat']) && $patientdetails['patient_maritalstat']=="Widowed" ){ echo "selected";} ?>>Widowed</option>
                        </select>

                        <?php 
                        if (!empty($reg_error['marital_stat'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['marital_stat']."</div>";
                        }
                        ?>
                      </div>
            
                  <!-- *************************NEXT OF KIN SECTION******************************** -->
                  <!-- Form for next of Kin -->
                  <h5 class="card-header text-center"> Patient's Next of Kin details</h5>
                    
                     <!-- next of Kin names -->
                    <div class="form-inline mt-3 mb-3">
                        <input type="text" name="kinsurname" placeholder="Next of Kin Surname" class="form-control mr-2" value="<?php if(isset($patientdetails)){echo $patientdetails['kin_surname'];} ?>" >
                        <input type="text" name="kinfirstname" placeholder="Next of Kin Firstname" class="form-control mr-2" value="<?php if(isset($patientdetails)){echo $patientdetails['kin_firstname'];} ?>" >
                        <input type="text" name="kinothername" placeholder="Next of Kin Othername" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['kin_othername'];} ?>" >

                        <?php 
                        if (isset($kinreg_error['kinnames'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$kinreg_error['kinnames']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Next of Kin address -->
                      <div class="form-group">
                        <input type="text" name="kinaddress" placeholder="Address of Next of Kin" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['kin_address'];} ?>" >

                        <?php 
                        if (isset($kinreg_error['kinaddress'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$kinreg_error['kinaddress']."</div>";
                        }
                        ?>
                      </div>

                      <!-- Next of kin phone numbers -->
                      <div class="form-group">
                        <input type="text" name="kinphone1" placeholder="Next of Kin Phone Number" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['kin_phone1'];} ?>" >

                        <?php 
                        if (isset($kinreg_error['kinphone1'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$kinreg_error['kinphone1']."</div>";
                        }
                        ?>
                      </div>

                      <div class="form-group">
                        <input type="text" name="kinphone2" placeholder="Next of Kin Second Phone Number (if available)" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['kin_phone2'];} ?>" >
                      </div>

                      <!-- Kin relationship to patient -->
                      <div class="form-group">
                        <input type="text" name="kinrelationship" placeholder="Relationship to the Patient" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['kin_relationship'];} ?>" >

                        <?php 
                        if (isset($kinreg_error['kinrelationship'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$kinreg_error['kinrelationship']."</div>";
                        }
                        ?>
                      </div>  

                    <div class="form-group">
                      <input type="submit" class="btn btn-primary btn-block" name="update" value="Update Details">

                    </div>
                      
                    </form>
                 
                </div>               
            </div>
        </div>
    </div>
  </div>
</div>






<?php
	include 'footer.php';
  ob_flush();
?>