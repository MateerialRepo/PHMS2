<?php
  include 'asideandheader.php';
  include '../class/phmsclasses.php'; 


  //statement below is to fetch the data of the patient and next of kin for the update
  $patientid = $_GET['patientid'];
  //var_dump($patientid); exit();

  if (isset($_GET)) {
    # code...
    $admin = new Patient;

    $patientdetails = $admin->patientAndKindetails($_GET['patientid']);

  }
  

?>



<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header text-center">Patient Details</h5>
            <div class="card-body">
              <div class="row justify-content-center text-center">
                <div class="col-9">
                  <div class="card-body">
                    <?php
                      if (isset($_GET['msg'])) {
                        if ($_GET['msg'] == true) {
                          echo "<div class='alert alert-success'>Profile update Successful</div>";
                        }else{
                          echo $_GET['msg'];
                        }
                        
                      }
                    ?>

                      <!-- Names -->
                      <input type="hidden" name="patientid" value="<?echo $_GET['patientid'];} ?>">
                    <div class="form-inline mb-1">
                        <input type="text" name="surname" placeholder="Surname" class="form-control mr-2" value="<?php echo $patientdetails['patient_lname']; ?>" disabled>
                        <input type="text" name="firstname" placeholder="First Name" class="form-control mr-2" value="<?php if(isset($patientdetails)){echo $patientdetails['patient_fname'];} ?>" disabled>
                        <input type="text" name="othername" placeholder="Othername" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['patient_othername'];} ?>" disabled>
                      </div>

                      <!-- Date of Birth -->
                      <div class="form-group">
                        <label><h6> Date of Birth: </h6></label>
                        <input type="date" name="dob"  placeholder="Date of Birth" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['patient_dob'];} ?>" disabled>
                      </div>

                      <!-- Address -->
                      <div class="form-group">
                        <input type="text" name="address"  placeholder="Address" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['patient_address'];} ?>" disabled>
                      </div>

                      <!-- Phone Number -->
                      <div class="form-group">
                        <input type="text" name="phone"  placeholder="Phone Number" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['patient_phone'];} ?>" disabled>
                      </div>

                      <!-- Email Address -->
                      <div class="form-group">
                        <input type="email" name="email"  placeholder="Your Email" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['patient_email'];} ?>" disabled>
                      </div>

                    <!-- Gender -->
                      <div class="form-group">
                        <select class="form-control" id="" name="gender" disabled>
                          <label for=""><h6>Patient's Gender:</h6></label>
                          <option value="" <?php if(isset($patientdetails['patient_gender']) && $patientdetails['patient_gender']=="" ){ echo "selected";} ?>>Please select Gender</option>
                          <option value="male" <?php if(isset($patientdetails['patient_gender']) && $patientdetails['patient_gender']=="male" ){ echo "selected";} ?>>Male</option>
                          <option value="female" <?php if(isset($patientdetails['patient_gender']) && $patientdetails['patient_gender']=="female" ){ echo "selected";} ?>>Female</option>
                        </select>
                      </div>

                      <!-- Blood group -->
                      <div class="form-group">
                        <label for=""><h6> Patient's Blood group:</h6></label>
                        <select class="form-control" id="" name="bloodgroup" disabled>
                          <option value="" <?php if(isset($patientdetails['patient_bloodgroup']) && $patientdetails['patient_bloodgroup']=="" ){ echo "selected";} ?>>Please select</option>
                          <option value="unsure" <?php if(isset($patientdetails['patient_bloodgroup']) && $patientdetails['patient_bloodgroup']=="unsure" ){ echo "selected";} ?>>Not sure</option>
                          <option value="A" <?php if(isset($patientdetails['patient_bloodgroup']) && $patientdetails['patient_bloodgroup']=="A" ){ echo "selected";} ?>>A</option>
                          <option value="B" <?php if(isset($patientdetails['patient_bloodgroup']) && $patientdetails['patient_bloodgroup']=="B" ){ echo "selected";} ?>>B</option>
                          <option value="AB" <?php if(isset($patientdetails['patient_bloodgroup']) && $patientdetails['patient_bloodgroup']=="AB" ){ echo "selected";} ?>>AB</option>
                          <option value="O+" <?php if(isset($patientdetails['patient_bloodgroup']) && $patientdetails['patient_bloodgroup']=="O+" ){ echo "selected";} ?>>O+</option>
                          <option value="O-" <?php if(isset($patientdetails['patient_bloodgroup']) && $patientdetails['patient_bloodgroup']=="O-" ){ echo "selected";} ?>>O-</option>
                        </select>
                      </div>

                      <!-- Genotype -->
                      <div class="form-group">
                        <label for=""><h6>Patient's Genotype:</h6></label>
                        <select class="form-control" id="" name="genotype" disabled>
                          <option value="" <?php if(isset($patientdetails['patient_genotype']) && $patientdetails['patient_genotype']=="" ){ echo "selected";} ?>>Please select</option>
                          <option value="unsure" <?php if(isset($patientdetails['patient_genotype']) && $patientdetails['patient_genotype']=="unsure" ){ echo "selected";} ?>>Not sure</option>
                          <option value="AA" <?php if(isset($patientdetails['patient_genotype']) && $patientdetails['patient_genotype']=="AA" ){ echo "selected";} ?>>AA</option>
                          <option value="AS" <?php if(isset($patientdetails['patient_genotype']) && $patientdetails['patient_genotype']=="AS" ){ echo "selected";} ?>>AS</option>
                          <option value="AC" <?php if(isset($patientdetails['patient_genotype']) && $patientdetails['patient_genotype']=="AC" ){ echo "selected";} ?>>AC</option>
                          <option value="SC" <?php if(isset($patientdetails['patient_genotype']) && $patientdetails['patient_genotype']=="SC" ){ echo "selected";} ?>>SC</option>
                          <option value="SS" <?php if(isset($patientdetails['patient_genotype']) && $patientdetails['patient_genotype']=="SS" ){ echo "selected";} ?>>SS</option>
                        </select>
                      </div>

                      <!-- Occupation -->
                      <div class="form-group">
                        <input type="text" name="occupation" placeholder="Patient's Occupation" class="form-control" value="<?php if(isset($patientdetails['patient_occupation'])){ echo $patientdetails['patient_occupation'];} ?>" disabled>
                      </div>

                      <!-- Marital status -->
                      <div class="form-group">
                        <select class="form-control" id="" name="marital_stat" disabled>
                          <option value="">Patient Marital status</option>
                          <option value="Single" <?php if(isset($patientdetails['patient_maritalstat']) && $patientdetails['patient_maritalstat']=="Single" ){ echo "selected";} ?>>Single</option>
                          <option value="Married" <?php if(isset($patientdetails['patient_maritalstat']) && $patientdetails['patient_maritalstat']=="Married" ){ echo "selected";} ?>>Married</option>
                          <option value="Divorced" <?php if(isset($patientdetails['patient_maritalstat']) && $patientdetails['patient_maritalstat']=="Divorced" ){ echo "selected";} ?>>Divorced</option>
                          <option value="Widowed" <?php if(isset($patientdetails['patient_maritalstat']) && $patientdetails['patient_maritalstat']=="Widowed" ){ echo "selected";} ?>>Widowed</option>
                        </select>
                      </div>
            
                  <!-- *************************NEXT OF KIN SECTION******************************** -->
                  <!-- Form for next of Kin -->
                  <h5 class="card-header text-center"> Patient's Next of Kin details</h5>
                    
                     <!-- next of Kin names -->
                    <div class="form-inline mt-3 mb-3">
                        <input type="text" name="kinsurname" placeholder="Next of Kin Surname" class="form-control mr-2" value="<?php if(isset($patientdetails)){echo $patientdetails['kin_surname'];} ?>" disabled>
                        <input type="text" name="kinfirstname" placeholder="Next of Kin Firstname" class="form-control mr-2" value="<?php if(isset($patientdetails)){echo $patientdetails['kin_firstname'];} ?>" disabled>
                        <input type="text" name="kinothername" placeholder="Next of Kin Othername" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['kin_othername'];} ?>" disabled>
                      </div>

                      <!-- Next of Kin address -->
                      <div class="form-group">
                        <input type="text" name="kinaddress" placeholder="Address of Next of Kin" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['kin_address'];} ?>" disabled>
                      </div>

                      <!-- Next of kin phone numbers -->
                      <div class="form-group">
                        <input type="text" name="kinphone1" placeholder="Next of Kin Phone Number" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['kin_phone1'];} ?>" disabled>
                      </div>

                      <div class="form-group">
                        <input type="text" name="kinphone2" placeholder="Next of Kin Second Phone Number (if available)" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['kin_phone2'];} ?>" disabled>
                      </div>

                      <!-- Kin relationship to patient -->
                      <div class="form-group">
                        <input type="text" name="kinrelationship" placeholder="Relationship to the Patient" class="form-control" value="<?php if(isset($patientdetails)){echo $patientdetails['kin_relationship'];} ?>" disabled>
                      </div>  

                    <div class="form-group">
                      <!-- the button doesnt pick the patientid when i attempt to redirect to the editprofile page -->
                      <a href="editpatientdetails.php?patientid=<?php echo $_GET['patientid']; ?>" style="text-decoration: none; color: white;"><button type="button" class="btn btn-block btn-primary">UPDATE PROFILE</button></a>

                    </div>
                      
                 
                </div>               
            </div>
        </div>
    </div>
  </div>
</div>






<?php
  include 'footer.php';

?>