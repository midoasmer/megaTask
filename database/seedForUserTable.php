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
    $name = 'user'.$i;
    $email = 'user'.$i.'@example.com';
    $pass = sha1('123456');
    $address = rand(1,3);
    $sql = "INSERT INTO users (name, email, password, phone, address) VALUES ('$name', '$email', '$pass', '0123456789', '$address')";
    $conn->query($sql);
}
//if ($conn->query($sql) === TRUE) {
//    echo "Table items created successfully";
//} else {
//    echo "Error creating table: " . $conn->error;
//}

$conn->close();
?>