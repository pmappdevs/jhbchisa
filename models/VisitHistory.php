<?php

    class VisitHistory {

        private $conn;
        private $table = 'visit_history';    

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function read() {

            $query = 'SELECT 
                patient_prn as id, 
                patient_visit_date as visit_date, 
                patient_diagnosis_details as diagnosis, 
                patient_prescription_details as prescription, 
                patient_amount_paid as amount_paid, 
                patient_visit_reason as visit_reason
            FROM 
                ' .$this->table .'
            ORDER BY
                patient_visit_date DESC';

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        
        }




        public function insert($newDetails) {
            $flag = false;
            $query = 'INSERT INTO ' . $this->table . '(
                patient_prn as id, 
                patient_visit_date as visit_date, 
                patient_diagnosis_details as diagnosis, 
                patient_prescription_details as prescription, 
                patient_amount_paid as amount_paid, 
                patient_visit_reason as visit_reason
            )
            VALUES(
                :id,
                :visit_date,
                :diagnosis,
                :prescription,
                :amount_paid,
                :visit_reason
            )';

            $stmt = $this->conn->prepare($query);    
            if (isset($newDetails['id']) && isset($newDetails['visit_date']) && 
                isset($newDetails['visit_reason'])) {
                    $flag = true;
            }else {
                $flag = false;
            }

            if ($flag) {
                $id = htmlspecialchars(strip_tags($newDetails['id']));
                $visit_date = htmlspecialchars(strip_tags($newDetails['visit_date']));
                $diagnosis = htmlspecialchars(strip_tags($newDetails['diagnosis']));
                $prescription = htmlspecialchars(strip_tags($newDetails['prescription']));
                $amount_paid = htmlspecialchars(strip_tags($newDetails['amount_paid']));
                $visit_reason = htmlspecialchars(strip_tags($newDetails['visit_reason']));
            
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":visit_date", $visit_date);
                $stmt->bindParam(":diagnosis", $diagnosis);
                $stmt->bindParam(":prescription", $prescription);
                $stmt->bindParam(":amount_paid", $amount_paid);
                $stmt->bindParam(":visit_reason", $visit_reason);
    
                print_r($stmt);
    
                if($stmt->execute()) {
                    return true;
                }else {
                    return false;
                } 
            }else {
                return false;
            }
                      
        }


        public function filter($filter_by) {
            print_r($filter_by);
            $query = 'SELECT
                patient_prn as id, 
                patient_visit_date as visit_date, 
                patient_diagnosis_details as diagnosis, 
                patient_prescription_details as prescription, 
                patient_amount_paid as amount_paid, 
                patient_visit_reason as visit_reason
            FROM ' . $this->table . '
            WHERE ' .$filter_by . '
            ORDER BY
                patient_visit_date
            DESC';

            $stmt = $this->conn->prepare($query);
            if($stmt->execute()) {
                return $stmt;
            }else {
                return $stmt;
            }  
        }


        public function search($key) {
            
            $columns = $this->getAllColumns($key);

            $query = 'SELECT 
                patient_prn as id, 
                patient_visit_date as visit_date, 
                patient_diagnosis_details as diagnosis, 
                patient_prescription_details as prescription, 
                patient_amount_paid as amount_paid, 
                patient_visit_reason as visit_reason
            FROM 
                ' .$this->table .'
            WHERE ';

            $query .= implode(" OR ", $columns);
            print_r($query);
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        private function getAllColumns($key) {
            $columns = Array();
            $colQuery = $this->conn->prepare("SHOW COLUMNS FROM $this->table");
            $colQuery->execute();
            while ($result_colSQL = $colQuery->fetch(PDO::FETCH_ASSOC)) {
                $columns[] = $result_colSQL['Field']." LIKE ('%".$key."%')";
            }
            return $columns;
        }

    }


?>