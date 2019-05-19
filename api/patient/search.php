<?php

    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once 'helper.php';

    $data = json_decode(file_get_contents("php://input"), true);

    $result = $patients->search($data['key']);

    $patient_count = $result->rowCount();

    if($patient_count > 0) {
        $patient_arr = array();
        while($row = $result -> fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $patient_obj = array(
                'id' => $id,
                'reg_date' => $reg_date,
                'name' => $name,
                'surname' => $surname,
                'middle_name' => $middle_name,
                'gender' => $gender,
                'age' => $age,
                'dob' => $dob,
                'mobile_number' => $mobile_number,
                'emergency_name' => $emergency_name,
                'emergency_contact' => $emergency_contact,
                'email_id' => $email_id
            );

            array_push($patient_arr, $patient_obj);
        }

        echo json_encode($patient_arr);

    }else {
        $patient_arr = array();
        echo json_encode($patient_arr);
    }

?>