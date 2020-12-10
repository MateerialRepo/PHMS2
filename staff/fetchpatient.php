<?php
include '../class/phmsclasses.php';

$patient = new Patient;

if (!empty($_POST['patientid'])) {
    $pid = $_POST['patientid'];
    //die($pid);

    $response = $patient->fetchSinglePatient($pid);

    $output = json_encode($response);
    //die($output)
    // return $output;
}






?>