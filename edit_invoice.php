<?php
require_once 'auth.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $invoice_id = $_GET["id"];

    // Fetch invoice data
    $resultInvoice = $conn->query("SELECT * FROM invoices WHERE id = $invoice_id");
    $invoice = $resultInvoice->fetch_assoc();

    // Fetch items in the invoice
    $resultItems = $conn->query("SELECT products.name AS product_name, invoice_items.quantity
                                  FROM invoice_items
                                  JOIN products ON invoice_items.product_id = products.id
                                  WHERE invoice_id = $invoice_id");
    $items = $resultItems->fetch_all(MYSQLI_ASSOC);
} else {
    header("Location: invoices.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Invoice</title>
</head>
<body>
    <h1>Edit Invoice</h1>

    <p>Invoice ID: <?= $invoice['id'] ?></p>
    <p>Customer ID: <?= $invoice['customer_id'] ?></p>
    <p>Total Amount: <?= $invoice['total_amount'] ?></p>

    <table border="1">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
        </tr>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= $item['product_name'] ?></td>
                <td><?= $item['quantity'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Add form for editing invoice details if needed -->

</body>
</html>
