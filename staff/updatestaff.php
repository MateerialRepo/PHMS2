<?php
  include 'asideandheader.php';
  include '../class/phmsclasses.php'; 

  if (isset($_GET)) {
    # code...
    $admin = new Staff;

    $staffdetails = $admin->fetchSingleStaff($_GET['staffid']);
    //var_dump($staffdetails); exit();

  }

  //form processings starts here
  $reg_error=array();

  if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['update'] == "update") {

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



    $firstname = strip_tags(trim($_POST['staff_firstname']));
    $lastname = strip_tags(trim($_POST['staff_surname']));
    $othername = strip_tags(trim($_POST['staff_othername']));
    $address = strip_tags(trim($_POST['staff_address']));
    $email = strip_tags(trim($_POST['staff_email']));#*************
    $phone = strip_tags(trim($_POST['staff_phone']));
    $speciality = strip_tags(trim($_POST['speciality']));

#***********************************************************************************************************************************
    // var_dump($reg_error);
    // exit();
    //check if there is no validation error
    if (count($reg_error) == 0) {
      # create object of the authentication
      //$staffid = $userauth->($firstname, $lastname, $othername, $gender, $address, $email, $phone, $speciality, $stafftype);
    }

}

?>



<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header text-center"> All Staff</h5>
            <div class="card-body">
             	<div class="row justify-content-center text-center">
                <div class="col-9">
                  <div class="card-body">
                    <?php
                    //   if (!empty($_GET)) {
                    //     # code...
                    //     echo "<div class='alert alert-success'>".$_GET['msg']."</div>";
                    //   }
                    ?>
                </div>
                <!-- Start of forms -->
                  <form action="" method="post">
                  <input type="hidden" name="staffid" value="<?php echo $_GET['staffid']; ?>">
                    <!-- staff type selection -->
                    <div class="form-group">
                      <label class="radio-inline">Doctor <input type="radio" name="stafftype" value="2"  <?php if(isset($staffdetails['staff_typeid']) && $staffdetails['staff_typeid']==2 ){ echo 'checked';} ?>></label>
                      <label class="radio-inline">Nurse <input type="radio" name="stafftype" value="3" <?php if(isset($staffdetails['staff_typeid']) && $staffdetails['staff_typeid']==3 ){ echo 'checked';} ?> ></label>
                      <label class="radio-inline">Admin <input type="radio" name="stafftype" value="4" <?php if(isset($staffdetails['staff_typeid']) && $staffdetails['staff_typeid']==4 ){ echo 'checked';} ?> ></label>
                      <?php 
                        if (isset($reg_error['stafftype'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['stafftype']."</div>";
                        }
                      ?>
                    </div>

                    <!-- First Name -->
                    <div class="form-group mb-3">
                      <input type="text" name="staff_firstname" class="form-control" placeholder="First Name" value="<?php echo $staffdetails['firstname']; ?>" >

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
                      <input type="text" name="staff_surname" class="form-control" placeholder="Surname" value="<?php echo $staffdetails['lastname']; ?>" >

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
                      <input type="text" name="staff_othername" class="form-control" placeholder="Othername" value="<?php echo $staffdetails['othername']; ?>" >
                    </div>

                    <!-- Gender -->
                    <div class="form-group">
                      <label class="radio-inline">Male <input type="radio" name="gender" value="male" <?php if(isset($staffdetails['gender']) && $staffdetails['gender']=='male' ){ echo 'checked';} ?>></label>
                      <label class="radio-inline">Female <input type="radio" name="gender" value="female" <?php if(isset($staffdetails['gender']) && $staffdetails['gender']=='female' ){ echo 'checked';} ?>></label>
                      <?php 
                        if (isset($reg_error['gender'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['gender']."</div>";
                        }
                      ?>
                    </div>

                    <!-- Address -->
                    <div class="form-group mb-3">
                      <input type="text" name="staff_address" class="form-control" placeholder="House Address" value="<?php echo $staffdetails['address']; ?>" >

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
                      <input type="email" name="staff_email" class="form-control" placeholder="Email address" value="<?php echo $staffdetails['email']; ?>" >

                       <!-- Email address error message -->
                      <?php 
                        if (!empty($reg_error['email'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['email']."</div>";
                        }
                      ?>
                    </div>

                    <!-- Phone -->
                    <div class="form-group">
                      <input type="text" name="staff_phone" value="<?php echo $staffdetails['phone']; ?>" placeholder="Phone Number" class="form-control">

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
                      <input type="text" name="speciality" id="speciality" value="<?php echo $staffdetails['speciality']; ?>" placeholder="Speciality" class="form-control">
                    </div>                    

                    
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="update" value="update">Update</button>
                  </form>


                </div>               
            </div>
        </div>
    </div>
  </div>
</div>






<?php
	include 'footer.php';

?>