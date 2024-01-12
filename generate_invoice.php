<?php
require_once 'auth.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST["customer_id"];
    $items = $_POST["items"];
    $total_amount = 0;

    // Insert new invoice into the invoices table
    $conn->query("INSERT INTO invoices (customer_id, invoice_date) VALUES ($customer_id, NOW())");
    $invoice_id = $conn->insert_id;

    // Insert items into the invoice_items table
    foreach ($items as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];

        // Fetch product price from the products table
        $result = $conn->query("SELECT price FROM products WHERE id = $product_id");
        $row = $result->fetch_assoc();
        $price = $row['price'];

        // Calculate total amount for the item
        $item_total = $quantity * $price;
        $total_amount += $item_total;

        // Insert item into the invoice_items table
        $conn->query("INSERT INTO invoice_items (invoice_id, product_id, quantity, total_amount) VALUES ($invoice_id, $product_id, $quantity, $item_total)");

        // Update inventory quantity
        $conn->query("UPDATE inventory SET quantity = quantity - $quantity WHERE product_id = $product_id");
    }

    // Update the total amount in the invoices table
    $conn->query("UPDATE invoices SET total_amount = $total_amount WHERE id = $invoice_id");

    header("Location: view_invoice.php?id=$invoice_id");
    exit();
}

// Fetch customer data for the dropdown
$resultCustomers = $conn->query("SELECT id, name FROM customers");
$customers = $resultCustomers->fetch_all(MYSQLI_ASSOC);

// Fetch product data for the dropdown
$resultProducts = $conn->query("SELECT id, name FROM products");
$products = $resultProducts->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Invoice</title>
</head>
<body>
    <h1>Generate Invoice</h1>

    <form method="post" action="">
        <label for="customer_id">Select Customer:</label>
        <select name="customer_id" id="customer_id" required>
            <?php foreach ($customers as $customer): ?>
                <option value="<?= $customer['id'] ?>"><?= $customer['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <table border="1">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
            </tr>
            <tr>
                <td>
                    <select name="items[0][product_id]" required>
                        <?php foreach ($products as $product): ?>
                            <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><input type="number" name="items[0][quantity]" min="1" value="1" required></td>
            </tr>
            <!-- You can add more rows dynamically using JavaScript -->
        </table>

        <button type="submit">Generate Invoice</button>
    </form>
</body>
</html>
