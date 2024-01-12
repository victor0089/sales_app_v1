<?php
require_once 'auth.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $credit_limit = $_POST["credit_limit"];

    // Insert new customer into the database
    $conn->query("INSERT INTO customers (name, credit_limit) VALUES ('$name', $credit_limit)");

    header("Location: customers.php");
    exit();
}
?>
