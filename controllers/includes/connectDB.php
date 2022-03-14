<?php 
    class connectDB{

        private $servername;
        private $username;
        private $password;
        private $database;

        public function connect(){

            $this->servername = "localhost";
            $this->username = "root";
            $this->password = "";
            $this->database = "webpj";

            try {
                $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->database."", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->exec("set names utf8");
                return $conn;
            }catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }