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
$sql = "CREATE TABLE orders (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id INT (6) UNSIGNED NOT NULL,
item_id INT(6) UNSIGNED NOT NULL,
status VARCHAR(50),
date DATE,  
address VARCHAR(50),
FOREIGN KEY(user_id) REFERENCES users(id),
FOREIGN KEY(item_id) REFERENCES items(id)
)";
$conn->query($sql);
//if ($conn->query($sql) === TRUE) {
//    echo "Table orders created successfully";
//} else {
//    echo "Error creating table: " . $conn->error;
//}

$conn->close();
?>