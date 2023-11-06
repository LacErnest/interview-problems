<?php

/**
 * Let's suppose you have to retrieve 10 000 records from the database and store it in a file. Write a php script or function to do this ; don't forget you don't have much memory space, so you should optimize your script; 
 * also it is mysql database; 

 * At the end we want you to generate a csv file that is goint to have all 10000 records; 
 * columns(name, price, description, quantity, createdAt, createdBy). 
 * Explain your logic and use good practice (DRY, design pattern, type hinting)
 */
class DBConn {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $host = 'localhost';
        $db   = 'database';
        $user = 'username';
        $pass = 'password';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->conn = new PDO($dsn, $user, $pass, $options);
    }

    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new DBConn();
        }

        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}

function getRecords($pdo, $limit, $offset) {
    $stmt = $pdo->prepare('SELECT name, price, description, quantity, createdAt, createdBy FROM table LIMIT :limit OFFSET :offset');
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        yield $row;
    }
}

function createCSV($pdo, $filename) {
    $file = fopen($filename, 'w');
    $limit = 1000;

    for($offset = 0; $offset < 10000; $offset += $limit) {
        foreach(getRecords($pdo, $limit, $offset) as $row) {
            fputcsv($file, $row);
        }
    }

    fclose($file);
}

$pdo = DBConn::getInstance()->getConnection();
createCSV($pdo, 'output.csv');
