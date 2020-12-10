<?php
	include_once 'patientheader.php';
	include '../class/phmsclasses.php';  

	$doc = new Staff;
	$docs = $doc->fetchdoctorsfromstaff(2);
	//var_dump($docs);

	if (!empty($_POST) && $_POST['submit'] == "submit") {

		$appointment = new Appointment;

		$patientid = $_POST['patientid'];
		$staffid = $_POST['staffid'];
		$visitdate = $_POST['date'];
		$visittime = $_POST['time'];
		$purpose = $_POST['purpose'];

		$response = $appointment->createAppointment($patientid,$staffid,$visitdate,$visittime,$purpose);

		if ($response == true) {
			
			$msg = "<div class='alert alert-success'>Appointment Created Successfully</div>";

			// header("Location: patientappointments.php?msg=$msg");

		} else{

			$msg = "<div class='alert alert-danger'>Opps! something went wrong</div>";
		}


	}
?>


<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header text-center"> Create Appointment</h5>
            <div class="card-body">
            	<?php
                      if (!empty($msg)) {
                        # code...
                        echo $msg;
                      }
                    ?>
            	<!-- form to handle patient diagnosis -->
               <form action="" method="post" >
	               	<div class="text-center">
               			<div class="row justify-content-center">
               				<div class="col-7">
							   	<!-- <label class="mr-2"><h6>Patient Details:</h6></label> -->
								<div class="form-inline mb-3 align-self-center">
									<input type="hidden" name="patientid" class="form-control mr-2" value="<?php echo $_SESSION['patientid'] ?>">
								</div>
               				</div>
							
							<div class="col-7">

								<div class="form-group">
			               			<label><h6>Preferred Date:</h6></label>
			               			<input type="Date" name="date" class="form-control">
								</div>
								
               					<div class="form-group">
			               			<label><h6>Preferred Time:</h6></label>
			               			<input type="Time" name="time" class="form-control">
								</div>

								<div class="form-group">
			               			<label for=""><h6>Preferred Doctor:</h6></label>
									<select class="form-control" name="staffid">
										<option selected>Please pick a Doctor</option>

										<?php
											foreach ($docs as $key => $value) {											
										?>

										<option value="<?php echo $value['staff_id'] ?>"> <?php echo $value['doctor'] ?></option>

										<?php
											}
										?>
									</select>
								</div>
								
								<div class="form-group">
									<label for=""><h6>Purpose of Visit:</h6></label>
									<textarea name="purpose" cols="90" rows="15"></textarea>
								</div>
								<button type="submit" class="btn btn-lg btn-primary" name="submit" value="submit">Submit</button>
							</div>				
	               	</div>
               </form>
            </div>
        </div>
    </div>



<?php
	include 'patientfooter.php';
?>