
<?php
	include 'asideandheader.php';
    include '../class/phmsclasses.php';
?>



<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header text-center"> Create Appointment</h5>
            <div class="card-body">
            	<!-- form to handle patient diagnosis -->
               <form action="" method="post" >
	               	<div class="text-center">
               			<div class="row justify-content-center">
               				<div class="col-7">
							   	<label class="mr-2"><h6>Patient Details:</h6></label>
								<div class="form-inline mb-3 align-self-center">
									<input type="number" name="patientid" placeholder="Enter Patient Id" id="patientid" onblur="patientName(this.value)" class="form-control mr-2" value="<?php  ?>">
									<input type="text" name="patient" placeholder="Patient Full name" id="patientname" class="form-control mr-2" value="" >
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
									<select class="form-control" id="">
										<option selected>Please pick a Doctor</option>
										<option>Yes</option>
										<option>No</option>
									</select>
								</div>
								
								<div class="form-group">
									<label for=""><h6>Purpose of Visit:</h6></label>
									<textarea name="diagnosis" cols="90" rows="15"></textarea>
								</div>
								<button type="submit" class="btn btn-lg btn-primary" name="submit" value="submit">Submit</button>
							</div>				
	               	</div>
               </form>
            </div>
        </div>
    </div>



<script src="ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<!-- do the ajax call here to auto fill the patient name -->
<script>
        function patientName(val) {
        	$.ajax({
        	type: "POST",
        	url: "fetchpatient.php",
        	data:'patientid='+val,
        	success: function(data){
				console.log(data)
				pname = data.patient_lname+" "+data.patient_fname+" "+data.patient_othername
        		//$("#patientname").val(pname);
				// alert(pname)
        	}

        	});
        }

        // function selectCountry(val) {
        // $("#search-box").val(val);
        // $("#suggesstion-box").hide();
        // }
      </script>	
<?php
	include 'footer.php';

?>