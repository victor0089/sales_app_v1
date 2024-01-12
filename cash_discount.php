<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch cash discount data
$result = $conn->query("SELECT * FROM cash_discount");
$discounts = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Discount</title>
</head>
<body>
    <h1>Cash Discount</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Entry Date</th>
            <th>Description</th>
            <th>Amount</th>
        </tr>
        <?php foreach ($discounts as $discount): ?>
            <tr>
                <td><?= $discount['id'] ?></td>
                <td><?= $discount['entry_date'] ?></td>
                <td><?= $discount['description'] ?></td>
                <td><?= $discount['amount'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
