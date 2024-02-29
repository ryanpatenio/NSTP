<?php

class Database {
    private $conn;

    // Constructor to establish database connection
    public function __construct($host, $username, $password, $database) {
        $this->conn = mysqli_connect($host, $username, $password, $database);

        // Check connection
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    // Method to sanitize user input
    public function sanitizeInput($input) {
        return mysqli_real_escape_string($this->conn, $input);
    }

    // Method to execute a query
    public function query($sql) {
        $result = mysqli_query($this->conn, $sql);

        // Check for errors
        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        }

        return $result;
    }

    // Method to fetch data from the result set
    public function fetchAssoc($result) {
        return mysqli_fetch_assoc($result);
    }

    // Method to free the result set
    public function freeResult($result) {
        mysqli_free_result($result);
    }

    // Method to close the database connection
    public function closeConnection() {
        mysqli_close($this->conn);
    }
}

// Usage example:

// Create a new Database object
$db = new Database("localhost", "username", "password", "database_name");

// Sample user input
$user_input = $_POST['user_input']; // Assuming user input is received via POST method

// Sanitize the user input
$sanitized_input = $db->sanitizeInput($user_input);

// Construct the SQL query using the sanitized input
$sql = "SELECT * FROM users WHERE username = '$sanitized_input'";

// Execute the query
$result = $db->query($sql);

// Fetch and process the data
while ($row = $db->fetchAssoc($result)) {
    // Process the fetched data
    // For example, echo $row['column_name'];
}

// Free the result set
$db->freeResult($result);

// Close the database connection
$db->closeConnection();

?>