<?php
require_once 'auth.php';
require_once 'config.php';

// Add your sales module code here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... Existing code ...

    // Update daily record for income
    $conn->query("INSERT INTO daily_records (record_date, income) VALUES (CURDATE(), $total)");

?>
