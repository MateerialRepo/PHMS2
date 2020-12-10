<?php
  include 'asideandheader.php';
  include '../class/phmsclasses.php'; 

  $searcherror;
  $failedmsg;
                        
?>


<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header text-center"> All Registered Patients</h5>
            <div class="card-body">
             	<div class="row justify-content-center text-center">
                <div class="col-9">
                  <div class="card-body">
                    <?php
                      if (!empty($failedmsg)) {
                        # code...
                        echo $failedmsg;
                      }
                    ?>

                    <form action="" method="post">
                      <div class="form-inline">
                        <input type="number" name="patientid" value="" placeholder="Enter Patient ID" class="form-control mr-3 btn-outline text-center w-50">
                        <input type="submit" name="submit" value="submit" class="btn btn-info">
                      </div>

                      <div class="form-group text-left">
                          <?php

                          if (!empty($_POST) && $_POST['patientid'] == "") {
                            # code...
                            $searcherror = "<small class='text-danger'>Enter Patient ID before clicking the submit button</small>";
                            echo $searcherror;
                          }

                          ?>
                      </div>
                    </form>

                  <table class="table table-striped table-bordered tab">
                    <thead>
                      <th>PatientID</th>
                      <th>First Name</th>
                      <th>Lastname</th>
                      <th>Email Address</th>
                      <th>Phone Number</th>
                      <th>Action</th>
                    </thead>

                    <tbody>
                      <?php
                      //form action
                      if (!empty($_POST) && $_POST['submit'] == 'submit') {
                        # code...
                        $admin = new Patient;
                        $patient = $admin->fetchSinglePatient($_POST['patientid']);
                        //var_dump($patients); exit();
                        if(count($patient) >0) {
                          # to check if the street variable has value
                          foreach ($patient as $key => $value) {
                      ?>
                      <tr>
                        <td><?php echo $value['patient_id']; ?></td>
                        <td><?php echo $value['patient_fname']; ?></td>
                        <td><?php echo $value['patient_lname']; ?></td>
                        <td><?php echo $value['patient_email']; ?></td>
                        <td><?php echo $value['patient_phone']; ?></td>
                        <td><a href="viewpatientprofile.php?patientid=<?php echo $value['patient_id']; ?>" class="mr-2">View Profile</a>|<a href="editpatientdetails.php?patientid=<?php echo $value['patient_id']; ?>" class="mr-2">Edit</a>|<a href="#" class="ml-2">Delete</a></td>
                      </tr>

                      <?php
                            }
                          } else{
                            $failedmsg = "<div class='alert alert-danger'>This patient was not found!</div>";
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                 
                </div>               
            </div>
        </div>
    </div>
  </div>
</div>






<?php
	include 'footer.php';

?>