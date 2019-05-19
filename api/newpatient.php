<?php

    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../api/helper.php';

    $data = json_decode(file_get_contents("php://input"));
    
    $patients->id = $data->id;
    $patients->name = $data->name;
    $patients->surname = $data->surname;
    $patients->middle_name = $data->middle_name;
    $patients->gender = $data->gender;
    $patients->age = $data->age;
    $patients->dob = $data->dob;
    $patients->mobile_number = $data->mobile_number;
    $patients->emergency_name = $data->emergency_name;
    $patients->emergency_contact = $data->emergency_contact;
    $patients->email_id = $data->email_id;

    if($patients->insert()) {
        echo json_encode(
            array('message' => 'Patient Added')
        );

    }else {
        echo json_encode(
            array('message' => 'Patient failed to add')
        );
    }

?>