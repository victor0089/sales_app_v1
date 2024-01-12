<?php
require_once 'auth.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $invoice_id = $_GET["id"];

    // Fetch invoice data
    $resultInvoice = $conn->query("SELECT * FROM invoices WHERE id = $invoice_id");
    $invoice = $resultInvoice->fetch_assoc();

    // Fetch customer data
    $resultCustomer = $conn->query("SELECT name FROM customers WHERE id = " . $invoice['customer_id']);
    $customer = $resultCustomer->fetch_assoc();

    // Fetch items in the invoice
    $resultItems = $conn->query("SELECT products.name AS product_name, invoice_items.quantity, invoice_items.total_amount
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
    <title>View Invoice</title>
</head>
<body>
    <h1>View Invoice</h1>

    <p>Invoice ID: <?= $invoice['id'] ?></p>
    <p>Customer: <?= $customer['name'] ?></p>
    <p>Total Amount: <?= $invoice['total_amount'] ?></p>

    <table border="1">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Total Amount</th>
        </tr>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= $item['product_name'] ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><?= $item['total_amount'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
