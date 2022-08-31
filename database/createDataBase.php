<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "megaTask";

    switch ($_POST["functionname"]) {

        case 'ini':
            createConnect($servername,$username,$password,$dbname);
            break;
    }


function initDatabase($servername,$username,$password){
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) {
        return $conn->connect_error;
    }else{
//         Create database and insert seed data
        $sql = "CREATE DATABASE megaTask";
        if ($conn->query($sql) === TRUE) {
            include  __DIR__ .'/createUsersTable.php';
            include __DIR__ .'/createItemsTable.php';
            include __DIR__ .'/createOrdersTable.php';
            include __DIR__ .'/seedForUserTable.php';
            include __DIR__ .'/seedForItemsTable.php';
            include __DIR__ .'/seedForOrderTable.php';
        }
    }
}

function createConnect($servername,$username,$password,$dbname){
    // Create connection
    $conn = new mysqli($servername,$username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        if($conn->connect_errno == 1049){//chick if database are created or not
            initDatabase($servername,$username,$password);
        }
    }
}

