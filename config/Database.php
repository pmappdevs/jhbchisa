<?php

    class Database {

        //DB Properties
        private $host = 'localhost';
        private $db_name = 'doctorserpsystem';
        private $uname = 'root';
        private $passwd = '';
        private $conn;

        //DB Connect
        public function connect() {
            $this->conn = null;
            try {
                $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->uname,$this->passwd);
            }catch(PDOException $error) {
                echo 'Connection Failed '. $error.getMessage();
            }
            return $this->conn;
        }

    }

?>