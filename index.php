<?php
require_once 'config.php';

// Fetch products from the database
$result = $conn->query("SELECT * FROM products");
$products = $result->fetch_all(MYSQLI_ASSOC);

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];

    // Fetch product price
    $result = $conn->query("SELECT price FROM products WHERE id = $product_id");
    $price = $result->fetch_assoc()["price"];

    // Calculate total
    $total = $quantity * $price;

    // Insert sale record into the database
    $conn->query("INSERT INTO sales (product_id, quantity, total) VALUES ($product_id, $quantity, $total)");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales App</title>
</head>
<body>
    <h1>Sales App</h1>

    <form method="post" action="">
        <label for="product_id">Product:</label>
        <select name="product_id" id="product_id">
            <?php foreach ($products as $product): ?>
                <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required>

        <button type="submit">Submit Sale</button>
    </form>
</body>
</html>
