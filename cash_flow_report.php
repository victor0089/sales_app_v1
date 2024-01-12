<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch sales data
$resultSales = $conn->query("SELECT * FROM sales");
$salesData = $resultSales->fetch_all(MYSQLI_ASSOC);

// Fetch expenses data (assuming you have an expenses table)
$resultExpenses = $conn->query("SELECT * FROM expenses");
$expensesData = $resultExpenses->fetch_all(MYSQLI_ASSOC);

// Calculate total revenue
$totalRevenue = array_sum(array_column($salesData, 'total'));

// Calculate total expenses
$totalExpenses = array_sum(array_column($expensesData, 'amount'));

// Calculate net cash flow
$netCashFlow = $totalRevenue - $totalExpenses;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Flow Report</title>
</head>
<body>
    <h1>Cash Flow Report</h1>

    <p>Total Revenue: <?= $totalRevenue ?></p>
    <p>Total Expenses: <?= $totalExpenses ?></p>
    <p>Net Cash Flow: <?= $netCashFlow ?></p>
</body>
</html>
