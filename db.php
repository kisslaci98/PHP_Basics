<?php

class DB {
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPassword = "";
    private $dbName = "testdb";
    private $conn;

    public function __construct() {
        try {
            $dsn = "mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName;
            $this->conn = new PDO($dsn, $this->dbUser, $this->dbPassword);
        }catch(PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    } 

    public function insertData($name, $email) {
        $sql = "INSERT INTO userdetails (name, email) VALUES (:name, :email)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email]);
        echo "Data inserted!";
    }

    public function getData() {
        $sql = "SELECT * FROM userdetails";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function deleteData($id) {
        $sql = "DELETE FROM userdetails WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        echo $stmt->rowCount() . " rows were affected.";
    }

    public function editData($id, $name) {
        $sql = "UPDATE userdetails SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id, 'name' => $name]);
    }
}