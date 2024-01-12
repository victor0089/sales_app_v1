<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch inventory data
$result = $conn->query("SELECT * FROM inventory");
$inventoryData = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Report</title>
</head>
<body>
    <h1>Inventory Report</h1>

    <table border="1">
        <tr>
            <th>Product ID</th>
            <th>Branch ID</th>
            <th>Quantity</th>
        </tr>
        <?php foreach ($inventoryData as $item): ?>
            <tr>
                <td><?= $item['product_id'] ?></td>
                <td><?= $item['branch_id'] ?></td>
                <td><?= $item['quantity'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
