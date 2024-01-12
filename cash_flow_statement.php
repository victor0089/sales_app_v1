<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch data for cash inflows (sales) and outflows (expenses)
$resultSales = $conn->query("SELECT SUM(total_amount) AS total_cash_inflows FROM invoices");
$resultExpenses = $conn->query("SELECT SUM(amount) AS total_cash_outflows FROM expenses");

$salesData = $resultSales->fetch_assoc();
$expensesData = $resultExpenses->fetch_assoc();

$totalCashInflows = $salesData['total_cash_inflows'] ?? 0;
$totalCashOutflows = $expensesData['total_cash_outflows'] ?? 0;

$netCashFlow = $totalCashInflows - $totalCashOutflows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Flow Statement</title>
</head>
<body>
    <h1>Cash Flow Statement</h1>

    <p>Total Cash Inflows: $<?= $totalCashInflows ?></p>
    <p>Total Cash Outflows: $<?= $totalCashOutflows ?></p>
    <p>Net Cash Flow: $<?= $netCashFlow ?></p>
</body>
</html>
