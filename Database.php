<?php

require 'vendor/autoload.php';

class Database {
    private $conn;

    public function __construct() {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $host = '127.0.0.1';  // Use 127.0.0.1 instead of localhost
        $db_name = $_ENV['DB_NAME'];
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];
        $socket = '/var/run/mysqld/mysqld.sock'; // Optional: Path to socket if needed

        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$db_name;unix_socket=$socket", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully..."; 
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function getAllStudents() {
        $stmt = $this->conn->prepare("SELECT * FROM students");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertStudent($name, $age, $course, $email, $phone) {
        try {
            $sql = "INSERT INTO students (name, age, course, email, phone) 
                    VALUES (:name, :age, :course, :email, :phone)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':course', $course);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);

            $stmt->execute();

            return "Student added successfully!";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    
}
$db = new Database();
?>