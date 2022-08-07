<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../Models/Course.php';
    
    $database = new Database();
    $db = $database->getConnection();
    $item = new Course($db);
    $data = json_decode(file_get_contents("php://input"));
    if(trim(@$data->Title) != ""){
        $item->Title = $data->Title;
    }else{
        http_response_code(400);
        echo json_encode(
            array("message" => "Missing parameters!")
        );
        die();
    }
    
    if($item->createCourse()){
        http_response_code(200);
        echo json_encode(
            array("message" => "Course created successfully.")
        );
        
    } else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Course could not be created.")
        );
    }
?>