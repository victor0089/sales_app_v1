<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch accounts receivable data
$result = $conn->query("SELECT * FROM accounts_receivable");
$accountsReceivable = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts Receivable</title>
</head>
<body>
    <h1>Accounts Receivable</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>General Journal ID</th>
            <th>Customer ID</th>
            <th>Amount</th>
        </tr>
        <?php foreach ($accountsReceivable as $account): ?>
            <tr>
                <td><?= $account['id'] ?></td>
                <td><?= $account['general_journal_id'] ?></td>
                <td><?= $account['customer_id'] ?></td>
                <td><?= $account['amount'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
