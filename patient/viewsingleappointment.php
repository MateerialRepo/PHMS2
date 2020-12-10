<?php
	include_once 'patientheader.php';
  include '../class/phmsclasses.php';  


    // $recordid = $_GET['recordid'];
    //var_dump($recordid); exit();
    //$date= date('m/d/Y');
    //var_dump($date); exit();

  if (isset($_GET)) {
    # code...
    $admin = new Appointment;

    $details = $admin->fetchSingleAppointment($_GET['visitid']);  
    ///var_dump($details); exit();  

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
        


<?php
	include 'patientfooter.php';
?>