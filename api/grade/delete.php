<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");

    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../Models/Grade.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Grade($db);
    
    $data = json_decode(file_get_contents("php://input"));
    $item->ID = @$data->ID;
    if(trim($item->ID) == "" || !isset($item->ID)){
        echo !isset($item->ID);
        echo trim($item->ID) == "";
        http_response_code(400);
        echo json_encode(["message" => "Missing parameters!"]);
        die();
    }
    
    if($item->deleteGrade()){
        http_response_code(200);
        echo json_encode(["message" => "Grade deleted!"]);
        die();

    } else{
        http_response_code(400);
        echo json_encode(["message" => "Grade could not be deleted!"]);
        die();
    }
?>