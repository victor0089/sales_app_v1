<?php
require_once 'auth.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    // Delete customer from the database
    $conn->query("DELETE FROM customers WHERE id = $id");

    header("Location: customers.php");
    exit();
}
?>
