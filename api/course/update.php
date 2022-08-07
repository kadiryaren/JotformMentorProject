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
    
    $item->ID = @$data->ID;
    $item->Title = @$data->Title;

    if(trim($item->ID) == "" || trim($item->Title) == "" || !isset($item->ID)|| !isset($item->Title) ){
        http_response_code(400);
        echo json_encode(["message" => "Missing parameters!"]);
        die();
    }
   
    
    if($item->updateCourse()){
        http_response_code(200);
        echo json_encode(["message" => "Course data updated."]);
        die();

    } else{
            http_response_code(400);
            echo json_encode(["message" => "Course could not be updated"]);
            die();
    }
?>