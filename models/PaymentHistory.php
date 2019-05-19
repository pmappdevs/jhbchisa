<?php

    class PaymentHistory {

         private $conn;
         private $table = 'payment_history';    
 
         public function __construct($db)
         {
             $this->conn = $db;
         }
 
         public function read() {
 
             $query = 'SELECT 
                 patient_prn as id, 
                 patient_visit_date as visit_date, 
                 patient_payment_particulars as particulars,
                 patient_bill_amount as bill_amount, 
                 patient_amount_paid as amount_paid, 
                 patient_amount_balance as amount_bal,
                 patient_total_amount as total_amount
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
                patient_payment_particulars as particulars, 
                patient_bill_amount as bill_amount, 
                patient_amount_paid as amount_paid, 
                patient_amount_balance as amount_bal,
                patient_total_amount as total_amount
             )
             VALUES(
                 :id,
                 :visit_date,
                 :particulars,
                 :bill_amount,
                 :amount_paid,
                 :amount_bal,
                 :total_amount
             )';
 
             $stmt = $this->conn->prepare($query);    
             if (isset($newDetails['id']) && isset($newDetails['visit_date'])) {
                     $flag = true;
             }else {
                 $flag = false;
             }
 
             if ($flag) {
                 $id = htmlspecialchars(strip_tags($newDetails['id']));
                 $visit_date = htmlspecialchars(strip_tags($newDetails['visit_date']));
                 $particulars = htmlspecialchars(strip_tags($newDetails['particulars']));
                 $bill_amount = htmlspecialchars(strip_tags($newDetails['bill_amount']));
                 $amount_paid = htmlspecialchars(strip_tags($newDetails['amount_paid']));
                 $amount_bal = htmlspecialchars(strip_tags($newDetails['amount_bal']));
                 $total_amount = htmlspecialchars(strip_tags($newDetails['total_amount']));
             
                 $stmt->bindParam(":id", $id);
                 $stmt->bindParam(":visit_date", $visit_date);
                 $stmt->bindParam(":particulars", $particulars);
                 $stmt->bindParam(":bill_amount", $bill_amount);
                 $stmt->bindParam(":amount_paid", $amount_paid);
                 $stmt->bindParam(":amount_bal", $amount_bal);
                 $stmt->bindParam(":total_amount", $total_amount);

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
                patient_payment_particulars as particulars, 
                patient_bill_amount as bill_amount, 
                patient_amount_paid as amount_paid, 
                patient_amount_balance as amount_bal,
                patient_total_amount as total_amount
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
                patient_payment_particulars as particulars, 
                patient_bill_amount as bill_amount, 
                patient_amount_paid as amount_paid, 
                patient_amount_balance as amount_bal,
                patient_total_amount as total_amount
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