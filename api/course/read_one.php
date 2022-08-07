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
    
    if(isset($_GET['id'])){
        $item->ID = $_GET['id'];
        if(trim($item->ID == "")){
            http_response_code(400);
            echo json_encode(["message" => "Missing parameters!"]);
            die();
        }
    }else{
        http_response_code(400);
        echo json_encode(["message" => "Missing parameter!"]);
        die();
    }
    
  
    if(!$item->getSingleCourse()){
        
            http_response_code(404);
            echo json_encode(["message" => "Course not found."]);
            die();
    }

    if($item->ID != null){
        // create array
        $emp_arr = array(
            "ID" =>  $item->ID,
            "Title" => $item->Title
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
    else{
        http_response_code(404);
        echo json_encode(["message" => "Course not found."]);
    }
?>