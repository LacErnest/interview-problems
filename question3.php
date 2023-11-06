<?php

/**
 * Let's suppose you have to retrieve 10 000 records from the database and store it in a file. Write a php script or function to do this ; don't forget you don't have much memory space, so you should optimize your script; 
 * also it is mysql database; 

 * At the end we want you to generate a csv file that is goint to have all 10000 records; 
 * columns(name, price, description, quantity, createdAt, createdBy). 
 * Explain your logic and use good practice (DRY, design pattern, type hinting)
 */
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct($host, $db, $user, $pass, $charset, $options) {
        $this->pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, $options);
    }

    public static function getInstance($host, $db, $user, $pass, $charset, $options) {
        if (self::$instance == null) {
            self::$instance = new Database($host, $db, $user, $pass, $charset, $options);
        }
        return self::$instance;
    }

    public function getPdo() {
        return $this->pdo;
    }
}

// Database connection parameters
$host = 'localhost';
$db   = 'database_name';
$user = 'username';
$pass = 'password';
$charset = 'utf8mb4';

// PDO options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Get the PDO instance
$pdo = Database::getInstance($host, $db, $user, $pass, $charset, $options)->getPdo();

// Open the CSV file
$file = fopen('output.csv', 'w');

// Write the header row to the CSV file
fputcsv($file, ['name', 'price', 'description', 'quantity', 'createdAt', 'createdBy']);

// Query parameters
$limit = 1000; // Fetch records in chunks of 1000
$offset = 0;

while (true) {
  // Prepare the SQL query
  $stmt = $pdo->prepare("SELECT name, price, description, quantity, createdAt, createdBy FROM table_name LIMIT :offset, :limit");
  $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
  $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

  // Execute the SQL query
  $stmt->execute();

  // Fetch the records
  $records = $stmt->fetchAll();

  // If no records were fetched, break the loop
  if (!$records) {
    break;
  }

  // Write the records to the CSV file
  foreach ($records as $record) {
    fputcsv($file, $record);
  }

  // Increase the offset for the next query
  $offset += $limit;
}

// Close the CSV file
fclose($file);
?>
