<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch sales and expense data
$resultSales = $conn->query("SELECT SUM(total_amount) AS total_sales FROM invoices");
$resultExpenses = $conn->query("SELECT SUM(amount) AS total_expenses FROM expenses");

$salesData = $resultSales->fetch_assoc();
$expensesData = $resultExpenses->fetch_assoc();

$totalSales = $salesData['total_sales'] ?? 0;
$totalExpenses = $expensesData['total_expenses'] ?? 0;

$netIncome = $totalSales - $totalExpenses;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Statement</title>
</head>
<body>
    <h1>Income Statement</h1>

    <p>Total Sales: $<?= $totalSales ?></p>
    <p>Total Expenses: $<?= $totalExpenses ?></p>
    <p>Net Income: $<?= $netIncome ?></p>
</body>
</html>
