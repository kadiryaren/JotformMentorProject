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
    if(trim(@$data->ID) == "" || !isset($item->ID)){
        http_response_code(400);
        echo json_encode(["message" => "Missing parameters!"]);
        die();
    }
    
    if($item->deleteStudent()){
        http_response_code(200);
        echo json_encode(["message" => "Student deleted!"]);
        die();

    } else{
        http_response_code(400);
        echo json_encode(["message" => "Student could not be deleted!"]);
        die();
    }
?>