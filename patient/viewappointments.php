<?php
  include 'patientheader.php';
  include '../class/phmsclasses.php'; 

  $patientid = $_SESSION['patientid'];

?>



<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header text-center"> All Your Appointments</h5>
            <div class="card-body">
             	<div class="row justify-content-center text-center">
                <div class="col-9">
                  <div class="card-body">
                    <?php
                      if (!empty($_GET)) {
                        # code...
                        echo $_GET['msg'];
                      }
                    ?>
                  <table class="table table-striped table-bordered">
                    <thead>
                      <th>PatientID</th>
                      <th>Full Name</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Doctor</th>
                      <th>Action</th>
                    </thead>

                    <tbody>
                      <?php
                        //create street object
                        $patient = new Appointment;
                        $appointments = $patient->fetchPatientappointments($patientid);
                        //var_dump($patients); exit();
                        if(count($appointments) >0) {
                          # to check if the street variable has value
                          foreach ($appointments as $key => $value) {
                          # code...                       
                          //var_dump($value); exit();
                      ?>
                      <tr>
                        <td><?php echo $value['patient_id']; ?></td>
                        <td><?php echo $value['Patient']; ?></td>
                        <td><?php echo $value['visit_date']; ?></td>
                        <td><?php echo $value['visit_time']; ?></td>
                        <td><?php echo $value['Doctor']; ?></td>
                        <td><a href=".php?patientid=<?php echo $value['patient_id']; ?>" class="mr-2">View</a>
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