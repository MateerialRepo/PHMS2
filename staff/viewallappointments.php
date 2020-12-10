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
                  <table class="table table-striped table-bordered ">
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
                        $admin = new Appointment;
                        $patients = $admin->viewallAppointments();
                        //var_dump($patients); exit();
                        if(count($patients) >0) {
                          # to check if the street variable has value
                          foreach ($patients as $key => $value) {
                          # code...                       
                          //var_dump($value); exit();
                      ?>
                      <tr>
                        <td><?php echo $value['patient_id']; ?></td>
                        <td><?php echo $value['Patient']; ?></td>
                        <td><?php echo $value['visit_date']; ?></td>
                        <td><?php echo $value['visit_time']; ?></td>
                        <td><?php echo $value['Doctor']; ?></td>
                        <td><a href="viewsingleappointment.php?patientid=<?php echo $value['patient_id']; ?>" class="mr-2">View</a>|<a href=".php?patientid=<?php echo $value['patient_id']; ?>" class="m-2">Add Vitals</a>
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