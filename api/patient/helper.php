<?php

    header('ACCESS-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/PatientInfo.php';


    //Instantiate DB
    $database = new Database();
    $db = $database->connect();

    $patients = new PatientInfo($db);

?>
