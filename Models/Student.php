<?php
    class Student{

        private $conn;
        private $db_table = "student";

        public $ID;
        public $FirstName;
        public $LastName;
        public $Entrance_Date;
 

        public function __construct($db){
            $this->conn = $db;
        }


        public function getStudents(){
            $sqlQuery = "SELECT id, FirstName, LastName, `Entrance Date` FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }


        public function createStudent(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        FirstName = :FirstName, 
                        LastName = :LastName, 
                        `Entrance Date` = :Entrance_Date";
        
            $stmt = $this->conn->prepare($sqlQuery);
        

            $this->FirstName=htmlspecialchars(strip_tags($this->FirstName));
            $this->LastName=htmlspecialchars(strip_tags($this->LastName));
            $this->Entrance_Date=htmlspecialchars(strip_tags($this->Entrance_Date));
           
        
      
            $stmt->bindParam(":FirstName", $this->FirstName);
            $stmt->bindParam(":LastName", $this->LastName);
            $stmt->bindParam(":Entrance_Date", $this->Entrance_Date);
           
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

         // READ single
         // single execute false donmesini kontrol et
         public function getSingleStudent(){
            $sqlQuery = "SELECT
                        ID, 
                        FirstName,
                        LastName,
                        `Entrance Date`
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
        
            $this->FirstName = $dataRow['FirstName'];
            $this->LastName = $dataRow['LastName'];
            $this->Entrance_Date = $dataRow['Entrance Date'];

            return true;
            
        } 

        // UPDATE
        public function updateStudent(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    FirstName = :FirstName, 
                    LastName = :LastName, 
                    `Entrance Date` = :Entrance_Date
                    WHERE 
                        ID = :ID";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->FirstName=htmlspecialchars(strip_tags($this->FirstName));
            $this->LastName=htmlspecialchars(strip_tags($this->LastName));
            $this->Entrance_Date=htmlspecialchars(strip_tags($this->Entrance_Date));
            $this->ID=htmlspecialchars(strip_tags($this->ID));
        
            // bind data
            $stmt->bindParam(":FirstName", $this->FirstName);
            $stmt->bindParam(":LastName", $this->LastName);
            $stmt->bindParam(":Entrance_Date", $this->Entrance_Date);
            $stmt->bindParam(":ID", $this->ID);
        
            if($stmt->execute()){
               return true;
            }

            return false;
        }
        // DELETE
        function deleteStudent(){
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