<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch invoices data
$result = $conn->query("SELECT * FROM invoices");
$invoices = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
