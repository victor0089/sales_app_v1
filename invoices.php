<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch invoices data
$result = $conn->query("SELECT * FROM invoices");
$invoices = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices</title>
</head>
<body>
    <h1>Invoices</h1>

    <ul>
        <?php foreach ($invoices as $invoice): ?>
            <li>
                <a href="view_invoice.php?id=<?= $invoice['id'] ?>">Invoice #<?= $invoice['id'] ?></a>
                <?php if (isAdmin()): ?>
                    <a href="edit_invoice.php?id=<?= $invoice['id'] ?>">Edit</a>
                    <a href="delete_invoice.php?id=<?= $invoice['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php if (isAdmin()): ?>
        <p><a href="generate_invoice.php">Generate New Invoice</a></p>
    <?php endif; ?>
</body>
</html>
