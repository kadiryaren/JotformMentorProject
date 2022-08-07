<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../Models/Grade.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new Grade($db);
    $stmt = $items->getGrades();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $gradeArr = array();
        $gradeArr["data"] = array();
        $gradeArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);


            $e = array(
                "id" => $ID,
                "CourseID" => $CourseID,
                "StudentID" => $StudentID,
 
                "Year" => $Year,
                "Semester" => $Semester,
                "Score" => $Score
            );

            array_push($gradeArr["data"], $e);
        }
        echo json_encode($gradeArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>