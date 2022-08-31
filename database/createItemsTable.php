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
$sql = "CREATE TABLE items (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
category VARCHAR(30) NOT NULL,
color VARCHAR(50),
user_id INT(6) UNSIGNED,  
price VARCHAR(50)
)";
$conn->query($sql);
//if ($conn->query($sql) === TRUE) {
//    echo "Table items created successfully";
//} else {
//    echo "Error creating table: " . $conn->error;
//}

$conn->close();
?>