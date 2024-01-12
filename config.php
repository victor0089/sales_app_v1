<?php

$servername = "your_server_name";
$username = "your_username";
$password = "your_password";
$database = "sales_app";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
