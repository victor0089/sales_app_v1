<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch inventory transfer data
$result = $conn->query("SELECT * FROM inventory_transfers");
$transfers = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Inventory Transfers</title>
</head>
<body>
    <h1>View Inventory Transfers</h1>

    <ul>
        <?php foreach ($transfers as $transfer): ?>
            <li>
                <p>Transfer ID: <?= $transfer['id'] ?></p>
                <p>Product ID: <?= $transfer['product_id'] ?></p>
                <p>Quantity: <?= $transfer['quantity'] ?></p>
                <p>From Branch ID: <?= $transfer['from_branch_id'] ?></p>
                <p>To Branch ID: <?= $transfer['to_branch_id'] ?></p>
                <p>Transfer Date: <?= $transfer['transfer_date'] ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
