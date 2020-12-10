<?php
	include '../class/phmsclasses.php';  

?>



<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header text-center"> Patient Diagnosis</h5>
            <div class="card-body">
            	<!-- form to handle patient diagnosis -->
               <form action="" method="post" >
	               	<div class="text-center">

	               		<div class="form-group">
	               			<label for=""><h6>Patient Diagnosis report:</h6></label>
               			<textarea name="diagnosis" cols="140" rows="15"></textarea>
               			</div>

               			<div class="row justify-content-center">
               				<div class="col-7">
               					<div class="form-group">
			               			<label><h6>Disease/Ailment</h6></label>
			               			<input type="text" name="disease" value="" class="form-control">
	               				</div>
               				</div>

               				<div class="col-7">
               					<div class="form-group">
								  <label for=""><h6>Is the patient going to be admitted?:</h6></label>
								  <select class="form-control" id="">
								  	<option selected>Please select</option>
								    <option>Yes</option>
								    <option>No</option>
								  </select>
								</div>
               				</div> 

               				<div class="col-7">
               					<div class="form-group">
			               			<label><h6>Prescription:</h6></label>
			               			<input type="text" name="drug" value="" class="form-control">
			               		</div>
               				</div>              				
               			</div>
               			<button type="submit" class="btn btn-lg btn-primary" name="submit" value="submit">Submit</button>
               			<button type="submit" class="btn btn-lg btn-primary" name="edit" value="edit">Edit</button>						
	               	</div>
               </form>
            </div>
        </div>
    </div>





<?php
	include 'footer.php';

?>