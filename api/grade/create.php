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
    // check if it set or not with isset()
    if(trim(@$data->CourseID) != "" || trim(@$data->StudentID) != "" || trim(@$data->Year) != "" || trim(@$data->Semester) != "" || trim(@$data->Score) != ""){
        $item->CourseID = $data->CourseID;
        $item->StudentID = $data->StudentID;
        $item->Year = $data->Year;
        $item->Semester = $data->Semester;
        $item->Score = $data->Score;

    }else{
        http_response_code(400);
        echo json_encode(
            array("message" => "Missing parameters!")
        );
        die();
    }
    
    if($item->createGrade()){
        http_response_code(200);
        echo json_encode(
            array("message" => "Grade created successfully.")
        );
        
    } else{
        http_response_code(400);
        echo json_encode(
            array("message" => "Grade could not be created.")
        );
    }
?>