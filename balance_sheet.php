<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch asset and liability data
$resultAssets = $conn->query("SELECT SUM(quantity * price) AS total_assets FROM inventory");
$resultLiabilities = $conn->query("SELECT SUM(amount) AS total_liabilities FROM expenses");

$assetsData = $resultAssets->fetch_assoc();
$liabilitiesData = $resultLiabilities->fetch_assoc();

$totalAssets = $assetsData['total_assets'] ?? 0;
$totalLiabilities = $liabilitiesData['total_liabilities'] ?? 0;

$equity = $totalAssets - $totalLiabilities;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Sheet</title>
</head>
<body>
    <h1>Balance Sheet</h1>

    <p>Total Assets: $<?= $totalAssets ?></p>
    <p>Total Liabilities: $<?= $totalLiabilities ?></p>
    <p>Equity: $<?= $equity ?></p>
</body>
</html>
