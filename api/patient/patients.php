<?php

    include_once 'helper.php';

    $result = $patients->read();

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