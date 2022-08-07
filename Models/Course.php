<?php
    class Course{
      
        private $conn;
        private $db_table = "courses";

        public $ID;
        public $Title;

        public function __construct($db){
            $this->conn = $db;
        }

        public function getCourses(){
            $sqlQuery = "SELECT ID, Title FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function createCourse(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    Title = :Title";
        
            $stmt = $this->conn->prepare($sqlQuery);
        

            $this->Title=htmlspecialchars(strip_tags($this->Title));
            $stmt->bindParam(":Title", $this->Title);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function getSingleCourse(){
            $sqlQuery = "SELECT
                        ID, 
                        Title
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       ID = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->ID,PDO::PARAM_STR);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if($dataRow == false){
                return false;
            }
            $this->Title = $dataRow['Title'];
        } 

        public function updateCourse(){

           
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    Title = :Title 
                   
                    WHERE 
                        ID = :ID";
        
            $stmt = $this->conn->prepare($sqlQuery);

        
            $this->Title=htmlspecialchars(strip_tags($this->Title));
            $this->ID=htmlspecialchars(strip_tags($this->ID));
        
            $stmt->bindParam(":Title", $this->Title);
            $stmt->bindParam(":ID", $this->ID);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        function deleteCourse(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE ID = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->ID));
            $stmt->bindParam(1, $this->ID);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>