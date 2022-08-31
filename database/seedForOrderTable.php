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
$status = ['Ordered','Delivered'];
// sql to insert data in table
for($i=1;$i<=10000;$i++){
    $user = rand(1,100);
    $item = rand(1,100);
    $statusIndex = rand(0,1);
    $address = rand(1,3);
    $sql = "INSERT INTO orders (user_id , item_id , status, address) VALUES ('$user', '$item', '$status[$statusIndex]', '$address')";
    $conn->query($sql);
}
//if ($conn->query($sql) === TRUE) {
//    echo "Table items created successfully";
//} else {
//    echo "Error creating table: " . $conn->error;
//}

$conn->close();
?>