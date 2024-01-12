<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch purchases returns and allowances data
$result = $conn->query("SELECT * FROM purchases_returns_allowances");
$returnsAllowances = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchases Returns & Allowances</title>
</head>
<body>
    <h1>Purchases Returns & Allowances</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>General Journal ID</th>
            <th>Product ID</th>
            <th>Quantity</th>
            <th>Amount</th>
        </tr>
        <?php foreach ($returnsAllowances as $returnAllowance): ?>
            <tr>
                <td><?= $returnAllowance['id'] ?></td>
                <td><?= $returnAllowance['general_journal_id'] ?></td>
                <td><?= $returnAllowance['product_id'] ?></td>
                <td><?= $returnAllowance['quantity'] ?></td>
                <td><?= $returnAllowance['amount'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
