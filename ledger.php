<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch ledger data
$result = $conn->query("SELECT * FROM ledger");
$ledgerEntries = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledger</title>
</head>
<body>
    <h1>Ledger</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Account ID</th>
            <th>Entry Date</th>
            <th>Debit</th>
            <th>Credit</th>
        </tr>
        <?php foreach ($ledgerEntries as $entry): ?>
            <tr>
                <td><?= $entry['id'] ?></td>
                <td><?= $entry['account_id'] ?></td>
                <td><?= $entry['entry_date'] ?></td>
                <td><?= $entry['debit'] ?></td>
                <td><?= $entry['credit'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
