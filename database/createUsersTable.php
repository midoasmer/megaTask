<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "megaTask";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
email VARCHAR(30) NOT NULL,
password VARCHAR(50),
phone VARCHAR(50),  
address VARCHAR(50)
)";
$conn->query($sql);
//if ($conn->query($sql) === TRUE) {
//    echo "Table users created successfully";
//} else {
//    echo "Error creating table: " . $conn->error;
//}

$conn->close();
?>