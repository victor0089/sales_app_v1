<?php
require_once 'auth.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $invoice_id = $_GET["id"];

    // Fetch items in the invoice
    $resultItems = $conn->query("SELECT product_id, quantity FROM invoice_items WHERE invoice_id = $invoice_id");
    $items = $resultItems->fetch_all(MYSQLI_ASSOC);

    // Update inventory quantity for each item
    foreach ($items as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];

        $conn->query("UPDATE inventory SET quantity = quantity + $quantity WHERE product_id = $product_id");
    }

    // Delete invoice from the database
    $conn->query("DELETE FROM invoices WHERE id = $invoice_id");
}

header("Location: invoices.php");
exit();
?>
