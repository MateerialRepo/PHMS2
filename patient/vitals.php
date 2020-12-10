<?php
  include 'asideandheader.php';
  
  // if (isset($_POST) && $_POST["patientreg"] == "submit") {
  //   # code...
     //echo var_dump($_POST);
  // }

?>



<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header text-center"> Register New Patient</h5>
            <div class="card-body">
            	<!-- form to register a new patient -->
               <form action="patientregprocess.php" method="post" >
	               	<div class="row justify-content-center text-center">
                    <div class="col-7">

                      <div class="form-inline mb-1">
                        <input type="text" name="surname" value="" placeholder="Surname" class="form-control mr-2">
                        <input type="text" name="firstname" value="" placeholder="Firstname" class="form-control mr-2">
                        <input type="text" name="othername" value="" placeholder="Othername" class="form-control">
                      </div>

                      <div class="form-group">
                        <label><h6> Date of Birth: </h6></label>
                        <input type="date" name="dob" value="" placeholder="Date of Birth" class="form-control">
                      </div>

                      <div class="form-group">
                        <input type="text" name="address" value="" placeholder="Address" class="form-control">
                      </div>

                      <div class="form-group">
                        <input type="text" name="phone" value="" placeholder="Phone Number" class="form-control">
                      </div>

                      <div class="form-group">
                        <input type="email" name="email" value="" placeholder="Your Email" class="form-control">
                      </div>

                      <div class="form-group">
                        <select class="form-control" id="">
                          <label for=""><h6>Patient's Gender:</h6></label>
                          <option selected>Please select Gender</option>
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <input type="text" name="height" value="" placeholder="Height in cm" class="form-control">
                      </div>

                      <div class="form-group">
                        <input type="text" name="weight" value="" placeholder="Weight in kg" class="form-control">
                      </div>

                      <div class="form-group">
                        <input type="text" name="bp" value="" placeholder="Blood Pressure" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for=""><h6> Patient's Blood group:</h6></label>
                        <select class="form-control" id="">
                          <option selected>Please select</option>
                          <option>A</option>
                          <option>B</option>
                          <option>AB</option>
                          <option>O+</option>
                          <option>O-</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for=""><h6>Patient's Genotype:</h6></label>
                        <select class="form-control" id="">
                          <option selected>Please select</option>
                          <option>AA</option>
                          <option>AS</option>
                          <option>AC</option>
                          <option>SC</option>
                          <option>SS</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <input type="text" name="occupation" value="" placeholder="Patient's Occupation" class="form-control">
                      </div>

                      <div class="form-group">
                        <select class="form-control" id="">
                          <option selected>Patient Marital status</option>
                          <option>Single</option>
                          <option>Married</option>
                          <option>Divorced</option>
                          <option>Widowed</option>
                        </select>
                      </div>

                      <!-- Form for next of Kin -->
                      <h5 class="card-header text-center"> Patient's Next of Kin details</h5>
                      <div class="form-inline mt-3 mb-3">
                        <input type="text" name="kinsurname" value="" placeholder="Next of Kin Surname" class="form-control mr-2">
                        <input type="text" name="kinfirstname" value="" placeholder="Next of Kin Firstname" class="form-control mr-2">
                        <input type="text" name="kinothername" value="" placeholder="Next of Kin Othername" class="form-control">
                      </div>

                      <div class="form-group">
                        <input type="text" name="kinaddress" value="" placeholder="Address of Next of Kin" class="form-control">
                      </div>

                      <div class="form-group">
                        <input type="text" name="kinphone1" value="" placeholder="Next of Kin Phone Number" class="form-control">
                      </div>

                      <div class="form-group">
                        <input type="text" name="kinphone2" value="" placeholder="Next of Kin Second Phone Number (if available)" class="form-control">
                      </div>

                      <div class="form-group">
                        <input type="text" name="kinrelationship" value="" placeholder="Relationship to the Patient" class="form-control">
                      </div>

                      <div class="form-group">
                        <button class="btn btn-primary btn-block" name="patientreg" value="submit">Submit</button>
                      </div>

                    </div>

                  </div>

               </form>
            </div>
        </div>
    </div>





<?php
	include 'footer.php';

?>