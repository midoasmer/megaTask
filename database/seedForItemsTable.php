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

// sql to insert data in table
for($i=1;$i<=100;$i++){
    $name = 'item'.$i;
    $price = rand(100,5000);
    $sql = "INSERT INTO items (name, category, color, user_id, price) VALUES ('$name', '1', 'blue', '2', '$price')";
    $conn->query($sql);
}
//if ($conn->query($sql) === TRUE) {
//    echo "Table items created successfully";
//} else {
//    echo "Error creating table: " . $conn->error;
//}

$conn->close();
?>