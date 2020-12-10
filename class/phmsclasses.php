<?php


//database connection class

	class DatabaseConfig{
	    //members variable
	    public $dbcon;//database connection handler

	    //members function
	    public function __construct(){
	        //connect connection ny instantiating MySQLi class
	        $this->dbcon=new mysqli("localhost","root","","phms");

	        //check connection
	        if($this->dbcon->connect_errno){
	            die('connection fail'.$this->dbcon->connect_error);
	        }else{
	          //  echo "connection successful";
	        }
	    }
	}


	//Authentication class for both staff and patient login
	class Authentication{
		//member variables
		public $user; //database handler

		//member methods
		public function __construct(){
			//create object of database
			$this->user = new DatabaseConfig;
		}


		#function for staff loging
		public function stafflogin($email, $password){
			$pwd = md5($password);

			//sql statement so that landing page shows the role of the user
			//we are selecting all columns from staff table
			$sql = "SELECT * FROM staff WHERE password = '$pwd' AND email = '$email'";

			//run query
			$result = $this->user->dbcon->query($sql);

			//check if the number of row returned is equal to one
			if ($result->num_rows == 1) {
				# to get the returned array
				$output = $result->fetch_assoc();

				//var_dump($output);

				//create the session variable
				$_SESSION['userid'] = $output['staff_id'];
				$_SESSION['userlname'] = $output['lastname'];
				$_SESSION['userfname'] = $output['firstname'];
				$_SESSION['role'] = $output['staff_typeid'];
				$_SESSION['useremail'] = $output['email'];

				header("Location: dashboard.php");
				exit();

			} else{
				//display the error
				//var_dump($this->user->dbcon->error); exit();
				//display invalid login credentials
				$output = "<div class='alert alert-danger'>Invalid Email address or Password</div>";
				return $output;
			}

			
		}


		//function for Login in Patients
		public function patientLogin($email,$password){

			$password = md5($password);

			$sql = "SELECT * FROM patient WHERE patient_email= '$email' AND password= '$password'";

			$result = $this->user->dbcon->query($sql);

			// var_dump($this->patient->dbcon->query($sql));
			// exit();
			//check if the number of row returned is equal to one
			if ($result->num_rows == 1) {
				# to get the returned array
				$output = $result->fetch_assoc();

				//var_dump($output);

				//create the session variable
				$_SESSION['patientid'] = $output['patient_id'];
				$_SESSION['patientlname'] = $output['patient_lname'];
				$_SESSION['patientfname'] = $output['patient_fname'];



				//redirect to the patient dashboard
				header("Location: patientdashboard.php");

				exit();

			} else{
				//display the error
				//var_dump($this->user->dbcon->error); exit();
				//display invalid login credentials
				$output = "<div class='alert alert-danger'>Invalid Email address or Password</div>";
				return $output;
			}

		}

	}



	#***************************PATIENT CLASS FOR ALL THE PATIENT'S CRUD ACTION*****************************************
	class Patient{
		//member variables
		public $patient; //database handler

		//member methods
		public function __construct(){
			//create object of database
			$this->patient = new DatabaseConfig;
		}


		//function for registering Patients by themselves
		public function patientRegister($firstname, $surname, $othername, $dob, $address, $phone, $email, $password, $gender, $occupation, $kinfirstname, $kinsurname, $kinphone1){
			$password = md5($password);

			$sql = "INSERT INTO patient SET patient_fname='$firstname', patient_lname='$surname', patient_othername='$othername', patient_dob='$dob', patient_address='$address', patient_phone='$phone', patient_email='$email', password='$password', patient_gender='$gender', patient_occupation='$occupation'";

			if ($this->patient->dbcon->query($sql)) {
				//if the query runs successfully get the patientID
				$patientid = $this->patient->dbcon->insert_id;

				$kinreg = self::registerKin($patientid, $kinfirstname, $kinsurname, $kinphone1);

				if ($kinreg == true) {				

				$msg = "Registration Successful";

				header("Location: patientlogin.php?msg=$msg");

				exit();

				}

			} else {

				return $this->patient->dbcon->error;
			}
		}


		//registering the next of kin details
		function registerKin($patientid, $kinfirstname, $kinsurname, $kinphone1){

			$sql = "INSERT INTO patient_kin SET patient_id='$patientid', kin_firstname='$kinfirstname', kin_surname='$kinsurname', kin_phone1='$kinphone1'";

			 //var_dump($sql); exit();

			if ($this->patient->dbcon->query($sql)) {
				//if the query runs successfully
				return true;

			} else{
	
				echo $this->patient->dbcon->error;
			}

		}



		#*******************Next set of functions carried out by admin on patient records***********************************

		function registerPatient($firstname, $surname, $othername, $dob, $address, $phone, $email, $gender, $occupation, $bloodgroup, $genotype, $marital_stat, $kinfirstname, $kinsurname, $kinothername, $kinaddress, $kinphone1, $kinphone2, $kinrelationship){

			$sql = "INSERT INTO patient SET patient_fname='$firstname', patient_lname='$surname', patient_othername='$othername', patient_dob='$dob', patient_address='$address', patient_phone='$phone', patient_email='$email', patient_gender='$gender', patient_occupation='$occupation', patient_bloodgroup='$bloodgroup', patient_genotype='$genotype', patient_maritalstat='$marital_stat'";
			// var_dump("I got past the sql statement"); exit();

			if ($this->patient->dbcon->query($sql)) {
				//if the query runs successfully
				$patientid = $this->patient->dbcon->insert_id;

				// var_dump($patientid); exit();

				$kinresult = self::registerPatientkin($patientid, $kinfirstname, $kinsurname, $kinothername, $kinaddress, $kinphone1, $kinphone2, $kinrelationship);

				//var_dump($patientid); exit();

				if ($kinresult == true) {
				//if the query runs successfully
				return true;

				} else{
		
					return false;
				}

			} else {
				# code...
				echo $this->patient->dbcon->error;
			}

			
		}


		//to update the patients and kin records simultaneously
		function updatePatientDetails($patientid, $firstname, $surname, $othername, $dob, $address, $phone, $email, $gender, $occupation, $bloodgroup, $genotype, $marital_stat, $kinfirstname, $kinsurname, $kinothername, $kinaddress, $kinphone1, $kinphone2, $kinrelationship){

			$sql = "UPDATE patient SET patient_fname='$firstname', patient_lname='$surname', patient_othername='$othername', patient_dob='$dob', patient_address='$address', patient_phone='$phone', patient_email='$email', patient_gender='$gender', patient_occupation='$occupation', patient_bloodgroup='$bloodgroup', patient_genotype='$genotype', patient_maritalstat='$marital_stat' WHERE patient_id='$patientid'";

			if ($this->patient->dbcon->query($sql)) {
				# code...
				$kinupdate = self::updateKinDetails($patientid, $kinfirstname, $kinsurname, $kinothername, $kinaddress, $kinphone1, $kinphone2, $kinrelationship);

				if ($kinupdate == true) {
					#if the kinupdate query was successful
					//return true;
					return true;

				} else{
					#if the kindupdate fails
					//return false;
					echo $this->patient->dbcon->error;
					
				}

			} else{
				#if the patient update query fails
				echo $this->patient->dbcon->error;
			}
		}


		//function to update the patient Kin record
		function updateKinDetails($patientid, $kinfirstname, $kinsurname, $kinothername, $kinaddress, $kinphone1, $kinphone2, $kinrelationship){

			$sql = "UPDATE patient_kin SET kin_firstname='$kinfirstname', kin_surname='$kinsurname', kin_othername='$kinothername', kin_address='$kinaddress', kin_phone1='$kinphone1', kin_phone2='$kinphone2', kin_relationship='$kinrelationship' WHERE patient_id='$patientid'";

			if ($this->patient->dbcon->query($sql)) {
				//if the query runs successfully
				return true;

			} else{
	
				return false;
			}

		}





		//function to register the patients next of kin
		function registerPatientkin($patientid, $kinfirstname, $kinsurname, $kinothername, $kinaddress, $kinphone1, $kinphone2, $kinrelationship){

			$sql = "INSERT INTO patient_kin SET patient_id='$patientid', kin_firstname='$kinfirstname', kin_surname='$kinsurname', kin_othername='$kinothername', kin_address='$kinaddress', kin_phone1='$kinphone1', kin_phone2='$kinphone2', kin_relationship='$kinrelationship'";

			 //var_dump($sql); exit();

			if ($this->patient->dbcon->query($sql)) {
				//if the query runs successfully
				return true;

			} else{
	
				echo $this->patient->dbcon->error;
			}

		}


		//Function to fetch all the patients details on the system
		function fetchPatients(){

			//write your query
				$sql = "SELECT * FROM patient";

				//run query
				//$output = $result = $this->user->dbcon->query($sql);

				if ($result = $this->patient->dbcon->query($sql)) {
					# code...
					$output = $result->fetch_all(MYSQLI_ASSOC);
				} else {
					echo "Error: ".$this->patient->dbcon->error;
				}

				return $output;

			}


		//function to fecth just a single patient detail
		function fetchSinglePatient($patientid){

			//write your query
				$sql = "SELECT * FROM patient WHERE patient_id='$patientid'";

				//run query
				//$output = $result = $this->user->dbcon->query($sql);

				if ($result = $this->patient->dbcon->query($sql)) {
					# code...
					$output = $result->fetch_array();
					return $output;

				} else {
					
					echo "Error: ".$this->patient->dbcon->error;

				}

				

			}
			

		//function to fetch the next of kin details for a specific patient
		function fetchNextOfKin($patientid){
			//write your query
				$sql = "SELECT * FROM patient_kin WHERE patient_id='$patientid'";

				//run query
				//$output = $result = $this->user->dbcon->query($sql);

				if ($result = $this->patient->dbcon->query($sql)) {
					# code...
					$output = $result->fetch_all(MYSQLI_ASSOC);
				} else {
					echo "Error: ".$this->patient->dbcon->error;
				}

				return $output;

			}


		//function to fetch Patient details and Kin details
		function patientAndKindetails($patientid){

			$sql = "SELECT patient.*, patient_kin.* FROM patient LEFT JOIN patient_kin ON patient.patient_id = patient_kin.patient_id WHERE patient.patient_id = '$patientid'";

			if ($result = $this->patient->dbcon->query($sql)) {
					# code...
					//$output = $result->fetch_all(MYSQLI_ASSOC);
					$output = $result->fetch_array();
				} else {
					echo "Error: ".$this->patient->dbcon->error;
				}

				return $output;

		}


		//function to delete patient record
		function deletePatient($patientid){

			$sql = "DELETE FROM patient WHERE patient_id='$patientid'";

			if ($this->patient->dbcon->query($sql)) {
					#if it is successfull return the message below
					$response = "Patient Record has been deleted";
					return $response;

				} else {
					echo "Error: ".$this->patient->dbcon->error;
				}

		}


	}


	#***************************STAFF CLASS FOR ALL STAFF'S CRUD ACTION*****************************************
	class Staff{
		//member variables
		public $staff; //database handler

		//member methods
		public function __construct(){
			//create object of database
			$this->staff = new DatabaseConfig;
		}


		//function for registering staff
		public function staffRegister($firstname, $surname, $othername, $gender, $address, $email, $password, $phone, $speciality, $stafftype){

			$password = md5($password);

			$sql = "INSERT INTO staff SET firstname='$firstname', lastname='$surname', othername='$othername', address='$address', email='$email', phone='$phone', gender='$gender', password='$password', speciality='$speciality', staff_typeid='$stafftype'";


			$result = $this->staff->dbcon->query($sql);			

			if ($output = $this->staff->dbcon->insert_id) {
				//die($output);
				//we would use this to check in our registerform validation page if registration was successful
				return $output;
				
			}else {
				
				# to show the error if the query fails to create record
				return $this->staff->dbcon->error;
			}


		}


		//Function to fetch all staff
		function fetchStaff(){

			//write your query
				$sql = "SELECT staff.*, staff_type.staff_type FROM staff LEFT JOIN staff_type ON staff.staff_typeid = staff_type.staff_typeid";

				if ($result = $this->staff->dbcon->query($sql)) {
					# code...
					$output = $result->fetch_all(MYSQLI_ASSOC);
				} else {
					echo "Error: ".$this->staff->dbcon->error;
				}

				return $output;

		}

		//Function to fetch all staff
		function fetchSingleStaff($staffid){

			//write your query
				$sql = "SELECT staff.*, staff_type.staff_type FROM staff LEFT JOIN staff_type ON staff.staff_typeid = staff_type.staff_typeid WHERE staff_id='$staffid'";

				if ($result = $this->staff->dbcon->query($sql)) {
					# code...
					$output = $result->fetch_array();
				} else {
					echo "Error: ".$this->staff->dbcon->error;
				}

				return $output;

		}


		function fetchdoctorsfromstaff($stafftype){

			//write your query
				$sql = "SELECT staff_id, concat(lastname,' ',firstname,' ',othername) AS 'doctor' from staff WHERE staff_typeid='$stafftype'";

				if ($result = $this->staff->dbcon->query($sql)) {
					# code...
					$output = $result->fetch_all(MYSQLI_ASSOC);
					//var_dump($output); exit();
				} else {
					echo "Error: ".$this->staff->dbcon->error;
				}

				return $output;

		}

		
		//Function to update the staff profile
		public function updateStaff($staffid, $firstname, $surname, $othername, $gender, $address, $email, $phone, $speciality, $stafftype){			

			$sql = "UPDATE staff SET firstname='$firstname', lastname='$surname', othername='$othername', address='$address', email='$email', phone='$phone', gender='$gender', speciality='$speciality', staff_typeid='$stafftype' WHERE staff_id='$staffid'";


			if ($this->staff->dbcon->query($sql)) {
				//if the query runs successfully
				return true;

			} else{
				
				echo "Error: ".$this->staff->dbcon->error;
				
			}

		}

		//function to delete patient record
		function deleteStaff($staffid){

			$sql = "DELETE FROM staff WHERE staff_id='$staffid'";

			if ($this->staff->dbcon->query($sql)) {
					#if it is successfull return the message below
					$response = "Staff Record has been deleted";
					return $response;

				} else {
					echo "Error: ".$this->staff->dbcon->error;
				}

		}


	}

	#***************************ROASTER CLASS FOR ALL ROASTER'S CRUD ACTION*****************************************
	class Roaster{
		//member variables
		public $roaster; //database handler

		//member methods
		public function __construct(){
			//create object of database
			$this->roaster = new DatabaseConfig;
		}


		//function to create roaster
		function createRoaster($staffid,$calldate,$callstart,$callend){

			$j = count($calldate);

			for ($i=0; $i < $j ; $i++) { 
				# extract the day from the first array in the date array
				#loop through the query execution by going through the forloop
				$sql = "INSERT INTO roaster SET staff_id='$staffid[$i]', call_date='$calldate[$i]', call_start='$callstart[$i]', call_end='$callend[$i]'";

				//var_dump($sql);exit();

				$this->roaster->dbcon->query($sql);
			}

			 
			//var_dump($this->admin->dbcon->errno); exit();

			if ($this->roaster->dbcon->errno == 0) {
				//if the query runs successfully				
				//var_dump("we are here o"); exit();
				return true;
			} else {
	
				echo $this->roaster->dbcon->error;
			}

		}


		//function to view roaster
		function fetchRoaster(){
		
			$sql = "SELECT roaster.*, staff.firstname, staff.lastname FROM roaster LEFT JOIN staff ON roaster.staff_id = staff.staff_id ";

			if ($result = $this->roaster->dbcon->query($sql)) {

				$output = $result->fetch_all(MYSQLI_ASSOC);

				} else {
					echo "Error: ".$this->roaster->dbcon->error;
				}

				return $output;
		}


		//function to fetch a single roaster record
		function fetchSingleRoaster($roasterid){
		
			$sql = "SELECT roaster.*, staff.firstname, staff.lastname FROM roaster LEFT JOIN staff ON roaster.staff_id = staff.staff_id WHERE roaster_id = '$roasterid' ";

			if ($result = $this->roaster->dbcon->query($sql)) {

				$output = $result->fetch_array();

				} else {
					echo "Error: ".$this->roaster->dbcon->error;
				}

				return $output;
		}

		//function to fetch a single doctor roasters record
		function fetchDoctorRoaster($staffid){
		
			$sql = "SELECT roaster.*, staff.firstname, staff.lastname FROM roaster LEFT JOIN staff ON roaster.staff_id = staff.staff_id WHERE staff_id = '$staffid' ";

			if ($result = $this->roaster->dbcon->query($sql)) {

				$output = $result->fetch_all(MYSQLI_ASSOC);

				} else {
					echo "Error: ".$this->roaster->dbcon->error;
				}

				return $output;
		}

		//function to update the roaster details
		function updateRoaster($roasterid, $staffid,$calldate,$callstart,$callend){

			$sql = "UPDATE roaster SET staff_id='$staffid', call_date='$calldate', call_start='$callstart', call_end='$callend' WHERE roaster_id = '$roasterid'";

			if ($this->roaster->dbcon->query($sql)) {
				//if the query runs successfully
				return true;

			} else{
				
				echo "Error: ".$this->roaster->dbcon->error;
				
			}

		}

		//function to delete patient record
		function deleteRoaster($roasterid){

			$sql = "DELETE FROM roaster WHERE roaster_id='$roasterid'";

			if ($this->roaster->dbcon->query($sql)) {
					#if it is successfull return the message below
					$response = "Staff Record has been deleted";
					return $response;

				} else {
					echo "Error: ".$this->roaster->dbcon->error;
				}

		}

	
	}




	#***************************APPOINTMENT CLASS FOR ALL APPOINTMENT'S CRUD ACTION*****************************************
	class Appointment{
		//member variables
		public $visit; //database handler

		//member methods
		public function __construct(){
			//create object of database
			$this->visit = new DatabaseConfig;
		}


		//function to create appointment from the admin end
		function createAppointment($patientid,$staffid,$visitdate,$visittime,$purpose){

			$sql = "INSERT INTO patientvisit SET patient_id='$patientid', staff_id='$staffid', visit_date='$visitdate', visit_time='$visittime', visit_purpose='$purpose'";

			if ($this->visit->dbcon->query($sql)) {

				return true;
			} else {

				return false;
			}

		}

		//function to view all appointments booked
		function viewallAppointments(){

			$sql = "SELECT patientvisit.*, concat(patient.patient_fname,' ', patient.patient_lname,' ', patient.patient_othername) AS 'Patient', 
					concat(staff.firstname,' ',staff.lastname) AS 'Doctor' 
					FROM patientvisit LEFT JOIN patient on patient.patient_id=patientvisit.patient_id 
					LEFT JOIN staff on staff.staff_id=patientvisit.staff_id";

			if ($result = $this->visit->dbcon->query($sql)){

				$output = $result->fetch_all(MYSQLI_ASSOC);

			} else {
				echo $this->visit->dbcon->error;
			}

			return $output;
		}


		//function to view all appointments booked by a single patient
		function fetchPatientappointments($patientid){

			$sql = "SELECT patientvisit.*, concat(patient.patient_fname,' ', patient.patient_lname,' ', patient.patient_othername) AS 'Patient', 
					concat(staff.firstname,' ',staff.lastname) AS 'Doctor' 
					FROM patientvisit LEFT JOIN patient on patient.patient_id=patientvisit.patient_id 
					LEFT JOIN staff on staff.staff_id=patientvisit.staff_id where patientvisit.patient_id='$patientid'";

			if ($result = $this->visit->dbcon->query($sql)){

				$output = $result->fetch_all(MYSQLI_ASSOC);

			} else {
				echo $this->visit->dbcon->error;
			}

			return $output;

		}

		//function to view just one of the patients appointment booked by a patient
		function fetchSingleAppointment($visitid){

			$sql = "SELECT patientvisit.*, concat(patient.patient_fname,' ', patient.patient_lname,' ', patient.patient_othername) AS 'Patient', 
					concat(staff.firstname,' ',staff.lastname) AS 'Doctor' 
					FROM patientvisit LEFT JOIN patient on patient.patient_id=patientvisit.patient_id 
					LEFT JOIN staff on staff.staff_id=patientvisit.staff_id where patientvisit.patientvisit_id='$visitid'";

			if ($result = $this->visit->dbcon->query($sql)){

				$output = $result->fetch_assoc();

			} else {
				echo $this->visit->dbcon->error;
			}

			return $output;

		}

		//function to fetch all appointments for a single doctor
		function fetchDoctorappointments($staffid){

			$sql = "SELECT patientvisit.*, concat(patient.patient_fname,' ', patient.patient_lname,' ', patient.patient_othername) AS 'Patient', 
					concat(staff.firstname,' ',staff.lastname) AS 'Doctor' 
					FROM patientvisit LEFT JOIN patient on patient.patient_id=patientvisit.patient_id 
					LEFT JOIN staff on staff.staff_id=patientvisit.staff_id where patientvisit.staff_id='$staffid'";

			if ($result = $this->visit->dbcon->query($sql)){

				$output = $result->fetch_all(MYSQLI_ASSOC);

			} else {
				echo $this->visit->dbcon->error;
			}

			return $output;

		}


		//function to update a single appointment by the patient or admin
		function updateAppointment($patientvisitid,$patientid,$staffid,$visitdate,$visittime,$purpose){

			$sql = "UPDATE patientvisit SET staff_id='$staffid', visit_date='$visitdate', visit_time='$visittime', visit_purpose='$purpose' WHERE patient_id = '$patientid' AND patientvisit_id='$patientvisitid' ";

			if ($this->visit->dbcon->query($sql)) {

				return true;
			} else {

				return false;
			}

		}


		//function to delete patient appointment record
		function deleteAppointment($patientvisitid){

			$sql = "DELETE FROM patientvisit WHERE patientvisit_id='$patientvisitid'";

			if ($this->visit->dbcon->query($sql)) {
					#if it is successfull return the message below
					$response = "Appointment has been deleted";
					return $response;

				} else {
					echo "Error: ".$this->visit->dbcon->error;
				}

		}

	}

	#This class is to handle all the vital CRUD application
	class Vitals{
		//member variables
		public $vital; //database handler

		//member methods
		public function __construct(){
			//create object of database
			$this->vital = new DatabaseConfig;
		}

		//function to create Vitals from the admin end
		function createVitals($patientid,$visitdate,$weight,$height,$temp,$bp,$blood_sugar){

			$sql = "INSERT INTO patient_vitals SET patient_id='$patientid', date='$visitdate', weight='$weight', height='$height', temperature='$temp', bp='$bp', blood_sugar='$blood_sugar'";

			if ($this->vital->dbcon->query($sql)) {

				return true;
			} else {

				return false;
			}

		}

		//function to fetch all the vitals recorded
		function fetchallVitals(){

			$sql = "SELECT patient_vitals.*, concat(patient.patient_fname,' ', patient.patient_lname,' ', patient.patient_othername) AS 'Patient' 
					FROM patient_vitals LEFT JOIN patient on patient.patient_id=patient_vitals.patient_id";

			if ($result = $this->vital->dbcon->query($sql)){

				$output = $result->fetch_all(MYSQLI_ASSOC);

			} else {
				echo $this->vital->dbcon->error;
			}

			return $output;
		}


		//function to view all vitals for a single patient
		function fetchPatientvitals($patientid){

			$sql = "SELECT patient_vitals.*, concat(patient.patient_fname,' ', patient.patient_lname,' ', patient.patient_othername) AS 'Patient' 
					FROM patient_vitals LEFT JOIN patient on patient.patient_id=patient_vitals.patient_id where patient_vitals.patient_id='$patientid'";

			if ($result = $this->vital->dbcon->query($sql)){

				$output = $result->fetch_all(MYSQLI_ASSOC);

			} else {
				echo $this->vital->dbcon->error;
			}

			return $output;

		}


		//function to update a single  vital by the Nurse
		function updateVital($vitalid,$patientid,$visitdate,$weight,$height,$temp,$bp,$blood_sugar){

			$sql = "UPDATE patient_vitals SET patient_id='$patientid', date='$visitdate', weight='$weight', height='$height', temperature='$temp', bp='$bp', blood_sugar='$blood_sugar' WHERE patient_id = '$patientid' AND vital_id='$vitalid,' ";

			if ($this->vital->dbcon->query($sql)) {

				return true;

			} else {

				return false;
			}

		}

		//function to delete a single patientvital record
		function deleteVital($vitalid){

			$sql = "DELETE FROM patient_vitals WHERE vital_id='$vitalid'";

			if ($this->vital->dbcon->query($sql)) {
					#if it is successfull return the message below
					$response = "Patient's Vital record has been deleted";
					return $response;

				} else {
					echo "Error: ".$this->vital->dbcon->error;
				}

		}

	}


	//this class is meant to handle the doctor's diagnosis
	class Diagnosis {
		//member variables
		public $diag; //database handler

		//member methods
		public function __construct(){
			//create object of database
			$this->diag = new DatabaseConfig;
		}

		//function to create diagnosis
		function createDiagnosis($patientid,$staffid,$vitalid,$prescription,$record_date,$diagnosis,$admission_stat,$disease,$discharge_date){

			$sql = "INSERT INTO records SET patient_id='$patientid', staff_id='$staffid', vitals_id='$vitalid', record_prescription='$prescription', 
					record_date='$record_date', diagnosis='$diagnosis', admission_stat='$admission_stat', disease='$disease', discharge_date='$discharge_date'";

			if ($this->diag->dbcon->query($sql)) {

				return true;

			} else {

				return false;
			}


		}

		//function to fetch all the diagnosis recorded
		function fetchallDiagnosis(){

			$sql = "SELECT records.*, concat(patient.patient_fname,' ', patient.patient_lname,' ', patient.patient_othername) AS 'Patient',					 
					concat(staff.firstname,' ',staff.lastname) AS 'Doctor' 
					FROM records LEFT JOIN patient on patient.patient_id=records.patient_id
					LEFT JOIN staff on staff.staff_id=records.staff_id";

			if ($result = $this->diag->dbcon->query($sql)){

				$output = $result->fetch_all(MYSQLI_ASSOC);

			} else {
				echo $this->diag->dbcon->error;
			}

			return $output;
		}

		//function to fetch all the diagnosis recorded
		function fetchallPatientDiagnosis($patientid){

			$sql = "SELECT records.*, concat(patient.patient_fname,' ', patient.patient_lname,' ', patient.patient_othername) AS 'Patient',					 
					concat(staff.firstname,' ',staff.lastname) AS 'Doctor' 
					FROM records LEFT JOIN patient on patient.patient_id=records.patient_id
					LEFT JOIN staff on staff.staff_id=records.staff_id WHERE records.patient_id='$patientid'";

			if ($result = $this->diag->dbcon->query($sql)){

				$output = $result->fetch_all(MYSQLI_ASSOC);

			} else {
				echo $this->diag->dbcon->error;
			}

			return $output;
		}

		//function to fetch all the diagnosis recorded
		function fetchallDoctorDiagnosis($staffid){

			$sql = "SELECT records.*, concat(patient.patient_fname,' ', patient.patient_lname,' ', patient.patient_othername) AS 'Patient',					 
					concat(staff.firstname,' ',staff.lastname) AS 'Doctor' 
					FROM records LEFT JOIN patient on patient.patient_id=records.patient_id
					LEFT JOIN staff on staff.staff_id=records.staff_id WHERE records.staff_id='$staffid'";

			if ($result = $this->diag->dbcon->query($sql)){

				$output = $result->fetch_all(MYSQLI_ASSOC);

			} else {
				echo $this->diag->dbcon->error;
			}

			return $output;
		}



		#*****************FUNCTION TO UPDATE A SINGLE DIAGNOSIS RECORD WOULD BE WRITTEN HERE**************************
		//function to update a single patient diagnosis by the doctor
		function updateDiagnosis($recordid,$patientid,$staffid,$vitalid,$prescription,$record_date,$diagnosis,$admission_stat,$disease,$discharge_date){

			$sql = "UPDATE records SET patient_id='$patientid', staff_id='$staffid', vitals_id='$vitalid', record_prescription='$prescription', 
					record_date='$record_date', diagnosis='$diagnosis', admission_stat='$admission_stat', disease='$disease', discharge_date='$discharge_date' 
					WHERE record_id='$recordid'";

			if ($this->diag->dbcon->query($sql)) {

				return true;

			} else {

				return false;
			}

		}
		

		//function to delete a single patientdiagnosis record
		function deleteDiagnosis($diagid){

			$sql = "DELETE FROM record WHERE record_id='$diagid'";

			if ($this->diag->dbcon->query($sql)) {
					#if it is successfull return the message below
					$response = "Patient's Diagnosis record has been deleted";
					return $response;

				} else {
					echo "Error: ".$this->vital->dbcon->error;
				}

		}


	}

?>