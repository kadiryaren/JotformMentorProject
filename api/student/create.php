<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../Models/Student.php';
    
    $database = new Database();
    $db = $database->getConnection();
    $item = new Student($db);
    $data = json_decode(file_get_contents("php://input"));
 
    // check if it set or not with isset()
    if(trim(@$data->FirstName) != "" || trim(@$item->LastName) != "" || trim(@$item->Entrance_Date) != "" ){
        $item->FirstName = $data->FirstName;
        $item->LastName = $data->LastName;
        $item->Entrance_Date = $data->{"Entrance Date"};
    }else{

        http_response_code(400);
        echo json_encode(
            array("message" => "Missing parameters!")
        );
        die();
    }
    
    if($item->createStudent()){
        http_response_code(200);
        echo json_encode(
            array("message" => "Student created successfully.")
        );
        
    } else{
        http_response_code(400);
        echo json_encode(
            array("message" => "Student could not be created.")
        );
    }
?>