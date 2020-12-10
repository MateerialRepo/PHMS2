<?php
  include 'asideandheader.php';
  include '../class/phmsclasses.php';

  // $admin = new Admin;

  // $response = $admin->deletePatient($_GET['patientid']);

  // header("Location: fetchallpatient.php?msg=$response");

  // exit();

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
                      if (!empty($_GET)) {
                        # code...
                        echo "<div class='alert alert-success'>".$_GET['msg']."</div>";
                      }
                    ?>
                  <table class="table table-striped table-bordered">
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
                        //create street object
                        $admin = new Patient;
                        $patients = $admin->fetchPatients();
                        //var_dump($patients); exit();
                        if(count($patients) >0) {
                          # to check if the street variable has value
                          foreach ($patients as $key => $value) {
                          # code...                       
                          //var_dump($value); exit();
                      ?>
                      <tr>
                        <td><?php echo $value['patient_id']; ?></td>
                        <td><?php echo $value['patient_fname']; ?></td>
                        <td><?php echo $value['patient_lname']; ?></td>
                        <td><?php echo $value['patient_email']; ?></td>
                        <td><?php echo $value['patient_phone']; ?></td>
                        <td><a href="viewpatientprofile.php?patientid=<?php echo $value['patient_id']; ?>" class="mr-2">View Profile</a>|<a href="editpatientdetails.php?patientid=<?php echo $value['patient_id']; ?>" class="mr-2">Edit</a>|<a href="fetchallpatient.php?patientid=<?php echo $value['patient_id']; ?>" class="ml-2">Delete</a></td>
                      </tr>

                      <?php
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