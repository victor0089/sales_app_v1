<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch deposit and withdraw data
$result = $conn->query("SELECT * FROM deposit_withdraw");
$transactions = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit and Withdraw</title>
</head>
<body>
    <h1>Deposit and Withdraw</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Entry Date</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Type</th>
        </tr>
        <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><?= $transaction['id'] ?></td>
                <td><?= $transaction['entry_date'] ?></td>
                <td><?= $transaction['description'] ?></td>
                <td><?= $transaction['amount'] ?></td>
                <td><?= $transaction['type'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
