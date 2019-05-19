<?php

    class PatientInfo {

        private $conn;
        private $table = 'patient_info';    

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public $id;
        public $name;
        public $surname;
        public $middle_name;
        public $gender;
        public $age;
        public $dob;
        public $mobile_number;
        public $emergency_name;
        public $emergency_contact;
        public $email_id;



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




        public function insert() {

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

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->surname = htmlspecialchars(strip_tags($this->surname));
            $this->middle_name = htmlspecialchars(strip_tags($this->middle_name));
            $this->gender = htmlspecialchars(strip_tags($this->gender));
            $this->age = htmlspecialchars(strip_tags($this->age));
            $this->dob = htmlspecialchars(strip_tags($this->dob));
            $this->mobile_number = htmlspecialchars(strip_tags($this->mobile_number));
            $this->emergency_name = htmlspecialchars(strip_tags($this->emergency_name));
            $this->emergency_contact = htmlspecialchars(strip_tags($this->emergency_contact));
            $this->email_id = htmlspecialchars(strip_tags($this->email_id));    
            $this->dob = DateTime::createFromFormat('Y-m-d', $this->dob)->format('Y-m-d');
        
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":surname", $this->surname);
            $stmt->bindParam(":middle_name", $this->middle_name);
            $stmt->bindParam(":gender", $this->gender);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":dob", $this->dob);
            $stmt->bindParam(":mobile_number", $this->mobile_number);
            $stmt->bindParam(":emergency_name", $this->emergency_name);
            $stmt->bindParam(":emergency_contact", $this->emergency_contact);
            $stmt->bindParam(":email_id", $this->email_id);

            print_r($stmt);

            if($stmt->execute()) {
                return true;
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

    }

?>