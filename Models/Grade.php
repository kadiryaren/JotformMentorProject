<?php
    class Grade{

        private $conn;
        private $db_table = "grades";
  
        public $ID;
        public $CourseID;
        public $StudentID;
        public $Year;
        public $Semester;
        public $Score;
 
        public function __construct($db){
            $this->conn = $db;
        }

        public function getGrades(){
            $sqlQuery = "SELECT ID, CourseID, StudentID, Year ,Semester,Score FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function createGrade(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    CourseID = :CourseID, 
                    StudentID = :StudentID, 
                    Year = :Year, 
                    Semester = :Semester, 
                    Score = :Score";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->CourseID=htmlspecialchars(strip_tags($this->CourseID));
            $this->StudentID=htmlspecialchars(strip_tags($this->StudentID));
            $this->Year=htmlspecialchars(strip_tags($this->Year));
            $this->Semester=htmlspecialchars(strip_tags($this->Semester));
            $this->Score=htmlspecialchars(strip_tags($this->Score));
           
            $stmt->bindParam(":CourseID", $this->CourseID);
            $stmt->bindParam(":StudentID", $this->StudentID);
            $stmt->bindParam(":Year", $this->Year);
            $stmt->bindParam(":Semester", $this->Semester);
            $stmt->bindParam(":Score", $this->Score);

           
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

         public function getSingleGrade(){
            $sqlQuery = "SELECT
                        ID, 
                        CourseID,
                        StudentID,
                        Year,
                        Semester,
                        Score
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
 
            $this->CourseID = $dataRow['CourseID'];
            $this->StudentID = $dataRow['StudentID'];
            $this->Year = $dataRow['Year'];
            $this->Semester = $dataRow['Semester'];
            $this->Score = $dataRow['Score'];
            

            return true;
        } 

        public function updateGrade(){

            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    CourseID = :CourseID, 
                    StudentID = :StudentID, 
                    Year = :Year, 
                    Semester = :Semester, 
                    Score = :Score
                    WHERE 
                        ID = :ID";
        
            $stmt = $this->conn->prepare($sqlQuery);

            $this->CourseID=htmlspecialchars(strip_tags($this->CourseID));
            $this->StudentID=htmlspecialchars(strip_tags($this->StudentID));
            $this->Year=htmlspecialchars(strip_tags($this->Year));
            $this->Semester=htmlspecialchars(strip_tags($this->Semester));
            $this->Score=htmlspecialchars(strip_tags($this->Score));
            $this->ID=htmlspecialchars(strip_tags($this->ID));
        
            $stmt->bindParam(":CourseID", $this->CourseID);
            $stmt->bindParam(":StudentID", $this->StudentID);
            $stmt->bindParam(":Year", $this->Year);
            $stmt->bindParam(":Semester", $this->Semester);
            $stmt->bindParam(":Score", $this->Score);
            $stmt->bindParam(":ID", $this->ID);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        function deleteGrade(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE ID = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->ID=htmlspecialchars(strip_tags($this->ID));
        
            $stmt->bindParam(1, $this->ID);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>