<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../Models/Student.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new Student($db);
    $stmt = $items->getStudents();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $studentArr = array();
        $studentArr["data"] = array();
        $studentArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "ID" => $row["id"],
                "FirstName" => $row["FirstName"],
                "LastName" => $row["LastName"],
                "Entrance Date" => $row["Entrance Date"]
            );
            array_push($studentArr["data"], $e);
        }
        echo json_encode($studentArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>