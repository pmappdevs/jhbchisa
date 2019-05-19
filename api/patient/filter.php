<?php

    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once 'helper.php';

    $data = json_decode(file_get_contents("php://input"), true);
    
    $filter_data = '';

    if (isset($data['id'])) {
        $filter_obj = "patient_prn = '$data[id]' ";
        if (empty($filter_data)) {
            $filter_data = $filter_data . $filter_obj;
        }else {
            $filter_data = $filter_data . " AND " . $filter_obj;
        }
    }

    if (isset($data['reg_date'])) {
        $filter_obj = "patient_reg_date = '$data[reg_date]' ";
        if (empty($filter_data)) {
            $filter_data = $filter_data . $filter_obj;
        }else {
            $filter_data = $filter_data . " AND " . $filter_obj;
        }
    }

    if (isset($data['name'])) {
        $filter_obj = "patient_name = '$data[name]' ";
        if (empty($filter_data)) {
            $filter_data = $filter_data . $filter_obj;
        }else {
            $filter_data = $filter_data . " AND " . $filter_obj;
        }
    }

    if (isset($data['surname'])) {
        $filter_obj = "patient_surname = '$data[surname]' ";
        if (empty($filter_data)) {
            $filter_data = $filter_data . $filter_obj;
        }else {
            $filter_data = $filter_data . " AND " . $filter_obj;
        }
    }

    if (isset($data['middle_name'])) {
        $filter_obj = "patient_middle_name = '$data[middle_name]' ";
        if (empty($filter_data)) {
            $filter_data = $filter_data . $filter_obj;
        }else {
            $filter_data = $filter_data . " AND " . $filter_obj;
        }
    }

    if (isset($data['gender'])) {
        $filter_obj = "patient_gender = '$data[gender]' ";
        if (empty($filter_data)) {
            $filter_data = $filter_data . $filter_obj;
        }else {
            $filter_data = $filter_data  . " AND " . $filter_obj;
        }
    }

    if(isset($data['age'])) {
        $filter_obj = "patient_age = '$data[age]' ";
        if (empty($filter_data)) {
            $filter_data = $filter_data . $filter_obj;
        }else {
            $filter_data = $filter_data . " AND " . $filter_obj;
        }
    }

    if(isset($data['dob'])) {
        $filter_obj = "patient_dob = '$data[dob]' ";
        if (empty($filter_data)) {
            $filter_data = $filter_data . $filter_obj;
        }else {
            $filter_data = $filter_data . " AND " . $filter_obj;
        }
    }

    if(isset($data['mobile_number'])) {
        $filter_obj = "patient_mobile_num = '$data[mobile_number]' ";
        if (empty($filter_data)) {
            $filter_data = $filter_data . $filter_obj;
        }else {
            $filter_data = $filter_data . " AND " . $filter_obj;
        }
    }

    if(isset($data['emergency_name'])) {
        $filter_obj = "patient_emergency_name = '$data[emergency_name]' ";
        if (empty($filter_data)) {
            $filter_data = $filter_data . $filter_obj;
        }else {
            $filter_data = $filter_data . " AND " . $filter_obj;
        }
    }

    if(isset($data['emergency_contact'])) {
        $filter_obj = "patient_emergency_num = '$data[emergency_contact]' ";
        if (empty($filter_data)) {
            $filter_data = $filter_data . $filter_obj;
        }else {
            $filter_data = $filter_data . " AND " . $filter_obj;
        }
    }

    if(isset($data['email_id'])) {
        $filter_obj = "patient_email_id = '$data[email_id]' ";
        if (empty($filter_data)) {
            $filter_data = $filter_data . $filter_obj;
        }else {
            $filter_data = $filter_data . " AND " . $filter_obj;
        }
    }

    $result = $patients->filter($filter_data);

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