<?php

    class PatientInfo {

        private $conn;
        private $table = 'patient_info';    

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function read() {

            $query = 'SELECT 
                patient_prn as id, 
                patient_reg_date as reg_date, 
                patient_name as name, 
                patient_surname as surname, 
                patient_middle_name as middle_name, 
                patient_gender as gender, 
                patient_age as age, 
                patient_dob as dob, 
                patient_mobile_num as mobile_number, 
                patient_emergency_name as emergency_name, 
                patient_emergency_num as emergency_contact, 
                patient_email_id as email_id
            FROM 
                ' .$this->table .'
            ORDER BY
                patient_reg_date DESC';

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        
        }




        public function insert($newDetails) {
            $flag = false;
            $query = 'INSERT INTO ' . $this->table . '(
                patient_prn,
                patient_name,
                patient_surname,
                patient_middle_name,
                patient_gender,
                patient_age,
                patient_dob,
                patient_mobile_num,
                patient_emergency_name,
                patient_emergency_num,
                patient_email_id
            )
            VALUES(
                :id,
                :name,
                :surname,
                :middle_name,
                :gender,
                :age,
                :dob,
                :mobile_number,
                :emergency_name,
                :emergency_contact,
                :email_id
            )';

            $stmt = $this->conn->prepare($query);    
            if (isset($newDetails['id']) && isset($newDetails['name']) && 
                isset($newDetails['surname']) && isset($newDetails['middle_name']) &&
                isset($newDetails['gender']) && isset($newDetails['age']) &&
                isset($newDetails['dob']) && isset($newDetails['mobile_number']) &&
                isset($newDetails['emergency_name']) && isset($newDetails['emergency_contact'])) {
                    $flag = true;
            }else {
                $flag = false;
            }

            if ($flag) {
                $id = htmlspecialchars(strip_tags($newDetails['id']));
                $name = htmlspecialchars(strip_tags($newDetails['name']));
                $surname = htmlspecialchars(strip_tags($newDetails['surname']));
                $middle_name = htmlspecialchars(strip_tags($newDetails['middle_name']));
                $gender = htmlspecialchars(strip_tags($newDetails['gender']));
                $age = htmlspecialchars(strip_tags($newDetails['age']));
                $dob = htmlspecialchars(strip_tags($newDetails['dob']));
                $mobile_number = htmlspecialchars(strip_tags($newDetails['mobile_number']));
                $emergency_name = htmlspecialchars(strip_tags($newDetails['emergency_name']));
                $emergency_contact = htmlspecialchars(strip_tags($newDetails['emergency_contact']));
                $email_id = htmlspecialchars(strip_tags($newDetails['email_id']));    
                $dob = DateTime::createFromFormat('Y-m-d', $newDetails['dob'])->format('Y-m-d');
            
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":surname", $surname);
                $stmt->bindParam(":middle_name", $middle_name);
                $stmt->bindParam(":gender", $gender);
                $stmt->bindParam(":age", $age);
                $stmt->bindParam(":dob", $dob);
                $stmt->bindParam(":mobile_number", $mobile_number);
                $stmt->bindParam(":emergency_name", $emergency_name);
                $stmt->bindParam(":emergency_contact", $emergency_contact);
                $stmt->bindParam(":email_id", $email_id);
    
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
                patient_prn AS id,
                patient_reg_date AS reg_date,
                patient_name AS name,
                patient_surname AS surname,
                patient_middle_name AS middle_name,
                patient_gender AS gender,
                patient_age AS age,
                patient_dob AS dob,
                patient_mobile_num AS mobile_number,
                patient_emergency_name AS emergency_name,
                patient_emergency_num AS emergency_contact,
                patient_email_id AS email_id
            FROM ' . $this->table . '
            WHERE ' .$filter_by . '
            ORDER BY
                patient_reg_date
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
                patient_reg_date as reg_date, 
                patient_name as name, 
                patient_surname as surname, 
                patient_middle_name as middle_name, 
                patient_gender as gender, 
                patient_age as age, 
                patient_dob as dob, 
                patient_mobile_num as mobile_number, 
                patient_emergency_name as emergency_name, 
                patient_emergency_num as emergency_contact, 
                patient_email_id as email_id
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