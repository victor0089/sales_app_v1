<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch purchases data
$result = $conn->query("SELECT * FROM purchases");
$purchases = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchases</title>
</head>
<body>
    <h1>Purchases</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>General Journal ID</th>
            <th>Product ID</th>
            <th>Quantity</th>
            <th>Amount</th>
        </tr>
        <?php foreach ($purchases as $purchase): ?>
            <tr>
                <td><?= $purchase['id'] ?></td>
                <td><?= $purchase['general_journal_id'] ?></td>
                <td><?= $purchase['product_id'] ?></td>
                <td><?= $purchase['quantity'] ?></td>
                <td><?= $purchase['amount'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
