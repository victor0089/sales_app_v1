<?php
require_once 'auth.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="sales_export.csv"');

    $output = fopen('php://output', 'w');

    // Add CSV headers
    fputcsv($output, array('Product ID', 'Quantity', 'Total', 'Sale Date'));

    // Fetch sales data from the database
    $result = $conn->query("SELECT * FROM sales");
    while ($row = $result->fetch_assoc()) {
        // Add data rows
        fputcsv($output, array($row['product_id'], $row['quantity'], $row['total'], $row['sale_date']));
    }

    fclose($output);
    exit();
}
?>

<!DOCTYPE html>
<!-- Add your export form code here -->
