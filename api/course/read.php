<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../Models/Course.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new Course($db);
    $stmt = $items->getCourses();
    $itemCount = $stmt->rowCount();

    
    if($itemCount > 0){
        
        $courseArr = array();
        $courseArr["data"] = array();
        $courseArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);


            $e = array(
                "id" => $ID,
                "Title" => $Title,
            );

            array_push($courseArr["data"], $e);
        }
        echo json_encode($courseArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>