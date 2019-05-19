<?php

    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once 'helper.php';

    $data = json_decode(file_get_contents("php://input"), true);

    if($patients->insert($data)) {
        echo json_encode(
            array('message' => 'Patient Added')
        );

    }else {
        echo json_encode(
            array('message' => 'Patient failed to add')
        );
    }

?>