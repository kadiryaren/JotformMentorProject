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
    
    $item->ID = @$data->ID;
    $item->FirstName = @$data->FirstName;
    $item->LastName = @$data->LastName;
    $item->Entrance_Date = @$data->{"Entrance Date"};
   
    if(trim(@$data->ID) == "" || trim(@$data->FirstName) == "" || trim(@$data->LastName) == "" || trim(@$data->{"Entrance Date"}) == ""){
        http_response_code(400);
        echo json_encode(["message" => "Missing parameters!"]);
        die();
    }
    
    if($item->updateStudent()){
        http_response_code(200);
        echo json_encode(["message" => "Student data updated."]);
        die();

    } else{
            http_response_code(400);
            echo json_encode(["message" => "Student could not be updated"]);
            die();
    }
?>