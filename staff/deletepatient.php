<?php
	include '../class/phmsclasses.php';  

	$admin = new Patient;

	$response = $admin->deletePatient($_GET['patientid']);

	header("Location: fetchallpatient.php?msg=$response");

	exit();


?>