<?php
	include 'asideandheader.php';
    include 'phmsclasses.php';

    // $recordid = $_GET['recordid'];
    //var_dump($recordid); exit();
    //$date= date('m/d/Y');
    //var_dump($date); exit();

  if (isset($_GET)) {
    # code...
    $admin = new Admin;

    $details = $admin->fetchPatientappointments($_GET['recordid']);  
    ///var_dump($details); exit();  

  }


  #********************adding Vitals
  if (!empty($_POST && $_POST['addvital'] == 'addvital')) {
    # code...
    $vital = new Admin;

    $patientid = $_POST['patientid'];
    $visitdate = $_POST['vital_date'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $temp = $_POST['temp'];
    $bp = $_POST['bp'];
    $blood_sugar = $_POST['blood_sugar'];

    var_dump($_POST); exit();

    $checkstatus = $vital->createVitals($patientid,$visitdate,$weight,$height,$temp,$bp,$blood_sugar);
}



?>



<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header text-center"> View Appointment</h5>
            <div class="card-body">
            	<!-- form to handle patient diagnosis -->
               <form action="" method="post" >
	               	<div class="text-center">
               			<div class="row justify-content-center">
               				<div class="col-7">
							   	<label class="mr-2"><h6>Patient Details:</h6></label>
								<div class="form-inline mb-3 align-self-center">
									<input type="hidden" name="visitid" placeholder="Enter Patient Id" class="form-control mr-2" value="<?php echo $details['patientvisit_id'] ?>" disabled>
									<input type="text" name="patientname" placeholder="Enter Fullname" class="form-control m-auto" value="<?php echo $details['Patient'] ?>" disabled>
								</div>
               				</div>
							
							<div class="col-7">

								<div class="form-group">
			               			<label><h6>Preferred Date:</h6></label>
			               			<input type="Date" name="date" class="form-control" value="<?php echo $details['visit_date'] ?>" disabled>
								</div>
								
               					<div class="form-group">
			               			<label><h6>Preferred Time:</h6></label>
			               			<input type="Time" name="time" class="form-control" value="<?php echo $details['visit_time'] ?>" disabled>
								</div>

								<div class="form-group">
			               			<label for=""><h6>Preferred Doctor:</h6></label>
									<select class="form-control" id="">
										<option selected>Please pick a Doctor</option>
										<option>Yes</option>
										<option>No</option>
									</select>
								</div>
								
								<div class="form-group">
									<label for=""><h6>Purpose of Visit:</h6></label>
									<textarea name="diagnosis" cols="90" rows="15" disabled><?php echo $details['visit_purpose'] ?></textarea>
								</div>
                  
							  </div>				
	               	</div>
               </form>
            </div>
        </div>
    </div>

    <div class="col-12 mt-3">
      <!-- This would be the section for another card showing the vitals for the patient -->
      <div class="card">
        <h5 class="card-header text-center">Vitals</h5>
        <div class="card-body">
        <table class="table table-striped table-bordered">
          <thead>
            <th>Date</th>
            <th>Weight</th>
            <th>Height</th>
            <th>Temperature</th>
            <th>Blood Pressure</th>
            <th>Blood Sugar</th>
          </thead>

          <tbody>
            <?php
              //create street object
              $vital = new Admin;
              $metrics = $vital->fetchRecordvitals($details['patientvisit_id']);
              var_dump($metrics); exit();
              // if(count($metrics) >0) {
              //   # to check if the street variable has value
              //   foreach ($metrics as $key => $value) {
                # code...                       
                //var_dump($value); exit();
            ?>
            <tr>
              <td><?php echo $value['patient_id']; ?></td>
              <td><?php echo $value['Patient']; ?></td>
              <td><?php echo $value['visit_date']; ?></td>
              <td><?php echo $value['visit_time']; ?></td>
              <td><?php echo $value['Doctor']; ?></td>
              <td><a href="viewsingleappointment.php?recordid=<?php echo $value['patientvisit_id']; ?>" class="mr-2">View</a>|<a href=".php?recordid=<?php echo $value['patient_id']; ?>" class="m-2">Add Vitals</a></td>
            </tr>

            <?php
              //   }
              // }

            ?>
          </tbody>
        </table>

          <!-- Button trigger modal -->
          <button type="button" class=" btn btn-block btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Add Vitals</button>
        </div>
      </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLongTitle">Vitals</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="" method="post">
            <div class="form-group">
                <input type="hidden" name="patientid" class="form-control" value="<?php echo $details['patientvisit_id'] ?>">
            </div>

            <div class="form-group">
                <input type="date" name="vital_date" class="form-control" value="" >
            </div>

            <div class="form-group">
                <label>Weight in Kg</label>
                <input type="number" name="weight" class="form-control" value="">
            </div>

            <div class="form-group">
                <label>Height in cm</label>
                <input type="text" name="height" class="form-control" value="">
            </div>

            <div class="form-group">
                <label>Temperature in degree celcius</label>
                <input type="number" name="temp" class="form-control" value="">
            </div>

            <div class="form-group">
                <label>Blood Pressure</label>
                <input type="text" name="bp" class="form-control" value="">
            </div>

            <div class="form-group">
                <label>Blood Sugar</label>
                <input type="text" name="blood_sugar" class="form-control" value="">
            </div>

        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="addvital" value="addvital">Add Vitals</button>
      </div>
      </form>
    </div>
  </div>
</div>


<?php
	include 'footer.php';
?>