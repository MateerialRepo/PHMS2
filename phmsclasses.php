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


	//Authentication class
	class Authentication{
		//member variables
		public $staff; //database handler

		//member methods
		public function __construct(){
			//create object of database
			$this->staff = new DatabaseConfig;
		}

		#function for registration
		public function stafflogin($email, $password){
			$pwd = md5($password);

			//sql statement so that landing page shows the role of the user
			//we are selecting all columns from staff table
			$sql = "SELECT * FROM staff WHERE password = '$pwd' AND email = '$email'";

			//run query
			$result = $this->staff->dbcon->query($sql);

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

			} else{
				//display the error
				//var_dump($this->user->dbcon->error); exit();
				//display invalid login credentials
				$output = "<div class='alert alert-danger'>Invalid Email address or Password</div>";
				return $output;
			}

			
		}



		//function for registering staff
		public function staffRegister($firstname, $surname, $othername, $gender, $address, $email, $password, $phone, $speciality, $stafftype){

			$pswd = md5($password);

			$sql = "INSERT INTO staff SET firstname='$firstname', lastname='$surname', othername='$othername', address='$address', email='$email', phone='$phone', gender='$gender', password='$pswd', speciality='$speciality', staff_typeid='$stafftype'";


			$result = $this->staff->dbcon->query($sql);
			$output = $this->staff->dbcon->insert_id;
			die($output);

			if (empty($output)) {
				# to show the error if the query fails to create record
				return $this->staff->dbcon->error;
				
			}else {
				//we would use this to check in our registerform validation page if registration was successful
				return $output;
			}


		}




	}


	/**
	 This is the patient class, the patients activites are listed thus: patientLogin, patientRegister, view thier profile, bookAppointments 
	 */
	class Patient
	{
		//member variables
		public $patient; //database handler

		//member methods
		public function __construct(){
			//create object of database
			$this->patient = new DatabaseConfig;
		}

		//function for Login in Patients
		public function patientLogin($email,$password){

			$password = md5($password);

			$sql = "SELECT * FROM patient WHERE patient_email= '$email' , patient_password= '$password'";

			$result = $this->patient->dbcon->query($sql);

			//check if the number of row returned is equal to one
			if ($result->num_rows == 1) {
				# to get the returned array
				$output = $result->fetch_assoc();

				//var_dump($output);

				//create the session variable
				$_SESSION['patientid'] = $output['patient_id'];
				$_SESSION['patientlname'] = $output['patient_lname'];
				$_SESSION['patientfname'] = $output['patient_fname'];
				$_SESSION[''] = $output[''];
				$_SESSION[''] = $output[''];

				#redirect to the patient dashboard
				//header("Location: dashboard.php");

			} else{
				//display the error
				//var_dump($this->user->dbcon->error); exit();
				//display invalid login credentials
				$output = "<div class='alert alert-danger'>Invalid Email address or Password</div>";
				return $output;
			}

		}

		//function for registering Patients
		public function patientRegister(){

		}
	}






?>